//variablen
var json= '';
var realName= '';
var fakeName= '';
var dataJson= 'data.json';
var wrapperImg= '';
var moreData= '';
var box= '';
var boxInt= '';
var showPower= true;
var showInt= true;
var showIntPower= true;
var showName= true;


//btn-Int
var btnInt = document.createElement('input');
btnInt.classList.add('btn-int');
btnInt.type = 'button';
btnInt.value = 'INT';
document.body.appendChild(btnInt);

//btn-power
var btnPower = document.createElement('input');
btnPower.classList.add('btn-power');
btnPower.type = 'button';
btnPower.value = 'Power';
document.body.appendChild(btnPower);

//btn-Name
var btnName = document.createElement('input');
btnName.classList.add('btnName');
btnName.type = 'button';
btnName.value = 'Name';
document.body.appendChild(btnName);

//container
var container = document.createElement('div');
container.classList.add('container');
document.body.appendChild(container);

var request = new XMLHttpRequest();
request.open('GET', dataJson, true);
request.send();

request.onload = function() {
    json = JSON.parse(request.responseText);
    loadInfo(json);
    loadSortedInt(json);
    loadSortedName(json);
}

function loadInfo(json) {
    for (var i = 0; i < json.length; i++) {
        //box
        box = document.createElement('div');
        box.classList.add('box');
        container.appendChild(box);

        box.addEventListener('click', function(e) {
            var getMoreData = e.target.querySelectorAll('.more-data');
            for(var k = 0; k < getMoreData.length; k++) {
                getMoreData[k].style.display= "block";
            }

            var getFakeName = e.target.querySelectorAll('.fake-name');
            for(var f = 0; f < getFakeName.length; f++) {
                getFakeName[f].style.borderTop= "none";
                getFakeName[f].style.bottom= "60%";
            }

            var getRealName = e.target.querySelectorAll('.real-name');
            for(var r = 0; r < getRealName.length; r++) {
                getRealName[r].style.bottom= "50%";
                getRealName[r].style.borderBottom= "2px solid #ffffff";
            }

            var getFoto = e.target.querySelectorAll('.img');
            for(var img = 0; img < getFoto.length; img++) {
                getFoto[img].style.filter= "blur(5px)";
                getFoto[img].style.transition= "filter 0.5s ease-in" ;
            }
        })

        //image
        wrapperImg = document.createElement('div');
        wrapperImg.classList.add('wrapper-image');
        wrapperImg.innerHTML = '<img class="img" src="' + json[i].image + '" >' ;
        box.appendChild(wrapperImg);

        //fakeName
        fakeName = document.createElement('div');
        fakeName.classList.add('fake-name');
        fakeName.innerHTML = json[i].Name;
        fakeName.style.display = "block";
        wrapperImg.appendChild(fakeName);

        //realName
        if(json[i].EchterName === 'unbekannt') {
            json[i].EchterName = '';
        }else{
            realName = document.createElement('div');
            realName.classList.add('real-name');
            realName.innerHTML = json[i].EchterName;
            realName.style.display = "block";
            wrapperImg.appendChild(realName);
        }

        //moreData
            moreData = document.createElement('div');
            moreData.classList.add('more-data');
            moreData.innerHTML += "<div class='place-of-birth'>"+((!json[i].Geburtsort) ? '' : json[i].Geburtsort)+"</div>" +
                "<div class='gender'>"+((!json[i].Geschlecht) ? '' : json[i].Geschlecht)+"</div>" +
                "<div class='power'>"+((!json[i].Kräfte) ? '' : json[i].Kräfte)+"</div>" +

                "<div class='ability-info'>"
                    + "<span>INT: </span>"+ json[i].INTELLIGENCE+ "</br>" +
                    "<span>STR: </span>"+ json[i].STRENGTH + "</br>" +
                    "<span>SPD: </span>"+ json[i].SPEED + "</br>" +
                    "<span>CMB: </span>"+ json[i].COMBAT +
                "</div>";

            moreData.style.display = "none";
            wrapperImg.appendChild(moreData);
       }
}

