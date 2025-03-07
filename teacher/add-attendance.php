
//start_here


<?php
session_start();
// error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['tlogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS Admin Manage Students</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="../css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="../css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="../css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="../css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="../text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="../css/main.css" media="screen" >


        <script src="../js/modernizr/modernizr.min.js"></script>
          <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

  .status{
    font-size: 10px;
  }
  .table{
    width:80%;
  }
  /* Create a custom radio button */


        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Add Attendance</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Attendance</li>
            							<li class="active">Add Attendance</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <center>

<div class="row">

  <div class="content">
    <h3>Attendance  </h3>
    <br>

    <center><p><?php if(isset($att_msg)) echo $att_msg; if(isset($error_msg)) echo $error_msg; ?></p></center> 
    
    <form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">

     <div class="form-group">


               <label>Select Class </label>
                <?php
                //get teacher id 
                $em=$_SESSION['tlogin'];
                $st="SELECT * FROM teacher_add WHERE teacher_email='$em'";
                $stc=mysqli_query($conn,$st);
                $std=mysqli_fetch_assoc($stc);
                $teacher_id=$std['teacher_id'];
                
                // $select="SELECT * FROM teacher_add INNER JOIN tblsubjectcombination ON tblsubjectcombination.t_id=teacher_add.teacher_id INNER JOIN tblsubjects ON tblsubjects.s_id=tblsubjectcombination.SubjectId INNER JOIN   tblclasses ON tblclasses.id=tblsubjectcombination.ClassId   WHERE  teacher_add.teacher_email='$em'";
                $select="SELECT DISTINCT *  FROM tblsubjectcombination INNER JOIN tblclasses ON tblclasses.id=tblsubjectcombination.ClassId INNER JOIN tblsubjects ON tblsubjects.s_id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.t_id='$teacher_id'";
                $com=mysqli_query($conn,$select)or die("Error");
                
                ?>
                <select class="from-control" name="class" id="input1">

                    <?php
              foreach($com as $item){
                    ?>
                    <option value="<?php echo $item['id']?>"><?php echo $item['ClassName'].'('.$item['Section'] ?>)</option>

                    <?php
                  }
                ?>
                </select>
                    <br>
                    <br>
                <select class="from-control" name="subject" id="input1" readonly>
                    
                    <?php  
                      foreach($com as $item){
                        ?>
                          <option value="<?php echo $item['s_id']; ?>"><?php echo $item['SubjectName'];  ?> </option>
        
    
                        <?php
                      }
                    ?>
                    </select>


                <!-- <label>Enter Batch</label>
                <input type="text" name="whichbatch" id="input2" placeholder="Only 2020"> -->
              </div>
              <div class="form-group">
                <input type="date" name="date" id="" required>
              </div>
               
     <input type="submit" class="btn btn-danger col-md-2 col-md-offset-5" style="border-radius:0%" value="Search" name="batch" />

    </form>

    <div class="content"></div>
                      
    

<?php
date_default_timezone_set("Asia/Dhaka");
$date1 = date("Y-m-d");
?>



    <p>Date : <?php echo $date1 ?></p>
    <div id="div1">

