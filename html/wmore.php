<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            .participantsresults{
                width: 80%;
                height: 40%;
                margin: auto 8%;
                margin-top: 3%;
                /* background-color: white; */
                overflow: scroll;
            }
            table{
                border-collapse: collapse;
                width:100%;
            }
            th{
                background-color: #5680e9;
            }
            td,th{
                text-align: center;
                font-weight: bold;
                /* border: solid; */
            }
        </style>
    </head>
<body>
<?php
$dept_codes=["dept"=>['1'=>"CSE","2"=>"MECH","3"=>"ECE","4"=>"EEE"],"year"=>["1"=>"1","2"=>"2","3"=>"3","4"=>"4"],"sec"=>["1"=>"A","2"=>"B","3"=>"C","4"=>"D"]];


include 'connect.php';
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
        // echo $res["name"]."  ".$res["year"]." ".$res["department"]." ".$res["class"]." ".$res["register"]." ".$i["vote"];
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
    $roll=$roll[0];    if(count($result)>0 && ($result[0]["vote"]!=$result[1]["vote"]))
    {
        echo "<h3>CONGRATULATONS</h3><h5>TO THE NEW</h5>"; ?> 
        <h5> <?php echo $roll["roll"]; ?> </h5><br> 
         <h2 style="text-align: center;"> <?php echo $winner; ?> </h2> <?php
    }
    ?>
    <br><br><h1 style="text-align: center;">POLL SUMMARY</h1>
    <div class="participantsresults">
        
    <table>
  
            <tr>
                <th style="border: solid;">NAME</th>
                <th style="border: solid;">YEAR</th>
                <th style="border: solid;">DEPARTMENT</th>
                <th style="border: solid;">CLASS</th>
                <th style="border: solid;">REGISTER</th>
                <th style="border: solid;">VOTES</th>
            </tr>

    
            
    <?php 
    foreach($result as $i)
    {
        $reg=$i["register"];
        $sql="select register,name,year,department,class,collageid from signup where register=$reg";
        $res=mysqli_query($conn,$sql);
        $res=mysqli_fetch_all($res,MYSQLI_ASSOC);
        $res=$res[0];
        ?>
        <tr>
            <td><?php echo $res["name"]; ?></td>
            <td><?php echo $res["year"]; ?></td>
            <td><?php echo $res["department"]; ?></td>
            <td><?php echo $res["class"]; ?></td>
            <td><?php echo $res["register"]; ?></td>
            <td><?php echo $i["vote"]; ?></td>
        </tr>
        <?php 
        if($f==0)
        {
            $winner=$res["name"];
            $year=$res["year"];
            $class=$res["class"];
            $deparment=$res["department"];
            $f=1;
        } 
    }?>
    </table> 
    </div>
    <?php
}
?>
</body>
</html>
