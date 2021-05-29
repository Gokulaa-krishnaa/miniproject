<?php
include 'connect.php';
$id=$i['pollid'];
$table=$id.'a';
$sql="SELECT max(vote) from $table";
$res=mysqli_query($conn,$sql);
$s=mysqli_fetch_all($res,MYSQLI_ASSOC);
$maxvote=$s[0]['max(vote)'];
$sql="SELECT register from $table where vote=$maxvote";
$res=mysqli_query($conn,$sql);
$s=mysqli_fetch_all($res,MYSQLI_ASSOC);
if(count($s)==1){
    $winnerreg=$s[0]['register'];
    $sql="SELECT name from signup where register=$winnerreg";
    $res=mysqli_query($conn,$sql);
    $s=mysqli_fetch_all($res,MYSQLI_ASSOC);
    $wname=$s[0]['name'];
}
?>
