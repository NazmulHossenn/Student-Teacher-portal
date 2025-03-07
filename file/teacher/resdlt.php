<?php
include('includes/config.php');
if(isset($_GET['year'])){
    $year=$_GET['year'];
    $classId=$_GET['class_id'];
    $subId=$_GET['sub_id'];
    $delete="DELETE FROM result_sheet WHERE res_year='$year' AND res_sub='$subId' AND res_class_id='$classId'";
    $comp=mysqli_query($conn,$delete);
    session_start();
    $_SESSION['tmp_msg']="$year result delte success";
    header("Location:manage-results.php");

}
?>