/*function init() {
     $.ajax("https://jsonplaceholder.typicode.com/albums")

        .done(function (result) {
            console.log(result);
            const d = document.createElement("div")
            d.setAttribute("class", "album")
            document.querySelector(".box").appendChild(d)

            for(let i = 1; i <= result.length; i++){
                const d2 = document.createElement("div")
                d2.setAttribute("id", "album" + i)
                d2.setAttribute("data-id", i)
                d.appendChild(d2)
                d2.innerHTML = result[i-1].title;
                d2.addEventListener("click", function(e){
                    console.log(e.currentTarget.dataset.id)
                    console.log(e.currentTarget)
                        var jqxhr = $.ajax("https://jsonplaceholder.typicode.com/photos/" + e.currentTarget.dataset.id)
                            .done(function(ergebnis) {
                                console.log(ergebnis)
                                d2.innerHTML += "<div id='foto" + i + "'>" + ergebnis.title + "</div>";
                            })

                })
            }
        })

        .fail(function () {
            console.log("error");
        })
    }

$(document).ready(init);*/


/*$(document).ready(function(){
    $.ajax({
        url : 'https://jsonplaceholder.typicode.com/albums',
        success: ausgabe
    })
})
function ausgabe(data){
    var html= '';
    $.each(data,function(k,v){
        html+='<div class="line">'+v.title+'</div>'
    })
   $('#output').html(html)


    $('.line').click(function(){
        $.ajax({
            url: 'https://jsonplaceholder.typicode.com/posts',
            success: replace
        })
    })
    function replace(){
        var html_1='';
        $.each(data, function(k,v){
          html_1+='<div>'+v.id+'</div>'
            $('.line').html(html_1)
        })

    }
}*/






/*$(document).ready(function () {
    $.ajax({
        url: "https://jsonplaceholder.typicode.com/albums",
        success: ausgabe,
    });
});
function ausgabe(data) {
    var html = "";
    $.each(data, function (k, v) {
        html += '<div class="line" id="l'+k+'">' + v.title + "</div>";
    });
    $("#output").html(html);


    $(".line").on("click", function () {
        var $that = $(this)
        var index = $that.index()
        $.ajax({
            url: "https://jsonplaceholder.typicode.com/posts/" + parseInt(index+1),
            success: replace
        });
        function replace(result) {
            $('#l'+ index).append("<div>"+result.title+"</div>")
        }
    });
}*/






document.querySelector('#clicked').addEventListener('click',loadajax)
var json='';
var json_1='';

function loadajax(data){
var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status==200) {
            json = JSON.parse(xhr.responseText)
            for (var i = 0; i < json.length; i++) {
                var d = document.createElement('div')
                d.setAttribute('id','album')
                d.setAttribute('data-id',i+1)
                d.innerHTML += json[i].title;
                document.querySelector('#output').appendChild(d)

                d.addEventListener('click', function(e){
                    var current = e.currentTarget;
                    var xhr_1 = new XMLHttpRequest();
                    xhr_1.onreadystatechange = function(){
                        if(xhr_1.readyState == 4 &&  xhr_1.status == 200){
                            json_1 = JSON.parse(xhr_1.responseText)
                            current.innerHTML += "<div id='posts'>" + json_1.id + "</div>";
                        }
                    }
                    xhr_1.open('GET','https://jsonplaceholder.typicode.com/posts/'+ current.dataset.id,true)
                    xhr_1.send()
                })
            }
        }
    }
xhr.open('GET','https://jsonplaceholder.typicode.com/albums',true)
xhr.send();
}





























