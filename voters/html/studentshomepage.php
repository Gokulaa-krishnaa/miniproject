
<?php  


$conn=new mysqli('localhost','root','','voter','8111');
$election=[];
$collageid=$_COOKIE["collageid"];
$sql = "SELECT * FROM starter";
$results =mysqli_query($conn,$sql);
// $result=mysqli_fetch_all($results,MYSQLI_ASSOC);
// print_r($result);
if ($results){
$result=mysqli_fetch_all($results,MYSQLI_ASSOC);

foreach($result as $i)
{
    if($i["startby"]==$collageid)
    {
        array_push($election,$i);
    }
}}
$status=$election[0]['status'];
// print_r($status);


?> 

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/studentshomepage.css">
</head>
<body>
<div class="navbbar">
    <div class="navbtn">
        <button class="btnn" id="profilebutton" onclick="gotosprofile()">PROFILE</button>
        <button class="btnn" id="backbutton" onclick="signout()">SIGNOUT</button>
    </div>
</div>
<!-- <div class="maincontainer row">
        <div class="votingcard center col-6">
            
            <div class="totalcontent">
                
                <div class="containsf"> -->
	<div class="maincontainer row">
        <?php if(count($election)>0){
            foreach($election as $i)
            { ?>
        <div class="votingcard center col-6">
            <div class="totalcontent">
                
                <div class="containsf">
                    <h5>POLLID:<?php 
                    echo $i["pollid"];
                    ?></h5><br>
                    <div class="infobtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="72" viewBox="0 0 52 72" id="infobtnn">
                                <g id="info" transform="translate(-763 -254)">
                                <g id="Ellipse_257" data-name="Ellipse 257" transform="translate(763 254)" fill="none" stroke="#000" stroke-width="5">
                                    <ellipse cx="26" cy="29.5" rx="26" ry="29.5" stroke="none"/>
                                    <ellipse cx="26" cy="29.5" rx="23.5" ry="27" fill="none"/>
                                </g>
                                <text id="i" transform="translate(783 313)" font-size="50" font-family="SegoeUI, Segoe UI"><tspan x="0" y="0">i</tspan></text>
                                </g>
                            </svg>

                            <?php if($i['status']==0){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="38" viewBox="0 0 37 38" id="availablelogo">
                                <g id="Ellipse_251" data-name="Ellipse 251" fill="#50ef0e" stroke="#707070" stroke-width="1">
                                    <ellipse cx="18.5" cy="19" rx="18.5" ry="19" stroke="none"/>
                                    <ellipse cx="18.5" cy="19" rx="18" ry="18.5" fill="none"/>
                                </g>
                            </svg>
                            <?php } ?>
                            <?php if($i['status']==1){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="38" viewBox="0 0 37 38" id="availablelogo">
                                <g id="Ellipse_253" data-name="Ellipse 253" fill="#ef0e0e" stroke="#707070" stroke-width="1">
                                    <ellipse cx="18.5" cy="19" rx="18.5" ry="19" stroke="none"/>
                                    <ellipse cx="18.5" cy="19" rx="18" ry="18.5" fill="none"/>
                                </g>
                            </svg>

                            <?php } ?>
                            <?php if($i['status']==2){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="38" viewBox="0 0 37 38" id="availablelogo">
                                <g id="Ellipse_252" data-name="Ellipse 252" fill="#d9ef0e" stroke="#707070" stroke-width="1">
                                    <ellipse cx="18.5" cy="19" rx="18.5" ry="19" stroke="none"/>
                                    <ellipse cx="18.5" cy="19" rx="18" ry="18.5" fill="none"/>
                                </g>
                            </svg>

                            <?php } ?>
                    </div>
                    <h5><?php 
                    echo $i["name"];
                    ?></h5><br>
                    <!-- <button class="btn" id="morebtn" onclick="on()">vote</button> -->
                    <form method="post">
                    <input type="hidden" name="pollid" value="<?php echo $i["pollid"] ?>">
                    <input type="submit" class="btn" id="votebtn" name="vote" value="vote">
                    </form>
                </div>
                <div class="containsb">
                    <h3>POLL INFO</h3><br>
                    <h5>Paricipants:</h5>
                    <h5>Hosted by:</h5>
                </div>
            </div>
            
        </div>
        <?php }
        } 
        if(isset($_POST["vote"]))
        {  
            ?>
            
            <?php
            
        ?>
        <!-- ************************************************************************** -->
        <div id="more-slide"><button  id="cancelbtn" onclick="off()">X</button>
            <?php
            if(isset($_POST["vote"]))
            {
            $id=$_POST["pollid"];
            $_SESSION["id"]=$id;
            $table1=$id.'a';
            $table2=$id.'b';
            $conn=new mysqli('localhost','root','','voter','8111');
            $sql="select register from $table1";
            $result=mysqli_query($conn,$sql);
            $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach($details as $key=>$values)
                    {
                        print_r($values["register"]);
                        ?><form method='post' action='makevote.php'>
                        <input type='hidden' value="<?php echo $values["register"]; ?>" name="reg" />
                        <input type='submit' value='vote me' name='vote '/>
                        
                    </form><br>
                    <?php
                    }
            }else if(isset($_SESSION["id"]))
            {
            $id=$_SESSION["id"];
            $table1=$id.'a';
            $table2=$id.'b';
            $conn=new mysqli('localhost','root','','voter','8111');
            $sql="select register from $table1";
            $result=mysqli_query($conn,$sql);
            $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach($details as $key=>$values)
                    {
                        print_r($values["register"]);
                        ?><form method='post' action='makevote.php'>
                        <input type='hidden' value="<?php echo $value["register"]; ?>" name="reg" />

                        <input type='submit' value='vote me' name='vote'/>
                        
                    </form><br>
                    <?php
                    }
            }
            ?>
        </div>
        <!-- ************************************************************************** -->
        <?php
 }   
 ?>
    </div>
       
    
    <script src="../js/profile&homepage.js"></script>
<?php
if(isset($_POST["vote"]))
{
echo '<script> 
document.getElementById("more-slide").style.display = "block";
</script>';
}
?>
</body>
</html>