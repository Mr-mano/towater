import "popper.js";
import "bootstrap";
import "jquery"

import "../css/app.scss";


/*modale 1
const current = document.querySelector('#current');
let enlargeMessages = document.querySelectorAll('.photo-overlay p');
const modal = document.getElementById('modal');
const overlay = document.querySelectorAll('.photo-overlay');
const modalContainer = document.querySelector('.modal-container');


for (let i =0; i < enlargeMessages.length; i++){
    enlargeMessages[i].addEventListener('click', imgClick);
}

window.addEventListener('click', clickOutside);

function imgClick(e){
    modal.style.display = 'block';
    current.src = e.target.parentNode.previousElementSibling.src;
}

function clickOutside(e){
    if(e.target == modal || e.target == modalContainer){
        modal.style.display = 'none';}
}
*/
/*modale 2*/

$(function(){

    var i=0,
        length = $("#gallery img").length;

    $("#gallery img").each(function(){
        i++;
        $(this).attr("id", "image" + i)
    })

    $("#gallery img").click(function(){

        $("#modal").fadeIn();
        i=$(this).index()+1;
        $("#modalImg").attr("src", $(this).attr("src"));

        var imgWidth = $("#modalImg").width(),
            imgHeight = $("#modalImg").height();

        if(imgWidth > imgHeight){
            $("#modalContent").css({maxWidth: "700px"})
        }else{
            $("#modalContent").css({maxWidth: "250px"})
        }

    });

    $("#close").click(function(){

        $("#modal").fadeOut()

    });

    $("#rarr").click(function(){
        i++;
        $("#modalImg").attr("src", $("#image" + i).attr("src"));
        if(i>length){
            i=1;
            $("#modalImg").attr("src", $("#image" + i).attr("src"));
        }
    });

    $("#larr").click(function(){
        i--;
        $("#modalImg").attr("src", $("#image" + i).attr("src"));
        if(i<1){
            i=length;
            $("#modalImg").attr("src", $("#image" + i).attr("src"));
        }
    })

})