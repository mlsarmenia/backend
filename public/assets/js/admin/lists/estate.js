$(document).ready(function() {
    let detailedArea = $('li[filter-name="extended_area"].active');
    if (detailedArea.length > 0) {
        detailedArea.find('input').prop('checked', true);
    }

    let detailedPrice = $('li[filter-name="extended_price"].active');
    if (detailedPrice.length > 0) {
        detailedPrice.find('input').prop('checked', true);
    }

});