function loadSortedInt(json) {
    for (var j = 0; j < json.length; j++) {
        var sorted = sortInt(json);
        //box
        boxInt = document.createElement('div');
        boxInt.classList.add('box-int');
        container.appendChild(boxInt);
        boxInt.style.display = 'none';

        boxInt.addEventListener('click', function(e) {
            var getMoreData = e.target.querySelectorAll('.more-data');
            for(var k = 0; k < getMoreData.length; k++) {
                getMoreData[k].style.display= "block";
            }

            var getFakeName = e.target.querySelectorAll('.fake-name');
            for(var f = 0; f < getFakeName.length; f++) {
                getFakeName[f].style.borderTop= "none";
                getFakeName[f].style.bottom= "60%";
            }

            var getRealName = e.target.querySelectorAll('.real-name');
            for(var r = 0; r < getRealName.length; r++) {
                getRealName[r].style.bottom= "50%";
                getRealName[r].style.borderBottom= "2px solid #ffffff";
            }

            var getFoto = e.target.querySelectorAll('.img');
            for(var img = 0; img < getFoto.length; img++) {
                getFoto[img].style.filter= "blur(5px)";
                getFoto[img].style.transition= "filter 0.5s ease-in" ;
            }
        })

        //image
        wrapperImg = document.createElement('div');
        wrapperImg.classList.add('wrapper-image');
        wrapperImg.innerHTML = '<img class="img" src="' + json[j].image + '" >' ;
        boxInt.appendChild(wrapperImg);

        //fakeName
        fakeName = document.createElement('div');
        fakeName.classList.add('fake-name');
        fakeName.innerHTML = json[j].Name;
        fakeName.style.display = "block";
        wrapperImg.appendChild(fakeName);

        //realName
        if(json[j].EchterName === 'unbekannt') {
            json[j].EchterName = '';
        }else {
            realName = document.createElement('div');
            realName.classList.add('real-name');
            realName.innerHTML = json[j].EchterName;
            realName.style.display = "block";
            wrapperImg.appendChild(realName);
        }

        //moreData
        moreData1 = document.createElement('div');
        moreData1.classList.add('more-data');
        moreData1.innerHTML += "<div class='place-of-birth'>"+((!json[j].Geburtsort) ? '' : json[j].Geburtsort)+"</div>" +
            "<div class='gender'>"+((!json[j].Geschlecht) ? '' : json[j].Geschlecht)+"</div>" +
            "<div class='power-int'>"+((!json[j].Kräfte) ? '' : json[j].Kräfte)+"</div>" +

            "<div class='ability-info'>"
            + "<span>INT: </span>"+ json[j].INTELLIGENCE+ "</br>" +
            "<span>STR: </span>"+ json[j].STRENGTH + "</br>" +
            "<span>SPD: </span>"+ json[j].SPEED + "</br>" +
            "<span>CMB: </span>"+ json[j].COMBAT +
            "</div>";

        moreData1.style.display = "none";
        wrapperImg.appendChild(moreData1);
    }
}

function sortInt(unsorted){
    var sorted = null;
    if(unsorted && unsorted.length > 0) {
       sorted = unsorted.sort(function(a, b) {
           return b.INTELLIGENCE - a.INTELLIGENCE;
        })
    }
    return sorted;
}



