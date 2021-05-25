<?php
session_start();
if(isset($_POST["reg"]))
{
    $_SESSION["pollid"]=$_SESSION["id"];
    $_SESSION["parti"]=$_POST["reg"];
}
else if(isset($_POST["submit"]))
{
$conn=new mysqli('localhost','root','','voter','8111');
if(strcmp($_POST["vote"],"vote")==0)
{
$id=$_SESSION["pollid"];
$reg=$_SESSION["parti"];
$table1=$id.'a';
$table2=$id.'b';
$user=$_SESSION["user"];
$sql="select * from $table2 where register=$user";
$result=mysqli_query($conn,$sql);
$results=mysqli_fetch_all($result,MYSQLI_ASSOC);
print_r($results);
if(count($results)>0)
{
    echo "you voted already";
}else{
    $sql="update $table1 set vote=vote+1 where register=$reg";
    mysqli_query($conn,$sql);
    $user=$_SESSION["user"];
    $sql="insert into $table2(register) values($user)";
    mysqli_query($conn,$sql);
    echo "<script>alert('voted successfully')</script>";
    echo "<script>location.href = 't1.php' </script>";
}
}
else{
    
    echo "<script>alert('type correctly')</script>";
    echo "<script>location.href = 'vote.php' </script>";
}
}
?>
<hmtl>
type "vote" to confirm
<form method="post">
<input type="text" name="vote"/>
<input type="submit" name="submit" value="vote"/>
</form>
</html> 