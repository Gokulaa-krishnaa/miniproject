<?php
include 'check.php';
session_start();
if(isset($_POST["padd"]))
{
    $_SESSION["name"][0]=$_POST["pname"];
    $_SESSION["roll"][0]=$_POST["roll"];
    echo "<script>window.location.href='t3.php'</script>";
    exit();
}

if(isset($_POST["removeall"]))
{
    echo "removed";
    if(isset($_SESSION["dept_list"])){
    session_unset();
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
    
    <form method="post" action="">
    ROLL:<br><input type='text' name='roll' required/><br>
    POLL NAME:<br><input type='text' name='pname' required/><br>
    <input type="submit" value="add participant" name="padd"/>
    </form>
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
                    <option value="IT">IT</option>
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
        <?php
        if(!empty($_SESSION["dept_list"]))
        {
            foreach($_SESSION["dept_list"] as $keys=>$values)
            {
                ?><tr>
                    <td><?php echo $values["year"]; ?></td>
                    <td><?php echo $values["dept"]; ?></td>
                    <td><?php echo $values["sec"]; ?></td>
                    <td><a href="t2.php?action=delete&id=<?php echo $values["dept_id"]; ?>" >Remove </a></td>
            </tr><br><?php
            }
            
        }?>
        <form method="post" action="">
        <input type="submit" value="remove all" name="removeall"/>
        </form>
    <?php 
    if(isset($_SESSION["dept_list"]))
    print_r($_SESSION["dept_list"]);
    ?>
 
        
    
</html>