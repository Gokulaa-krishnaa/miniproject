<?php
include 'connect.php';
session_start();
$sql="select max(id) from poll";
$result=mysqli_query($conn,$sql);
$details=mysqli_fetch_all($result,MYSQLI_ASSOC);
$max=$details[0]["max(id)"] ?? 0;
$max=$max+1;
$user=$_COOKIE["collageid"];
foreach($_SESSION["dept_list"] as $key=>$values)
{
    $name=$_SESSION["pollname"];
    $depid=$values["dept_id"];
    $roll=$_SESSION["roll"];
    $sql="insert into poll(id,name,class,roll,started_by) values(?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
	$stmt->bind_param("issss",$max,$name,$depid,$roll,$user);
	$stmt->execute();
	
}
$table_name=$max."a";
$sql="create table $table_name(register text,vote int default 0) ";
$stmt=$conn->prepare($sql);
$stmt->execute();
foreach($_SESSION["stu_list"] as $values)
{
    $sql="insert into $table_name(register) values(?)";
    $stmt=$conn->prepare($sql);
	$stmt->bind_param("s",$values);
	$stmt->execute();
	
}
$table_name=$max."b";
$sql="create table $table_name(register text,time DATETIME DEFAULT CURRENT_TIMESTAMP)";
$stmt=$conn->prepare($sql);
$stmt->execute();

$name=$_SESSION["pollname"];
$roll=$_SESSION["roll"];
$sql="insert into starter(pollid,name,roll,startby) values(?,?,?,?)";
$stmt=$conn->prepare($sql);
$stmt->bind_param('isss',$max,$name,$roll,$user);
$stmt->execute();


unset($_SESSION["dept_list"]);
unset($_SESSION["stu_list"]);
echo "<script>
		alert('poll created successfully');
		window.location.href='teacherhomepage.php';  
	</script>";
?>