</div>  

    <table class="table table-stripped">
      <thead>
      <?php
        if(isset($_POST['class'])){
          $date=$_POST['date'];
           $class=$_POST['class'];
           $subject=$_POST['subject']; 
           $sb="SELECT * FROM tblsubjects WHERE s_id='$subject'";
           $com=mysqli_query($conn,$sb);
           $sbd=mysqli_fetch_assoc($com);
           $subjectName=$sbd['SubjectName'];

           $cl="SELECT * FROM tblclasses WHERE id='$class'";
           $com6=mysqli_query($conn,$cl);
           $cld=mysqli_fetch_assoc($com6);
           $className=$cld['ClassName'];
           
      ?>
      <tr>
        <th>Subject Name : <?php echo $subjectName; ?> </th>
        <th>Class Name: <?php echo $className; ?> </th>
      </tr>
        <tr>
          
          <th scope="col">Name</th>
          <th scope="col">Reg. No.</th>
          <th scope="col">Absent</th>
          <th cope="col">Present</th>
        </tr>
      </thead>


    <tbody>
          <?php
          //CHEKC POINT START
            $student11="SELECT * FROM attendtance INNER JOIN tblstudents ON tblstudents.StudentId=attendtance.student_id WHERE attendtance.class_id='$class' AND attendtance.subject_id='$subject' AND attendtance.att_date='$date' ";
            $comp2=mysqli_query($conn,$student11) or die(mysqli_error($conn));
           echo $countCheck=mysqli_num_rows($comp2) ;
           $finalId='';
          
            foreach($comp2 as $final){
              $finalId6= $final['student_id'];
              $finalId=$finalId6.','. $finalId;
            }
            $finalId1=rtrim($finalId,",");
            

          //CHECK POINT ENDT
          if($countCheck>0){
            $student1="SELECT * FROM tblstudents WHERE ClassId='$class' AND StudentId not in($finalId1)";
          }else{
            $student1="SELECT * FROM tblstudents WHERE ClassId='$class'";
          }
 
          $st=mysqli_query($conn,$student1);
          foreach($st as $stdata){
            $classId=$class;
            $studentId=$stdata['StudentId'];
            $subjectId=$subject;
?>


    
    <tr id="hidden<?php echo $stdata['StudentId']?>">
          <td>
           
              <?php
                echo $stdata['StudentName'];
              ?>
          </td>
 
          <td>
          <?php
                echo $stdata['RollId'];
              ?>
              </td>
              <input type="hidden" name="dateg" id="date" value="<?php echo $date; ?>">

              <td>
                
                <button data-subid="<?php echo $subject; ?>" data-classid="<?php echo $class; ?>"  data-stid="<?php echo $stdata['StudentId']?>" class="btn btn-danger absent">Absent</button> 
              </td>
              <td>
    
              <button  data-subid="<?php echo $subject; ?>" data-classid="<?php echo $class; ?>"  data-stid="<?php echo $stdata['StudentId']?>" class="btn btn-success present">Present</button>
              </td>
    </tr>
    <?php
            }

            ?>
    <?php
          }
          ?>
</tbody>
<?php
        
      ?>

    </table>



</form>

  </div>

</div>

</center>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

  

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="../js/jquery/jquery-2.2.4.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/pace/pace.min.js"></script>
        <script src="../js/lobipanel/lobipanel.min.js"></script>
        <script src="../js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="../js/prism/prism.js"></script>
        <script src="../js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="../js/main.js"></script>
        <script>
            
                  $(document).ready(function(){
                    $(".absent").click(function(){
                      var subjectId=$(this).data("subid");
                      var classId=$(this).data("classid");
                      var studentId=$(this).data("stid");
                      var date=$("#date").val();
                      $.ajax({
                        method:"post",
                        url:"attendtance.config.php",
                        data:"subjectId="+subjectId+"&classId="+classId+"&studentId="+studentId+"&date="+date+"&absent",
                        success:function(result){
                        $("#div1").html(result);
                        $("#hidden"+studentId).fadeOut(500);
                         }
                      });
                     console.log(subjectId+','+classId+','+studentId);
                    });

                    $(".present").click(function(){
                      var subjectId=$(this).data("subid");
                      var classId=$(this).data("classid");
                      var studentId=$(this).data("stid");
                      var date=$("#date").val();
                      $.ajax({
                        method:"post",
                        url:"attendtance.config.php",
                        data:"subjectId="+subjectId+"&classId="+classId+"&studentId="+studentId+"&date="+date+"&present",
                        success:function(result){
                        $("#div1").html(result);
                        $("#hidden"+studentId).fadeOut(500);
                         }
                      });
                     console.log(subjectId+','+classId+','+studentId);
                    });
                  })
              
        </script>
    </body>
</html>
<?php } ?>

