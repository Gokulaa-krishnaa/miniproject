<?php
session_start();
$conn=new mysqli('localhost','root','','voter','8111');
if(isset($_POST["back"]))
{
    echo "<script>window.location.href='t2.php'</script>";
    exit();
}
if(isset($_POST['search']))
{
    if(isset($_POST["stu_reg"]))
    {
    $reg=$_POST["stu_reg"];
    $sql="select * from signup where register=$reg";
    $results =mysqli_query($conn,$sql);
    if($results)
    {
    $details =mysqli_fetch_all($results,MYSQLI_ASSOC);
    $details=$details[0];
    }
    }
}
else if(isset($_GET["action"]))
{
    if(isset($_SESSION["stu_list"]))
    {
        $count=count($_SESSION["stu_list"]);
        $_SESSION["stu_list"][$count]=$_GET["id"];
    }else{
        $_SESSION["stu_list"][0]=$_GET["id"];
    }
    print_r($_SESSION["stu_list"]);
}
?>
<html>
    <form method="post">
        <input type="submit" value="back" name="back"/>
</form>
<form method="post">
    <input type="text" placeholder="search participants" name="stu_reg"/>
    <input type="submit" value="search" name="search"/>
</form>
<form method="post">

<?php
        if(isset($details))
        {
            foreach($details as $i)
            {
                ?><tr>
                    <td><?php echo $i ;?></td>
                    
            <?php } ?>
            <td><a href="t3.php?action=add&id=<?php echo $reg; ?>" >ADD </a></td>
            </tr><br>
        <?php
            
        }?>
<a href="preview.php" >preview</a>
       
</html>