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
            window.location.href = "file:///C:/Users/Ganapathi%20Raman/Desktop/mini%20project/html/signuppage.html";
            // window.location.replace("");
            // setTimeout("sgotosignup()", 100);
        }