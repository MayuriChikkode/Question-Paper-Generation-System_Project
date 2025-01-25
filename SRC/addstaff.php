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
else if($_SESSION['user_type']!=1)
{
    echo "<script>window.location='dashboard.php';</script>"; 
}

if($_POST)
{
    $msg = $helper->addStaff();
}

$row = array();

if($id)
{
    $row = $helper->getStaffInfo($id);
}
?>
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->

<script type="text/javascript">
function validate_form()
{
    var name        = document.getElementById("name").value;
    var mobile      = document.getElementById("mobile").value;
    var email       = document.getElementById("email").value;
    var user_type   = document.getElementById("user_type").value;
    var username    = document.getElementById("username").value;
    var password    = document.getElementById("password").value;
    
    var validchar = /^[A-Z a-z]+$/;
    const isWhitespace = /^(?=.*\s)/;
    const isContainsUppercase = /^(?=.*[A-Z])/;
    const isContainsLowercase = /^(?=.*[a-z])/;
    const isContainsNumber = /^(?=.*[0-9])/;
    const isContainsSymbol = /^(?=.*[~`!@#$%^&*()--+={}\[\]|\\:;"'<>,.?/_₹])/;
    const isValidLength = /^.{8,16}$/;
    
    if(name=='')
    {
        alert("Please Enter Name.");
        return false;
    }
    else if(!validchar.test(name))
    {
        alert("Name should not be numeric.");
        return false;
    }
    else if(mobile=='')
    {
        alert("Please Enter Mobile.");
        return false;
    }
    else if(checkInternationalPhone(mobile)==false)
    {
        alert("Please Enter a Valid Mobile Number");
		return false;
    }
    else if(email=='')
    {
        alert("Please Enter Email.");
        return false;
    }
    else if(validateEmail(email))
    {
        alert("Please Enter Valid Email Address.");
        return false;   
    }
    else if(user_type=='')
    {
        alert("Please Select User Type.");
        return false;
    }
    else if(username=='')
    {
        alert("Please Enter User Name.");
        return false;
    }
    else if(password=='')
    {
        alert("Please Enter Password");
        return false;
    }
    else if (isWhitespace.test(password)) 
    {
        alert("Password must not contain Whitespaces.");
        return false;
    }
    else if (!isContainsUppercase.test(password)) 
    {
        alert("Password must have at least one Uppercase Character.");
        return false;
    }
    else if (!isContainsLowercase.test(password)) 
    {
        alert("Password must have at least one Lowercase Character.");
        return false;
    }
    else if (!isContainsNumber.test(password)) 
    {
        alert("Password must contain at least one Digit.");
        return false;
    }
    else if (!isContainsSymbol.test(password)) 
    {
        alert("Password must contain at least one Special Symbol.");
        return false;
    }
    else if (!isValidLength.test(password)) 
    {
        alert("Password must be 8-16 Characters Long.");
        return false;
    }   
}

function validateEmail(email)
{
    var atpos  = email.indexOf("@");   // The indexOf() method returns the position of the first occurrence of a specified value in a string. // Default value of start is 0  
    //alert(atpos);
    var dotpos = email.lastIndexOf(".");  // The lastIndexOf() method returns the position of the last occurrence of a specified value in a string. // Default value of start is 0  
    //alert(dotpos);
    
    if((atpos<1) || (dotpos<(atpos+2)) || (dotpos+2>=email.length))  
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
    var bracket=3;
    strPhone=trim(strPhone);
    if(strPhone.indexOf("+")>1) return false;
    if(strPhone.indexOf("-")!=-1)bracket=bracket+1;
    if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false;
    var brchr=strPhone.indexOf("(");
    if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false;
    if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false;
    s=stripCharsInBag(strPhone,validWorldPhoneChars);
    return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
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
                <h1><?php echo ($row->id) ? "Update" : "Add";?> Staff</h1>
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
                <div class="row">
                 <div class="col-md-6">
                  <div class="row">
                    <div class="form-group col-md-12">
                        <h3 class="mb-5">Name:</h3>
                        <input type="text" name="name" id="name" class="form-control input-lg" placeholder="Enter Name" value="<?php echo $row->name; ?>" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <h3 class="mb-5">Mobile:</h3>
                        <input type="text" name="mobile" id="mobile" class="form-control input-lg" placeholder="Enter Mobile" value="<?php echo $row->mobile; ?>" maxlength="10" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <h3 class="mb-5">Email:</h3>
                        <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Enter Email" value="<?php echo $row->email; ?>" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <h3 class="mb-5">User Type:</h3>
                        <select name="user_type" id="user_type" class="form-control input-lg">
                            <option value="">Select</option>
        		            <option value="1" <?php echo ($row->user_type==1) ? 'selected="selected"' : ''; ?>>Admin</option>
                            <option value="2" <?php echo ($row->user_type==2) ? 'selected="selected"' : ''; ?>>Staff</option>
       		           </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <h3 class="mb-5">User Name:</h3>
                        <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Enter User Name" value="<?php echo $row->username; ?>" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <h3 class="mb-5">Password:</h3>
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Enter Password" value="<?php echo $row->password; ?>" />
                    </div>
                  </div>
                  
                  </div> 
              </div>  
                          
              <div class="row">
                <div class="form-group ">
                  <div class="col-md-12">
                    <input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>"/>
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="<?php echo ($row->id) ? "Update" : "Add";?> Staff"/>
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
  
  <?php
    require_once "footer.php";
  ?> 
  </div>
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