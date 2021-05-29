<?php  
session_start();
include 'connect.php';
//make class as code
$dept_codes=["dept"=>["CSE"=>'1',"MECH"=>"2","ECE"=>"3","EEE"=>"4"],"year"=>["1"=>"1","2"=>"2","3"=>"3","4"=>"4"],"sec"=>["A"=>"1","B"=>"2","C"=>"3","D"=>"4"]];
$reg=$_COOKIE["reg"];
$sql="select department,class,year from signup where register=$reg";
$result=mysqli_query($conn,$sql);
$details=mysqli_fetch_all($result,MYSQLI_ASSOC);
$detail=$details[0];
$class=$dept_codes["year"][$detail["year"]].$dept_codes["dept"][$detail["department"]].$dept_codes["sec"][$detail["class"]];
//select poll where student is eligible
$polls=[];
$sql="select id from poll where class=$class";
$results=mysqli_query($conn,$sql);
$poll=mysqli_fetch_all($results,MYSQLI_ASSOC);
//get election details
$election=[];
if(count($poll)>0)
{
    foreach($poll as $i=>$j)
    {
        $id=$j["id"];
        $sql = "select * from starter where pollid=$id";
        $results =mysqli_query($conn,$sql);
        $result=mysqli_fetch_all($results,MYSQLI_ASSOC);
        if(count($result)>0)
        array_push($election,$result[0]);
    }
}
//final voting
if(isset($_POST["submit"]))
{
    if(strcmp($_POST["vote"],"VOTE")==0)
    {
        $id=$_SESSION["pollid"];
        $reg=$_SESSION["parti"];
        $table1=$id.'a';
        $table2=$id.'b';
        $user=$_COOKIE["reg"];
        $sql="select * from $table2 where register=$user";
        $result=mysqli_query($conn,$sql);
        $results=mysqli_fetch_all($result,MYSQLI_ASSOC);
        if(count($results)>0)
        {
            //already voted
            echo "<script>alert('you voted already')</script>";
            echo "<script>location.href = 'studentshomepage.php' </script>";
        }
        else
        {
            //update candidate vote
            $sql="update $table1 set vote=vote+1 where register=$reg";
            mysqli_query($conn,$sql);
            //insert voted students
            $user=$_COOKIE["reg"];
            $sql="insert into $table2(register) values($user)";
            mysqli_query($conn,$sql);
            //vote done
            echo "<script>alert('voted successfully')</script>";
            echo "<script>location.href = 'studentshomepage.php' </script>";
        }
    }
    else
    {
         //type wrong           
        echo "<script>alert('type correctly')</script>";
        echo "<script>location.href = 'studentshomepage.php' </script>";
    }
}
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
    <style>
       #votebtn{
    background-color: #c1c8e4;
    margin-left: 41%;
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
        #flipback{
            border-radius: 50%;
            margin: 5%;
            position: absolute;
        }
        #removebtn{
            margin-left: 43%;
            background-color: #C91F37;
        }
        
        </style>
</head>
<body>
<div class="navbbar">
    <div class="navbtn">
        <button class="btnn" id="profilebutton" onclick="gotosprofile()">PROFILE</button>
        <button class="btnn" id="backbutton" onclick="signout()">SIGNOUT</button>
    </div>
</div>
	<div class="maincontainer row">
        <?php if(count($election)>0){
            $index=0;
            foreach($election as $i)
            { ?>
        <div class="votingcard center col-6">
            <div class="totalcontent">
                
                <div class="containsf">
                    <h5>POLLID:<?php 
                    echo $i["pollid"];
                    ?></h5><br>
                    <div class="infobtn"  onclick="doflip(<?php echo $index; ?>)">
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
                        echo 'YOUR  '.$i['roll'].'<br>';
                        ?><h4 style="text-align: center;"><?php echo $wname; ?></h4><?php } ?>
                    </h5><br>
                    <?php if($i['status']==0){ ?>
                        <!-- //date; -->
                    <?php } ?>
                    <?php if($i['status']==1){ ?>
                    <form method="post">
                    <input type="hidden" name="pollid" value="<?php echo $i["pollid"] ?>">                    
                    <input type="submit" class="btn" id="votebtn" name="vote" value="vote">
                    </form>
                    <?php } ?>
                    <?php if($i['status']==2){ ?>
                    <!-- <form method="post">
                    <input type="hidden" name="pollid" value="<?php echo $i["pollid"] ?>">                    
                    <input type="submit" class="btn" id="votebtn" name="vote" value="vote">
                    </form> -->
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
                    <h5 >Hosted by: <?php echo $res["name"]."<br>".$id; ?></h5>
                </div>
            </div>
            
        </div>
        
            <?php $index+=1;}
        } ?>
        <!-- ******************************************************************************* -->
        <div id="more-slide"><button  id="cancelbtn" onclick="off()">X</button>
                <?php
                //this is vote page outer
            if(isset($_POST["vote"]))
            {
                //list participants of poll
                $id=$_POST["pollid"];
                $_SESSION["id"]=$id;
                $table1=$id.'a';
                $table2=$id.'b';
                $conn=new mysqli('localhost','root','','voter');
                $sql="select register from $table1";
                $result=mysqli_query($conn,$sql);
                $details=mysqli_fetch_all($result,MYSQLI_ASSOC);
                foreach($details as $key=>$values)
                {
                    $reg=$values["register"];
                    $sql = "select * from signup where register=$reg";
                    $results =mysqli_query($conn,$sql);
                    $r=mysqli_fetch_all($results,MYSQLI_ASSOC);
                    echo $r[0]["name"]."      ".$r[0]["year"]." ".$r[0]["department"]." ".$r[0]["class"];
                    ?><form method='post' action=''>
                    <input type='hidden' value="<?php echo $values["register"]; ?>" name="reg" />
                    <input type='hidden' value="<?php echo $id; ?>" name="poll" />
                    <input type='submit' value='vote me' name='votein'/>
                    </form><br>
                    <?php
                }
            }
            //this is vote page inner
            elseif(isset($_POST["votein"]))
            {
                $_SESSION["pollid"]=$_POST["poll"];
                $_SESSION["parti"]=$_POST["reg"];
                ?>
                type "VOTE" to confirm
                <form method="post">
                <input type="text" name="vote"/>
                <input type="submit" name="submit" value="vote"/>
                </form>
                
            <?php }
            ?>


        </div>
        <!-- ******************************************************************************* -->

    </div>
    <script src="../js/profile&homepage.js"></script>
    <?php
        //invoke both inner and outer pages
        if(isset($_POST["vote"]) || isset($_POST["votein"]))
        {
        echo '<script> 
        document.getElementById("more-slide").style.display = "block";
        </script>';
        }
    ?>
</body>
</html>