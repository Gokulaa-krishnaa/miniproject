<?php 

$conn=new mysqli('localhost','root','','voter','8111');
if(isset($_POST['reg'])){
    $reg=$_POST['reg'];
    $password=$_POST['password'];
    $sql="select register,password from signup where register=? AND password=?";
    
    $stmt=$conn->prepare($sql);
	$stmt->bind_param("ss",$reg,$password);
	$stmt->execute();
	$stmt->store_result();
	$rnum=$stmt->num_rows;
	if($rnum>=1){
        setcookie('reg',$reg);
        echo "<script>
		window.location.href='../html/profile.php';
		</script>";
	
    }
    else{
		$user_check="select register from signup where register=?";
		$stmt=$conn->prepare($user_check);
		$stmt->bind_param("s",$reg);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows==0)
			echo "<script>alert('USER NOT EXISTS');</script>";
		else
			echo "<script>alert('INCORRECT PASSWORD');</script>";
    }
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votingportal</title>
    <link rel="stylesheet" href="../css/loginpage.css" >

</head>
<body>
    <div class="entrybox">
        <div class="togglearea">
            <div id="btn"></div>
            <button type="button" class="studentteachertoggle" id="student" onclick="student()">STUDENT</button>
            <button type="button" class="studentteachertoggle" id="staffs" onclick="teacher()">TEACHER</button>
        </div>
        <form id="studentlogin" class="input" method="post">
            <input type="text" class="inputfield" placeholder="STUDENT'S REG NO" name="reg" required>
            <br><br>
            <input type="password" class="inputfield" placeholder="PASSWORD" name="password" required>
            <br><br><br>
            <button type="submit" id="loginbutton" class="submitbutton" name='login'>LOGIN</button>
            <button type="button" id="signupbutton" class="submitbutton" onclick="sgotosignup()">SIGNUP</button>
        </form>
        <form id="teacherlogin" class="input">
            <input type="text" class="inputfield" placeholder="TEACHER'S-USER-ID" required>
            <br><br>
            <input type="password" class="inputfield" placeholder="PASSWORD" required>
            <br><br><br>
            <button type="submit" id="loginbutton" class="submitbutton">LOGIN</button>
            <button type="button" id="signupbutton" class="submitbutton" onclick="tgotosignup()">SIGNUP</button>
        </form>
    </div>
   <script src="../js/loginpagejs.js"></script>

</body>
</html>