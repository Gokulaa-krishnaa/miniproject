/*************************signin-page *************************/
var x= document.getElementById("studentlogin");
        var y= document.getElementById("teacherlogin");
        var z= document.getElementById("btn");
        function teacher(){
            x.style.left= "-380px";
            y.style.left= "-460px";
            z.style.left= "120px";
        }
        function student(){
            x.style.left= "0px";
            y.style.left= "0px";
            z.style.left= "0px";
        }
        function sgotosignup(){
            window.location.href = "studentsignuppage.php"; 
        }
        function tgotosignup(){
            window.location.href = "teachersignup.php";
        }
/*************************signup-page *************************/
        function gotoprev(){
            window.location.replace("loginhtml.php");
        }    
        function refresh(){
            window.location.replace("studentsignuppage.php");
            }