<?php  
session_start();
if(isset($_SESSION["dept_list"])){
    unset($_SESSION["dept_list"]);
}
if(isset($_SESSION["stu_list"])){
    unset($_SESSION["stu_list"]);
}

include 'connect.php';
if(isset($_POST['start'])){
    $id=$_POST['pollid'];
    $sql="UPDATE starter set status=1 where pollid=$id";
    mysqli_query($conn,$sql);
}
if(isset($_POST['remove'])){
    $id=$_POST['pollid'];
    $table1=$id.'a';
    $table2=$id.'b';
    $sql="drop table $table1";
    mysqli_query($conn,$sql);
    $sql="drop table $table2";
    mysqli_query($conn,$sql);
    $sql="delete from starter where pollid=$id";
    mysqli_query($conn,$sql);
}
if(isset($_POST['stop'])){
    $id=$_POST['pollid'];
    $sql="UPDATE starter set status=2 where pollid=$id";
    mysqli_query($conn,$sql);
}
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
        body{
            background-image: url("../images/hands.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
        h3{
            text-align: center;
            color:azure;
        }
        h5{
            text-align: center;
            color:azure;
        }
        .navbbar{
            background-color: #C1C8E4;;
            width: 100%;
            opacity: 80%;
        }
        .navbtn{
            margin-left: 75%;
        }
        .btnn{
            margin: -40px 2% ;     /* trbl */
            padding: 25px;
            padding-top: 70px;
            border-radius: 30px;
            font-size: 20px;
            border:none;
            overflow: hidden;
            cursor: pointer;
            transition: 0.3s;
        }
        .btnn:hover{
            width: 150px;
            margin-left: -2px; 
        }
        #editbutton{
            background-color: #0A0A0A;
            color: #ffffff;
        }
        #backbutton{
            padding: 20px;
            padding-top: 70px;
            background-color: #F3E0DC;
            color: black;
        }
        .maincontainer{
            margin-top: 3%;
            margin-left: 5%;
            width:90%;
        }
        .votingcard{
            background-color: transparent;
            margin-top: 1%;
            border-radius: 20%;
            height: 25em;
            perspective: 1000px;
        }
        .totalcontent{
            position: relative;
            width: 80%;
            height: 90%;
            margin:  auto;
            margin-top: 1%;
            margin-left: 25%;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }
        .containsf,.containsb{
            background-color: rgba(70,52,78,0.8);
            width: 80%;
            height: 90%;
            margin:  auto;
            margin-top: 1%;
            border-radius: 10%;
            perspective: 1000px;
            position:absolute;
            /* -webkit-backface-visibility: hidden; Safari */
            backface-visibility: hidden;
        } 
        #infobtnn:hover{
            cursor: pointer;

        }
        .containsb{
            /* background-color: #0A0A0A; */
            transform: rotateY(180deg);
            margin-left:20%;
        }


        #infobtnn{
            margin: 2%;
            margin-top: -5%;
            width: 5%;
            height: 50px;
        }
        #availablelogo{
            position: absolute;
            margin-left:82%;
            margin-top: -10%;
            width: 20px;
        }
        .btn{
            position: absolute;
            width: 80px;
            height: 40px;
            margin-left: 30%;
            margin-top: 15%;
            background-color: #c1c8e4;
            border-radius: 30px;
            outline: none;
        }
        #morebtn{
            background-color: #c1c8e4;
        }
        #stopbtn{
            margin-left: 42%;
            background-color: #60DB3C;
        }
        #startbtn{
            margin-left: 55%;
            background-color: #60DB3C;
        }
        #deletebtn{
            background-color: #C91F37;
            margin-left: 55%;
        }
        #removebtn{
            margin-left: 43%;
            background-color: #C91F37;
        }
        #editbtn{
            margin-left: 43%;
        }
        #Add{
            margin: auto 70%;
            margin-top: 30%;
            /* margin-left: 40%; */
            margin-bottom: 30%;
        }
        #flipback{
            border-radius: 50%;
            margin: 5%;
            position: absolute;
        }
        .paritcipantslist{
            color: #c1c8e4;
            list-style-type: none; 
            text-align: center;
            font-size: 18px;
            /* margin: 2; */
        }
        .participantsgist{
            /* background-color: #c1c8e4 ; */
            width: 80%;
            height: 45%;
            margin: auto 9%;
            overflow: hidden;
            overflow-y: scroll;
        }
        #more-slide {
            position: fixed ; 
            display: none; 
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            right: 10%;
            bottom: 5%;
            background-color: rgba(193,200,228,0.80);
            z-index: 2;
            border-radius: 5%;
            overflow: scroll;
            cursor: pointer;
        }
        #cancelbtn{
            margin: 1.5%;
            position: absolute;
            background-color: #707070;
            border-radius: 30px;
            outline: none;
            position: fixed;
        }
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

        /******************temp*****************/
        /* .contains{
            background-color: rgba(70,52,78,0.8);
            width: 80%;
            height: 90%;
            margin:  auto;
            margin-top: 1%;
            border-radius: 10%;
            perspective: 1000px;
            position:absolute;} */
        /******************temp*****************/

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

                            <?php if($i['status']==1){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="38" viewBox="0 0 37 38" id="availablelogo">
                                <g id="Ellipse_251" data-name="Ellipse 251" fill="#50ef0e" stroke="#707070" stroke-width="1">
                                    <ellipse cx="18.5" cy="19" rx="18.5" ry="19" stroke="none"/>
                                    <ellipse cx="18.5" cy="19" rx="18" ry="18.5" fill="none"/>
                                </g>
                            </svg>
                            <?php } ?>
                            <?php if($i['status']==2){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="38" viewBox="0 0 37 38" id="availablelogo">
                                <g id="Ellipse_253" data-name="Ellipse 253" fill="#ef0e0e" stroke="#707070" stroke-width="1">
                                    <ellipse cx="18.5" cy="19" rx="18.5" ry="19" stroke="none"/>
                                    <ellipse cx="18.5" cy="19" rx="18" ry="18.5" fill="none"/>
                                </g>
                            </svg>

                            <?php } ?>
                            <?php if($i['status']==0){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="38" viewBox="0 0 37 38" id="availablelogo">
                                <g id="Ellipse_252" data-name="Ellipse 252" fill="#d9ef0e" stroke="#707070" stroke-width="1">
                                    <ellipse cx="18.5" cy="19" rx="18.5" ry="19" stroke="none"/>
                                    <ellipse cx="18.5" cy="19" rx="18" ry="18.5" fill="none"/>
                                </g>
                            </svg>

                            <?php } ?>
                    </div>
                    <h5>
                    <?php 
                    if($i['status']!=2) 
                    echo $i["name"];
                    else{
                        include 'winner.php';
                        echo 'WINNER OF <div style="text-transform: uppercase> '.$i['roll'].'</div> ELECTION<br>';
                        ?><h4 style="text-align: center;"><?php echo $wname; ?></h4><?php 
                    } 
                    ?></h5><br>
                     <?php if($i['status']==1){ ?>
                    <form method="post" action="">
                        <input type="hidden" value="<?php echo $i['pollid']; ?>" name="pollid"/>
                        <input type="submit" class="btn" id="stopbtn" value="Stop" name="stop"/>
                        <!-- <button class="btn" id="stopbtn">stop</button> -->
                        </form>
                        <?php } ?>
                        <?php if($i['status']==2){ ?>
                            <form method="POST" action="">
                            <input type="hidden" value="<?php echo $i['pollid']; ?>" name="pollid"/>
                            <input class="btn" id="resbtn" type="submit" style="margin-left: 28%;" value="Result" name="wmore"/>
                            </form>
                            <form method="POST" action="">
                            <input type="hidden" value="<?php echo $i['pollid']; ?>" name="pollid"/>
                            <input class="btn" id="deletebtn" type="submit"  value="Delete" name="remove"/>
                            </form>
                        <?php } ?>
                        <?php if($i['status']==0){ ?>
                            <h5><?php echo $i["date"]." ".$i["time"]; ?></h5><br>
                            <form method="POST" action="">
                            <input type="hidden" value="<?php echo $i['pollid']; ?>" name="pollid"/>
                            <input class="btn" id="morebtn" type="submit" style="margin-left: 30%;" value="More" name="more"/>
                            </form>
                        <form method="POST" action="">
                            <input type="hidden" value="<?php echo $i['pollid']; ?>" name="pollid"/>
                            <input class="btn" id="startbtn" type="submit" value="Start" name="start"/>
                        <!-- <button >start</button> -->
                        </form>
                        <?php } ?>
                </div>
                <div class="containsb">
                    <button id ="flipback" onclick="dobackflip(<?php echo $index; ?>)">X</button>
                    <h3 >POLL INFO</h3><br>
                    <h5 style="margin-top: -3%;">Paricipants:</h5>
                    <div class="participantsgist" style=" width: 80%;height: 50%;margin: auto 9%;overflow: hidden;overflow-y: scroll;">
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
                    <h5 style="margin-top: 2%;">Hosted by: <?php echo $res["name"]."<br>".$id; ?></h5>
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
    <!--***************************preview*******************************  -->
    <div id="more-slide">
            <button  id="cancelbtn" onclick="off()">X</button>
            <?php
            include 'more.php'; 
            ?>
        </div>
    
        <!-- ************************************************************ -->


