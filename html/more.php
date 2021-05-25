<?php
$id=$_POST["id"];
$conn=new mysqli('localhost','root','','voter');
$sql = "SELECT * FROM poll where id=$id";
$results =mysqli_query($conn,$sql);
$result=mysqli_fetch_all($results,MYSQLI_ASSOC);
foreach($result as $i)
{
    echo $i["class"];
    echo "<br>";
}
$table=$id.'a';
$sql = "SELECT * FROM $table";
$results =mysqli_query($conn,$sql);
$result=mysqli_fetch_all($results,MYSQLI_ASSOC);
foreach($result as $i)
{
    echo $i["register"];
    echo "<br>";
}
?>