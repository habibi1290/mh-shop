//variablen
var realName = '';
var fakeName = '';
var dataJson = 'data.json';
var wrapperImg = '';
var moreData = '';
var box = '';
var btnCombat = '';
var btnStamina = '';
var showPower = false;
var sortedByInt = false;
var sortedBySpeed = false;
var sortedByName = false;
var sortedByCombat = false;
var sortedByStamina = false;
var btnName;
var btnInt;
var btnPower;
var container;
var sortedData;
var originalData;


function init() {
    createElements();
    getData();
}

function createElements() {
    //btn-Int
    btnInt = document.createElement('input');
    btnInt.classList.add('btn','btn-int');
    btnInt.type = 'button';
    btnInt.value = 'Sort by INT';
    document.body.appendChild(btnInt);
    btnInt.addEventListener('click', handleSortInt);
    
    //btn-speed
    btnSpeed = document.createElement('input');
    btnSpeed.classList.add('btn','btn-speed');
    btnSpeed.type = 'button';
    btnSpeed.value = 'Sort by SPEED';
    document.body.appendChild(btnSpeed);
    btnSpeed.addEventListener('click', handleSortSpeed);
    
    //btn-name
    btnName = document.createElement('input');
    btnName.classList.add('btn','btnName');
    btnName.type = 'button';
    btnName.value = 'Sort by Name';
    document.body.appendChild(btnName);
    btnName.addEventListener('click', handleSortName);
    
    //btn-power
    btnPower = document.createElement('input');
    btnPower.classList.add('btn','btn-power');
    btnPower.type = 'button';
    btnPower.value = 'Sort by Power';
    document.body.appendChild(btnPower);
    btnPower.addEventListener("click", handleFilterStrength);

    //btn-combat
    btnCombat = document.createElement('input');
    btnCombat.classList.add('btn','btn-combat');
    btnCombat.type = 'button';
    btnCombat.value = 'sort by Combat';
    document.body.appendChild(btnCombat);
    btnCombat.addEventListener("click",handleSortCombat);

    //btn-stamina
    btnStamina = document.createElement('input');
    btnStamina.classList.add('btn','btn-stamina');
    btnStamina.type = 'button';
    btnStamina.value = 'Sort by Stamina';
    document.body.appendChild(btnStamina);
    btnStamina.addEventListener("click",handleSortStamina);
    
    //container
    container = document.createElement('div');
    container.classList.add('container');
    document.body.appendChild(container);   
}

function getData() {
    var request = new XMLHttpRequest();
    request.open('GET', dataJson, true);
    request.send();
    
    request.onload = function() {
        sortedData = JSON.parse(request.responseText);
        originalData = JSON.parse(request.responseText);
        createBoxes(sortedData);
    }
}

function createBoxes(myJsonData) {
    document.querySelectorAll('.box').forEach(function(elem) { elem.remove(); });
    
    for (var i = 0; i < myJsonData.length; i++) {
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
        wrapperImg.innerHTML = '<img class="img" src="' + myJsonData[i].image + '" >' ;
        box.appendChild(wrapperImg);
        
        //fakeName
        fakeName = document.createElement('div');
        fakeName.classList.add('fake-name');
        fakeName.innerHTML = myJsonData[i].Name;
        fakeName.style.display = "block";
        wrapperImg.appendChild(fakeName);
        
        //realName
        if(myJsonData[i].EchterName === 'unbekannt') {
            myJsonData[i].EchterName = '';
        }else{
            realName = document.createElement('div');
            realName.classList.add('real-name');
            realName.innerHTML = myJsonData[i].EchterName;
            realName.style.display = "block";
            wrapperImg.appendChild(realName);
        }
        
        //moreData
        moreData = document.createElement('div');
        moreData.classList.add('more-data');
        moreData.innerHTML += "<div class='place-of-birth'>"+((!myJsonData[i].Geburtsort) ? '' : myJsonData[i].Geburtsort)+"</div>" +
        "<div class='gender'>"+((!myJsonData[i].Geschlecht) ? '' : myJsonData[i].Geschlecht)+"</div>" +
        "<div class='power'>"+((!myJsonData[i].Kräfte) ? '' : myJsonData[i].Kräfte)+"</div>" +
        
        "<div class='ability-info'>"
        + "<span>INT: </span>"+ myJsonData[i].INTELLIGENCE+ "</br>" +
        "<span>STR: </span>"+ myJsonData[i].STRENGTH + "</br>" +
        "<span>SPD: </span>"+ myJsonData[i].SPEED + "</br>" +
        "<span>CMB: </span>"+ myJsonData[i].COMBAT +
        "</div>";
        
        moreData.style.display = "none";
        wrapperImg.appendChild(moreData);
    }
}

