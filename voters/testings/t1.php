<?php
$dept_codes=["dept"=>["CSE"=>'1',"MECH"=>"2","IT"=>"3"],"year"=>["1"=>"1","2"=>"2","3"=>"3","4"=>"4"],"sec"=>["A"=>"1","B"=>"2","C"=>"3","D"=>"4"]];
session_start();
$_SESSION["user"]="412519104160";
if(isset($_SESSION["dept_list"]))
{
session_unset();
session_destroy();
}
$reg="412519104160";
$conn=new mysqli('localhost','root','','voter','8111');
$sql="select department,class,year from signup where register=$reg";
$result=mysqli_query($conn,$sql);
$details=mysqli_fetch_all($result,MYSQLI_ASSOC);
$detail=$details[0];
$class_id=$dept_codes["year"][$detail["year"]].$dept_codes["dept"][$detail["department"]].$dept_codes["sec"][$detail["class"]];
$sql="select * from poll where class=$class_id";
$result=mysqli_query($conn,$sql);
$details=mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
<html>
    <form method='post' action='t2.php'>
        <input type='submit' value='new voting' name='new'/>
        
    </form><br>
    <?php
        foreach($details as $keys=>$values)
        {
            foreach($values as $i=>$j)
            {
                echo "$j     ";
            }?><form method='post' action='vote.php'>
            <input type="hidden" value="<?php echo $values['id'];?>" name="id"/>
            <input type="hidden" value="<?php echo $reg;?>" name="reg"/>
            <input type='submit' value='vote' name='vote'/>
            
        </form><br>
            <?php
        }?>