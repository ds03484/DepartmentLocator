/**
 * Created by ds034_000 on 10/13/2015.
 */

$(document).ready(function(){
    //populate dropdown menu
    $('#departments').append($("<option>"));
    $.getJSON('DeptID.json').then( function(data){
        $.each(data, function(index, dept){
            $("#departments").append(
                $("<option>").attr("value", dept).text(dept)
            );
        });
    });

    //provide address info for selected department id
    $('#Department').submit(function(e){
        e.preventDefault();
        var details = $('#Department').serialize();
        $.post('getDept.php', details, function(data) {
            $('#DeptContent').html(data);
        });
    });
});