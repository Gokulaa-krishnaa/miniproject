<?php  
session_start();
if(isset($_SESSION["dept_list"])){
    unset($_SESSION["dept_list"]);
}
if(isset($_SESSION["stu_list"])){
    unset($_SESSION["stu_list"]);
}

include 'connect.php';
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
$status=$election[0]['status'] ?? -1;
// print_r($status);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/teacherhomepage.css">
    <style>
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgb(70,52,78);
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #5680e9;
        }
        #flipback{
            border-radius: 50%;
            margin: 5%;
            position: absolute;
        }
        #removebtn{
            margin-left: 43%;
            background-color: #C91F37;
        }
        #startbtn{
            margin-left: 55%;
            background-color: #60DB3C;
        }
        #editbtn{
            /* background-color: black; */
            margin-left: -20%;
        }
        </style>
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
            $index=0;
            foreach($election as $i)
            { ?>
        <div class="votingcard center col-6">
            <div class="totalcontent" id="totalcontentid">
                
                <div class="containsf">
                    <h5>POLLID:<?php 
                    echo $i["pollid"];
                    ?></h5><br>
                    <div class="infobtn" id="infobtnid" onclick="doflip(<?php echo $index; ?>)">
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
                     <?php if($i['status']==0){ ?>
                    <button class="btn" id="morebtn" onclick="gotomore()">more</button>
                        <button class="btn" id="stopbtn">stop</button>
                        <?php } ?>
                        <?php if($i['status']==1){ ?>
                    <button class="btn" id="removebtn" style="margin-left: 43%;" onclick="remove()">remove</button>
                        <?php } ?>
                        <?php if($i['status']==2){ ?>
                        <button class="btn" id="editbtn" style="margin-left: 30%;">edit</button>
                        <button class="btn" id="startbtn">start</button>
                        <?php } ?>
                </div>
                <div class="containsb">
                    <button id ="flipback" onclick="dobackflip(<?php echo $index; ?>)">X</button>
                    <h3 >POLL INFO</h3><br>
                    <h5 style="margin-top: -3%;">Paricipants:</h5>
                    <div class="participantsgist" style=" width: 80%;height: 60%;margin: auto 9%;overflow: hidden;overflow-y: scroll;">
                    <ul class="paritcipantslist" style="color: #c1c8e4;list-style-type: none; text-align: center;font-size: 18px;">
                        <?php 
                        $pollid=$i["pollid"];
                        $table=$pollid.'a';
                        $sql = "select register from $table";
                        $results =mysqli_query($conn,$sql);
                        $result=mysqli_fetch_all($results,MYSQLI_ASSOC);
                        foreach($result as $ii)
                        {
                            $reg=$ii["register"];
                            $sql = "select * from signup where register=$reg";
                            $results =mysqli_query($conn,$sql);
                            $r=mysqli_fetch_all($results,MYSQLI_ASSOC);
                        ?>
                        <li><?php echo $r[0]["name"]."      ".$r[0]["year"]." ".$r[0]["department"]." ".$r[0]["class"]; ?></li>
                        <?php } ?>
                    </ul>
                    </div>
                    <?php
                    $id=$i["startby"];
                    $sql = "select * from teacher";
                    $results =mysqli_query($conn,$sql);
                    $r=mysqli_fetch_all($results,MYSQLI_ASSOC);
                    foreach($r as $key=>$value)
                    {
                        if($value["collageid"]==$id)
                        {
                            $res=$value;
                            break;
                        }
                    }
                    ?>
                    <h5 style="margin-top: 2%;">Hosted by: <?php echo $res["name"]."<br>".$res["department"]."<br>".$id; ?></h5>
                </div>
            </div>
            
        </div>
        
            <?php $index+=1;}
        } ?>
        
        <div class="addpoll col-3">
            <svg id="Add" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="218" height="204" viewBox="0 0 218 204" onclick="gotoadd()">
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
        


    <script src="../js/profile&homepage.js"></script>
    <script>
        function gotoadd(){
    window.location.href="addpoll.php";
} 
</script>

</body>
</html>