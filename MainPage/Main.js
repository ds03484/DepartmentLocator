/**
 * Created by ds034_000 on 10/13/2015.
 */

$(document).ready(function(){
    $('#Department').submit(function(e){
        e.preventDefault();
        var details = $('#Department').serialize();
        $.post('getDept.php', details, function(data) {
            $('#DeptContent').html(data);
        });

    });
});