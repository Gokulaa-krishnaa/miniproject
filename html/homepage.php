<?php 

$conn= new mysqli('localhost','root','','voter');

$sql_query="SELECT * FROM signup";

$sql_res=mysqli_query($conn,$sql_query);

$details= mysqli_fetch_all($sql_res,MYSQLI_ASSOC);

print_r($details);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/homepage.css">
</head>
<body>
<div class="navbbar">
    <div class="navbtn">
        <button class="btnn" id="profilebutton" onclick="gotoprofile()">PROFILE</button>
        <button class="btnn" id="backbutton" onclick="signout()">SIGNOUT</button>
    </div>
</div>
	<div class="maincontainer row">
        <div class="votingcard center col-3">
            <h5>hi</h5>

        </div>
        <div class="votingcard col-3"></div>
        <div class="votingcard col-3"></div>
        <div class="votingcard col-3"></div>
    </div>
        


    <script src="../js/profliepagejs.js"></script>

</body>
</html>