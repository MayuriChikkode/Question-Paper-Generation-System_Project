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

$msg = '';
$id  = $_REQUEST['id'];
if(!$_SESSION['admin_id'])
{
   echo "<script>window.location='login.php';</script>"; 
}

if($_POST)
{
    $msg = $helper->addQuestion();
}

$row = array();

if($id)
{
    $row = $helper->getQuestionInfo($id);
}
?>
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->

<script type="text/javascript">
function validate_form()
{
    var subject_id      = document.getElementById("subject_id").value;
    var unit_id         = document.getElementById("unit_id").value;
    var question_type   = document.getElementById("question_type").value;
    var question        = document.getElementById("question").value;
    var opt1            = document.getElementById("opt1").value;
    var opt2            = document.getElementById("opt2").value;
    var opt3            = document.getElementById("opt3").value;
    var opt4            = document.getElementById("opt4").value;
    var mark            = document.getElementById("mark").value;
    
    
    if(subject_id=='')
    {
        alert("Please select Subject Name.");
        return false;
        
    }
    else if(unit_id=='')
    {
        alert("Please select Unit Name.");
        return false;
        
    }
    else if(question_type=='')
    {
        alert("Please select Question Type.");
        return false;
        
    }
    else if(question=='')
    {
        alert("Please Enter Question.");
        return false;
        
    }
    else if(opt1=='' && question_type==2)
    {
        alert("Please Enter option 1.");
        return false;
        
    }
     else if(opt2=='' && question_type==2)
    {
        alert("Please Enter option 2.");
        return false;
        
    }
     else if(opt3=='' && question_type==2)
    {
        alert("Please Enter option 3.");
        return false;
        
    }
     else if(opt4=='' && question_type==2)
    {
        alert("Please Enter option 4.");
        return false;
        
    }
     else if(mark=='')
    {
        alert("Please Enter Mark.");
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
                <h1><?php echo ($row->id) ? "Update" : "Add";?> Question</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <?php
                if($msg!='')
                {
                    ?>
                    <div class="alert alert-success fade in"> <a href="#" data-dismiss="alert" class="close">?</a><?php echo $msg;?></div>
                    <?php
                }
            ?>
             
            <form method="post" action="" onsubmit="return validate_form();" enctype="multipart/form-data">
             <div class="col-md-6">
             <div class="row">
                <div class="form-group col-md-12">  
                    <h3 class="mb-5">Subject:</h3>
                    <select name="subject_id" id="subject_id" class="form-control input-lg">
                        <option value="">Select Subject</option>
    		            <?php
                        $helper->getSubjectSelect($row->subject_id);
                        ?>
   		           </select>
                </div>
             </div>
             <div class="row">
                <div class="form-group col-md-12">  
                    <h3 class="mb-5">Unit:</h3>
                    <select name="unit_id" id="unit_id" class="form-control input-lg">
                        <option value="">Select Unit</option>
    		            <?php
                        $helper->getUnitSelect($row->unit_id);
                        ?>
   		           </select>
                </div>
             </div>
             <div class="row">
                <div class="form-group col-md-12">  
                    <h3 class="mb-5">Question Type:</h3>
                    <select name="question_type" id="question_type" class="form-control input-lg" onchange="showOptions(this.value);">
                        <option value="">Select Type</option>
    		            <option value="1" <?php echo ($row->question_type == 1) ? 'selected="selected"' : ''; ?>>Descriptive</option>
                        <option value="2" <?php echo ($row->question_type == 2) ? 'selected="selected"' : ''; ?>>MCQ</option>
   		           </select>
                </div>
             </div>
              <div class="row">
                <div class="form-group col-md-12">
                    <h3 class="mb-5">Question:</h3>
                    <textarea name="question" id="question" class="form-control input-lg" placeholder="Enter Question"><?php echo $row->question; ?></textarea>
                </div>
              </div>
              <div id="question_options" style="<?php echo ($row->question_type == 2) ? '' : 'display: none;'; ?>">
              <div class="row">
                <div class="form-group col-md-12">
                    <h3 class="mb-5">Option 1:</h3>
                    <input type="text" name="opt1" id="opt1" value="<?php echo $row->opt1; ?>"  class="form-control input-lg" placeholder="Enter Option 1"/>
                </div>
              </div>
              
               <div class="row">
                <div class="form-group col-md-12">
                    <h3 class="mb-5">Option 2:</h3>
                    <input type="text" name="opt2" id="opt2" value="<?php echo $row->opt2; ?>"  class="form-control input-lg" placeholder="Enter Option 2"/>  
                </div>
              </div>
               
               <div class="row">
                <div class="form-group col-md-12">
                    <h3 class="mb-5">Option 3:</h3>
                    <input type="text" name="opt3" id="opt3" value="<?php echo $row->opt3; ?>"  class="form-control input-lg" placeholder="Enter Option 3"/>
                </div>
              </div>
               
               <div class="row">
                <div class="form-group col-md-12">
                    <h3 class="mb-5">Option 4:</h3>
                    <input type="text" name="opt4" id="opt4" value="<?php echo $row->opt4; ?>"  class="form-control input-lg" placeholder="Enter Option 4"/>
                </div>
              </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                    <h3 class="mb-5">Mark:</h3>
                    <input type="text" name="mark" id="mark" value="<?php echo $row->mark; ?>"  class="form-control input-lg" placeholder="Enter Mark"/>  
                </div>
              </div>
               
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>"/>
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="<?php echo ($row->id) ? "Update" : "Add";?> Question"/>
                  </div>
                </div>
              </div>
              </div>
            </form>
          </div>
          <!-- Start Sidebar -->
          <aside class="col-md-3 sidebar right-sidebar">
            
          </aside>
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
<script type="">
function showOptions(id)
{
    if(id == 2)
    {
        $("#question_options").show();
    }
    else
    {
        $("#question_options").hide();
    }
}
</script>
<!-- End Js --> 
</body>
</html>