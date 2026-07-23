<?php

namespace App\Traits\Controllers;

use App\Enum\BuildingProjectType;
use App\Enum\BuildingType;
use App\Enum\EstateStatus;
use App\Enum\FloorsQuantity;
use App\Enum\RepairingType;
use App\Enum\RoomsQuantity;
use App\Models\Client;
use App\Models\RealtorUser;
use Illuminate\Database\Eloquent\Builder;

trait HasEstateFilters
{
    private function addListFilters(): void
    {


        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'apartment',
            'label' => 'ԲՆԱԿԱՐԱՆ',
            'className' => 'col-md-4',
        ],
            false,
            function () {
                $this->crud->addClause('apartment');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'house',
            'label' => 'ԱՌԱՆՁՆԱՏՈՒՆ'
        ],
            false,
            function () {
                $this->crud->addClause('house');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'townhouse',
            'label' => 'ԹԱՈՒՆՀԱՈՒՍ'
        ],
            false,
            function () {
                $this->crud->addClause('townhouse');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'Commercial',
            'label' => 'ԿՈՄԵՐՑԻՈՆ'
        ],
            false,
            function () {
                $this->crud->addClause('commercial');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'land',
            'label' => 'ՀՈՂ'
        ],
            false,
            function () {
                $this->crud->removeAllFilters();
                $this->crud->addClause('land');
            });
        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_types',
        ]);

        // select2 filter
        $this->crud->addFilter([
            'name' => 'contract_type',
            'type' => 'select2_multiple_red',
            'label' => 'Գործարքային տիպը',
        ], function () {
            return [
                1 => 'Վաճառք',
                2 => 'Վարձակալություն',
                3 => 'Օրավարձ',
            ];
        }, function ($values) {
            $this->crud->addClause('whereIn', 'contract_type_id', json_decode($values));
        });

        $this->crud->addFilter([
            'name' => 'location_province',
            'type' => 'select2',
            'label' => 'Մարզ',
        ], function () {
            return \App\Models\CLocationProvince::all()->pluck('name_arm', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'location_province_id', $value);
        });

        if (request('location_province')) {
            $province = request('location_province');

            if ($province == 1) {
                $this->crud->addFilter([
                    'name' => 'location_community',
                    'type' => 'select2_multiple_red',
                    'label' => 'Համայնք',
                ], function () {
                    return \App\Models\CLocationCommunity::orderBy('sort_id')->pluck('name_arm', 'id')->toArray();
                }, function ($values) {
                    $this->crud->addClause('whereIn', 'location_community_id', json_decode($values));
                });
            } else {
                $this->crud->addFilter([
                    'name' => 'location_city',
                    'type' => 'select2_multiple_red',
                    'label' => 'Քաղաք',
                ], function () {
                    $province = request('location_province');
                    return \App\Models\CLocationCity::where('parent_id', '=', json_decode($province))->pluck('name_arm', 'id')->toArray();
                }, function ($values) {
                    $this->crud->addClause('whereIn', 'location_city_id', json_decode($values));
                });
            }
        }


        $this->crud->addFilter([
            'name' => 'location_street',
            'type' => 'select2_multiple_red',
            'label' => 'Փողոց',
        ], function () {
            return \App\Models\CLocationStreet::all()->pluck('name_arm', 'id')->toArray();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'location_street_id', json_decode($values));
        });

        $this->crud->addFilter([
            'type' => 'text',
            'name' => 'address_building',
            'label' => 'Շենք',
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'address_building', '=', $value);
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_9',
        ]);

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'isExclusive',
            'label' => 'Միայն էքսկլյուզիվ գույքերը'
        ],
            false,
            function () {
                $this->crud->addClause('isExclusive');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'isNotExclusive',
            'label' => 'Բացի էքսկլյուզիվ գույքերից'
        ],
            false,
            function () {
                $this->crud->addClause('isNotExclusive');
            });








        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_1',
        ]);


        if (!request('extended_price')) {
            $currency = session('currency') ? session('currency') : 'AMD';
            $contractType = request('contract_type');

            if (!empty($currency)) {
                $this->crud->addFilter([
                    'name' => 'price_range',
                    'type' => 'select2',
                    'label' => 'Գին',
                ], function () use ($currency,$contractType) {
                    if ($currency == 'USD') {
                        if($contractType == 2) {
                            return \App\Models\CRentPriceInUsd::all()->pluck('name_arm', 'name_eng')->toArray();
                        }
                        if($contractType == 3) {
                            return \App\Models\CDailyPriceInUsd::all()->pluck('name_arm', 'name_eng')->toArray();
                        }
                        return \App\Models\CSellPriceInUsd::all()->pluck('name_arm', 'name_eng')->toArray();
                    }
                    if ($currency == 'RUB') {
                        if($contractType == 2) {
                            return \App\Models\CRentPriceInRur::all()->pluck('name_arm', 'name_eng')->toArray();
                        }
                        if($contractType == 3) {
                            return \App\Models\CDailyPriceInRur::all()->pluck('name_arm', 'name_eng')->toArray();
                        }
                        return \App\Models\CSellPriceInRur::all()->pluck('name_arm', 'name_eng')->toArray();
                    }
                    if ($currency == 'AMD') {
                        if($contractType == 2) {
                            return \App\Models\CRentPriceInAmd::all()->pluck('name_arm', 'name_eng')->toArray();
                        }
                        if($contractType == 3) {
                            return \App\Models\CDailyPriceInAmd::all()->pluck('name_arm', 'name_eng')->toArray();
                        }
                        return \App\Models\CSellPriceInAmd::all()->pluck('name_arm', 'name_eng')->toArray();
                    }
                }, function ($values) {
                    $currency = session('currency') ? session('currency') : 'AMD';

                    preg_match('/(\d+)/', $values, $matches);

                    if (strpos($values, 'Up to') !== false) {
                        $range = [null, (int) $matches[1]];
                    } elseif (strpos($values, 'and more') !== false) {
                        $range = [(int) $matches[1], null];
                    } else {
                        if ($currency == 'AMD') {
                            preg_match('/(\d+) million/', $values, $matches);
                            $range = [(int) $matches[0]* 1000000, (int) $matches[1] * 1000000];
                        } else {
                            preg_match('/(\d+)-(\d+)/', $values, $matches);
                            $range = [(int) $matches[1], (int) $matches[2]];

                        }

                    }


                    if ($currency == 'AMD') {
                        if ($range[0]) {
                            $this->crud->addClause('where', 'price_amd', '>=', (float)$range[0]);
                        }
                        if ($range[1]) {
                            $this->crud->addClause('where', 'price_amd', '<=', (float)$range[1]);
                        }
                    }

                    if ($currency == 'RUB') {
                        if ($range[0]) {
                            $this->crud->addClause('where', 'price_amd', '>=', (float)$range[0] * 4);
                        }
                        if ($range[1]) {
                            $this->crud->addClause('where', 'price_amd', '<=', (float)$range[1] * 4);
                        }
                    }

                    if ($currency == 'USD') {
                        if ($range[0]) {
                            $this->crud->addClause('where', 'price_amd', '>=', (float)$range[0] * 390);
                        }
                        if ($range[1]) {
                            $this->crud->addClause('where', 'price_amd', '<=', (float)$range[1] * 390);
                        }
                    }


                });
            }


        }



        if (request('extended_price')) {

            $this->crud->addFilter([
                'name' => 'price',
                'type' => 'range',
                'label' => 'Գին',
            ],
                false,
                function ($value) {
                    $range = json_decode($value);


                    $currency = session('currency') ? session('currency') : 'AMD';

                    if ($currency == 'AMD') {
                        if ($range->from) {
                            $this->crud->addClause('where', 'price_amd', '>=', (float)$range->from);
                        }
                        if ($range->to) {
                            $this->crud->addClause('where', 'price_amd', '<=', (float)$range->to);
                        }
                    }

                    if ($currency == 'RUB') {
                        if ($range->from) {
                            $this->crud->addClause('where', 'price_amd', '>=', (float)$range->from * 4);
                        }
                        if ($range->to) {
                            $this->crud->addClause('where', 'price_amd', '<=', (float)$range->to * 4);
                        }
                    }

                    if ($currency == 'USD') {
                        if ($range->from) {
                            $this->crud->addClause('where', 'price_amd', '>=', (float)$range->from * 390);
                        }
                        if ($range->to) {
                            $this->crud->addClause('where', 'price_amd', '<=', (float)$range->to * 390);
                        }
                    }

                });
        }

        if (!request('extended_area')) {

            $this->crud->addFilter([
                'name' => 'area_range',
                'type' => 'select2',
                'label' => 'Մակերես',
            ], function () use ($contractType) {
                    return \App\Models\CAreaForBuilding::all()->pluck('name_arm', 'name_eng')->toArray();
            }, function ($values) {
                preg_match('/(\d+)/', $values, $matches);
                $range = [null, null];
                if (strpos($values, 'up to') !== false) {
                    $range[1] = (int) $matches[1];
                } elseif (strpos($values, '+ sq.m') !== false) {
                    $range[0] = (int) $matches[1];
                } else {
                    preg_match_all('/(\d+)/', $values, $matches);
                    $range[0] = (int) $matches[0][0];
                    $range[1] = (int) $matches[0][1];
                }

                if ($range[0] !== null) {
                    $this->crud->addClause('where', 'area_total', '>=', $range[0]);
                }
                if ($range[1] !== null) {
                    $this->crud->addClause('where', 'area_total', '<=', $range[1]);
                }
            });
;

        }

        if (request('extended_area')) {
            $this->crud->addFilter([
                'name' => 'area',
                'type' => 'range',
                'label' => 'Մակերես',
            ],
                false,
                function ($value) {
                    $range = json_decode($value);
                    if ($range->from) {
                        $this->crud->addClause('where', 'area_total', '>=', (float)$range->from);
                    }
                    if ($range->to) {
                        $this->crud->addClause('where', 'area_total', '<=', (float)$range->to);
                    }
                });
        }


        if (!request('extended_price_sqm')) {
            $currency = session('currency') ? session('currency') : 'AMD';

            $this->crud->addFilter([
                'name' => 'price_sqm',
                'type' => 'select2_multiple_red',
                'label' => '1 ք․մ․ արժեք',
            ], function () use ($currency) {

                if ($currency == 'USD') {
                    return \App\Models\CPricePerQwdMeterUsd::all()->pluck('name_arm', 'name_eng')->toArray();
                }
                if ($currency == 'RUB') {
                    return \App\Models\CPricePerQwdMeterRur::all()->pluck('name_arm', 'name_eng')->toArray();
                }
                if ($currency == 'AMD') {
                    return \App\Models\CPricePerQwdMeterArm::all()->pluck('name_arm', 'name_eng')->toArray();
                }

            }, function ($values) {
                $valuesArray = json_decode($values, true);
                $currency = session('currency') ? session('currency') : 'AMD';

                preg_match('/(\d+)/', $values, $matches);

                if (strpos($values, 'Up to') !== false) {
                    $range = [null, (int) $matches[1]];
                } elseif (strpos($values, 'and more') !== false) {
                    $range = [(int) $matches[1], null];
                } else {
                        preg_match('/(\d+)-(\d+)/', $values, $matches);
                        $range = [(int) $matches[1], (int) $matches[2]];


                }

                if ($currency == 'AMD') {
                    if ($range[0]) {
                        $this->crud->addClause('whereRaw', 'price_amd  / area_total >= ?', (float)$range[0]);
                    }
                    if ($range[1]) {
                        $this->crud->addClause('whereRaw', 'price_amd / area_total <= ?', (float)$range[1]);
                    }
                }

                if ($currency == 'RUB') {
                    if ($range[0]) {
                        $this->crud->addClause('whereRaw', 'price_amd / 4 / area_total >= ?', (float)$range[0]);
                    }
                    if ($range[1]) {
                        $this->crud->addClause('whereRaw', 'price_amd / 4 / area_total <= ?', (float)$range[1]);
                    }
                }

                if ($currency == 'USD') {
                    if ($range[0]) {
                        $this->crud->addClause('whereRaw', 'price_amd / 390 / area_total >= ?', (float)$range[0]);
                    }
                    if ($range[1]) {
                        $this->crud->addClause('whereRaw', 'price_amd / 390 / area_total <= ?', (float)$range[1]);
                    }
                }

            });
        }

        if (request('extended_price_sqm')) {
            $this->crud->addFilter([
                'name' => 'extended_price_sqm_range',
                'type' => 'range',
                'label' => 'ք/մ գին',
            ],
                false,
                function ($value) {
                    $range = json_decode($value);

                    $currency = session('currency') ? session('currency') : 'AMD';

                    if ($currency == 'AMD') {
                        if ($range->from) {
                            $this->crud->addClause('whereRaw', 'price_amd/area_total > ?', [(float)$range->from]);
                        }
                        if ($range->to) {
                            $this->crud->addClause('whereRaw', 'price_amd / estate.area_total < ?', [(float)$range->to]);
                        }
                    }

                    if ($currency == 'RUB') {
                        if ($range->from) {
                            $this->crud->addClause('whereRaw', 'price_amd/area_total > ?', [(float)$range->from * 4]);
                        }
                        if ($range->to) {
                            $this->crud->addClause('whereRaw', 'price_amd / estate.area_total < ?', [(float)$range->to * 4]);
                        }
                    }

                    if ($currency == 'USD') {
                        if ($range->from) {
                            $this->crud->addClause('whereRaw', 'price_amd/area_total > ?', [(float)$range->from * 390]);
                        }
                        if ($range->to) {
                            $this->crud->addClause('whereRaw', 'price_amd / estate.area_total < ?', [(float)$range->to * 390]);
                        }
                    }
                });
        }

        $this->crud->addFilter([
            'name' => 'room_count',
            'type' => 'select2_multiple_red',
            'label' => 'Սենյակներ',
        ], function () {
            return RoomsQuantity::names();
        }, function ($values) {
            $valuesArray = json_decode($values, true);
            if (in_array('4+', $valuesArray)) {
                // Add values 5 through 15 to the array
                for ($i = 5; $i <= 15; $i++) {
                    $valuesArray[] = (string)$i;
                }
            }

            $this->crud->addClause('whereIn', 'room_count', $valuesArray);

        });




        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_price_discount',
        ]);

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'extended_price',
            'label' => 'Ընդլայնված',
        ],
            false,
            function () {
                //For frontend purposes, DO NOT REMOVE
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'extended_area',
            'label' => 'Ընդլայնված',
        ],
            false,
            function () {
                //For frontend purposes, DO NOT REMOVE
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'extended_price_sqm',
            'label' => 'Ընդլայնված',
        ],
            false,
            function () {
                //For frontend purposes, DO NOT REMOVE
            });


        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_price',
        ]);

        if(request('apartment')) {
            $this->crud->addFilter([
                'name' => 'building_project_type',
                'type' => 'select2_multiple_red',
                'label' => 'Շենքի նախագիծը',
            ], function () {
                return BuildingProjectType::names();
            }, function ($values) {
                $this->crud->addClause('whereIn', 'building_project_type_id', json_decode($values));
            });
        }


        if(!request('land')) {
            $this->crud->addFilter([
                'name' => 'building_type',
                'type' => 'select2_multiple_red',
                'label' => 'Արտաքին պատեր',
            ], function () {
                return BuildingType::names();
            }, function ($values) {
                $this->crud->addClause('whereIn', 'building_type_id', json_decode($values));
            });
        }

        if(request('apartment')) {
            $this->crud->addFilter([
                'name' => 'floor_count',
                'type' => 'select2_multiple_red',
                'label' => 'Հարկ',
            ], function () {
                return FloorsQuantity::names();
            }, function ($values) {
                $this->crud->addClause('whereIn', 'building_floor_count', json_decode($values));
            });
        }
        if(!request('land')) {
            $this->crud->addFilter([
                'name' => 'repairing_type',
                'type' => 'select2_multiple_red',
                'label' => 'Վերանորոգման տեսակ',
            ], function () {
                return RepairingType::names();
            }, function ($values) {
                $this->crud->addClause('whereIn', 'repairing_type_id', json_decode($values));
            });
        }

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_4',
        ]);


        $this->crud->addFilter([
            'name' => 'estate_status',
            'type' => 'select2_multiple_red',
            'label' => 'Կարգավիճակ',
        ], function () {
            return EstateStatus::names();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'estate_status_id', json_decode($values));
        });

        $this->crud->addFilter([
            'name' => 'seller-owner',
            'type' => 'text',
            'label' => 'Վաճառող / Վարձատու',
        ],   false,
            function ($value) {
                $searchWithSpaces = str_replace(' ', '', $value);

                $this->crud->addClause('where', function ($query) use ($value, $searchWithSpaces) {
                    $query->whereHas('seller', function ($subquery) use ($value, $searchWithSpaces) {
                        $subquery
                            ->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`) LIKE ?', ['%' . $value . '%'])
                            ->orWhereRaw('REPLACE(`phone_mobile_1`, " ", "") LIKE ?', ['%' . $searchWithSpaces . '%']);
                    })->orWhereHas('sellerRenter', function ($subquery) use ($value, $searchWithSpaces) {
                        $subquery
                            ->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`) LIKE ?', ['%' . $value . '%'])
                            ->orWhereRaw('REPLACE(`phone_mobile_1`, " ", "") LIKE ?', ['%' . $searchWithSpaces . '%']);
                    });
                });
            });

        $this->crud->addFilter([
            'name' => 'client_potential',
            'type' => 'select2',
            'label' => 'Հաճախորդ-պոտենցիալ գույքեր',
        ], function () {
            return Client::query()
                ->whereNotNull(['name_arm'])
                ->select(['id', 'name_arm', 'last_name_arm', 'phone_mobile_1'])
                ->get()
                ->pluck('fullContact', 'id')
                ->toArray();

        }, function ($value) {
            $client = Client::findOrfail($value);


            if($client->estate_type_id) {
                $this->crud->addClause('where', 'estate_type_id', '=', $client->estate_type_id);
            }

            if($client->contract_type_id) {
                $this->crud->addClause('where', 'contract_type_id', '=', $client->contract_type_id);
            }


            if($client->area_from) {
                $this->crud->addClause('where', 'area_total', '>=', $client->area_to);
            }

            if($client->area_to) {
                $this->crud->addClause('where', 'area_total', '<=', $client->area_to);
            }

            if($client->location_province_id) {
                $this->crud->addClause('where', 'location_province_id', '=', $client->location_province_id);
            }

            if($client->location_city_id) {
                $this->crud->addClause('where', 'location_province_id', '=', $client->location_city_id);
            }

            if($client->communities) {
                $communities = $client->communities->pluck('id')->all();
                $this->crud->addClause('whereIn', 'location_community_id',  $communities);
            }

            if ($client->price_from) {
                $this->crud->addClause('where', 'price_usd', '>=', $client->price_from);
            }

            if ($client->price_to) {
                $this->crud->addClause('where', 'price_usd', '<=', $client->price_to);
            }


            if ($client->room_count_from) {
                $this->crud->addClause('where', 'room_count', '>=', $client->room_count_from);
            }

            if ($client->room_count_to) {
                $this->crud->addClause('where', 'room_count', '<=', $client->room_count_to);
            }
        });

        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'created_at_from',
            'label' => 'Ստեղծված սկսած'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'created_at', '>=', $value);
            });


        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'created_at_to',
            'label' => 'Ստեղծված մինչև'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'created_at', '<=', $value . ' 23:59:59');
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_created',
        ]);

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_from_public',
            'label' => 'Միայն հայտեր'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_from_public', 1);
            });



        $this->crud->addFilter([
            'name' => 'agents',
            'type' => 'select2',
            'label' => 'Գործակալ',
        ], function () {

            return RealtorUser::whereHas('contact', function ($query) {
                $query->where('contact_type_id', 3)
                    ->whereNotNull('name_arm');
            })
                ->whereHas('roles', function ($query) {
                    $query->whereIn('role_id', [4, 6, 7, 8]);
                })
                ->with('contact') // Eager load contact relationship
                ->get()
                ->pluck('contact.fullName', 'id')
                ->toArray();


        }, function ($value) {
            $this->crud->addClause('where', 'agent_id', $value);
        });

        $this->crud->addFilter([
            'name' => 'client_remembered',
            'type' => 'select2',
            'label' => 'Հաճախոդ-հիշված գույքեր',
        ], function () {
            return Client::query()
                ->where('contact_type_id', 4)
                ->whereNotNull(['name_arm'])
                ->select(['id', 'name_arm', 'last_name_arm', 'phone_mobile_1'])
                ->orderBy('contact_id')
                ->get()
                ->take(2)
                ->pluck('fullContact', 'id')
                ->toArray();
        }, function ($value) {
            $client = Client::findOrfail($value);

            $this->crud->addClause('where', 'area_total', '>=', $client->area_from);

            if($client->area_to) {
                $this->crud->addClause('where', 'area_total', '<=', $client->area_to);
            }

            if($client->location_province_id) {
                $this->crud->addClause('where', 'location_province_id', '=', $client->location_province_id);
            }

            if($client->location_city_id) {
                $this->crud->addClause('where', 'location_province_id', '=', $client->location_city_id);
            }
        });


