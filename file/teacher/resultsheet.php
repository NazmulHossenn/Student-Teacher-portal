<?php
include('includes/config.php');
$array="";
foreach ($_POST as $key => $value) {
    $student=htmlspecialchars($value);
    $array=$student.','.$array;
}

$final=rtrim($array,',');
$all= (explode(",",$final));

  $total=count($all)-1;


$values='';
$step=7;
$j=0;
for($i=0;$i<=$total;$i++){
    $j++;
   $mn =$all[$i];
    $values="'$mn'".','.$values;
    if($j==$step){
        $step=$step+7;
         $real= $values;
         $data=rtrim($real,',');
        $values='';
        
        $insert="INSERT INTO result_sheet( res_year, res_class_id,res_sub, res_student_id, res_student_roll, res_mark, res_class_parsent)VALUES($data)";
        mysqli_query($conn,$insert);
    }
    echo "<script>window.location ='add-result.php?suc';</script>";
  
}



//parsent,mark,studentRoll,studentid,classid,year
?>