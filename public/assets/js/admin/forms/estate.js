crud.field('location_province').onChange(function(field) {
    crud.field('location_community').show(field.value == 1);
    crud.field('location_city').hide(field.value == 1);
}).change();

crud.field('is_separate_building').onChange(function(field) {
    crud.field('address_apartment').show(field.value == 0).enable(field.value == 0);
}).change();

crud.field('is_estate_commercial_land').onChange(function(field) {
    crud.field('land_type').show(field.value == 1).enable(field.value == 1);
    crud.field('land_use_type').show(field.value == 1).enable(field.value == 1);
    crud.field('land_structure_type').show(field.value == 1).enable(field.value == 1);
    crud.field('communication_type').show(field.value == 1).enable(field.value == 1);
    crud.field('fence_type').show(field.value == 1).enable(field.value == 1);
    crud.field('road_way_type').show(field.value == 1).enable(field.value == 1);
    crud.field('front_with_street').show(field.value == 1).enable(field.value == 1);
    crud.field('front_length').show(field.value == 1).enable(field.value == 1);
}).change();

crud.field('is_organization').onChange(function(field) {
    crud.field('name_arm').show(field.value == 0).enable(field.value == 0);
    crud.field('name_en').show(field.value == 0).enable(field.value == 0);
    crud.field('name_ru').show(field.value == 0).enable(field.value == 0);
    crud.field('last_name_arm').show(field.value == 0).enable(field.value == 0);
    crud.field('last_name_en').show(field.value == 0).enable(field.value == 0);
    crud.field('last_name_ru').show(field.value == 0).enable(field.value == 0);
    crud.field('organization').show(field.value == 1).enable(field.value == 1);
}).change();

crud.field('estate_status').onChange(function(field) {
    crud.field('archive_till_date').show(field.value == 8).enable(field.value == 8);
    crud.field('archive_comment_arm').show(field.value == 8).enable(field.value == 8);
}).change();

crud.field('estate_status').onChange(function(field) {
    crud.field('rentContracts').show(field.value == 6).enable(field.value == 6);
    crud.field('rentContracts').show(field.value == 6).enable(field.value == 6);
}).change();

crud.field('contract_type').onChange(function(field) {
    crud.field('owner').hide(!field.value);
    crud.field('owner').hide(field.value == 1);
    crud.field('owner')
        .show(field.value == 2 || field.value == 3)
        .enable(field.value == 2 || field.value == 3)
        .require();

    crud.field('seller').hide(!field.value);
    crud.field('seller').show(field.value == 1).enable(field.value == 1).require();
    crud.field('seller').hide(!field.value || field.value == 2 || field.value == 3);
}).change();

crud.field('is_published').onChange(function(field) {
    crud.field('url').show(field.value == 1).enable(field.value == 1);
}).change();

function checkActionParameter(action) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('action') === action;
}

// Perform actions based on the 'action' parameter
$(document).ready(function() {

    const priceInput = document.querySelector("[name='price_amd']");
    const priceInputS = new AutoNumeric(priceInput, 'integer');

    if (checkActionParameter()) {
        $statusList =  crud.field('estate_status').input;
        $($statusList).val(3);
        $($statusList).trigger('change');
    }
});

$(document).ready(function() {
    if (checkActionParameter('recover')) {
        $statusList =  crud.field('estate_status').input;
        $($statusList).val(1);
        $($statusList).trigger('change');
    }

    if (checkActionParameter('archive')) {
        $statusList =  crud.field('estate_status').input;
        $($statusList).val(8);
        $($statusList).trigger('change');
    }

    if (checkActionParameter('selled')) {
        $statusList =  crud.field('estate_status').input;
        $($statusList).val(7);
        $($statusList).trigger('change');
    }

});
