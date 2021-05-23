
<?php 

$conn=new mysqli('localhost','root','','voter','8111');




$reg=$_COOKIE['reg'];
$sql = "SELECT * FROM signup where register=$reg";
$results =mysqli_query($conn,$sql);
$details =mysqli_fetch_all($results,MYSQLI_ASSOC);
$detail=$details[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/profilepage.css">
</head>
<body>
	<div class="profilecard">
    <h2>DETAILS</h2>
        <div class="detailscard">
        <p>
            NAME:  <?php echo htmlspecialchars($detail['name']);?> 
            <br>
            DEPT:  <?php echo htmlspecialchars($detail['department']);?> 
            CLASS: <?php echo htmlspecialchars($detail['class']);?><br>  
            YEAR:  <?php echo htmlspecialchars($detail['year']);?> <br>
            REG. No:  <?php echo htmlspecialchars($detail['register']);?>  <br>
            COLLEGE.id:  <?php echo htmlspecialchars($detail['collageid']);?> <br>
            MOBILE No.:  <?php echo htmlspecialchars($detail['mobile']);?> <br>
            GENDER:  <?php echo htmlspecialchars($detail['gender']);?> <br>
            MAIL id: <?php echo htmlspecialchars($detail['mailid']);?> <br>
            PASSWORD:<?php echo htmlspecialchars($detail['password']);?>
        </p></div>

    </div>
	
</body>
</html>