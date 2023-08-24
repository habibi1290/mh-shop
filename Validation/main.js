
//variables
//var zipcode = '';
//var alert = '';

//init
//document.addEventListener("DOMContentLoaded", function() {
    //variables
  /*  var inputfield = document.getElementById('postcode')
    alert = document.getElementById('alert');
    var select = document.getElementById('land');

    //eventlistener
    select.addEventListener('change', selectFunction)
    inputfield.addEventListener('blur', selectFunction)
});




function selectFunction(){
      zipcode = document.getElementById('postcode').value;
      var selectedCountry = document.getElementById('land').value;

    switch(selectedCountry){
        case 'Deutschland':
                if (!((/^[0-9]{5}/.test(zipcode)))) {
                    alert.style.display = 'block';
                    alert.innerHTML = 'plz muss nur 5 ziffern lang sein';


                } else {
                    alert.style.display = 'none';

                }
            break;

       case 'Österreich':
            if(!((/^[0-9]{4}/.test(zipcode) ))){
                alert.style.display = 'block';
                alert.innerHTML= 'plz muss nur 4 ziffern lang sein';


            } else {
                alert.style.display = 'none';

            }
            break;

        case 'Schweiz':
            if(!((/^[0-9]{4}/.test(zipcode) ))){
                alert.style.display = 'block';
                alert.innerHTML= 'plz muss nur 4 ziffern lang sein';


            } else {
                alert.style.display = 'none';

            }
            break;
    }

    }*/

$(function(){
    $("#land").on('change', zipcodeValidation)
    $("#postcode").on('blur', zipcodeValidation)
});

function zipcodeValidation() {
        switch($("#land").val()){
            case 'Deutschland':
                if (!((/^[0-9]{5}/.test($("#postcode").val())))) {
                    $("#alert").css("display", "block");
                    $("#alert").html("plz muss 5 ziffern lang sein");
                } else {
                    $("#alert").css("display","none")
                }
                break;


            case 'Österreich':
                if (!((/^[0-9]{4}/.test($("#postcode").val())))) {
                    $("#alert").css("display", "block");
                    $("#alert").html("plz muss 4 ziffern lang sein");
                } else {
                    $("#alert").css("display","none");
                }
                break;


            case 'Schweiz':
                if (!((/^[0-9]{4}/.test($("#postcode").value)))) {
                    $("#alert").css("display", "block");
                    $("#alert").html("plz muss 4 ziffern lang sein");
                } else {
                    $("#alert").css("display","none");
                }
                break;
            }
}


