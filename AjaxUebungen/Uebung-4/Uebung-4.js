
var d = document.createElement("div")
d.setAttribute("id", "output")
var u = document.createElement("ul")
u.setAttribute("id", "taskList")
d.appendChild(u);
document.body.appendChild(d)

var data = '{"tasks":{"CutGrass":false,"CleanRoom":false,"GotoRoom":true,"makeDinner":false}}';

var jasonData = JSON.parse(data);
console.log(jasonData);
for(var key in jasonData.tasks){
    console.log(key, jasonData.tasks[key]);
    var status =! jasonData.tasks[key]? '':'checked';
    var html = '<li>'+key+'<input type="checkbox" value="'+key+'" '+status+'></li>';
    taskList.innerHTML += html;
}

/*for(var i = 0; i <jasonData.length; i++ ){
    console.log(jasonData[i].tasks)
}*/

