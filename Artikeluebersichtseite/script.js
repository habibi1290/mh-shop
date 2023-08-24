$(document).ready(function() {

    $('html').keypress(function (e) {
        console.log(e);
        if (e.which === 4) {
            $('body').toggleClass('helper-in');
        }
    });

    $('.collapse-bar').click(function () {
        $('#collapse-bar-para1').toggle(50);
        $('i', this).toggleClass("fas fa-plus fas fa-minus");
    });

    $('.collapse-bar1').click(function () {
        $('#collapse-bar-para2').toggle(50);
        $('i', this).toggleClass("fas fa-plus fas fa-minus");
    });

    $('.collapse-bar2').click(function () {
        $('#collapse-bar-para3').toggle(50);
        $('i', this).toggleClass("fas fa-plus fas fa-minus");
    });

    $('.collapse-bar3').click(function () {
        $('#collapse-bar-para4').toggle(50);
        $('i', this).toggleClass("fas fa-plus fas fa-minus");
    });

    $('.filter-option-collapse').click(function(){
        $('.list-filter-option-part-2').toggle(50)
        $('i', this).toggleClass("fas fa-caret-down fas fa-caret-up");
    });

})
