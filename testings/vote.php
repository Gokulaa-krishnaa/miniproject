<?php
session_start();
if(isset($_POST["id"]))
{
$id=$_POST["id"];
$_SESSION["id"]=$id;
$table1=$id.'a';
$table2=$id.'b';
$conn=new mysqli('localhost','root','','voter','8111');
$sql="select register from $table1";
$result=mysqli_query($conn,$sql);
$details=mysqli_fetch_all($result,MYSQLI_ASSOC);
print_r($details);
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
print_r($details);
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
print_r($_SESSION);
?>