function loadSortedName(json) {
    for (var j = 0; j < json.length; j++) {

        var sorted1 = sortName(json);
        //box
        boxName = document.createElement('div');
        boxName.classList.add('box-name');
        container.appendChild(boxName);
        boxName.style.display = 'none';

        boxName.addEventListener('click', function (e) {
            var getMoreData = e.target.querySelectorAll('.more-data');
            for (var k = 0; k < getMoreData.length; k++) {
                getMoreData[k].style.display = "block";
            }

            var getFakeName = e.target.querySelectorAll('.fake-name');
            for (var f = 0; f < getFakeName.length; f++) {
                getFakeName[f].style.borderTop = "none";
                getFakeName[f].style.bottom = "60%";
            }

            var getRealName = e.target.querySelectorAll('.real-name');
            for (var r = 0; r < getRealName.length; r++) {
                getRealName[r].style.bottom = "50%";
                getRealName[r].style.borderBottom = "2px solid #ffffff";
            }

            var getFoto = e.target.querySelectorAll('.img');
            for (var img = 0; img < getFoto.length; img++) {
                getFoto[img].style.filter = "blur(5px)";
                getFoto[img].style.transition = "filter 0.5s ease-in";
            }
        })

        //image
        wrapperImg = document.createElement('div');
        wrapperImg.classList.add('wrapper-image');
        wrapperImg.innerHTML = '<img class="img" src="' + json[j].image + '" >';
        boxName.appendChild(wrapperImg);

        //fakeName
        fakeName = document.createElement('div');
        fakeName.classList.add('fake-name');
        fakeName.innerHTML = json[j].Name;
        fakeName.style.display = "block";
        wrapperImg.appendChild(fakeName);

        //realName
        if (json[j].EchterName === 'unbekannt') {
            json[j].EchterName = '';
        } else {
            realName = document.createElement('div');
            realName.classList.add('real-name');
            realName.innerHTML = json[j].EchterName;
            realName.style.display = "block";
            wrapperImg.appendChild(realName);
        }

        //moreData
        moreData1 = document.createElement('div');
        moreData1.classList.add('more-data');
        moreData1.innerHTML += "<div class='place-of-birth'>" + ((!json[j].Geburtsort) ? '' : json[j].Geburtsort) + "</div>" +
            "<div class='gender'>" + ((!json[j].Geschlecht) ? '' : json[j].Geschlecht) + "</div>" +
            "<div class='power-int'>" + ((!json[j].Kräfte) ? '' : json[j].Kräfte) + "</div>" +

            "<div class='ability-info'>"
            + "<span>INT: </span>" + json[j].INTELLIGENCE + "</br>" +
            "<span>STR: </span>" + json[j].STRENGTH + "</br>" +
            "<span>SPD: </span>" + json[j].SPEED + "</br>" +
            "<span>CMB: </span>" + json[j].COMBAT +
            "</div>";

        moreData1.style.display = "none";
        wrapperImg.appendChild(moreData1);
    }
}

function sortName(unsorted) {
    var sorted = null;
    if(unsorted && unsorted.length > 0) {
        sorted = unsorted.sort(function(a, b) {
            a = a.Name.toLowerCase();
            b = b.Name.toLowerCase();
            return a < b ? -1 : a > b ? 1 : 0;
        });
    }
    return sorted;
}

//btnName
btnName.addEventListener('click', function() {
    showName = !showName;
    var getBox1 = document.querySelectorAll('.box');
    for(var p = 0; p < getBox1.length; p++) {
        if(showName) {
            getBox1[p].style.display= 'none';
        }else {
            getBox1[p].style.display= 'block';
        }
    }

    var getBoxName = document.querySelectorAll('.box-name');
    for(var k = 0; k < getBoxName.length; k++) {
        if(showName) {
            getBoxName[k].style.display = 'block';
            btnName.style.border= '1px solid red';
        }else {
            getBoxName[k].style.display = 'none';
            btnName.style.border= 'none';
        }
    }
})

//btnPower
btnPower.addEventListener("click",function() {
    showPower = !showPower;
    //showIntPower = !showIntPower;
    var getBox = document.querySelectorAll('.box');
    for(var b = 0; b < getBox.length; b++) {
        var getPower = getBox[b].querySelector('.power');
        if (getPower.innerHTML.toLowerCase().includes('stärke')) {
            if (showPower) {
                getBox[b].style.display = 'block';
                btnPower.style.border = 'none';
            }else {
                getBox[b].style.display = 'none';
                btnPower.style.border = '1px solid red';
            }
        }
    }

    /* var getBox1 = document.querySelectorAll('.box');
     for(var p = 0; p < getBox1.length; p++) {
         if(showPower) {
             getBox1[p].style.display = 'none';
         }else {
             getBox1[p].style.display = 'none';
         }
     }

     var getBoxInt = document.querySelectorAll('.box-int');
     for(var q = 0; q < getBoxInt.length; q++) {
         if(showPower) {
             getBoxInt[q].style.display = 'none';
             btnInt.style.border = '1px solid red';
         }else {
             getBoxInt[q].style.display = 'none';
             btnInt.style.border = 'none';
         }
     }*/
})

//btnInt
btnInt.addEventListener('click', function() {

    showInt = !showInt;
    var getBox1 = document.querySelectorAll('.box');
    for(var p = 0; p < getBox1.length; p++) {
        if(showInt) {
            getBox1[p].style.display = 'none';
        }else {
            getBox1[p].style.display = 'block';
        }
    }

    var getBoxInt = document.querySelectorAll('.box-int');
    for(var q = 0; q < getBoxInt.length; q++) {
        if(showInt) {
            getBoxInt[q].style.display = 'block';
            btnInt.style.border = '1px solid red';
        }else {
            getBoxInt[q].style.display = 'none';
            btnInt.style.border = 'none';
        }
    }
})












