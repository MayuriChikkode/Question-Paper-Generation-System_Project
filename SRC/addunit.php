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

$msg = '';
$id  = $_REQUEST['id'];

if($_POST)
{
    $msg = $helper->addUnit();
}

$row = array();

if($id)
{
    $row = $helper->getUnitInfo($id);
}
?>
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->

<script type="text/javascript">
function validate_form()
{
    var unit_name = document.getElementById("unit_name").value;
    
    if(unit_name=='')
    {
        alert("Please Enter Unit Name.");
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
                <h1><?php echo ($row->id) ? "Update" : "Add";?> Unit</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-9" style="min-height: 300px;">
            <?php
            if($msg!='')
            {
                ?>
                <div class="alert alert-success fade in"> 
                    <a href="#" data-dismiss="alert" class="close">&times;</a>
                    <?php echo $msg;?>
                </div>
                <?php
            }
            ?>
                
            <form method="post" action="" onsubmit="return validate_form();">
             <div class="col-md-6">
             <div class="row">
                <div class="form-group">  
                    <div class="col-md-12"> 
                        <h3 class="mb-5">Unit Name:</h3>
                        <input type="text" name="unit_name" id="unit_name" value="<?php echo $row->unit_name; ?>" class="form-control input-lg" placeholder="Enter Unit Name"/>
                    </div>  
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                   <input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>"/>
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="<?php echo ($row->id) ? "Update" : "Add";?> Unit"/>
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
<!-- End Js --> 
</body>
</html>