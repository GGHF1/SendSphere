$(document).ready(function() {
    $('#country').change(function() {
        var selectedCountryId = $(this).val();
        $('#city').val(''); 
        $('#city option').each(function() {
            var cityCountryId = $(this).data('country-id'); 

            if (selectedCountryId == cityCountryId || selectedCountryId == '') {
                $(this).show(); 
            } else {
                $(this).hide(); 
            }
        });
    });
});
