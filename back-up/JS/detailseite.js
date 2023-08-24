$(document).ready(function(){
    console.log('in ready function');
    $('html').keypress(function(e) {
        // console.log(e);
        if(e.which === 83){
            $('body').toggleClass('helper-in')
        }
    });

    $('.navbar-menu').click(function() {
        $('.navbar-menu-email').toggle();
    })

})
