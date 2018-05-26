$(document).ready(function() {
    var stext_max = 250;
    $('#sdfeedback').html((stext_max - $('#shortdescription').val().length) + ' characters remaining');

    $('#shortdescription').keyup(function() {
        var stext_length = $('#shortdescription').val().length;
        var stext_remaining = stext_max - stext_length;

        $('#sdfeedback').html(stext_remaining + ' characters remaining');
    });

    var ltext_max = 3500;
    $('#ldfeedback').html((ltext_max - $('#longdescription').val().length) + ' characters remaining');

    $('#longdescription').keyup(function() {
        var ltext_length = $('#longdescription').val().length;
        var ltext_remaining = ltext_max - ltext_length;

        $('#ldfeedback').html(ltext_remaining + ' characters remaining');
    });
});
