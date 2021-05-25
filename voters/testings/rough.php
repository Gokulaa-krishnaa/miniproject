function present_check($name)
{
    if(isset($_SESSION["eclass"]))
    {
        if(in_array($name,$_SESSION["eclass"]))
        {
            foreach($_SESSION["dept_list"] as $keys=>$values)
            {
                if(in_array($name,$values))
                {
                    unset($_SESSION["dept_list"][$keys]);
                }
            }
        }else{
            $count=count($_SESSION["eclass"]);
            $_SESSION["eclass"][$count]=$name;
        }
    }else{
        $_SESSION["eclass"][0]=$name;
    }
}
function check($y,$d,$s)
{
    
    include 'check.php';
    if($y=="ALL")
    {
        foreach($dept_ids["year"] as $i)
        {
            if($d=="ALL")
            {
                foreach($dept_ids["dept"] as $j)
                {
                    if($s=="ALL")
                    {
                        foreach($dept_ids["sec"] as $k)
                        {
                            $name=$i.$j.$k;
                            present_check($name);
                        } 
                    }else{
                        $name=$i.$j.$s;
                        present_check($name);
                    }
                }
            }else{
                
                    if($s=="ALL")
                    {
                        foreach($dept_ids["sec"] as $k)
                        {
                            $name=$i.$d.$k;
                            present_check($name);
                        } 
                    }else{
                        $name=$i.$d.$s;
                        present_check($name);
                    }
                
            }
        }
    }else{
            if($d=="ALL")
            {
                foreach($dept_ids["dept"] as $j)
                {
                    if($s=="ALL")
                    {
                        foreach($dept_ids["sec"] as $k)
                        {
                            $name=$y.$j.$k;
                            present_check($name);
                        } 
                    }else{
                        $name=$y.$j.$s;
                        present_check($name);
                    }
                }
            }else{
              
                    if($s=="ALL")
                    {
                        foreach($dept_ids["sec"] as $k)
                        {
                            $name=$y.$d.$k;
                            present_check($name);
                        } 
                    }else{
                        $name=$y.$d.$s;
                        present_check($name);
                    }
                
        }
    }
}