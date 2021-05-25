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
    <link rel="stylesheet" href="../css/teacherhomepage.css">
</head>
<body>
<div class="navbbar">
    <div class="navbtn">
        <button class="btnn" id="profilebutton" onclick="gototprofile()">PROFILE</button>
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
                    <button class="btn" id="morebtn" onclick="gotomore()">more</button>
                        <button class="btn" id="editbtn">edit</button>
                </div>
                <div class="containsb">
                    <h3>POLL INFO</h3><br>
                    <h5>Paricipants:</h5>
                    <h5>Hosted by:</h5>
                </div>
            </div>
            
        </div>
        
            <?php }
        } ?>
        
        <div class="addpoll col-3">
            <svg id="Add" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="218" height="204" viewBox="0 0 218 204" onclick="gotomore()">
                <defs>
                    <linearGradient id="linear-gradient" x1="-0.125" y1="-0.443" x2="0.769" y2="0.944" gradientUnits="objectBoundingBox">
                    <stop offset="0" stop-color="#faed26"/>
                    <stop offset="0.491" stop-color="#827b14"/>
                    <stop offset="1" stop-color="#5d001e"/>
                    </linearGradient>
                </defs>
                <path id="Union_1" data-name="Union 1" d="M95.375,204V114.751H0v-25.5H95.375V0H122.63V89.249H218v25.5H122.63V204Z" fill="url(#linear-gradient)"/>
            </svg>
        </div>
    </div>
        


    <script src="../js/proflie&homepage.js"></script>

</body>
</html>