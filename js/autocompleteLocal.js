$(document).ready(function() {
    $('.rechercheDB').on("input",function (error) {
        var stations = {};
        var input = $(this).val();
        getData(input, stations);
    })
    Materialize.updateTextFields();
})

function getData(input, stations) {
    $.ajax({
        url: '/bike_pc_lz/UI/getStation.php?input='+input,
        type: 'GET',
        dataType: 'json',
        success: function(result){
            console.log(result);
            //var result = JSON.parse(result)
            $.each(result, function( id, val ) {
                stations[val.name] = null;
            });

            $('input.rechercheDB').autocomplete({
                data: stations,
                limit: 10, // The max amount of results that can be shown at once. Default: Infinity.
                minLength: 2, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
        }
    })
}