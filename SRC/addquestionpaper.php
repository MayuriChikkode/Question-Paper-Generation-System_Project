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

if($_POST)
{
    if($task == 'add_question_paper')
    {
        $msg = $helper->addQuestionPaper();
    }
}

if($task == 'add_question_to_paper')
{
    $msg = $helper->add_question_to_paper();
}

if($task == 'remove_question_from_paper')
{
    $row_id = $_REQUEST['row_id'];
    $msg = $helper->remove_question_from_paper($row_id);
}

$row = array();

if($id)
{
    $row = $helper->getQuestionPaperInfo($id);
    $paper_questions = $helper->getPaperQuestions($id);
    
    $exclude_questions = array();
    if($paper_questions)
    {
        foreach($paper_questions as $paper_question)
        {
            $exclude_questions[] = $paper_question['question_id'];
        } 
    }
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
                <h1><?php echo ($row->id) ? "Update" : "Add";?> Question Paper</h1>
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
                            <h3 class="mb-5">Group 2 Title:</h3>
                            <input type="text" name="group_2" id="group_2" value="<?php echo $row->group_2; ?>"  class="form-control input-lg" placeholder="Enter Group 2 Title"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 3 Title:</h3>
                            <input type="text" name="group_3" id="group_3" value="<?php echo $row->group_3; ?>"  class="form-control input-lg" placeholder="Enter Group 3 Title"/>
                        </div>
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Group 4 Title:</h3>
                            <input type="text" name="group_4" id="group_4" value="<?php echo $row->group_4; ?>"  class="form-control input-lg" placeholder="Enter Group 4 Title"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">  
                            <input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>"/>
                            <input type="hidden" id="task" name="task" value="add_question_paper" />
                            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="<?php echo ($row->id) ? "Update" : "Add";?> Question Paper"/>
                        </div>
                    </div>
                </div>
            </form>
            
            <?php
            if($row->id && $row->subject_id)
            {
                $extraSql = '';
                if($exclude_questions)
                {
                    $extraSql .= " AND a.id NOT IN (".implode(",", $exclude_questions).")";
                }
                
                if($_REQUEST['unit_id']!='')
                {
                    $extraSql .= " AND a.unit_id = ".$_REQUEST['unit_id'];
                }
                
                $sql2    = "SELECT a.*, b.subject_name, c.unit_name from questions as a 
                          LEFT JOIN subjects as b ON a.subject_id = b.id
                          LEFT JOIN units as c ON a.unit_id = c.id 
                          WHERE a.subject_id = ".$row->subject_id." ".$extraSql."
                          ORDER BY a.id DESC";
                $result2 = $db->query($sql2);
                ?>
                <div class="col-md-12">
                <form action="addquestionpaper.php?id=<?php echo $row->id;?>" method="POST">
                    
                    <div class="row">
                        <div class="form-group col-md-4">  
                            <h3 class="mb-5">Unit:</h3>
                            <select id="unit_id" name="unit_id" class="form-control input-lg">
                                <option value="">Select</option>
                                <?php
                                $helper->getUnitSelect($_REQUEST['unit_id']);
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <h3 class="mb-5">&nbsp;</h3>
                            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Search"/>
                        </div>
                    </div>
                    
                </form>
                <table class="table table-bordered">
                    <tr>
                        <th width="7%">ID</th>
                        <th width="15%">Unit Name</th>
                        <th>Question</th>
                        <th class="text-center" width="7%">Mark</th>
                        <th width="12%">Actions</th>
                    </tr>
                    <?php
                    $count = 0;
                    while($row2 = $db->fetcharray($result2))
                    {
                        ?>
                        <tr>
                            <td><?php echo $row2['id'];?></td>
                            <td><?php echo $row2['unit_name'];?></td>
                            <td><?php echo $row2['question'];?></td>
                            <td class="text-center"><?php echo $row2['mark'];?></td>
                            <td>
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Add to Paper
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="addquestionpaper.php?question_id=<?php echo $row2['id'];?>&group_id=1&question_paper_id=<?php echo $row->id; ?>&task=add_question_to_paper">Group 1</a></li>
                                    <li><a href="addquestionpaper.php?question_id=<?php echo $row2['id'];?>&group_id=2&question_paper_id=<?php echo $row->id; ?>&task=add_question_to_paper">Group 2</a></li>
                                    <li><a href="addquestionpaper.php?question_id=<?php echo $row2['id'];?>&group_id=3&question_paper_id=<?php echo $row->id; ?>&task=add_question_to_paper">Group 3</a></li>
                                    <li><a href="addquestionpaper.php?question_id=<?php echo $row2['id'];?>&group_id=4&question_paper_id=<?php echo $row->id; ?>&task=add_question_to_paper">Group 4</a></li>
                                  </ul>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $count++;
                    }
                    
                    if($count==0)
                    {
                        ?>
                        <tr>
                            <td class="text-center" colspan="5">No Questions</td>
                        </tr>
                        <?php
                    }
                ?>
                </table>
                </div>
                <?php
            }
            
            
            if($paper_questions)
            {
                ?>
                <div class="col-md-12">
                <h3>Question Added To Paper</h3>
                <table class="table table-bordered">
                    <tr>
                        <th width="7%">No.</th>
                        <th width="15%">Unit</th>
                        <th width="10%">Group</th>
                        <th>Question</th>
                        <th class="text-center" width="7%">Mark</th>
                        <th width="12%">Actions</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach($paper_questions as $paper_question)
                    {
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $paper_question['unit_name'];?></td>
                            <td>Group <?php echo $paper_question['group_id'];?></td>
                            <td><?php echo $paper_question['question'];?></td>
                            <td class="text-center"><?php echo $paper_question['mark'];?></td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="addquestionpaper.php?id=<?php echo $row->id; ?>&task=remove_question_from_paper&row_id=<?php echo $paper_question['id']; ?>">Remove</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
                
                <a class="btn btn-primary btn-lg" href="printquestionpaper.php?id=<?php echo $row->id; ?>" target="_blank">Print Question Paper</a>
                               
                </div>
                <?php
            }
            ?>
            
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