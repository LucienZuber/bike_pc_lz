$(document).ready(function(){
    var list = [];
    $(".recherche").on("keydown",function(){
        var input = $(this).val();
        $.getJSON("https://timetable.search.ch/api/completion.en.json?term="+input, function (data) {
                for (var i=0; i<data.length; i++){
                    list.push(data[i]["label"]);
                }
            }
        ).done(function(){
            $(".recherche").autocomplete(
                {source : list}
            );
        });
    });
});