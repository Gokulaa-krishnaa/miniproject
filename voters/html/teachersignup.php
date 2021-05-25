<?php
$dept_codes=["dept"=>["CSE"=>'1',"MECH"=>"2","ECE"=>"3","EEE"=>"4"],"year"=>["1"=>"1","2"=>"2","3"=>"3","4"=>"4"],"sec"=>["A"=>"1","B"=>"2","C"=>"3","D"=>"4"]];
if(isset($_POST['signup']))
{

$name=$_POST['name'];
$dept=$_POST['dept'];
$cdeptt=$_POST['deptt'];
$cclass=$_POST['cclass'];
$cyear=$_POST['cyear'];
$collageid=$_POST['collageid'];
$mobile=$_POST['mobile'];
$gender=$_POST['gender'];
$mailid=$_POST['mailid'];
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];
$coord=$dept_codes["year"][$cyear].$dept_codes["dept"][$cdeptt].$dept_codes["sec"][$cclass];
$conn=new mysqli('localhost','root','','voter','8111');
	if($conn->connect_error)
	{
		die('connection failed'.$conn->connect_error);
	}else{
		$sql="SELECT collageid from teacher where collageid=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("s",$collageid);
		$stmt->execute();
		$stmt->bind_result($collageid);
		$stmt->store_result();
		$rnum=$stmt->num_rows;
		if($rnum==0){
			$stmt->prepare("insert into teacher(name,department,coordinator,collageid,mobile,gender,mailid,password) values(?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssssssss",$name,$dept,$coord,$collageid,$mobile,$gender,$mailid,$pass1);
			$stmt->execute();
			echo "<script>
				alert('registration successful');
		         window.location.href='loginhtml.php';  
		</script>";
		}else{
			echo "<script>alert('user already exist with collage_id: $collageid')
			     
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
    <h1>TEACHER'S SIGN-UP</h1>
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
            <label for ="coordinatorof">CORRODINATOR OF:</label>
            <br>
            <label for="year">YEAR:</label>
            <select placeholder="YEAR" class="inputfield dropdown" id="cyear" name="cyear" required>
                <option value="1">I</option>
                <option value="2">II</option>
                <option value="3">III</option>
                <option value="4">IV</option>
              </select>
              <br>
              <label for="dept">DEPT:</label>
            <select placeholder="DEPT" class="inputfield dropdown" id="cdeptt" name="deptt" required>
                <option value="CSE">CSE</option>
                <option value="MECH">MECH</option>
                <option value="ECE">ECE</option>
                <option value="EEE">EEE</option>
              </select>
              <br>
              <label for="class">CLASS:</label>
            <select placeholder="CLASS" class="inputfield dropdown" id="cclass" name="cclass" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
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
<script src="../js/teacherslogin&signup.js"></script>
</body>

</html>