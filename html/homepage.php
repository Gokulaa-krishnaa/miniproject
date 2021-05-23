<?php 

$conn=new mysqli('localhost','root','','voter','8111');
$collageid=$_COOKIE["collageid"];
$sql = "SELECT * FROM starter";
$results =mysqli_query($conn,$sql);
$result=mysqli_fetch_all($results,MYSQLI_ASSOC);
$election=[];
foreach($result as $i)
{
    if($i["startby"]==$collageid)
    {
        array_push($election,$i);
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
        <?php if(count($election)>0){
            foreach($election as $i)
            { ?>
        <div class="votingcard center col-3">
            <h5><?php 
            echo $i["pollid"];
            ?></h5><br>
            <h5><?php 
            echo $i["name"];
            ?></h5><br>
            <h5><?php 
            echo $i["roll"];
            ?></h5><br>
            <form method="post" action="more.php">
            <input type="hidden" value="<?php echo $i["pollid"] ?>" name="id"/>
            <input type="submit" value="more" name="more"/>
            </form>

        </div>
            <?php }
        } ?>
    </div>
        


    <script src="../js/profliepagejs.js"></script>

</body>
</html>