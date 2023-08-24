
var myobjekt = {
    "friends": [{
        "firstName": "john"
        ,"lastName": "jones"
    },{
        "firstName": "martin"
        ,"lastName": "müller"
    },{
        "firstName": "lorenz"
        ,"lastName": "hagebauer"
    }]
}

var d = document.createElement("div")
document.body.appendChild(d);

var friendlist = myobjekt.friends;
var HTMLContent = "";
for(var i = 0; i <friendlist.length; i++){
    console.log(friendlist[i]);
    HTMLContent += friendlist[i].firstName+''+friendlist[i].lastName + '</br>';
}

d.innerHTML = HTMLContent;


