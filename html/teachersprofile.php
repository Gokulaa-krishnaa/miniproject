<?php
include 'connect.php';
session_start();
$id=$_COOKIE["collageid"];
$sql="select * from teacher";
$detail=mysqli_query($conn,$sql);
$detail=mysqli_fetch_all($detail,MYSQLI_ASSOC);
foreach($detail as $i=>$j)
{
    if($j["collageid"]==$id)
    {
        $detail=$j;
        break;
    }
}
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
    <button class="btnn" id="editbutton" onclick="gototedit()">EDIT</button>
    <button class="btnn" id="backbutton" onclick="gotback()">BACK</button></div>
</div>
	<div class="profilecard">   
        <h1>DETAILS</h1>   
        <div class="detailscard row">
            <div class="photodetail col-3">

            </div>
            <div class="textdetailslabel col-4">
                <div class="detailslines ">NAME:   <br></div>
                <div class="detailslines">    DEPT: <br> </div>  
                <div class="detailslines">    COORDINATOR-OF:  <br></div>
                <div class="detailslines">    COLLEGE.id:   <br></div>
                <div class="detailslines">    MOBILE No.:  <br></div>
                <div class="detailslines">    GENDER:  <br></div>
                <div class="detailslines">    MAIL id:  <br></div>
                <div class="detailslines">    PASSWORD: </div>
            </div>
            <div class="textdetails col-3">
                <div class="detailslines"><?php echo htmlspecialchars($detail['name']);?> </div>
                <div class="detailslines"><?php echo htmlspecialchars($detail['department']);?>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['coordinator']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['collageid']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['mobile']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['gender']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['mailid']);?> </div>  
                <div class="detailslines"><?php echo htmlspecialchars($detail['password']);?> </div>  
            </div>
        </div>
    </div>
    <script src="../js/profliepage&homepagejs.js"></script>
</body>
</html>