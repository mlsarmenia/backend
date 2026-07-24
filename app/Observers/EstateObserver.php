<?php

namespace App\Observers;

use App\Models\Estate;
use App\Models\EstateDocument;
use App\Services\CurrencyRateService;
use App\Services\EstateMainImageService;
use App\Traits\GeneratesEstateCode;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Prologue\Alerts\Facades\Alert;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class EstateObserver
{
    use GeneratesEstateCode;

    /**
     * Handle the Estate "creating" event.
     */
    public function creating(Estate $estate): void
    {

        if (($estate->estate_type_id === 1 || $estate->estate_type_id === 3) &&
            isset($estate->location_street_id, $estate->address_building, $estate->address_apartment)) {

            // Check for clone with apartment
            $checkClone = Estate::where([
                ['location_province_id', '=', $estate->location_province_id],
                ['location_street_id', '=', $estate->location_street_id],
                ['address_building', '=', $estate->address_building],
                ['address_apartment', '=', $estate->address_apartment],
            ])->first();



        } elseif (($estate->estate_type_id === 2 || $estate->estate_type_id === 4) && isset( $estate->location_street_id, $estate->address_building)) {
            // Check for clone without apartment
            $checkClone = Estate::where([
                ['location_province_id', '=', $estate->location_province_id],
                ['location_street_id', '=', $estate->location_street_id],
                ['address_building', '=', $estate->address_building],
            ])->first();
        } else {
            $checkClone = null;
        }


        if ($checkClone) {
            $cloneCode = $checkClone->id;
            \Alert::add('error', 'Նման կարգավիճակով գույք կա:  <br/><a target="_blank" style="color: #000; display: block; background: #fff; padding: 5px; border-radius:4px" class="btn" href="/admin/estate/'.$cloneCode.'/show">Դիտել գույքը</a>')->flash();
            // Optionally, you can throw an exception to prevent the creation
            // Throwing a validation exception to halt the creation
            throw ValidationException::withMessages(['error' => 'This address already exists.']);
        }
    }

    /**
     * Handle the Estate "created" event.
     */
    public function created(Estate $estate): void
    {

        $estate->code = $this->generateEstateCode($estate);

        if (!empty(request()->input('location'))) {
            $location = json_decode(request()->input('location'));
            $estate->estate_latitude = $location->lat;
            $estate->estate_longitude = $location->lng;
        }


    }

    /**
     * Handle the Estate "updating" event.
     * @throws BindingResolutionException
     */
    public function updating(Estate $estate): void
    {


        $existingEstates = [];

        if (($estate->estate_type_id === 1 || $estate->estate_type_id === 3) &&
            isset($estate->location_street_id, $estate->address_building, $estate->address_apartment)) {

            // Check for clone with apartment
            $existingEstates = Estate::where([
                ['location_province_id', '=', $estate->location_province_id],
                ['location_street_id', '=', $estate->location_street_id],
                ['address_building', '=', $estate->address_building],
                ['address_apartment', '=', $estate->address_apartment],
            ])->pluck('id')->toArray();;


            $checkClone = Estate::where([
                ['location_province_id', '=', $estate->location_province_id],
                ['location_street_id', '=', $estate->location_street_id],
                ['address_building', '=', $estate->address_building],
                ['address_apartment', '=', $estate->address_apartment],
            ])->first();

        } elseif (($estate->estate_type_id === 2 || $estate->estate_type_id === 4) && isset( $estate->location_street_id, $estate->address_building)) {
            // Check for clone without apartment
            $existingEstates = Estate::where([
                ['location_province_id', '=', $estate->location_province_id],
                ['location_street_id', '=', $estate->location_street_id],
                ['address_building', '=', $estate->address_building],
            ])->pluck('id')->toArray();

            $checkClone = Estate::where([
                ['location_province_id', '=', $estate->location_province_id],
                ['location_street_id', '=', $estate->location_street_id],
                ['address_building', '=', $estate->address_building],
            ])->first();

        } else {
            $checkClone = null;
        }

        if ($checkClone && !in_array($estate->id, $existingEstates)) {
            $cloneCode = $checkClone->id;
            \Alert::add('error', 'Նման կարգավիճակով գույք կա:  <br/><a target="_blank" style="color: #000; display: block; background: #fff; padding: 5px; border-radius:4px" class="btn" href="/admin/estate/'.$cloneCode.'/show">Դիտել գույքը</a>')->flash();
            // Optionally, you can throw an exception to prevent the creation
            // Throwing a validation exception to halt the creation
            throw ValidationException::withMessages(['error' => 'This address already exists.']);
        }

        $estate->code = $this->generateEstateCode($estate);

        if (!empty(request()->input('location'))) {
            $location = json_decode(request()->input('location'));
            $estate->estate_latitude = $location->lat;
            $estate->estate_longitude = $location->lng;
        }

        if (isset($estate->price_amd) && !is_numeric($estate->price_amd)) {
            $unformattedPriceString = $estate->price_amd;
            $numberWithoutCommas = str_replace(',', '', $unformattedPriceString);

            $price_amd = (int)$numberWithoutCommas;

            $estate->price_amd = $price_amd;
            $usdRate = App::make(CurrencyRateService::class)->getRate('USD');
            $estate->price_usd = $usdRate ? (int)((int)$estate->price_amd / $usdRate) : null;
        }
    }

    /**
     * Handle the Estate "updated" event.
     */
    public function updated(Estate $estate): void
    {

    }

    /**
     * Handle the Estate "deleted" event.
     */
    public function deleted(Estate $estate): void
    {
        //
    }

    /**
     * Handle the Estate "restored" event.
     */
    public function restored(Estate $estate): void
    {
        //
    }

    /**
     * Handle the Estate "force deleted" event.
     */
    public function forceDeleted(Estate $estate): void
    {
        //
    }

    public function saving(Estate $estate)
    {
        if (isset($estate->price_amd) && !is_numeric($estate->price_amd)) {
                $this->formatPriceAmd($estate);
        }
    }

    public function saved(Estate $estate)
    {

        if (!empty($estate->temporary_photos)) {

            $estatePhotos = json_decode($estate->temporary_photos, true);


            if (!empty($estatePhotos) && is_array($estatePhotos)) {

                $existingPhotos = EstateDocument::where('estate_id', '=', $estate->id)->pluck('path')->toArray();

                $uniqueFilenames = array_diff($estatePhotos, $existingPhotos);

                $estateDocumentsData = [];

                foreach ($estatePhotos as $key => $photo) {
                    $filename = basename($photo);

                    if (str_starts_with($photo, 'uploads/tmp/')) {
                        if (in_array($photo, $uniqueFilenames)) {
                            $this->transferOriginalImage($estate, $photo, $filename);
                            $this->optimizeImage($estate, $photo, $filename);
                        }
                    }

                    $estateDocumentsData[] = [
                        'estate_id' => $estate->id,
                        'path' => $filename,
                        'path_thumb' => $filename,
                        'file_name' => $filename,
                        'is_public' => true,
                        'position' => $key,
                    ];
                }

                EstateDocument::query()->upsert(
                    $estateDocumentsData,
                    ['estate_id', 'path'],
                    ['position']
                );

                $filenames = array_map('basename', $estatePhotos);

                EstateDocument::where('estate_id', $estate->id)->whereIn('path', array_diff($existingPhotos, $filenames))->delete();

                App::make(EstateMainImageService::class)->applyDeferredSelection(
                    $estate,
                    $estatePhotos,
                    request()->input('temporary_photos_main')
                );
            }
        }


        $temporaryPhotos = [];
        $updatedTemporaryPhotos = EstateDocument::where('estate_id', $estate->id)->get();

        foreach ($updatedTemporaryPhotos as $updatedTemporaryPhoto) {
            $temporaryPhotos[] = 'estate/photos/'.$estate->id.'/'. $updatedTemporaryPhoto->path;
        }



        $estate->unsetEventDispatcher();
        $estate->temporary_photos = json_encode($temporaryPhotos);

        if ($estate->is_public_text_generation) {
            $estate->public_text_arm = $this->setPublicTextGeneratorByApartment($estate);
        }


        if (!empty(request()->input('location'))) {
            $location = json_decode(request()->input('location'));
            $estate->estate_latitude = $location->lat;
            $estate->estate_longitude = $location->lng;
        }

        $estate->saveQuietly();

    }


    private function setPublicTextGeneratorByApartment($estate)
    {

        if ($estate->estate_type_id === 1) {


            if ($estate->contract_type_id === 1) {
                $sale1 = trans("estate.label.generating.text.apartment.sale.1");
            } else if ($estate->contract_type_id === 2) {
                $sale1 = trans("estate.label.generating.text.apartment.rent.1");
            } else {
                $sale1 = trans("estate.label.generating.text.apartment.fee.1");
            }

            $sale2 = trans("estate.label.generating.text.apartment.sale.2");
            $sale3 = trans("estate.label.generating.text.apartment.sale.3");
            $sale4 = trans("estate.label.generating.text.apartment.sale.4");
            $sale5 = trans("estate.label.generating.text.apartment.sale.5");
            $sale5One = trans("estate.label.generating.text.apartment.sale.5.1");
            $sale6 = trans("estate.label.generating.text.apartment.sale.6");
            $sale7 = trans("estate.label.generating.text.apartment.sale.7");


            $sale7One = ($estate->entrance_type_id == null || $estate->entrance_type_id == 3)
                ? " " . trans("estate.label.generating.text.apartment.sale.7.1") : "";


            $sale8 = trans("estate.label.generating.text.apartment.sale.8");


            $sale8One = $estate->courtyard_improvement_id == 8 ? trans("estate.label.generating.text.apartment.sale.8.1") . " " . $estate->courtyard_improvement->name_arm
                . trans("estate.label.generating.text.apartment.sale.8.2") : "";


            $sale9 = trans("estate.label.generating.text.apartment.sale.9");
            $sale10 = trans("estate.label.generating.text.apartment.sale.10");
            $sale11 = trans("estate.label.generating.text.apartment.sale.11");
            $sale12 = trans("estate.label.generating.text.apartment.sale.12");
            $sale13 = trans("estate.label.generating.text.apartment.sale.13");
            $sale14 = trans("estate.label.generating.text.apartment.sale.14");


            $sale14One = $estate->uninhabited ? " " . trans("estate.label.generating.text.apartment.sale.14.1") : "";


            $sale15 = trans("estate.label.generating.text.apartment.sale.15");
            $sale15One = $estate->sunny ? " " . trans("estate.label.generating.text.apartment.sale.15.1") : "";


            $sale15Two = trans("estate.label.generating.text.apartment.sale.15.2");
            $sale16 = trans("estate.label.generating.text.apartment.sale.16");
            $sale16One = "";
            $sale16Five = "";


            $sale16Nine = $estate->can_be_used_as_commercial ? " " . trans("estate.label.generating.text.apartment.sale.16.9") : "";
            $sale17 = trans("estate.label.generating.text.apartment.sale.17");


            $sale18 = '';


            if ($estate->contract_type_id === 1) {
                $sale18 = trans("estate.label.generating.text.apartment.sale.18");
            } else if ($estate->contract_type_id === 2) {
                $sale18 = trans("estate.label.generating.text.apartment.rent.3");
            } else {
                $sale18 = trans("estate.label.generating.text.apartment.fee.2");
            }

            $sale19 = trans("estate.label.generating.text.apartment.sale.19");

            $sale20 = sprintf(trans("estate.label.generating.text.apartment.sale.20"),
                $estate->contract_type_id === 1 ? trans("estate.label.generating.text.apartment.sale.20.1") :
                    trans("estate.label.generating.text.apartment.sale.20.2"));

            $sale = trans("estate.label.generating.text.1");

            $roomCount = $estate->room_count != null ? $estate->room_count : "...";
            $roomCountModified = ($estate->room_count_modified != null && $estate->room_count_modified != 0)
                ? ($sale . " " . strval($estate->room_count_modified) . " ") : "";
            $street = $estate->full_address_for_auto_text != null ? $estate->full_address_for_auto_text : "...";
            $buildingProjectType = $estate->building_project_type_id != null ? $estate->building_project_type->name_arm : "...";
            $buildingType = $estate->building_type != null ? $estate->building_type->name_arm : "...";
            $buildingFloorCount = $estate->building_floor_count != null ? $estate->building_floor_count : "...";
            $floor = $estate->floor ? $estate->floor : "...";
            $entranceType = $estate->entrance_type  ? $estate->entrance_type->name_arm : "...";
            $entranceDoorType = $estate->entrance_door_type  ? $estate->entrance_door_type->name_arm : "...";
            $ceilingHeightType = $estate->ceiling_height_type  ? $estate->ceiling_height_type->name_arm : "...";
            $buildingWindowCount = $estate->building_window_count  ? $estate->building_window_count->name_arm : "...";
            $repairingType = $estate->repairing_type ? $estate->repairing_type->name_arm : "...";
            $heatingSystemType = $estate->heating_system_type ? $estate->heating_system_type->name_arm : "...";


            $sale16OneList = array();
            if ($estate->open_balcony == 1) {
                $sale16OneList[] = trans('estate.label.generating.text.apartment.sale.16.2');
            }
            if ($estate->oriel == 1) {
                $sale16OneList[] = trans('estate.label.generating.text.apartment.sale.16.3');
            }
            if ($estate->balcony == 1) {
                $sale16OneList[] = trans('estate.label.generating.text.apartment.sale.16.4');
            }
            if (!empty($sale16OneList)) {
                $sale16One = trans('estate.label.generating.text.apartment.sale.16.1') . " "
                    . implode(", ", $sale16OneList)
                    . trans('estate.label.generating.text.apartment.sale.16');
            }


            $sale16FiveList = array();
            if ($estate->contract_type_id == 1) {
                if ($estate->new_water_tubes == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.sale.16.5');
                }
                if ($estate->new_wiring == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.sale.16.6');
                }
                if ($estate->new_windows == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.sale.16.7');
                }
                if (!empty($sale16FiveList)) {
                    $sale16Five = " " . implode(", ", $sale16FiveList)
                        . " " . trans('estate.label.generating.text.apartment.sale.16.8');
                }
            } else {
                if ($estate->natural_gas == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.1');
                }
                if ($estate->gas_heater == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.2');
                }
                if ($estate->refrigirator == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.3');
                }
                if ($estate->washer == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.4');
                }
                if ($estate->dish_washer == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.5');
                }
                if ($estate->tv == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.6');
                }
                if ($estate->conditioner == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.7');
                }
                if ($estate->internet == 1) {
                    $sale16FiveList[] = trans('estate.label.generating.text.apartment.rent.2.8');
                }
                if (!empty($sale16FiveList)) {
                    $sale16Five = trans('estate.label.generating.text.apartment.rent.2') . " "
                        . implode(", ", $sale16FiveList)
                        . trans('estate.label.generating.text.apartment.sale.16');
                }
            }


            $areaTotal = $estate->area_total != null ? $estate->area_total : "...";


            $priceUSD = $estate->price_usd != null ? $estate->price_usd : "...";

            $text = '';
            $text = $sale1 . " " . $roomCount . " " . $sale2 . " " . $roomCountModified . " " . $street . " " . $sale3 . " " . $buildingProjectType . " "
                . $sale4 . " " . $buildingFloorCount . " " . $sale5 . " " . $buildingType . " " . $sale5One . " "
                . $floor . " " . $sale6 . $sale7 . $sale7One . " " . $entranceType . " "
                . $sale8 . $sale8One . $sale9 . " " . $entranceDoorType
                . " " . $sale10 . " " . $ceilingHeightType . $sale11
                . " " . $buildingWindowCount . " " . $sale12 . "\n"
                . $sale13 . " " . $repairingType . " " . $sale14 . $sale14One
                . $sale15 . " " . $heatingSystemType . $sale15One . $sale16
                . " " . $sale16One . $sale16Five . $sale16Nine . "\n"
                . $sale17 . " " . $areaTotal . " " . $sale18 . " " . $priceUSD
                . " " . $sale19 . "\n" . $sale20;

            return $text;


        }
        else if($estate->estate_type_id === 2) {


            if ($estate->contract_type_id === 1) {
                $sale1 = trans("estate.label.generating.text.house.sale.1");
            } else if ($estate->contract_type_id === 2) {
                $sale1 = trans("estate.label.generating.text.house.rent.1");
            } else {
                $sale1 = trans("estate.label.generating.text.apartment.fee.1");
            }

            $sale2 = trans("estate.label.generating.text.house.sale.2");
            $sale3 = trans("estate.label.generating.text.house.sale.3");
            $sale4 = trans("estate.label.generating.text.house.sale.4");
            $sale5 = trans("estate.label.generating.text.house.sale.5");
            $sale6 = trans("estate.label.generating.text.house.sale.6");
            $sale7Block = "";

            $sale7 = trans("estate.label.generating.text.house.sale.7");
            $sale8 = trans("estate.label.generating.text.house.sale.8");
            $sale9 = trans("estate.label.generating.text.house.sale.9");
            $sale10 = trans("estate.label.generating.text.house.sale.10");
            $sale11 = trans("estate.label.generating.text.house.sale.11");
            $sale12 = trans("estate.label.generating.text.house.sale.12");

            $sale13 = trans("estate.label.generating.text.house.sale.13");
            $sale14 = trans("estate.label.generating.text.house.sale.14");

            $sale14One = $estate->un_inhabited != null && $estate->un_inhabited
                ? " ".trans("estate.label.generating.text.apartment.sale.14.1") : "";

            $sale15 = trans("estate.label.generating.text.house.sale.15");
            $sale16 = trans("estate.label.generating.text.apartment.sale.16");
            $sale16One = "";
            $sale16Five = "";
            $sale16Nine = "";
            $sale16House = "";

            // Determine sale17 value based on contract type
            if ($estate->contract_type_id === 1) {
                $sale17 = sprintf(
                    trans("estate.label.generating.text.house.sale.17"),
                    trans("estate.label.generating.text.house.sale.17.1")
                );
            } else {
                $sale17 = sprintf(
                    trans("estate.label.generating.text.house.sale.17"),
                    trans("estate.label.generating.text.house.sale.17.2")
                );
            }


            $sale19 = trans("estate.label.generating.text.apartment.sale.19");

            $houseFloorsType = $estate->house_floors_type != null ? $estate->house_floors_type->name_arm : "...";

            $roomCount = $estate->room_count != null ? $estate->room_count : "...";
            $street = $estate->full_address_for_auto_text != null ? $estate->full_address_for_auto_text : "...";
            $repairingType = $estate->repairing_type ? $estate->repairing_type->name_arm : "...";
            $heatingSystemType = $estate->heating_system_type ? $estate->heating_system_type->name_arm : "...";


            $areaResidential = $estate->area_residential != null ? $estate->area_residential : "...";
            $areaTotal = $estate->area_total != null ? $estate->area_total : "...";

            $priceUSD = $estate->price_usd > 0 ? $estate->price_usd : "...";

            $year = $estate->year != null ? $estate->year->name_arm : "...";


            $landStructureType =  $estate->land_structure_type != null
                ? $estate->land_structure_type->name_arm : "...";


            $roadWayType = $estate != null && $estate->road_way_type != null
                ? $estate->road_way_type->name_arm : "...";
            $frontWithStreet = $estate != null && $estate->front_with_street != null
                ? $estate->front_with_street->name_arm : "...";

            $frontLength = $estate != null && $estate->front_length != null  ? $estate->front_length : "...";


            $sale16OneList = [];

            // Check each condition and add the corresponding translated strings to the list
            if ($estate->open_balcony === 1) {
                $sale16OneList[] = trans("estate.label.generating.text.apartment.sale.16.2");
            }
            if ($estate->oriel === 1) {
                $sale16OneList[] = trans("estate.label.generating.text.apartment.sale.16.3");
            }
            if ($estate->balcony === 1) {
                $sale16OneList[] = trans("estate.label.generating.text.apartment.sale.16.4");
            }

            // Determine sale16One based on whether the list is empty
            if (!empty($sale16OneList)) {
                // Construct sale16One by concatenating translations and the list of conditions
                $sale16One = trans("estate.label.generating.text.apartment.sale.16.1") . ' '
                    . implode(', ', $sale16OneList) // Join the list with a comma and space
                    . trans("estate.label.generating.text.apartment.sale.16");
            }


                       // Initialize an array to hold the strings
            $sale16FiveList = [];

            // Check the estate type and relevant conditions
            if ($estate->contract_type_id !== 1) {
                if ($estate->natural_gas == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.1");
                }
                if ($estate->gas_heater == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.2");
                }
                if ($estate->refrigirator == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.3");
                }
                if ($estate->washer == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.4");
                }
                if ($estate->dish_washer == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.5");
                }
                if ($estate->tv == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.6");
                }
                if ($estate->conditioner == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.7");
                }
                if ($estate->internet == 1) {
                    $sale16FiveList[] = trans("estate.label.generating.text.apartment.rent.2.8");
                }

                // Determine sale16Five based on whether the list is empty
                if (!empty($sale16FiveList)) {
                    $sale16Five = trans("estate.label.generating.text.house.rent.2") . ' '
                        . implode(', ', $sale16FiveList)
                        . trans("estate.label.generating.text.apartment.sale.16");
                } else {
                    $sale16Five = trans("estate.label.generating.text.apartment.sale.16");
                }

                // Determine sale16Nine if the estate is for renting
                if ($estate->contract_type_id === 2) {
                    $sale16Nine = $estate->can_be_used_as_commercial == 1
                        ? "\n" . trans("estate.label.generating.text.house.sale.16.9")
                        : "";
                }
            }





            // Initialize sale7Block
            $sale7Block = '';

             if ($estate->contract_type_id == 1 || $estate->contract_type_id == 2) {
                // Construct sale7Block based on the estate contract type
                $sale7Block = $sale7 . ' ' . $year . ' ' . $sale8 . ' ' . $landStructureType . ' '
                    . $sale9 . ' ' . $roadWayType . ' ' . $sale10 . ' ' . $frontWithStreet . ' '
                    . $sale11 . ' ' . $frontLength . ' ' . $sale12 . "\n";
            }

            // Determine sale16House based on the contract type
            if ($estate->contract_type_id == 1) {
                // For sale estates
                $sale16House = trans("estate.label.generating.text.house.sale.16");
            } else if ($estate->contract_type_id === 2) {
                // For renting estates
                $sale16House = trans("estate.label.generating.text.house.rent.3");
            } else {
                // For other types of estates
                $sale16House = trans("estate.label.generating.text.house.fee.2");
            }


            $text = '';

            // Append variables and strings to the text variable
            $text .= $sale1 . ' ' . $houseFloorsType . ' ' . $roomCount . ' '
                . $sale2 . ' ' . $street . ' ' . $sale3 . "\n "
                . $sale4 . ' ' . $areaResidential . ' ' . $sale5 . ' '
                . $areaTotal . ' ' . $sale6 . "\n"
                . $sale7Block
                . $sale13 . ' ' . $repairingType . ' ' . $sale14 . $sale14One
                . $sale15 . ' ' . $heatingSystemType . $sale16 . $sale16One
                . $sale16Five . $sale16Nine . "\n"
                . $sale16House . ' ' . $priceUSD
                . ' ' . $sale19 . "\n" . $sale17;

            return $text;
        }
        else  if ($estate->estate_type_id === 3) {

            $sale1 = "";

            if ($estate->contract_type_id == 1) {
                $sale1 = trans("estate.label.generating.text.commercial.sale.1");
            } else if ($estate->contract_type_id === 2) {
                $sale1 = trans("estate.label.generating.text.commercial.rent.1");
            }


            $sale2 = trans("estate.label.generating.text.commercial.sale.2");
            $sale3 = trans("estate.label.generating.text.commercial.sale.3");
            $sale4 = trans("estate.label.generating.text.commercial.sale.4");
            $sale5 = trans("estate.label.generating.text.commercial.sale.5");
            $sale6 = trans("estate.label.generating.text.commercial.sale.6");
            $sale7 = trans("estate.label.generating.text.commercial.sale.7");
            $sale16 = trans("estate.label.generating.text.apartment.sale.16");
            $sale7One = "";


            if ($estate->vitrage_type_id !== null && $estate->vitrage_type_id !== 26) {
                $sale7One = __('label.generating.text.commercial.sale.7.1') . ' '
                    . $estate->vitrage_type->name_arm . ' '
                    . __('label.generating.text.commercial.sale.7.2')
                    . ' ' . $sale16;
            }


            if ($estate->contract_type_id == 1) {
                $sale8 = trans("estate.label.generating.text.commercial.sale.8");
            } else {
                $sale8 = trans("estate.label.generating.text.commercial.rent.2");
            }
            $sale9 = trans("estate.label.generating.text.commercial.sale.9");



            if ($estate->contract_type_id == 1) {
                $sale10 = sprintf(
                    trans('estate.label.generating.text.commercial.sale.10'),
                    trans('estate.label.generating.text.commercial.sale.10.1')
                );
            } else {
                $sale10 = sprintf(
                    trans('estate.label.generating.text.commercial.sale.10'),
                    trans('estate.label.generating.text.commercial.sale.10.2')
                );
            }

            $commercialPurposeType = $estate->commercial_purpose_type != null ? $estate->commercial_purpose_type->name_arm : "...";

            $street  = $estate->full_address_for_auto_text != null ? $estate->full_address_for_auto_text : "...";

            $areaTotal = $estate->area_total != null ? $estate->area_total : "...";
            $roomCount = $estate->room_count != null ? $estate->room_count : "...";
            $repairingType = $estate->repairing_type ? $estate->repairing_type->name_arm : "...";
            $heatingSystemType = $estate->heating_system_type ? $estate->heating_system_type->name_arm : "...";

            $priceUSD = $estate->price_usd != null ? $estate->price_usd : "...";


            $text = $sale1 . ' ' . $commercialPurposeType . ' '
                . $sale2 . ' ' . $street . ' ' . $sale3 . ' ' . $areaTotal . ' '
                . $sale4 . ' ' . $roomCount . ' ' . $sale5 . "\n"
                . $sale6 . ' ' . $repairingType . ' ' . $sale7 . ' '
                . $heatingSystemType . ' ' . $sale16 . ' ' . $sale7One . "\n"
                . $sale8 . ' ' . $priceUSD . ' ' . $sale9 . "\n"
                . $sale10;

            return $text;
        }
        else  if ($estate->estate_type_id === 4) {

            $sale1 = trans("estate.label.generating.text.land.sale.1");
            $sale2 = trans("estate.label.generating.text.land.sale.2");
            $sale3 = trans("estate.label.generating.text.land.sale.3");
            $sale4 = trans("estate.label.generating.text.land.sale.4");
            $sale5 = trans("estate.label.generating.text.land.sale.5");
            $sale6 = trans("estate.label.generating.text.land.sale.6");
            $sale7 = trans("estate.label.generating.text.land.sale.7");
            $sale8 = trans("estate.label.generating.text.land.sale.8");
            $sale9 = trans("estate.label.generating.text.land.sale.9");
            $sale10 = trans("estate.label.generating.text.land.sale.10");
            $sale16 = trans("estate.label.generating.text.apartment.sale.16");

            $street  = $estate->full_address_for_auto_text != null ? $estate->full_address_for_auto_text : "...";

            $areaTotal = $estate->area_total != null ? $estate->area_total : "...";

            $landType = $estate->land_type != null ? $estate->land_type->name_arm : "...";

            $landStructureType =  $estate->land_structure_type != null
                ? $estate->land_structure_type->name_arm : "...";

            $roadWayType =  $estate->road_way_type != null
                ? $estate->road_way_type->name_arm : "...";

            $frontWithStreet =  $estate->front_with_street != null
                ? $estate->front_with_street->name_arm : "...";

            $frontLengthValue = $estate->front_length ?? null;

            if ($frontLengthValue !== null) {
                // Calculate the fractional part
                $fractionalPart = $frontLengthValue - floor($frontLengthValue);
                if ($fractionalPart !== 0) {
                    // The number has a fractional part
                    $frontLength = (string) $frontLengthValue;
                } else {
                    // The number is an integer
                    $frontLength = (string) (int) $frontLengthValue;
                }
            } else {
                // The front length is null
                $frontLength = "...";
            }

            $communicationType =  $estate->communication_type != null
                ? $estate->communication_type->name_arm : "...";

            $text = '';
            $text .= $sale1 . ' ' . $areaTotal . ' ';
            $text .= $sale2 . ' ' . $landType . ' ';
            $text .= $sale3 . ' ' . $street . ' ' . $sale4 . "\n ";
            $text .= $sale5 . ' ' . $landStructureType . ' ' . $sale6 . ' ';
            $text .= $roadWayType . ' ' . $sale7 . ' ' . $frontWithStreet . ' ';
            $text .= $sale8 . ' ' . $frontLength . ' ' . $sale9 . ' ';
            $text .= $communicationType . $sale16 . "\n";
            $text .= $sale10 . "\n";

            return $text;
        }
    }

    private function setEstateCode($estate)
    {
        $code = '';
        if ($estate->contract_type_id != null) {
            $code .= $estate->contract_type_id == 1 ? 0 : 1;
        } else {
            $code .= "-";
        }
        if ($estate->estate_type_id != null) {
            $code .= $estate->estate_type_id;
        } else {
            $code .= "-";
        }

        if ($estate->room_count != null && $estate->room_count != 0) {
            $code .= $estate->room_count;
        } else {
            $code .= "-";
        }

        return $code . '-' . $estate->id;
    }

    public function watermarkImage($estate, $imagePath, $filename)
    {

        try {
            $imageContents = Storage::disk('S3Public')->get($imagePath);

            // Save the image locally temporarily
            $localImagePath = storage_path('app/public/temp.jpg');
            file_put_contents($localImagePath, $imageContents);

            // Apply watermark
//            $watermarkPath = public_path('watermark.png');  // Updated to use public_path helper function
            $watermarkedImage = Image::load($localImagePath)
                ->optimize();
//                ->apply()
//                ->watermark($watermarkPath)
//                ->watermarkPosition(Manipulations::POSITION_CENTER)
//                ->watermarkHeight(15, Manipulations::UNIT_PERCENT)
//                ->watermarkWidth(15, Manipulations::UNIT_PERCENT)
//                ->apply()
//                ->watermark($watermarkPath)
//                ->watermarkPosition(Manipulations::POSITION_TOP_LEFT)
//                ->watermarkHeight(15, Manipulations::UNIT_PERCENT)
//                ->watermarkWidth(15, Manipulations::UNIT_PERCENT)
//                ->apply()
//                ->watermark($watermarkPath)
//                ->watermarkPosition(Manipulations::POSITION_TOP_RIGHT)
//                ->watermarkHeight(15, Manipulations::UNIT_PERCENT)
//                ->watermarkWidth(15, Manipulations::UNIT_PERCENT)
//                ->apply()
//                ->watermark($watermarkPath)
//                ->watermarkPosition(Manipulations::POSITION_BOTTOM_LEFT)
//                ->watermarkHeight(15, Manipulations::UNIT_PERCENT)
//                ->watermarkWidth(15, Manipulations::UNIT_PERCENT)
//                ->apply()
//                ->watermark($watermarkPath)
//                ->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT)
//                ->watermarkHeight(15, Manipulations::UNIT_PERCENT)
//                ->watermarkWidth(15, Manipulations::UNIT_PERCENT);


            // Save the watermarked image
            $watermarkedImagePath = storage_path('app/public/watermarked.jpg');
            $watermarkedImage->save($watermarkedImagePath);

            // Upload the watermarked image back to S3
            $newImageContents = file_get_contents($watermarkedImagePath);

            $newImagePath = 'estate/photos/' . $estate->id . '/' . $filename;

            Storage::disk('S3Public')->put($newImagePath, $newImageContents, $filename);  // Update the path

            unlink($localImagePath);
            unlink($watermarkedImagePath);


        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Alert::error('An error occured uploading files. Check log files.')->flash();
        }


        return true;
    }


    public function optimizeImage($estate, $imagePath, $filename)
    {

        try {
            $imageContents = Storage::disk('S3Public')->get($imagePath);

            // Save the image locally temporarily
            $localImagePath = storage_path('app/public/temp.jpg');
            file_put_contents($localImagePath, $imageContents);

            $watermarkedImage = Image::load($localImagePath)
                ->optimize();

            // Save the watermarked image
            $watermarkedImagePath = storage_path('app/public/watermarked.jpg');
            $watermarkedImage->save($watermarkedImagePath);

            // Upload the watermarked image back to S3
            $newImageContents = file_get_contents($watermarkedImagePath);

            $newImagePath = 'estate/photos/' . $estate->id . '/' . $filename;

            Storage::disk('S3Public')->put($newImagePath, $newImageContents, $filename);  // Update the path

            unlink($localImagePath);
            unlink($watermarkedImagePath);


        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Alert::error('An error occured uploading files. Check log files.')->flash();
        }


        return true;
    }


//    public function watermarkImage($estate, $imagePath, $filename)
//    {
//        try {
//
//            $startTime = microtime(true);
//            $imageContents = Storage::disk('S3Public')->get($imagePath);
//            $localImagePath = storage_path('app/public/temp.jpg');
//            file_put_contents($localImagePath, $imageContents);
//
//            $watermarkPath = public_path('watermark.png');
////            $watermarkedImage = Image::load($localImagePath);
////
////            $positions = [
////                Manipulations::POSITION_CENTER,
////                Manipulations::POSITION_TOP_LEFT,
////                Manipulations::POSITION_TOP_RIGHT,
////                Manipulations::POSITION_BOTTOM_LEFT,
////                Manipulations::POSITION_BOTTOM_RIGHT,
////            ];
////
////            foreach ($positions as $position) {
////                $watermarkedImage->watermark($watermarkPath)
////                    ->watermarkPosition($position)
////                    ->watermarkHeight(15, Manipulations::UNIT_PERCENT)
////                    ->watermarkWidth(15, Manipulations::UNIT_PERCENT);
////            }
////
////            $watermarkedImage->apply();
//
//            $watermarkedImage = Image::load($imageContents)
//                ->watermark($watermarkPath)
//                ->watermarkPosition(Manipulations::POSITION_CENTER)
//                ->watermarkHeight(15, Manipulations::UNIT_PERCENT)
//                ->watermarkWidth(15, Manipulations::UNIT_PERCENT)
//                ->apply();
//
//            $newImagePath = 'estate/photos/' . $estate->id . '/' . $filename;
//            Storage::disk('S3Public')->put($newImagePath, (string)$watermarkedImage->encode(), $filename);
//
//            unlink($localImagePath);
//            $endTime = microtime(true);
//
//            // Calculate and log the execution time
//            $executionTime = $endTime - $startTime;
//            Log::info("Watermarking image via S3 took {$executionTime} seconds.");
//        } catch (\Throwable $th) {
//            Log::error($th->getMessage());
//            throw $th; // Consider throwing the exception for better error handling
//        }
//
//        return true;
//    }


    public function transferOriginalImage($estate, $imagePath, $filename)
    {
        try {
            Storage::disk('S3')->writeStream('estate/photos/' . $estate->id . '/' . $filename, Storage::disk('S3Public')->readStream($imagePath));

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Alert::error('An error occured uploading files. Check log files.')->flash();
        }


        return true;
    }


    /**
     * Parse integer from comma-separated string and update the price fields.
     *
     * @param Estate $estate
     * @return void
     */
    private function formatPriceAmd(Estate $estate)
    {
        $unformattedPriceString = $estate->price_amd;
        $numberWithoutCommas = str_replace(',', '', $unformattedPriceString);
        $priceAmd = (int) $numberWithoutCommas;

        $estate->price_amd = $priceAmd;
        $estate->price_usd = (int) ($priceAmd / 387);
    }

}
