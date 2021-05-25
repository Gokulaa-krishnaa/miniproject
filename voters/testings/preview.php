<?php
session_start();
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
if(!empty($_SESSION["stu_list"]))
        {
            foreach($_SESSION["stu_list"] as $v)
            {
                ?><tr>
                    <td><?php echo $v; ?></td>
            </tr><br><?php
            }
            
        }
else{
    print_r($_SESSION["stu_list"]);
}
?>
<html>
<form method="post" action="create.php">
<input type="submit" value="create poll" name="create"/>
</form>
</html>