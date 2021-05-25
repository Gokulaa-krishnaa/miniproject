<?php
$conn=new mysqli('localhost','root','','voter','8111');
session_start();
$sql="select max(id) from poll";
$result=mysqli_query($conn,$sql);
$details=mysqli_fetch_all($result,MYSQLI_ASSOC);
$max=$details[0]["max(id)"] ?? 0;
$max=$max+1;
print_r($_SESSION["dept_list"]);

foreach($_SESSION["dept_list"] as $key=>$values)
{
    $name=$_SESSION["name"][0];
    $depid=$values["dept_id"];
    $roll=$_SESSION["roll"][0];
    $me="yogi";
    $sql="insert into poll(id,name,class,roll) values(?,?,?,?)";
    $stmt=$conn->prepare($sql);
	$stmt->bind_param("isss",$max,$name,$depid,$roll);
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
echo "<script>
		alert('poll created successfully');
		window.location.href='t3.php';  
	</script>";
?>