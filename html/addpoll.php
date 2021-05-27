<?php
$dept_codes=["dept"=>["CSE"=>'1',"MECH"=>"2","ECE"=>"3","EEE"=>"4"],"year"=>["1"=>"1","2"=>"2","3"=>"3","4"=>"4"],"sec"=>["A"=>"1","B"=>"2","C"=>"3","D"=>"4"]];
$dept_ids=["dept"=>["1","2","3"],"year"=>["1","2","3","4"],"sec"=>["1","2","3","4"]];
$dept_ids=["dept"=>["1","2","3"],"year"=>["1","2","3","4"],"sec"=>["1","2","3","4"]];

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
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/teacherhomepage.css">
    <!-- class add  -->
    <h2>ADD CLASSES</h2>
    <form method="get" action="">
            <label for="year">YEAR:</label>
                <select placeholder="YEAR" class="inputfield dropdown" id="year" name="year" required>
                    <option value="1">I</option>
                    <option value="2">II</option>
                    <option value="3">III</option>
                    <option value="4">IV</option>
                </select>
                <br><br>
            <label for="year">DEPARTMENT:</label>
                <select placeholder="DEPARTMENT" class="inputfield dropdown" id="dept" name="dept" required>
                    <option value="CSE">CSE</option>
                    <option value="MECH">MECH</option>
                    <option value="ECE">ECE</option>
                    <option value="ECE">ECE</option>
                </select>
                <br><br>
            <label for="year">SECTION:</label>
                <select placeholder="SECTION" class="inputfield dropdown" id="sec" name="sec" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
                <br><br>
            <input type='submit' value='Add' name='add'/>
        </form>
        <form method="post">
        <input type="submit" value="Remove All" name="removeall"/>
        </form>
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
            
        }?>
        <!-- add participants -->
        <h2>ADD PARTICIPANTS</h2>
        <form method="post">
                <input type="text" placeholder="search participants" name="stu_reg"/>
                <input type="submit" value="search" name="search"/>
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
        <input type="submit" value="Remove All" name="removeallp"/>
        </form>
        <form method="post">
        ROLL:<input type="text" name="roll" required/>
        POLL NAME:<input type="text" name="pollname" required/>
        <input type="submit" name="preview" value="PREVIEW"/>
        </form>
        <!--***************************preview*******************************  -->
        <div id="more-slide"><button  id="cancelbtn" onclick="off()">X</button>
            <h1>PARTICIPANTS</h1><br>
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
                        ?><tr>
                            <td><?php echo $details["name"]; ?></td>
                            <td><?php echo $details["year"]; ?></td>
                            <td><?php echo $details["department"]; ?></td>
                            <td><?php echo $details["class"]; ?></td>
                            <td><?php echo $details["register"]; ?></td>
                            <td><?php echo $details["collageid"]; ?></td>
                    </tr><br><?php
                        }
                    }
                    
                }
            ?>
            <h1>classes</h1><br>
            <?php
            //this is for class
                if(!empty($_SESSION["dept_list"]))
                {
                    foreach($_SESSION["dept_list"] as $keys=>$values)
                    {
                        ?><tr>
                            <td><?php echo $values["year"]; ?></td>
                            <td><?php echo $values["dept"]; ?></td>
                            <td><?php echo $values["sec"]; ?></td>
                    </tr><br><?php
                    }
                    
                }
            ?>
            <h1>POLL NAME</h1><br>
            <?php
            //this is for pollname and roll
            if(isset($_POST["preview"]))
            {
                echo $_POST["pollname"];
                $_SESSION["pollname"]=$_POST["pollname"];
                ?>
                <h1>ROLL</h1><br>
                <?php
                echo $_POST["roll"];
                $_SESSION["roll"]=$_POST["roll"];
            }
            ?>
            <!-- final button -->
            <form method="post" action="createpoll.php">
            <input type="submit" value="create poll" name="create"/>
        </div>
        <!-- ************************************************************ -->
<script src="../js/profile&homepage.js"></script>

        
    
</html>