function autocompletionFromDB(input, stations) {
    $.ajax({
        url: '/resabike/index/getStations',
        data: {
            'input': input
        },
        type: 'GET',
        success: function (resultJSON) {
            var result = JSON.parse(resultJSON);

            $.each(result, function (id, val) {
                stations[val.name] = null;
            });

            $('input.autocompleteDB').autocomplete({
                data: stations,
                limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
        }
    });
}