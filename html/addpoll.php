<?php
$dept_codes=["dept"=>["CSE"=>'1',"MECH"=>"2","ECE"=>"3","EEE"=>"4"],"year"=>["1"=>"1","2"=>"2","3"=>"3","4"=>"4"],"sec"=>["A"=>"1","B"=>"2","C"=>"3","D"=>"4"]];

session_start();
include 'connect.php';
include 'addparticipant.php';
if(isset($_POST["removeallp"]))
{
    if(isset($_SESSION["stu_list"]))
    {
        unset($_SESSION["stu_list"]);
    }
}
if(isset($_POST["removeall"]))
{
    if(isset($_SESSION["dept_list"]))
    {
        unset($_SESSION["dept_list"]);
    }
}
else if(isset($_GET["action"]))
{
    if($_GET["action"]=="delete")
    {
        foreach($_SESSION["dept_list"] as $keys => $values)
        {
            if($values["dept_id"]==$_GET["id"])
            {
                unset($_SESSION["dept_list"][$keys]);
            }
        }
    }
}
else if(isset($_GET["add"]))
{
    $dept_id=$dept_codes["dept"][$_GET["dept"]];
    $year_id=$dept_codes["year"][$_GET["year"]];
    $sec_id=$dept_codes["sec"][$_GET["sec"]];
    $id=$year_id.$dept_id.$sec_id;
    if(isset($_SESSION["dept_list"]))
    {
        
        $dept_array_id=array_column($_SESSION["dept_list"],"dept_id");
        if(!in_array($id,$dept_array_id))
        {
            $count=count($_SESSION["dept_list"]);
            
            $item_array=array(
                "year"=>$_GET["year"],
                "dept"=>$_GET['dept'],
                "sec"=>$_GET['sec'],
                "dept_id"=>$id);
            $_SESSION["dept_list"][$count]=$item_array;
        }
    }else{
        $item_array=array(
            "year"=>$_GET["year"],
            "dept"=>$_GET['dept'],
            "sec"=>$_GET['sec'],
            "dept_id"=>$id
        );
        $_SESSION["dept_list"][0]=$item_array;
        
    }
    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/addpollpage.css">
    <title>Document</title>
</head>
<body>
    <div class="navbbar">
    <div class="navbtn">
        <button class="btnn" id="profilebutton" onclick="gotback()">BACK</button>
        <button class="btnn" id="backbutton" onclick="gototprofile()">PROFILE</button>
    </div>
    </div>
    <html>


    <!-- class add  -->
    <div class="enterdetails addclasses">
        <h2><div class="heads">ADD CLASSES</div></h2>
        <div class="detailcontent">
            <form method="get" action="">
                    <label for="year"><h6 style="color: white">YEAR:</h6></label>
                        <select placeholder="YEAR" class="inputfield dropdown" id="year" name="year" required>
                            <option value="1">I</option>
                            <option value="2">II</option>
                            <option value="3">III</option>
                            <option value="4">IV</option>
                        </select>
                    <label for="dept"><h6 style="color: white">DEPARTMENT:</h6></label>
                        <select placeholder="DEPARTMENT" class="inputfield dropdown" id="dept" name="dept" required>
                            <option value="CSE">CSE</option>
                            <option value="MECH">MECH</option>
                            <option value="ECE">ECE</option>
                            <option value="EEE">EEE</option>
                        </select>
                    <label for="sec"><h6 style="color: white">SECTION:</h6></label>
                        <select placeholder="SECTION" class="inputfield dropdown" id="sec" name="sec" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                        <br><br>
                        <?php
                            if(!empty($_SESSION["dept_list"]))
                            {
                                foreach($_SESSION["dept_list"] as $keys=>$values)
                                {
                                    ?><tr>
                                        <td><?php echo $values["year"]; ?></td>
                                        <td><?php echo $values["dept"]; ?></td>
                                    <td><?php echo $values["sec"]; ?></td>
                                        <td><a href="addpoll.php?action=delete&id=<?php echo $values["dept_id"]; ?>" >Remove </a></td>
                                </tr><br><?php
                                }
                            }
                        ?>
                    <input class="subbtn" id="addbtnn"  type='submit' value='Add' name='add'/>
                    
            </form>
            <form method="post">
                <input class="subbtn" id="rmvallbtn" type="submit" value="Remove All" name="removeall"/>
            </form>
            
        </div>
    </div>
        <!-- add participants -->
        
    <div class="enterdetails addparticipants">
        <h2><div class="heads">ADD PARTICIPANTS</div></h2>
        <div class="detailcontent">
            <form method="post">
                <input class="inputfield textinput" type="text" placeholder="Search participants" name="stu_reg"/>
                <input class="searchbtn" type="submit" value="search" name="search"/>
            </form>
            <?php
                if(isset($details))
                {
                    if(count($details)>0)
                    {
                        foreach($details as $i)
                        {?>
                            <tr>
                                <td><?php echo $i ;?></td>
                                        
                        <?php } if(count($details)>0)
                                {?>
                                <td><a href="addpoll.php?action=add&id=<?php echo $reg; ?>" >ADD </a></td>
                            </tr><br>
                            <?php } 
                    } 
                }
            ?>
            <!-- printing participants -->
            <?php
            if(!empty($_SESSION["stu_list"]))
            {
                foreach($_SESSION["stu_list"] as $values)
                {
                    // getting student detail
                    $sql="select * from signup where register=$values";
                    $results =mysqli_query($conn,$sql);
                    $detail =mysqli_fetch_all($results,MYSQLI_ASSOC);
                    
                    if(count($detail)>0){
                        $details=$detail[0];
                    ?><tr>
                        <td><?php echo $details["name"]; ?></td>
                        <td><?php echo $details["year"]; ?></td>
                        <td><?php echo $details["department"]; ?></td>
                        <td><?php echo $details["class"]; ?></td>
                        <td><?php echo $details["register"]; ?></td>
                        <td><?php echo $details["collageid"]; ?></td>
                        <td><a href="addpoll.php?action=deletep&id=<?php echo $details["register"]; ?>" >Remove </a></td>
                </tr><br><?php
                }
                }
                
            }?>
            <form method="post">
            <input class="subbtn" id="rmvallbtn2" type="submit" value="Remove All" name="removeallp"/>
            </form>
            <form method="post">
            <strong style="color: white"> ROLL: </strong>
            <input   class="inputfield textinput"  type="text" name="roll" required>
            <!-- <label for="pollname">POLL NAME:</lable>  -->
            <strong style="color: white"> POLL NAME:</strong>
            <input class="inputfield textinput" type="text" name="pollname" required>
            <!-- <label for="name">FULL NAME:</label>
            <input type="text" class="inputfield" placeholder="NAME" name="name" required> -->
            <br><br>
            <strong style="color: white"> POLL DATE:</strong>
            <input class="inputfield textinput" type="date" id="date" name="date" required>
            <strong style="color: white"> POLL TIME:</strong>
            <input class="inputfield textinput" type="time" id="time" name="time" required><br><br>
            <input class="subbtn" id="previewbtn" type="submit" name="preview" value="PREVIEW" />
            </form>

        </div>
    </div>
        <!--***************************preview*******************************  -->
        <div id="preview-slide">
            <button  id="cancelbtn" onclick="off()">X</button>
            <h1 style="text-align:center;">PREVIEW-AREA</h1>
            <h2>PARTICIPANTS</h2><br>
            <div class="displayarea">
            <?php
            // this is for participants
                if(!empty($_SESSION["stu_list"]))
                {
                    foreach($_SESSION["stu_list"] as $values)
                    {
                        // getting student detail
                        $sql="select * from signup where register=$values";
                        $results =mysqli_query($conn,$sql);
                        $details =mysqli_fetch_all($results,MYSQLI_ASSOC);
                        if(count($details))
                        {
                        $details=$details[0];
                        ?>
                        <table>
                        <tr>
                            <th>NAME</th>
                            <th>YEAR</th>
                            <th>DEPARTMENT</th>
                            <th>CLASS</th>
                            <th>REGISTER</th>
                            <th>COLLEGE-ID</th>

                        </tr>
                        <tr>
                            <td><?php echo $details["name"]; ?></td>
                            <td><?php echo $details["year"]; ?></td>
                            <td><?php echo $details["department"]; ?></td>
                            <td><?php echo $details["class"]; ?></td>
                            <td><?php echo $details["register"]; ?></td>
                            <td><?php echo $details["collageid"]; ?></td>
                        </tr>
                        </table><br><?php
                        }
                    }
                    
                }
            ?>
            </div>
            
            <h2>CLASSES</h2><br>
            <div class="displayarea" >
            <?php
            //this is for class
                if(!empty($_SESSION["dept_list"]))
                {
                    foreach($_SESSION["dept_list"] as $keys=>$values)
                    {
                        ?>
                        <table>
                        <tr>
                            <th>YEAR</th>
                            <th>DEPARTMENT</th>
                            <th>SECTION</th>
                        </tr>
                        <tr>
                            <td><?php echo $values["year"]; ?></td>
                            <td><?php echo $values["dept"]; ?></td>
                            <td><?php echo $values["sec"]; ?></td>
                        </tr>
                    </table>
                    <br><?php
                    }
                    
                }
            ?>
            </div>
            <h2>POLL NAME</h2><br>
            <div class="displayarea" style="font-size: 20px;margin-left:10%;">
            <?php
            //this is for pollname and roll
            if(isset($_POST["preview"]))
            {
                echo $_POST["pollname"];
                $_SESSION["pollname"]=$_POST["pollname"];
                ?>
                <h2 style="color:black;">ROLL</h2><br>
                <?php
                echo $_POST["roll"];
                $_SESSION["roll"]=$_POST["roll"];?>
                <br><br>
                <b style="color:black;">DATE</b>
                <?php
                echo $_POST["date"];
                $_SESSION["date"]=$_POST["date"];?>
                <b style="color:black;">TIME</b>
                <?php
                echo $_POST["time"];
                $_SESSION["time"]=$_POST["time"];
                
            }
            ?>
            <!-- final button -->
            <form method="post" action="createpoll.php">
            <input type="submit" class="btn" id="createpollbtn" value="create poll" name="create"/>
        </div>
        </div>
        <!-- ************************************************************ -->


<script src="../js/addpoll&parcipants.js"></script>
<?php
    if(isset($_POST["preview"]))
    {
    echo '<script> 
    document.getElementById("preview-slide").style.display = "block";
    </script>';
 }
?> 
</body>

</html>