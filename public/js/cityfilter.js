$(document).ready(function() {
    $('#country').change(function() {
        var selectedCountryId = $(this).val();
        $('#city').empty(); 

        if (selectedCountryId) {
            $.ajax({
                url: '/cities/' + selectedCountryId,
                type: 'GET',
                dataType: 'json',
                success: function(cities) {
                    $('#city').append('<option value="">Select City</option>');
                    $.each(cities, function(index, city) {
                        $('#city').append('<option value="' + city.city_id + '">' + city.name + '</option>');
                    });
                },
                error: function() {
                    console.error('Failed to fetch cities');
                }
            });
        } else {
            $('#city').append('<option value="">Select City</option>');
        }
    });
});
