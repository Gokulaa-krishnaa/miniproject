
<?php 

include 'connect.php';
$reg=$_COOKIE['reg'];
$sql = "SELECT * FROM signup where register=$reg";
$results =mysqli_query($conn,$sql);
$details =mysqli_fetch_all($results,MYSQLI_ASSOC);
$detail=$details[0];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/profilepage.css">
</head>
<body>
    <div class="navbbar">
    <div class="navbtn">
    <ul>
    <button class="btnn" id="editbutton" onclick="gotoedit()">EDIT</button>
    <button class="btnn" id="backbutton" onclick="gosback()">BACK</button></div>
</div>
	<div class="profilecard">   
        <h1>DETAILS</h1>   
        <div class="detailscard row">
            <div class="photodetail col-3">

            </div>
            <div class="textdetailslabel col-4">
                <div class="detailslines ">NAME:   <br></div>
                <div class="detailslines">    DEPT & CLASS: <br> </div>  
                <div class="detailslines">    YEAR:  <br></div>
                <div class="detailslines">    REG. No:   <br></div>
                <div class="detailslines">    COLLEGE.id:   <br></div>
                <div class="detailslines">    MOBILE No.:  <br></div>
                <div class="detailslines">    GENDER:  <br></div>
                <div class="detailslines">    MAIL id:  <br></div>
                <div class="detailslines">    PASSWORD: </div>
            </div>
            <div class="textdetails col-3">
                <div class="detailslines"><?php echo htmlspecialchars($detail['name']);?> </div>
                <div class="detailslines"><?php echo htmlspecialchars($detail['department']);?> <?php echo htmlspecialchars($detail['class']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['year']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['register']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['collageid']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['mobile']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['gender']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['mailid']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['password']);?> </div>  
            </div>
        </div>
    </div>
    <script src="../js/profile&homepage.js"></script>
</body>
</html>