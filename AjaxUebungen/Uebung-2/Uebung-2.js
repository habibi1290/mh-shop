
var data= '{"results":[{"gender":"female","name":{"title":"mrs","first":"brandie","last":"harper"},"location":{"street":"6201 w sherman dr","city":"dayton","state":"oklahoma","postcode":62855},' +
    '"email":"brandie.harper@example.com","login":{"username":"brownbutterfly621","password":"gonzo","salt":"GsbcT8AP","md5":"57cc5b1158d11bb68e899297fef0ebf5","sha1":"0ae0b3af0d2a91754802217f2785f74e93392591","sha256":' +
    '"4fa6313116c8f3d4d55d79e3a0e8ac7382dfb53d3e5e0b55c89db71f08861296"},' +
    '"dob":"1992-07-25 23:42:44","registered":"2013-06-20 21:46:22","phone":"(477)-226-7686","cell":"(052)-024-9912","id":{"name":"SSN","value":"210-83-7107"},"picture":{"large":"https://randomuser.me/api/portraits/women/85.jpg",' +
    '"medium":"https://randomuser.me/api/portraits/med/women/85.jpg",' +
    '"thumbnail":"https://randomuser.me/api/portraits/thumb/women/85.jpg"},"nat":"US"}],' +
    '"info":{"seed":"cb7d885d5ca37ec4","results":1,"page":1,"version":"1.1"}}'

/*console.log(data);*/

var dataJSON = JSON.parse(data)
console.log(dataJSON.results);

var person = dataJSON.results[0];

var d = document.createElement("div")
document.body.appendChild(d)
var htmlContent = person.name.last+' '+person.name.first
htmlContent += '<img src="'+person.picture.thumbnail+'">';
d.innerHTML = htmlContent;