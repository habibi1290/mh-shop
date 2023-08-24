$(document).ready(function() {

    $('html').keypress(function (e) {
        // console.log(e);
        if (e.which === 4) {
            $('body').toggleClass('helper-in')
        }
    });
});


