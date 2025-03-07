<?php
session_start();

include('includes/config.php');
                //get teacher id 
 $em=$_SESSION['tlogin'];
 $st="SELECT * FROM teacher_add WHERE teacher_email='$em'";
  $stc=mysqli_query($conn,$st);
  $std=mysqli_fetch_assoc($stc);
  $teacher_id=$std['teacher_id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS Admin| Add Result </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="../css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="../css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="../css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="../css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="../css/select2/select2.min.css" >
        <link rel="stylesheet" href="../css/main.css" media="screen" >
        <script src="../js/modernizr/modernizr.min.js"></script>

<style>

    .app-loader{
            width:100%;
            height:100vh;
            text-align:center;
            background-color:white;
            display:none;
    }
    .app-loader img{
        position:absolute;
        width: 300px;
        height:300px;
        top:0;
        bottom:0;
        left:0;
        right:0;
        margin:auto;
    }
    .din{
        display:none;
    }
</style>
    </head>
    <body class="top-navbar-fixed">
        <div class="app-loader">
                <img src="../images/loading.gif" alt="">
        </div>
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Declare Result</h2>
                                    <?php
                                     if(isset($_GET['suc'])){
                                        $msg="Result Upload Success";
                                     }
                                    ?>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student Result</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                           
                                            <div class="panel-body">
<?php if(isset($msg)){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if(isset($error)){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">


  <div class="form-group">
<label for="default" class="col-sm-2 control-label">Class Id</label>
 <div class="col-sm-10">
 <select name="classid" class="form-control clid" id="classid" onChange="getStudent(this.value);" required="required">
<option value="">Select Class</option>
<?php 
 $sql = "SELECT DISTINCT ClassId,ClassName,Section from tblsubjectcombination
 INNER JOIN tblclasses ON tblclasses.id=tblsubjectcombination.ClassId WHERE tblsubjectcombination.t_id='$teacher_id'";
 $results=mysqli_query($conn,$sql) or die("Error");
 echo "s";
foreach($results as $result)

{   ?>
<option value="<?php echo htmlentities($result['ClassId']); ?>"><?php echo htmlentities($result['ClassName']); ?>&nbsp; Section-<?php echo htmlentities($result['Section']); ?></option>
<?php } ?>
 </select>
                                                        </div>
                                                    </div>

 <div class="form-group">
<label for="default" class="col-sm-2 control-label">Subject</label>
 <div class="col-sm-10">
 <select name="subject" class="form-control clid" id="classid" onChange="getStudent(this.value);" required="required">
<option value="">Select Subject</option>
<?php 
 $sql = "SELECT DISTINCT SubjectId,SubjectName from tblsubjectcombination
 INNER JOIN tblsubjects ON tblsubjects.s_id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.t_id='$teacher_id'";
 $results=mysqli_query($conn,$sql) or die("Error");
 echo "s";
foreach($results as $result)

{   ?>
<option value="<?php echo htmlentities($result['SubjectId']); ?>"><?php echo htmlentities($result['SubjectName']); ?></option>
<?php } ?>
 </select>
                                                        </div>
                                                    </div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Year</label>
<div class="col-sm-10">
    <input type="number" class="form-control" name="year" required>
    </div>
</div>
                                                    
<div class="form-group" style="text-align:center;">
                                    <input type="submit" class="btn btn-primary" name="showres" value="Show" id="">
                                                       
                                                    </div>
                                                    

                                                </form>

                                            </div>

    
                                        </div>
                                    </div>
                                    <div id="div11">
                                       
                                    </div>
               <form id="my-form">                 
            <?php 
                if(isset($_POST['showres'])){
                    $year =$_POST['year'];
                    $classid=$_POST['classid'];
                    $subjectid=$_POST['subject'];
                    //data check start
                        $selec129="SELECT * FROM result_sheet WHERE res_year='$year' AND res_class_id='$classid' AND res_sub='$subjectid'";
                        $checkAll=mysqli_query($conn,$selec129);
                        $checkCount=mysqli_num_rows($checkAll);
                  

                     
                    //data check end
                    //class name start
                    $class="SELECT * FROM tblclasses WHERE id='$classid'";
                    $cls=mysqli_query($conn,$class);
                    $classdata=mysqli_fetch_assoc($cls);
                    $className1=$classdata['ClassName'].'('.$classdata['Section'].')';
                    //class name end

                    //subject name start
                    $class="SELECT * FROM tblsubjects WHERE s_id='$subjectid'";
                    $cls=mysqli_query($conn,$class);
                    $classdata=mysqli_fetch_assoc($cls);
                   $subjectName=$classdata['SubjectName'];
                    //subject name end
                    $select="SELECT * FROM tblstudents WHERE ClassId='$classid'";
                    $comp=mysqli_query($conn,$select);
                    ?>


        <!--all result add start-->
                <table class="table">
                    <tr> 
                        <th class="text-success">Subject : <?php echo $subjectName; ?></th> 
                        <th class="text-success">Class : <?php echo $className1; ?></th>
                        <th colspan="2" class="text-success">Year : <?php echo $year; ?></th>   
                    </tr>

                            <?php

                                                    if($checkCount>0){
                                                        echo   "<tr>
                                                        <th colspan='4'>";
                                                        echo "<center><b>Result Already Add</b></center>";
                                                        echo "</th>";
                                                        die();
                                                    }
                            ?>
                        
                    </tr>
                    <tr>
                        <th>Student Name</th>
                        <th>Roll</th>
                        <th>Mark</th>
                        <th>Attendance %</th>
                        <form action="" method="get" id="resultform">
                    </tr>


                    <?php
                    $l=0;
                    $store=0;
                    foreach($comp as $data){
                        $l++;
                        $store=$l+$store;
                        ?>


                    <tr>
                   
                    <td>
                    <input type="hidden" name="year_<?php echo $l?>" value="<?php echo $year ?>" id="">
                    <input type="hidden" value="<?php echo $classid; ?>" name="class_id_<?php echo $l ?>" id="">
                    <input type="hidden" value="<?php echo  $subjectid; ?>" name="subject_id_<?php echo $l ?>" id="">
                        <input type="hidden" value="<?php echo $data['StudentId']; ?>" name="student_id_<?php echo $l ?>" id="">
                        <?php echo $data['StudentName']; ?>
                    </td>
                    
                    <td>
                        <input type="hidden" value="<?php echo $data['RollId']; ?>" name="studentRoll_<?php echo $l ?>" id="">
                        <?php echo $data['RollId']; ?>
                    </td>

                        <td>
                            <input type="text" value="" data-id='<?php echo $l ?>' name="mark_<?php echo $l ?>" class="marking" id="mark<?php echo $l;?>"  required>
                            <span id="error<?php echo $l ?>" class="text-danger din">
                            Minimum nUmber 1 And Maximum 100
                        </span>
                        </td>
     

                        <td>
                        <?php 
                            //parsent find start
                                 $stId=$data['StudentId']; 
                                $find="SELECT * FROM attendtance WHERE student_id='$stId' AND class_id='$classid' AND subject_id='$subjectid'";
                                $fca=mysqli_query($conn,$find)or die("error");
                                $totalClass=mysqli_num_rows($fca);
                               //absent student
                               $finda="SELECT * FROM attendtance WHERE student_id='$stId' AND class_id='$classid' AND subject_id='$subjectid' AND student_status_at='absent'";
                               $fcaa=mysqli_query($conn,$finda)or die("error");
                               $absentStudent=mysqli_num_rows($fcaa);
                               if($totalClass==0){
                                $parsent=100;
                               }else{
                                $presentclass=$totalClass-$absentStudent;
                                $parsent=$presentclass*100/$totalClass;
                               }

                                echo $parsent;
                            //parsent find end 
                        ?>
                        <input type="hidden" value="<?php echo $parsent; ?>" name="parsent_<?php echo $l ?>" id="">

                        </td>
                        
                    </tr>

                    <?php
                
            } 

            ?>


                </table>
                <tr>
               
            </tr>

              <center>  <input type="button" value="submit" class="btn btn-primary" name="" id="submit">
                    
              </center></form>
                    <?php
                }
            ?>
        <!--all result add end-->

                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="../js/jquery/jquery-2.2.4.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/pace/pace.min.js"></script>
        <script src="../js/lobipanel/lobipanel.min.js"></script>
        <script src="../js/iscroll/iscroll.js"></script>
        <script src="../js/prism/prism.js"></script>
        <script src="../js/select2/select2.min.js"></script>
        <script src="../js/main.js"></script>

    </body>
    
    <script>
            $(document).ready(function(){
                $("#submit").prop('disabled', true);
                $(".marking").on("change keyup paste", function(){
                    var mark=$(this).val();
                    var id=$(this).data('id');
                    if(mark<1 || mark>100){
                        $("#error"+id).fadeIn(200);
                        $("#submit").prop('disabled', true);
                    }else{
                        $("#error"+id).fadeOut(200);
                        $("#submit").prop('disabled', false);
                    }
                })

            });
        </script>
   
    <script>
            $(document).ready(function(){

                    $('#submit').click(function() {
                    if ($('#my-form input').filter(function() {
                        return !this.value;
                    }).length > 0) {
                        // at least one input element is empty
                        alert('Please fill out all input fields');
                    } else {
                        // all input elements are not empty
                            var data1 = $("#my-form").serializeArray();
                           var myJsonString = JSON.stringify(data1);
                           $.ajax({
                            url:'resultsheet.php?param1',
                            method:'post',
                            data:data1,
                            success:function(result){
                            $("#div11").html(result);
                            $(".main-wrapper").show();
                            $(".app-loader").hide();
                            }
                        
                           })
                    }
                });

                    // //get form data start
                    //     $("#submit").click(function(){
   

                    //        var data1 = $("#resultform").serializeArray();
                    //        var myJsonString = JSON.stringify(data1);
                    //        $.ajax({
                    //         url:'resultsheet.php?param1',
                    //         method:'post',
                    //         data:data1,
                    //         success:function(result){
                    //         $("#div11").html(result);
                    //         $(".main-wrapper").show();
                    //         $(".app-loader").hide();
                    //         }
                        
                    //        })
                        
                    //     });
                    // //get form data end





                $("#classid").change(function(){
                    var classid=$("#classid").val();
                    $.ajax({
                        method:'post',
                        url:"resultconfig.php",
                        data:{
                            'classid':classid,
                        },
                        success:function(result){
                        $("#div1").html(result);
                        $("#hidden"+studentId).fadeOut(500);
                       
                         }

                        
                    })
                })
            })
        </script>

</html>

