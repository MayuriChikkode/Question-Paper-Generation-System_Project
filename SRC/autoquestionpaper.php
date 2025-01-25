<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Question Paper Generation System</title>
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no"/>
<!-- CSS
  ================================================== -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<link href="plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="plugins/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="plugins/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugins/rs-plugin/css/settings.css" media="screen" />
<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->
<!-- Color Style -->
<link class="alt" href="colors/purple.css" rel="stylesheet" type="text/css">
<?php
require_once "questionhelper.php";
$helper = new QuestionHelper();

if(!$_SESSION['admin_id'])
{
   echo "<script>window.location='login.php';</script>"; 
}
else if($_SESSION['user_type']!=1)
{
    echo "<script>window.location='dashboard.php';</script>"; 
}

$db = new Database();
$db->open();
                
$msg  = '';
$id   = $_REQUEST['id'];
$task = $_REQUEST['task'];

$msg2 = $_REQUEST['msg2'];
if($msg2!='')
{
    $msg = $msg2;
}

if($task == 'auto_question_paper')
{
    $msg = $helper->auto_question_paper();
}

?>
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->

<script type="text/javascript">
function validate_form()
{
    var subject_id           = document.getElementById("subject_id").value;
    var title           = document.getElementById("title").value;
    var total_time      = document.getElementById("total_time").value;
    var total_marks     = document.getElementById("total_marks").value;
    
    if(subject_id=='')
    {
        alert("Please Select Subject.");
        return false;
    }
    else if(title=='')
    {
        alert("Please Enter Question Paper Title.");
        return false;
    }
    else if(total_time=='')
    {
        alert("Please Enter Total Time.");
        return false;
    }
    else if(total_marks=='')
    {
        alert("Please Enter Total Time.");
        return false;
    }
}
</script>


</head>
<body>
<!-- Start Body Container -->
<div class="body"> 
  <!-- Start Header -->
  <?php
    require_once "header.php";
  ?>
  <!-- End Header --> 
  <!-- Start Content -->
  <div class="main" role="main">
    <div id="content" class="content page-content full">
      <header class="page-header flexible parallax text-align-center parallax-overlay">
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1><?php echo ($row->id) ? "Update" : "Auto";?> Question Paper</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-12" style="min-height: 300px;">
            <?php
            if($msg!='')
            {
                ?>
                <div class="col-md-12">
                    <div class="alert alert-success fade in"> 
                        <a href="#" data-dismiss="alert" class="close">&times;</a>
                        <?php echo $msg;?>
                    </div>
                </div>
                <?php
            }
            ?>
            
            <form method="post" action="" onsubmit="return validate_form();">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-12">  
                            <h3 class="mb-5">Question Paper Title:</h3>
                            <input type="text" name="title" id="title" value="<?php echo $row->title; ?>"  class="form-control input-lg" placeholder="Enter Question Paper Title"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Subject:</h3>
                            <?php 
                            if($row->id && $row->subject_id) 
                            {  
                                ?>
                                <input type="text" value="<?php echo $helper->getSubjectInfo($row->subject_id)->subject_name;?>" class="form-control input-lg" readonly=""/>
                                <input type="hidden" id="subject_id" name="subject_id" value="<?php echo $row->subject_id; ?>" />
                                <?php
                            } 
                            else 
                            { 
                                ?>
                                <select id="subject_id" name="subject_id" class="form-control input-lg">
                                    <option value="">Select</option>
                                    <?php
                                    $helper->getSubjectSelect($row->subject_id);
                                    ?>
                                </select>
                                <?php 
                            } 
                            ?>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Total Time:</h3>
                            <input type="text" name="total_time" id="total_time" value="<?php echo $row->total_time; ?>"  class="form-control input-lg" placeholder="Enter Total Time"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Total Marks:</h3>
                            <input type="text" name="total_marks" id="total_marks" value="<?php echo $row->total_marks; ?>"  class="form-control input-lg" placeholder="Enter Total Marks"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 1 Title:</h3>
                            <input type="text" name="group_1" id="group_1" value="<?php echo $row->group_1; ?>"  class="form-control input-lg" placeholder="Enter Group 1 Title"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 1 Marks(Per Question):</h3>
                            <input type="text" name="group_1_marks" id="group_1_marks" value="<?php echo $row->group_1_marks; ?>"  class="form-control input-lg" placeholder="Enter Group 1 Marks(Per Question)"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 1 No. of Questions:</h3>
                            <input type="text" name="group_1_questions" id="group_1_questions" value="<?php echo $row->group_1_questions; ?>"  class="form-control input-lg" placeholder="Enter Group 1 No. of Questions"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 2 Title:</h3>
                            <input type="text" name="group_2" id="group_2" value="<?php echo $row->group_2; ?>"  class="form-control input-lg" placeholder="Enter Group 2 Title"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 2 Marks(Per Question):</h3>
                            <input type="text" name="group_2_marks" id="group_2_marks" value="<?php echo $row->group_2_marks; ?>"  class="form-control input-lg" placeholder="Enter Group 2 Marks(Per Question)"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 2 No. of Questions:</h3>
                            <input type="text" name="group_2_questions" id="group_2_questions" value="<?php echo $row->group_2_questions; ?>"  class="form-control input-lg" placeholder="Enter Group 2 No. of Questions"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 3 Title:</h3>
                            <input type="text" name="group_3" id="group_3" value="<?php echo $row->group_3; ?>"  class="form-control input-lg" placeholder="Enter Group 3 Title"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 3 Marks(Per Question):</h3>
                            <input type="text" name="group_3_marks" id="group_3_marks" value="<?php echo $row->group_3_marks; ?>"  class="form-control input-lg" placeholder="Enter Group 3 Marks(Per Question)"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 3 No. of Questions:</h3>
                            <input type="text" name="group_3_questions" id="group_3_questions" value="<?php echo $row->group_3_questions; ?>"  class="form-control input-lg" placeholder="Enter Group 3 No. of Questions"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 4 Title:</h3>
                            <input type="text" name="group_4" id="group_4" value="<?php echo $row->group_4; ?>"  class="form-control input-lg" placeholder="Enter Group 4 Title"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 4 Marks(Per Question):</h3>
                            <input type="text" name="group_4_marks" id="group_4_marks" value="<?php echo $row->group_4_marks; ?>"  class="form-control input-lg" placeholder="Enter Group 4 Marks(Per Question)"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 4 No. of Questions:</h3>
                            <input type="text" name="group_4_questions" id="group_4_questions" value="<?php echo $row->group_4_questions; ?>"  class="form-control input-lg" placeholder="Enter Group 4 No. of Questions"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">  
                            <input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>"/>
                            <input type="hidden" id="task" name="task" value="auto_question_paper" />
                            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="<?php echo ($row->id) ? "Update" : "Add";?> Question Paper"/>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="clearfix"></div>
             
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    require_once "footer.php";
  ?> 
</div>

<!-- End Body Container --> 
<script src="js/jquery-latest.min.js"></script> <!-- Jquery Library Call --> 
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>  
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script> 
<script src="plugins/page-scroller/jquery.pagescroller.js"></script> 
<script src="js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="js/bootstrap.js"></script> <!-- UI --> 
<script src="js/init.js"></script> <!-- All Scripts --> 
<!-- End Js --> 
</body>
</html>