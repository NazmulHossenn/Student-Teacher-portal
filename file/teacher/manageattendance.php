
<?php
session_start();

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
                                    <h2 class="title">Attendance Report</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Attendance</li>
            							<li class="active">Attendance Report</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                            <center>

<div class="row">

  <div class="content">
    <h3>Individual Report</h3>

    <form method="post" action="">


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
                <p>

                </p>
                <select class="from-control" name="subject" id="input1" readonly>
                    
                    <?php  
                      foreach($com as $item){
                        ?>
                          <option value="<?php echo $item['s_id']; ?>"><?php echo $item['SubjectName'];  ?> </option>
        
    
                        <?php
                      }
                    ?>
                    </select>

      <p>  </p>
      <label>Roll</label>
      <input type="number" name="roll" required>
      <input type="submit" name="sr_btn" value="Go!" >

    </form>
<p></p>
    <div class="card">
      <div class="card-body">
        <?php if(isset($_POST['sr_btn'])){
          ?>
                     
                      <?php
                            $classId=$_POST['class'];
                            $subjectId=$_POST['subject'];
                            $roll=$_POST['roll'];
                            $getst="SELECT * FROM tblstudents WHERE RollId=$roll";
                            $com99=mysqli_query($conn,$getst)or die("error");
                            $count=mysqli_num_rows($com99);
                            $datas=mysqli_fetch_assoc($com99);
                           echo $unSid=$datas['StudentId'];
                          //  $name=$datas['StudentName'];
                          //absent
                          $ab="SELECT * FROM attendtance INNER JOIN tblstudents ON tblstudents.StudentId=attendtance.student_id INNER JOIN
                          tblclasses ON tblclasses.id=attendtance.class_id INNER JOIN tblsubjects ON 
                          tblsubjects.s_id=attendtance.subject_id
                            WHERE attendtance.student_id='$unSid'
                             AND attendtance.subject_id='$subjectId'
                              AND attendtance.class_id='$classId'
                              AND attendtance.student_status_at='absent'";
                              $c123=mysqli_query($conn, $ab);
                              $totalAbsent=mysqli_num_rows($c123);

                          //present
                          $pr="SELECT * FROM attendtance INNER JOIN tblstudents ON tblstudents.StudentId=attendtance.student_id INNER JOIN
                          tblclasses ON tblclasses.id=attendtance.class_id INNER JOIN tblsubjects ON 
                          tblsubjects.s_id=attendtance.subject_id
                            WHERE attendtance.student_id='$unSid'
                             AND attendtance.subject_id='$subjectId'
                              AND attendtance.class_id='$classId'
                              AND attendtance.student_status_at='present'";
                               $c1233=mysqli_query($conn, $pr);
                                $totalPresent=mysqli_num_rows($c1233);

                            $select="SELECT * FROM attendtance INNER JOIN tblstudents ON 
                            tblstudents.StudentId=attendtance.student_id INNER JOIN
                            tblclasses ON tblclasses.id=attendtance.class_id INNER JOIN tblsubjects ON 
                            tblsubjects.s_id=attendtance.subject_id
                              WHERE attendtance.student_id='$unSid'
                               AND attendtance.subject_id='$subjectId' AND attendtance.class_id='$classId'";
                            $comp456=mysqli_query($conn,$select) or die("erro");
                           $totalClass=mysqli_num_rows($comp456);
                        if($totalClass<1){
                          echo "No Record Found";
                        }else{

                        
                            foreach($comp456 as $item){
                                $name=$item['StudentName'];
                                $sub=$item['SubjectName'];
     
                  
                               
                               }
                              ?>
    <table class="table" style="text-align:center;width:300px;">
                          <tr>
                            <th><b class="text-success">Student Name</b></th> <th><?php echo $name ?></th>
                          </tr>
                          <tr>
                            <th><b class="text-success">Subject Name</b></th> <th><?php echo $sub; ?></th>
                          </tr>
                          <tr>
                            <th><b class="text-success">Total Absent</b></th> <th><?php echo $totalAbsent ?></th>
                          </tr>
                          <tr>
                            <th><b class="text-success">Total Present</b></th> <th><?php echo $totalPresent; ?></th>
                          </tr>
                          <tr>
                            <th><b class="text-success">Total Class</b></th> <th><?php echo $totalClass; ?></th>
                          </tr>
                              </table>
                      <?php
                      }}
                      ?>
      </div>
    </div>

    <h3>Mass Report</h3>

    <form method="post" action="">

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
                <p>

                </p>
                <select class="from-control" name="subject" id="input1" readonly>
                    
                    <?php  
                      foreach($com as $item){
                        ?>
                          <option value="<?php echo $item['s_id']; ?>"><?php echo $item['SubjectName'];  ?> </option>
        
    
                        <?php
                      }
                    ?>
                    </select>

      <p>  </p>
    <p>  </p>
      <label>Date </label>
      <input type="date" name="date">
      <input type="submit" name="sr_date" value="Go!" >
    </form>

    <br>

    <br>

    <?php if(isset($_POST['sr_date'])){
          ?>
                      <table class="table">
                        <tr>
                        <th>Date</th>
                          <th>
                            Student Name
                          </th>
                          <th>Class Name</th>
                          <th>Subject Name</th>
                          <th>Status</th>
                          </tr>


                          <?php
                          $datee=$_POST['date'];
                           
                          
                            $classId=$_POST['class'];
                            $subjectId=$_POST['subject'];
                           
                     
                            $select="SELECT * FROM attendtance INNER JOIN tblstudents ON tblstudents.StudentId=attendtance.student_id INNER JOIN
                            tblclasses ON tblclasses.id=attendtance.class_id INNER JOIN tblsubjects ON 
                            tblsubjects.s_id=attendtance.subject_id  WHERE attendtance.att_date='$datee' AND attendtance.subject_id='$subjectId' AND attendtance.class_id='$classId'";
                            $comp456=mysqli_query($conn,$select) or die("error");
                            foreach($comp456 as $item){
                              ?>
                     

                          <tr>
                            <td><?php echo $item['att_date']; ?></td>
                            <td><?php echo $item['StudentName']; ?></td>
                            <td><?php echo $item['ClassName']; ?></td>
                            <td><?php echo $item['SubjectName']; ?></td>
                            <td>
                              <?php 
                                  $st=$item['student_status_at'];
                                  if($st=='absent'){
                                    ?>
                                      <button class="badge badge-danger">Absent</button>
                                <?php
                                  }else{
                                    ?>
                                    <button class="badge badge-primary">Present</button>
                              <?php
                                  }
                              ?>
                              
                            
                          </td>
                          </tr>
                          <?php
                            }
                          ?>
                      </table>
                      <?php
                      }
                      ?>


   

  </div>

</div>

</center>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                        </section>
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
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php } ?>

