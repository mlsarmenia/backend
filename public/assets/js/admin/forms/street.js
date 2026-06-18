crud.field('parent_is_community').onChange(function(field) {
    crud.field('location_community').show(field.value == 1);
    crud.field('location_city').hide(field.value == 1);
}).change();
