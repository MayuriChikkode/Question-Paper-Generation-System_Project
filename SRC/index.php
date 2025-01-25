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

if($_POST)
{
    $msg = $helper->checkAdmin();
}
?>
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->

<script type="text/javascript">
function validate_form()
{
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    if(username=='')
    {
        alert("Please Enter User Name.");
        return false;
        
    }
    else if(password=='')
    {
        alert("Please Enter Password.");
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
  
    <div class="main" role="main">
    <div id="content" class="content full">
      <div class="rev-slider-container">
        <div class="tp-banner-container">
          <div class="tp-banner" >
            <ul>
              <!-- SLIDE  -->
              <li data-delay="4000" data-masterspeed="600" data-slotamount="7" data-transition="scaledownfromtop"> 
                <!-- MAIN IMAGE --> 
                <img src="images/slide-1.jpg" alt=""> 
                
              </li>
              
              <li data-delay="4000" data-masterspeed="600" data-slotamount="7" data-transition="scaledownfromtop"> 
                <!-- MAIN IMAGE --> 
                <img src="images/slide-2.jpg" alt=""> 
                
              </li>
              
              
            </ul>
          </div>
        </div>
      </div>

      
  
  <!-- Start Content -->
  <div class="main" role="main">
    <div id="content" class="content page-content full">
      <header class="page-header flexible parallax text-align-center parallax-overlay">
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h2 class="text-white">Welcome to KLE society’s College of Computer Application</h2>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>KLE society’s College of Computer Application, started in 2007 with goal to facilitate aspiring minds in the filled of computer science and technologies for the rural students. It’s the decennial celebration of the college as it completes 10 years of dedicated service to society by giving quality technical education to the students of all facets of society.</p>
            <p>Over the years, the College has evolved into one of the most proactive institutions for higher studies in north Karnataka. In its successful journey, the Institution has completed a decade in its services to aspirants of higher education and moving ahead with vigor. Our college has been playing a valuable role in its concern for students future, both in their career in life. The institution has umpteen numbers of case studies wherein average students have been inducted and raised to achieve distinctions. The emphasis is on development of Emotional Quotient along with Intelligent Quotient.</p>
            <p>Students in our campus will have the due freedom coupled with responsibility and discipline. Concern for communities is one of the forefront objectives in our students' grooming.</p>
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
<script src="plugins/rs-plugin/js/jquery.themepunch.plugins.min.js"></script> 
<script src="plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script> 
<script src="js/revolution-slider-init.js"></script> <!-- Revolutions Slider Intialization --> 
<!-- Preloader --> 
<script type="text/javascript">
	//<![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded
			$("#status").fadeOut(); // will first fade out the loading animation
			$("#preloader").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
		});
	//]]>
</script> 
<!-- End Js -->
<!-- End Js --> 
</body>
</html>