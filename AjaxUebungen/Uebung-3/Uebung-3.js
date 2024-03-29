
var myForm = document.getElementById('myForm');

window.onload = function(){
    if(sessionStorage['person'] != null){
        var data = JSON.parse(sessionStorage['person'])
        var message = 'Welcome '+data.first+' '+data.last+' to the site!!!';
        document.getElementById('output').innerHTML = message;
        console.log(data)
    }
}

myForm.addEventListener('submit',function(e){
    e.preventDefault();
    var data = JSON.stringify(formData(myForm));
    if(data){
        sessionStorage['person'] = data;
    }
    console.log(data)
})

function formData(form){
    var el = form.querySelectorAll('input[type="text"]');
    var myData = {};
    for(var x=0;x<el.length;x++){
        var name = el[x].name;
        var value = el[x].value;
        myData[name ] = value
    }

    return myData;
}
