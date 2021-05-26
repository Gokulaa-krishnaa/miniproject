function goback(){
    window.location.href="homepage.php";
}
function signout(){
    window.location.href="loginhtml.php";
}
function gotback(){
    window.location.href="teacherhomepage.php";
}
/*************************************studentpage***********************************************/

function gosback(){
    window.location.href="studentshomepage.php";
}
/*******************************************************HOMEPAGE***********************************************************/
/*************************************teacherPAGE***********************************************/

function gototprofile(){
    window.location.href="teachersprofile.php";
}
function gotomore(){
    window.location.href="more.php";
}
function on() {
    document.getElementById("more-slide").style.display = "block";
  }
  
  function off() {
    document.getElementById("more-slide").style.display = "none";
  }
function doflip(index){
    var temp=document.getElementsByClassName("totalcontent");
    temp[index].style.transform="rotateY(180deg)";
}
function dobackflip(index){
    var temp=document.getElementsByClassName("totalcontent");
    temp[index].style.transform="rotateY(0deg)";
}
/*************************************studentpage***********************************************/
function gotosprofile(){
    window.location.href="studentprofile.php";
}
function govote(){
    window.location.href=""
}