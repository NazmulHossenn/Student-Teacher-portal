<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['tlogin'])=="")
    {   
    header("Location: index.php"); 
    die();
    }

// date_default_timezone_set("Asia/Dhaka");
// $date = date("Y-m-d");
if(isset($_POST['absent'])){
   $studentId=$_POST['studentId'];
   $classId=$_POST['classId'];
   $subjectId=$_POST['subjectId'];
   $date=$_POST['date'];
   //check point
        $check="SELECT * FROM attendtance WHERE  class_id='$classId' AND student_id='$studentId' AND subject_id='$subjectId'  AND att_date='$date'";
        $comc=mysqli_query($conn,$check);
        $chCount=mysqli_num_rows($comc);
        if($chCount>0){
            echo "already add";
        }else{
        //check point end
        $insert="INSERT INTO attendtance (class_id,student_id,subject_id,student_status_at,att_date) VALUES('$classId','$studentId','$subjectId','absent','$date')";
        $comp=mysqli_query($conn,$insert);
}
}


if(isset($_POST['present'])){
    $date=$_POST['date'];
    $studentId=$_POST['studentId'];
    $classId=$_POST['classId'];
    $subjectId=$_POST['subjectId'];
       //check point
       $check="SELECT * FROM attendtance WHERE  class_id='$classId' AND student_id='$studentId' AND subject_id='$subjectId'  AND att_date='$date'";
       $comc=mysqli_query($conn,$check);
       $chCount=mysqli_num_rows($comc);
       if($chCount>0){
        echo "already add";
       }else{
  //check point end
    $insert="INSERT INTO attendtance (class_id,student_id,subject_id,student_status_at,att_date) VALUES('$classId','$studentId','$subjectId','present','$date')";
    $comp=mysqli_query($conn,$insert);
}
}

?>