;

        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'updated_at_from',
            'label' => 'Թարմացված սկսած'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'updated_at', '>=', $value);
            });


        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'updated_at_to',
            'label' => 'Թարմացված մինչև'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'updated_at', '<=', $value . ' 23:59:59');
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_8_others',
        ]);
        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_ready_from_rent',
            'label' => 'Պատրաստ է վերակ. վարձակալումից'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'estate_status_id', '=', 6);
                $this->crud->addClause('isReadyFromRent');
            });





        $this->crud->addFilter([
            'name' => 'info_source',
            'type' => 'select2',
            'label' => 'Ինֆորմացիայի աղբյուր',
        ], function () {
            return RealtorUser::whereHas('contact', function (Builder $query) {
                $query->whereNotNull(['name_arm']);
            })->with('contact')->get()->pluck('contact.fullName', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'info_source_id', $value);
        });

        $this->crud->addFilter([
            'name' => 'delete_remembered',
            'type' => 'simple',
            'label' => 'Հեռացնել բոլոր հիշվածները',
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_urgent', 1);
            });


        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'filled_on_from',
            'label' => 'Տեղազննված սկսած'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'filled_on', '>=', $value);
            });


        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'filled_on_to',
            'label' => 'Տեղազննված մինչև'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'filled_on', '<=', $value . ' 23:59:59');
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_4_others',
        ]);



        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'ready_from_archive',
            'label' => 'Պատրաստ է վերակ. արխիվից'
        ], false, function () {
            $currentDate = \Carbon\Carbon::now();
            $this->crud->addClause('whereDate', 'archive_till_date', '<=', $currentDate->toDateString());
            $this->crud->addClause('whereNotNull', 'archive_till_date');
            $this->crud->addClause('where', 'estate_status_id', '=', 8);
        });


        $this->crud->addFilter([
            'name' => 'property_agent',
            'type' => 'select2',
            'label' => 'Տեղազննող Գործակալ',
        ], function () {
            return RealtorUser::whereHas('contact', function (Builder $query) {
                $query->whereNotNull(['name_arm']);
            })->with('contact')->get()->pluck('contact.fullName', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'property_agent_id', $value);
        });

        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'price_down_on_from',
            'label' => 'Սակարկված սկսած'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'price_down_on', '>=', $value);
            });




        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'price_down_on_to',
            'label' => 'Սակարկված մինչև'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'price_down_on', '<=', $value . ' 23:59:59');
            });




        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'verified_on_from',
            'label' => 'Հաստատված սկսած'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'verified_on', '>=', $value);
            });




        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'verified_on_to',
            'label' => 'Հաստատված մինչև'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'verified_on', '<=', $value . ' 23:59:59');
            });



        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_end_agents',
        ]);



        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'apartment_construction',
            'label' => 'Կառուցապատողից'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'apartment_construction', 1);
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_exchangeable',
            'label' => 'Փոխանակելի'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'exchange', 1);
            });



        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_urgent',
            'label' => 'Շտապ'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_urgent', 1);
            });

        $this->crud->addFilter(
            [
                'type' => 'simple',
                'name' => 'is_company_project',
                'label' => 'Մեր գույքերը'
            ],
            false,
            function () {
                $this->crud->addClause('where', 'is_company_project', true);
            }
        );

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_end_filters',
        ]);




    }

}