function handleSortCombat() {
    sortedByCombat = !sortedByCombat;

    sortedBySpeed = false;
    sortedByInt = false;
    sortedByName = false;
    document.querySelectorAll('.btn').forEach(function(elem) {
        elem.classList.remove('btn-active');
    });

    if (sortedByCombat) {
        btnCombat.classList.add('btn-active');
        sortedData = sortByCombat(sortedData);
        createBoxes(sortedData);
    } else {
        createBoxes(originalData);
        btnCombat.classList.remove('btn-active');
    }
}

function handleSortName() {
    sortedByName = !sortedByName;

    sortedBySpeed = false;
    sortedByInt = false;
    sortedByCombat = false;
    document.querySelectorAll('.btn').forEach(function(elem) {
        elem.classList.remove('btn-active');
    });
    
    if (sortedByName) {
        btnName.classList.add('btn-active');
        sortedData = sortByName(sortedData);
        createBoxes(sortedData);
    } else {
        createBoxes(originalData);
        btnName.classList.remove('btn-active');
    }
}

function handleSortSpeed() {
    sortedBySpeed = !sortedBySpeed;

    sortedByCombat = false;
    sortedByName = false;
    sortedByInt = false;
    document.querySelectorAll('.btn').forEach(function(elem) {
        elem.classList.remove('btn-active');
    });
    
    if (sortedBySpeed) {
        btnSpeed.classList.add('btn-active');
        sortedData = sortBySpeed(sortedData);
        createBoxes(sortedData);
    } else {
        createBoxes(originalData);
        btnSpeed.classList.remove('btn-active');
    }
}

function handleSortInt() {
    sortedByInt = !sortedByInt;
    
    sortedByName = false;
    sortedBySpeed = false;
    document.querySelectorAll('.btn').forEach(function(elem) {
        elem.classList.remove('btn-active');
    });
    
    if (sortedByInt) {
        btnInt.classList.add('btn-active');
        sortedData = sortByInt(sortedData);
        createBoxes(sortedData);
    } else {
        createBoxes(originalData);
        btnInt.classList.remove('btn-active');
    }
}

function handleSortStamina() {
    sortedByStamina = !sortedByStamina;
    var getBox1 = document.querySelectorAll('.box');

    if (sortedByStamina) {
        btnStamina.classList.add('btn-active');

        for (var j = 0; j < getBox1.length; j++) {
            var getPower1 = getBox1[j].querySelector('.power');

            if (getPower1.innerHTML.toLowerCase().includes('ausdauer')) {
                getBox1[j].style.display = 'block';
            } else {
                getBox1[j].style.display = 'none';
            }
        }
    } else {
        btnStamina.classList.remove('btn-active');

        for (var j = 0; j < getBox1.length; j++) {
            getBox1[j].style.display = 'block';
        }
    }
}

function handleFilterStrength() {
    showPower = !showPower;
    var getBox = document.querySelectorAll('.box');
    if (showPower) {
        btnPower.classList.add('btn-active');

        for (var b = 0; b < getBox.length; b++) {
            var getPower = getBox[b].querySelector('.power');
            
            if (getPower.innerHTML.toLowerCase().includes('stärke')) {
                getBox[b].style.display = 'block';
            } else {
                getBox[b].style.display = 'none';
            }
        }
    } else {
        btnPower.classList.remove('btn-active');

        for (var b = 0; b < getBox.length; b++) {
            getBox[b].style.display = 'block';
        }
    }
}

function sortByInt(unsorted){
    var sorted = null;
    if(unsorted && unsorted.length > 0) {
        sorted = unsorted.sort(function(a, b) {
            return b.INTELLIGENCE - a.INTELLIGENCE;
        })
    }
    return sorted;
}

function sortByCombat(unsorted){
    var sorted = null;
    if(unsorted && unsorted.length > 0) {
        sorted = unsorted.sort(function(a, b) {
            return b.COMBAT - a.COMBAT;
        })
    }
    return sorted;
}

function sortBySpeed(unsorted){
    var sorted = null;
    if(unsorted && unsorted.length > 0) {
        sorted = unsorted.sort(function(a, b) {
            return b.SPEED - a.SPEED;
        })
    }
    return sorted;
}

function sortByName(unsorted) {
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

window.addEventListener('load', init);
