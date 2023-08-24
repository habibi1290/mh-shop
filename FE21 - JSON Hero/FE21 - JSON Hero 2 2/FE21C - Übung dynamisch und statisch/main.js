var box = document.querySelectorAll('.box');
var img  = document.querySelectorAll('.img');
//var info  = document.querySelector('.info');
//var info1  = document.querySelector('.info1');
var fakeName = document.querySelectorAll('.fake-name');
var realName = document.querySelectorAll('.real-name');
var dataJson = 'data.json';

var request = new XMLHttpRequest();
request.open('GET', dataJson, true);
request.send();
var json = '';
request.onload = function() {
    json = JSON.parse(request.responseText);
    loadName(json);
}

function loadName(json) {
    for (var i = 0; i < json.length; i++) {
        fakeName[i].innerHTML += json[i].Name;
        realName[i].innerHTML += json[i].EchterName;

        box.forEach(item => {
           item.addEventListener('click', moreData);

       })
    }
}

function moreData(){
    for (var j = 0; j < json.length; j++) {
        realName[j].innerHTML += json[j].Geburtsort + '</br>' + json[j].Geschlecht;
       // info1.innerHTML += json[1].Geburtsort + '</br>' + json[1].Geschlecht;
    }
}




