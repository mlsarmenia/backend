{{-- regular object attribute --}}
@php
    $column['value'] = $column['value'] ?? data_get($entry, $column['name']);
    $column['escaped'] = $column['escaped'] ?? true;
    $column['limit'] = $column['limit'] ?? 32;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['text'] = $column['default'] ?? '-';
    $column['hideLabel'] = true;

    if($column['value'] instanceof \Closure) {
        $column['value'] = $column['value']($entry);
    }

    if(is_array($column['value'])) {
        $column['value'] = json_encode($column['value']);
    }

    if(!empty($column['value'])) {
        $column['text'] = $column['prefix'].Str::limit($column['value'], $column['limit'], '…').$column['suffix'];
    }


      $showMap = false;

    if($column['value']) {
          $coordinatesData = $column['value'];

    $coordinates = $coordinatesData ? explode(',', $coordinatesData) : null;
    $defaultLat = $coordinates ? $coordinates[0] : null;
    $defaultLng = $coordinates ? $coordinates[1] :null;

   $mapValue = [
    'lat' => $defaultLat,
    'lng' => $defaultLng,
];

   $mapValueJson = json_encode($mapValue);
   $showMap = true;
    } else {
        $mapValueJson =  json_encode([
    'lat' => 40,
    'lng' => 44.5,
]);


    }

@endphp
@if($showMap)

<div style="overflow: hidden">
    <input id="googleMap" type="hidden" name="mapValue" value="{{ $mapValueJson }}">
    <div style="width: 100%;height:500px" map-unique-name="map_location"></div>
</div>
@endif

@push('after_scripts')
    @bassetBlock('backpack/pro/fields/google-map-field.js')
    <script>
        $(document).ready(function() {

            if(typeof google === "undefined") { return; }



            // setup the appropriate unique names for the elements and return html entities not jquery objects
            let mapField = $("#googleMap").closest('div:not(".input-group, .input-group-prepend")').children('input[type=hidden]');

            let element = $("#googleMap");



            mapField = mapField[0];

            let mapImageElement = $(element).closest('div:not(".input-group, .input-group-prepend")').children('[map-unique-name]');
            mapImageElement.attr('map-unique-name', 'map_location');

            var map = null;
            var marker = null


            try {
                if (mapField.value) {
                    var existingData = JSON.parse(mapField.value);
                    var latlng = new google.maps.LatLng(existingData.lat, existingData.lng);

                } else {
                    var lat = JSON.stringify(element.data('google-default-lat'));
                    var lng = JSON.stringify(element.data('google-default-lng'));
                    var latlng = new google.maps.LatLng(lat, lng);
                }

                map = new google.maps.Map(document.querySelector('[map-unique-name="map_location"]'), {
                    center: latlng,
                    zoom: 15,
                    mapTypeId: "roadmap",
                });
                infoWindow = new google.maps.InfoWindow();


                marker = new google.maps.Marker({
                    map,
                    position: latlng,
                    draggable: true
                });
                // drag response


                // Create the search box and link it to the UI element.
                element.keydown(function(e) {
                    if ($('.pac-container').is(':visible') && e.keyCode == 13) {
                        e.preventDefault();
                        return false;
                    }
                });


            } catch (e) {
                console.log(e);
            }



        });

    </script>
    @endBassetBlock

    @loadOnce('google_places_api_script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&key={{ config('services.google_places.key') }}&language=en" async defer></script>
    @endLoadOnce
@endpush
