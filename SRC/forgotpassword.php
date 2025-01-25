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

if($_SESSION['admin_id'])
{
   echo "<script>window.location='dashboard.php';</script>"; 
}


$db = new Database();
$db->open();

$msg = '';
if($_POST)
{
    $username   = $_POST['username'];
    $sql        = "SELECT * FROM admins WHERE username = '".$username."'";
    $result     = $db->query($sql);
    $row        = $db->fetchobject($result);
    
    if(!$row)
    {
        $msg = "Please enter valid username";
    }
    else
    {
        $password = $row->password;
        $mobile   = $row->mobile;
        $sms = "Your password is ".$password;
        
        $ch = curl_init();
        $smsurl="http://sms.svmindlogic.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=44ecb723ff9d59ff22c4cfeb3f6252b&senderId=KSNPLS&message=".urlencode($sms)."&mobileNos=".$mobile."&smsContentType=english";
        curl_setopt($ch, CURLOPT_URL,$smsurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, '3');
        $content = trim(curl_exec($ch));
        curl_close($ch);
        
        $msg = "Password sent your registered mobile no.";
    }
}
?>
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->

<script type="text/javascript">
function validate_form()
{
    var username = document.getElementById("username").value;
    
    if(username=='')
    {
        alert("Please Enter User Name.");
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
                <h1>Forgot Password</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h2><strong>Forgot Password</strong></h2>
            <hr/>
            <?php
            if($msg!='')
            {
                ?>
                <div class="alert alert-error fade in"> 
                    <a href="#" data-dismiss="alert" class="close">&times;</a>
                    <?php echo $msg;?>
                </div>
                <?php
            }
            ?>
            
            
            <form name="adminlogin" id="adminlogin" action="" method="post" onsubmit="return validate_form();" >
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" placeholder="Username" class="form-control input-lg" name="username" id="username">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="submit" value="Forgot Password" class="btn btn-primary btn-lg" name="submit">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <p><a href="login.php">Login</a></p>
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