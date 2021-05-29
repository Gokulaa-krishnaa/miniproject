<html>
<?php
$dept_codes=["dept"=>['1'=>"CSE","2"=>"MECH","3"=>"ECE","4"=>"EEE"],"year"=>["1"=>"1","2"=>"2","3"=>"3","4"=>"4"],"sec"=>["1"=>"A","2"=>"B","3"=>"C","4"=>"D"]];


include 'connect.php';
if(isset($_POST["more"]))
{
    $id=$_POST["pollid"];
    ?><h5>CLASSES</h5><?php
    $sql="select class from poll where id=$id";
    $result=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach($result as $i)
    {
        $class=$i["class"];
        $dept_id=$dept_codes["dept"][$class[1]];
        $year_id=$dept_codes["year"][$class[0]];
        $sec_id=$dept_codes["sec"][$class[2]];
        $class=$year_id.$dept_id.$sec_id;
        echo $class;
    }
    $table=$id.'a';
    $sql="select register from $table";
    $result=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
    ?><h5>PARTICIPANTS</h5><?php
    foreach($result as $i)
    {
        $reg=$i["register"];
        $sql="select register,name,year,department,class,collageid from signup where register=$reg";
        $res=mysqli_query($conn,$sql);
        $res=mysqli_fetch_all($res,MYSQLI_ASSOC);
        $res=$res[0];
        echo $res["name"]."  ".$res["year"]." ".$res["department"]." ".$res["class"]." ".$res["register"]." ".$res["collageid"];
    }
    
}
if(isset($_POST["wmore"]))
{
    $id=$_POST["pollid"];
    $table=$id.'a';
    $sql="select * from $table order by vote desc";
    $result=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($result,MYSQLI_ASSOC);
    $f=0;
    foreach($result as $i)
    {
        $reg=$i["register"];
        $sql="select register,name,year,department,class,collageid from signup where register=$reg";
        $res=mysqli_query($conn,$sql);
        $res=mysqli_fetch_all($res,MYSQLI_ASSOC);
        $res=$res[0];
        echo $res["name"]."  ".$res["year"]." ".$res["department"]." ".$res["class"]." ".$res["register"]." ".$i["vote"];
        if($f==0)
        {
            $winner=$res["name"];
            $year=$res["year"];
            $class=$res["class"];
            $deparment=$res["department"];
            $f=1;
        } 
    }
    $sql="select roll from starter where pollid=$id";
    $res=mysqli_query($conn,$sql);
    $roll=mysqli_fetch_all($res,MYSQLI_ASSOC);
    $roll=$roll[0];
    if(count($result)>0 && ($result[0]["vote"]!=$result[1]["vote"]))
    {
        echo "CONGRATULATONS "."  ".$winner." OF".$year.$deparment.$class."<br>"."You Are Now a".$roll["roll"];
    }
}
?>
</html>