$(document).ready(function() {
    $('.recherche').on("input",function (error) {
        var list = {};
        var input = $(this).val();
        getData(input, list);
    })
    Materialize.updateTextFields();
})
function getData(input, list) {
    $.ajax({
        url: "https://timetable.search.ch/api/completion.en.json?nofavorites=0&term="+input,
        type: 'Get',
        dataType: 'json',
        success: function(result){
            $.each(result, function( id, val ) {
                list[val.label] = null;
            });

            $('input.recherche').autocomplete({
                data: list,
                limit: 10, // The max amount of results that can be shown at once. Default: Infinity.
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
        }
    })
}
