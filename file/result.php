<?php
session_start();

include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Result Automation System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

  <style>
    table, tr, td,th{
        text-align:center;
    }
  </style>
    </head>
    <body>
        <div class="main-wrapper">
            <div class="content-wrapper">
                <div class="content-container">

         
                    <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-12">
                                    <h2 class="title" align="center">Result Automation System</h2>
                                </div>
                            </div>
                            <!-- /.row -->
                          
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">
                              
                             

                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">



                                            </div>
                                            <div class="panel-body p-20">
<?php
if(isset($_POST['rollid'])){
    $roll=$_POST['rollid'];
    $class=$_POST['class'];
    $year=$_POST['year'];
    $pass=$_POST['pass'];
    $select="SELECT * FROM tblstudents  WHERE Rollid='$roll' AND pass='$pass'";
    $comp=mysqli_query($conn,$select);
    $count=mysqli_num_rows($comp);
    if($count>0){
        $data=mysqli_fetch_assoc($comp);
        $studentId=$data['StudentId'];
            $selectr="SELECT * FROM result_sheet INNER JOIN tblclasses ON tblclasses.id=result_sheet.res_class_id
            INNER JOIN tblstudents ON tblstudents.StudentId=result_sheet.res_student_id
            INNER JOIN tblsubjects ON tblsubjects.s_id=result_sheet.res_sub 
             WHERE result_sheet.res_student_id='$studentId' AND result_sheet.res_year='$year'
              AND result_sheet.res_class_id='$class'";
             $rescomp=mysqli_query($conn,$selectr);
             $rescount=mysqli_num_rows($rescomp);
             $t1=mysqli_fetch_assoc($rescomp);
             if($rescount>0){
                ?>
                <tr><a href="find-result.php" class="badge badge-primary">got result page</a></tr>
                <tr>
                    <button onclick="generatePDF()" class="btn btn-success">Download</button>
                </tr>
                <div >
                <table id="download" class="table table-hover table-bordered">
                <tr>
                <th class="text-success">Name : <?php echo $t1['StudentName']; ?></th>
                <th class="text-success">Class : <?php echo $t1['ClassName']; ?></th>
                <th class="text-success">Year : <?php echo $t1['res_year']; ?></th>
                
                </tr>
                
                <tr>
                                                            <th>#</th>
                                                                <th>Subject</th>    
                                                                <th>Marks(sub+attendance)</th>
                                                            </tr>
            <?php
            $i=0;
            $totalMark=0;
                foreach($rescomp as $item){
                    $i++;
                    echo "<tr>";
                    ?>
                <th><?php echo $i; ?></th>
                <th><?php echo $item['SubjectName']; ?></th>
                <th>
                    <?php
                    $mark=$item['res_mark'];
                    $pars=$item['res_class_parsent'];

                    if($pars>0){
                        $realmark=ceil($mark*90/100);
                        $parsemark=$mark-$realmark;
                        $realpassmark=ceil($parsemark*$pars/100);
                        echo  $mark= $realmark+$realpassmark;
                        $totalMark=$mark+$totalMark;
                        
                    }else{
                        $realmark=ceil($mark*90/100);
                        echo $mark= $realmark;
                    }
                    ?>
                </th>
                
            <?php
            echo "</tr>";
           
                }
                echo "<tr>
                     <th>Total :</th> <th colspan='2' class='text-right'>  $totalMark </th>
                 </tr>";
             }else{
                echo "<tr><th class='text-danger'>Result Not Publish<th></tr>";
             }
    }else{
        echo "<tr><th class='text-danger'>Student Information wrong<th></tr>";
    }
}

?>




                                                    </tbody>
                                                    
                                                    <table>
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
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script type="text/javascript">
  function generatePDF() {
        
        // Choose the element id which you want to export.
        var element = document.getElementById('download');
        element.style.width = '100%';
        element.style.height = 'auto';
        var opt = {
            margin:       0.5,
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 1. },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait',precision: '12' }
          };
        
        // choose the element and pass it to html2pdf() function and call the save() on it to save as pdf.
        html2pdf().set(opt).from(element).save();
      }
</script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

    </body>
</html>
