<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<title>Print Question Paper</title>
    <style>
    body {font: 14px/1.4 Times New Roman,Arial,sans-serif;}
    .page-wrap{width: 790px;margin: 0 auto;}
    .text-center{text-align: center;}
    h2{font-size: 24px;margin: 0;}
    h3{font-size: 20px;margin: 0;}
    h4{font-size: 18px;margin: 0;}
    h5{font-size: 16px;margin: 0;}
    td,th{vertical-align: top;}
    p, ul li{margin: 0;font-size: 15px;}
    ul{margin-top: 5px;margin-bottom: 5px;padding-left: 0px;}
    </style>
    <?php
    require_once "questionhelper.php";
    $helper = new QuestionHelper();
    
    if(!$_SESSION['admin_id'])
    {
       echo "<script>window.location='login.php';</script>"; 
    }
    
    $db = new Database();
    $db->open();
    
    $id   = $_REQUEST['id'];
    
    if($id)
    {
        $row = $helper->getQuestionPaperInfo($id);
    }
    $sr = 1;
    ?>              
</head>
<body>
    <div class="page-wrap">
        <table class="" width="100%">
            <tr>
                <td colspan="3">
                    <h1 class="text-center">KLE society’s College of Computer Application</h1>
                    <h2 class="text-center">Exam : <?php echo $row->title; ?></h2>
                    <h3 class="text-center">Subject : <?php echo $row->subject_name; ?></h3>
                    <h4 class="text-center">Total Time: <?php echo $row->total_time; ?> Total Marks: <?php echo $row->total_marks; ?></h4>
                </td>
            </tr>
            <?php 
            $group_1_questions = $helper->getPaperQuestions($id, 1);
            if($row->group_1!='' && $group_1_questions)
            {
                ?>
                <tr>
                    <td colspan="3">
                        <h5><?php echo $row->group_1; ?></h5>
                    </td>
                </tr>
                <?php
                foreach($group_1_questions as $group_1_question)
                {
                    ?>
                    <tr>
                        <td width="3%"><?php echo $sr; ?></td>
                        <td>
                            <p><?php echo $group_1_question['question'];?></p>
                            <?php
                            if($group_1_question['question_type']==2)
                            {
                                ?>
                                <ul type="none">
                                    <li>&#9744; <?php echo $group_1_question['opt1']; ?></li>
                                    <li>&#9744; <?php echo $group_1_question['opt2']; ?></li>
                                    <li>&#9744; <?php echo $group_1_question['opt3']; ?></li>
                                    <li>&#9744; <?php echo $group_1_question['opt4']; ?></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </td>
                        <td width="3%"><?php echo $group_1_question['mark'];?></td>
                    </tr>
                    <?php
                    $sr++;
                }
            }
            
            $group_2_questions = $helper->getPaperQuestions($id, 2);
            if($row->group_2!='' && $group_2_questions)
            {
                ?>
                <tr>
                    <td colspan="3">
                        <h5><?php echo $row->group_2; ?></h5>
                    </td>
                </tr>
                <?php
                foreach($group_2_questions as $group_2_question)
                {
                    ?>
                    <tr>
                        <td width="3%"><?php echo $sr; ?></td>
                        <td>
                            <p><?php echo $group_2_question['question'];?></p>
                            <?php
                            if($group_2_question['question_type']==2)
                            {
                                ?>
                                <ul type="none">
                                    <li>&#9744; <?php echo $group_2_question['opt1']; ?></li>
                                    <li>&#9744; <?php echo $group_2_question['opt2']; ?></li>
                                    <li>&#9744; <?php echo $group_2_question['opt3']; ?></li>
                                    <li>&#9744; <?php echo $group_2_question['opt4']; ?></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </td>
                        <td width="3%"><?php echo $group_2_question['mark'];?></td>
                    </tr>
                    <?php
                    $sr++;
                }
            }
            ?>
            <?php 
            $group_3_questions = $helper->getPaperQuestions($id, 3);
            if($row->group_3!='' && $group_3_questions)
            {
                ?>
                <tr>
                    <td colspan="3">
                        <h5><?php echo $row->group_3; ?></h5>
                    </td>
                </tr>
                <?php
                foreach($group_3_questions as $group_3_question)
                {
                    ?>
                    <tr>
                        <td width="3%"><?php echo $sr; ?></td>
                        <td>
                            <p><?php echo $group_3_question['question'];?></p>
                            <?php
                            if($group_3_question['question_type']==2)
                            {
                                ?>
                                <ul type="none">
                                    <li>&#9744; <?php echo $group_3_question['opt1']; ?></li>
                                    <li>&#9744; <?php echo $group_3_question['opt2']; ?></li>
                                    <li>&#9744; <?php echo $group_3_question['opt3']; ?></li>
                                    <li>&#9744; <?php echo $group_3_question['opt4']; ?></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </td>
                        <td width="3%"><?php echo $group_3_question['mark'];?></td>
                    </tr>
                    <?php
                    $sr++;
                }
            }
            ?>
            <?php 
            $group_4_questions = $helper->getPaperQuestions($id, 4);
            if($row->group_4!='' && $group_4_questions)
            {
                ?>
                <tr>
                    <td colspan="3">
                        <h5><?php echo $row->group_4; ?></h5>
                    </td>
                </tr>
                <?php
                foreach($group_4_questions as $group_4_question)
                {
                    ?>
                    <tr>
                        <td width="3%"><?php echo $sr; ?></td>
                        <td>
                            <p><?php echo $group_4_question['question'];?></p>
                            <?php
                            if($group_4_question['question_type']==2)
                            {
                                ?>
                                <ul type="none">
                                    <li>&#9744; <?php echo $group_4_question['opt1']; ?></li>
                                    <li>&#9744; <?php echo $group_4_question['opt2']; ?></li>
                                    <li>&#9744; <?php echo $group_4_question['opt3']; ?></li>
                                    <li>&#9744; <?php echo $group_4_question['opt4']; ?></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </td>
                        <td width="3%"><?php echo $group_4_question['mark'];?></td>
                    </tr>
                    <?php
                    $sr++;
                }
            }
            ?>
        </table>
    </div>
</body>
</html>