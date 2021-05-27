<?php
include 'connect.php';
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
    if(count($details)>0)
    $details=$details[0];
    }
    }
}
else if(isset($_GET["action"]))
{
    if($_GET["action"]=="deletep")
    {
        foreach($_SESSION["stu_list"] as $keys => $values)
        {
            if($values==$_GET["id"])
            {
                unset($_SESSION["stu_list"][$keys]);
            }
        }
    }
    else if(isset($_SESSION["stu_list"]))
    {
        $flag=0;
        foreach($_SESSION["stu_list"] as $keys=>$values)
        {
            if($_GET["id"]==$values)
            {
                $flag=1;
                break;
            }
        }
        if($flag==0)
        {
            $count=count($_SESSION["stu_list"]);
            $_SESSION["stu_list"][$count]=$_GET["id"];
        }
    }else{
        $_SESSION["stu_list"][0]=$_GET["id"];
    }
}
?>
