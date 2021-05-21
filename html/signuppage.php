<?php
if(isset($_POST['signup']))
{

$name=$_POST['name'];
$dept=$_POST['dept'];
$class=$_POST['class'];
$year=$_POST['year'];
$reg=$_POST['reg'];
$collageid=$_POST['collageid'];
$mobile=$_POST['mobile'];
$gender=$_POST['gender'];
$mailid=$_POST['mailid'];
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];

	$conn=new mysqli('localhost','root','','voter','8111');
	if($conn->connect_error)
	{
		die('connection failed'.$conn->connect_error);
	}else{
		$sql="SELECT register from signup where register=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("s",$reg);
		$stmt->execute();
		$stmt->bind_result($reg);
		$stmt->store_result();
		$rnum=$stmt->num_rows;
		if($rnum==0){
			$stmt->prepare("insert into signup(name,department,class,year,register,collageid,mobile,gender,mailid,password) values(?,?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssssisisss",$name,$dept,$class,$year,$reg,$collageid,$mobile,$gender,$mailid,$pass1);
			$stmt->execute();
			echo "<script>
				alert('registration successful');
		         window.location.href='loginhtml.php';  
		</script>";
		}else{
			echo "<script>alert('user already exist with reg no: $reg')
			     
			</script>";
		}
		$stmt->close();
		$conn->close();
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <link rel="stylesheet" href="../css/signuppage.css" >
</head>

<body>
    <div class="detailsformbox">
    <h1>DETAILS</h1>
    <form id="studentsignup" class="input" method="post" action="">
            <label for="name">FULL NAME:</label>
            <input type="text" class="inputfield" placeholder="NAME" name="name" required>
            <br><br>
            <label for="dept">DEPARTMENT:</label>
            <select placeholder="DEPT" class="inputfield dropdown" id="dept" name="dept" required>
                <option value="CSE">CSE</option>
                <option value="MECH">MECH</option>
                <option value="ECE">ECE</option>
                <option value="EEE">EEE</option>
              </select>
            <br><br>
            <label for="class">CLASS:</label>
            <select placeholder="CLASS" class="inputfield dropdown" id="class" name="class" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
            <br><br>
            <label for="year">YEAR:</label>
            <select placeholder="YEAR" class="inputfield dropdown" id="year" name="year" required>
                <option value="1">I</option>
                <option value="2">II</option>
                <option value="3">III</option>
                <option value="4">IV</option>
              </select>
            <br><br>
            <label for="reg-no.">REGISTER NUMBER:</label>
            <input type="text" class="inputfield" placeholder="REG NO." name="reg" required>
            <br><br>
            <label for="clg-id">COLLEGE-ID:</label>
            <input type="text" class="inputfield" placeholder="COLLEGE-ID" name="collageid" required>
            <br><br>
            <label for="mobilenumber">MOBILE NUMBER:</label>
            <input type="text" class="inputfield" placeholder="MOBILE NO." name="mobile" required>
            <br><br>
            <label for="gender">GENDER:</label>
            <select placeholder="GENDER" class="inputfield dropdown" id="gender" name="gender" required>
                <option value="male">MALE</option>
                <option value="female">FEMALE</option>
                <option value="others">OTHERS</option>
        
              </select>
            <br><br>
            <label for="mailid">MAILD-ID:</label>
            <input type="email" class="inputfield" placeholder="MAIL-ID" name="mailid" required>
            <br><br>
            <label for="password">PASSWORD:</label>
            <input type="password" class="inputfield" placeholder="PASSWORD" name="pass1" required>
            <br><br>
            <label for="password">CONFIRM PASSWORD:</label>
            <input type="password" class="inputfield" placeholder="CONFIRM-PASSWORD" name="pass2" required>
            <br><br><br>
            <button type="button" id="backbutton" class="submitbutton" onclick="gotoprev()" >BACK</button>
            <button type="button" id="clearbutton" class="submitbutton" onclick="refresh()" >CLEAR</button>
            <button type="submit" id="signupbutton" class="submitbutton" name="signup" >SIGNUP</button>
    </form>
</div>
<script src="../js/signuppage.js"></script>
</body>

</html>