<?php
    if(isset($_POST["more"]) || isset($_POST["wmore"]))
    {
    echo '<script> 
    document.getElementById("more-slide").style.display = "block";
    </script>';
    }
?>    


    <script src="../js/profile&homepage.js">    </script>
    <script>
        function gotoadd(){
    window.location.href="addpoll.php";
    function goback(){
    window.location.href="homepage.php";
    }
    function signout(){
        window.location.href="loginhtml.php";
    }
    function gotback(){
        window.location.href="teacherhomepage.php";
    }
    /*************************************studentpage***********************************************/

    function gosback(){
        window.location.href="studentshomepage.php";
    }
    /*******************************************************HOMEPAGE***********************************************************/
    /*************************************teacherPAGE***********************************************/

    function gototprofile(){
        window.location.href="teachersprofile.php";
    }
    function gotoadd(){
        window.location.href="addpoll.php";
    }
    function on() {
        document.getElementById("more-slide").style.display = "block";
    }
    
    function off() {
        document.getElementById("more-slide").style.display = "none";
    }
    function doflip(index){
        var temp=document.getElementsByClassName("totalcontent");
        temp[index].style.transform="rotateY(180deg)";
    }
    function dobackflip(index){
        var temp=document.getElementsByClassName("totalcontent");
        temp[index].style.transform="rotateY(0deg)";
    }
    /*************************************studentpage***********************************************/
    function gotosprofile(){
        window.location.href="studentprofile.php";
    }
    function govote(){
        window.location.href=""
    }
    
} 
</script>

</body>
</html>