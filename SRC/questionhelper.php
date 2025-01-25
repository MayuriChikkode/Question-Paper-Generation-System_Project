<?php
error_reporting(0);
session_start();
require_once "inc/config.php";
require_once "inc/dbhelper.php";
 
class QuestionHelper
{
    
    function checkAdmin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db=new Database();
        $db->open();
        $sql    = "SELECT * FROM `admins` WHERE `username` ='".$username."' and `password`='".$password."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if($row)
        {
            $_SESSION['admin_id']   = $row->id;
            $_SESSION['name']       = $row->name;
            $_SESSION['user_type']  = $row->user_type;
            echo "<script>window.location='dashboard.php';</script>";
        }
        else
        {
            $_SESSION['admin_id']   = '';
            $_SESSION['name']       = '';
            
            return 'Login failed. Please enter valid login details.';
        }
    }
    
    function addStaff()
    {
        $db = new Database();
        $db->open();
        
        $msg = '';
        $class = '';
                    
        $id         = $_POST['id'];
        $name       = $_POST['name'];
        $mobile     = $_POST['mobile'];
        $email      = $_POST['email'];
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $user_type  = $_POST['user_type'];
        
        if($id)
        {
            $sql = "UPDATE `admins` SET `name`='".$name."', `mobile`='".$mobile."', `email` = '".$email."', `user_type` = '".$user_type."', `username` = '".$username."', `password` = '".$password."' WHERE `id`= '".$id."'";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Staff Updated.";
            }
            else
            {
                $msg = "Error Occured";
            }   
        }
        else
        {
            $sql    = "SELECT * FROM `admins` WHERE `username` ='".$username."'";
            $result = $db->query($sql);
            $row    = $db->fetchobject($result);
            
            if($row)
            {
                $msg = "User name already exists.";
            }
            else
            {
                $sql = "INSERT INTO `admins` (`id`, `name`, `mobile`, `email`, `user_type`, `username`, `password`) VALUES (NULL, '".$name."', '".$mobile."', '".$email."', '".$user_type."', '".$username."', '".$password."');";
                $result=$db->query($sql);
            
                if($result)
                {
                    $msg = "Staff Added.";
                }
                else
                {
                    $msg = "Error Occured";
                } 
            }
        }
            
        return $msg;
    }
    
    function staffs()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from admins ORDER BY id DESC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="10%">ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>User Name</th>
                <th>User Type</th>
                <th width="15%">Actions</th>
            </tr>
            <?php 
            $user_type_array = array('1'=>'Admin','2'=>'Staff');
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td width="10%"><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['mobile'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $user_type_array[$row['user_type']];?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="addstaff.php?id=<?php echo $row['id'];?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="staffs.php?task=delete_staff&id=<?php echo $row['id'];?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    
    function getStaffInfo($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from admins WHERE id = ".$id;
        $result = $db->query($sql);
        
        $row    = $db->fetchobject($result);
         
        return $row;
    }
    
    function deleteStaff($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "DELETE FROM admins WHERE id = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'Staff Deleted';
        }
        else
        {
            return 'Staff Not Deleted';
        }
    }
    
    function addSubject()
    {
        $db = new Database();
        $db->open();
        
        $msg = '';
        $class = '';
                    
        $id             = $_POST['id'];
        $subject_name   = $_POST['subject_name'];
        
        if($id)
        {
            $sql = "UPDATE `subjects` SET `subject_name`='".$subject_name."' WHERE `id`= '".$id."'";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Subject Updated.";
            }
            else
            {
                $msg = "Error Occured";
            }   
        }
        else
        {
            $sql = "INSERT INTO `subjects` (`id`, `subject_name`) VALUES (NULL, '".$subject_name."');";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Subject Added.";
            }
            else
            {
                $msg = "Error Occured";
            } 
        }
            
        return $msg;
    }
    
    function subjects()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from subjects ORDER BY id DESC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="10%">ID</th>
                <th>Subject Name</th>
                <th width="15%">Actions</th>
            </tr>
            <?php 
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td width="10%"><?php echo $row['id'];?></td>
                    <td><?php echo $row['subject_name'];?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="addsubject.php?id=<?php echo $row['id'];?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="subjects.php?task=delete_subject&id=<?php echo $row['id'];?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    
    function getSubjectSelect($id = 0)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from subjects ORDER BY id ASC";
        $result = $db->query($sql);
        
        while($row = $db->fetcharray($result))
        {
            $selected = '';
            if($id == $row['id'])
            {
                $selected = 'selected="selected"';
            }
            ?>
            <option value="<?php echo $row['id'];?>" <?php echo $selected;?>><?php echo $row['subject_name'];?></option>
            <?php
        }
        
    }
    
    function getSubjectInfo($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from subjects WHERE id = ".$id;
        $result = $db->query($sql);
        
        $row    = $db->fetchobject($result);
         
        return $row;
    }
    
    function deleteSubject($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "DELETE FROM subjects WHERE id = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'Subject Deleted';
        }
        else
        {
            return 'Subject Not Deleted';
        }
    }
        
    function addUnit()
    {
        $db = new Database();
        $db->open();
        
        $msg = '';
        $class = '';
                    
        $id          = $_POST['id'];
        $unit_name   = $_POST['unit_name'];
        
        if($id)
        {
            $sql = "UPDATE `units` SET `unit_name`='".$unit_name."' WHERE `id`= '".$id."'";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Unit Updated.";
            }
            else
            {
                $msg = "Error Occured";
            }   
        }
        else
        {
            $sql = "INSERT INTO `units` (`id`, `unit_name`) VALUES (NULL, '".$unit_name."');";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Unit Added.";
            }
            else
            {
                $msg = "Error Occured";
            } 
        }
            
        return $msg;
    }
    
    function units()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from units ORDER BY id DESC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="10%">ID</th>
                <th>Unit Name</th>
                <th width="15%">Actions</th>
            </tr>
            <?php 
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td width="10%"><?php echo $row['id'];?></td>
                    <td><?php echo $row['unit_name'];?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="addunit.php?id=<?php echo $row['id'];?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="units.php?task=delete_unit&id=<?php echo $row['id'];?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    
    
    function getUnitSelect($id = 0)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from units ORDER BY id ASC";
        $result = $db->query($sql);
        
        while($row = $db->fetcharray($result))
        {
            $selected = '';
            if($id == $row['id'])
            {
                $selected = 'selected="selected"';
            }
            ?>
            <option value="<?php echo $row['id'];?>" <?php echo $selected;?>><?php echo $row['unit_name'];?></option>
            <?php
        }
        
    }
    
    function getUnitInfo($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from units WHERE id = ".$id;
        $result = $db->query($sql);
        
        $row    = $db->fetchobject($result);
         
        return $row;
    }
    
    function deleteUnit($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "DELETE FROM units WHERE id = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'Unit Deleted';
        }
        else
        {
            return 'Unit Not Deleted';
        }
    }
    
    function addQuestion()
    {
        $db = new Database();
        $db->open();
        
        $msg = '';
        $class = '';
                    
        $id             = $_POST['id'];
        $subject_id     = $_POST['subject_id'];
        $unit_id        = $_POST['unit_id'];
        $question_type  = $_POST['question_type'];
        $question       = $_POST['question'];
        $opt1           = $_POST['opt1'];
        $opt2           = $_POST['opt2'];
        $opt3           = $_POST['opt3'];
        $opt4           = $_POST['opt4'];
        $mark           = $_POST['mark'];
        
        if($id)
        {
            $sql = "UPDATE `questions` SET `subject_id`='".$subject_id."', `unit_id`='".$unit_id."', `question_type` = '".$question_type."', `question` = '".$question."', `opt1` = '".$opt1."', `opt2` = '".$opt2."', `opt3` = '".$opt3."', `opt4` = '".$opt4."', `mark` = '".$mark."' WHERE `id`= '".$id."'";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Question Updated.";
            }
            else
            {
                $msg = "Error Occured";
            }   
        }
        else
        {
            $sql = "INSERT INTO `questions` (`id`, `subject_id`, `unit_id`, `question_type`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `mark`) VALUES (NULL, '".$subject_id."','".$unit_id."','".$question_type."','".$question."', '".$opt1."','".$opt2."','".$opt3."','".$opt4."', '".$mark."');";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Question Added.";
            }
            else
            {
                $msg = "Error Occured";
            } 
        }
            
        return $msg;
    }
    
    
    function questions()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT a.*, b.subject_name, c.unit_name from questions as a 
                  LEFT JOIN subjects as b ON a.subject_id = b.id
                  LEFT JOIN units as c ON a.unit_id = c.id 
                  ORDER BY a.id DESC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="10%">ID</th>
                <th>Subject Name</th>
                <th>Unit Name</th>
                <th>Question</th>
                <th>Mark</th>
                <th width="15%">Actions</th>
            </tr>
            <?php 
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td width="10%"><?php echo $row['id'];?></td>
                    <td><?php echo $row['subject_name'];?></td>
                    <td><?php echo $row['unit_name'];?></td>
                    <td><?php echo $row['question'];?></td>
                    <td><?php echo $row['mark'];?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="addquestion.php?id=<?php echo $row['id'];?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="questions.php?task=delete_question&id=<?php echo $row['id'];?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    
    function getQuestionInfo($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select * from questions WHERE id = ".$id;
        $result = $db->query($sql);
        
        $row    = $db->fetchobject($result);
         
        return $row;
    }
    
    function deleteQuestion($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "DELETE FROM questions WHERE id = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'Question Deleted';
        }
        else
        {
            return 'Question Not Deleted';
        }
    }
    
    
    
    function addQuestionPaper()
    {
        $db = new Database();
        $db->open();
        
        $msg = '';
        $class = '';
                    
        $id         = $_POST['id'];
        $title      = $_POST['title'];
        $subject_id = $_POST['subject_id'];
        $total_time = $_POST['total_time'];
        $total_marks= $_POST['total_marks'];
        $group_1    = $_POST['group_1'];
        $group_2    = $_POST['group_2'];
        $group_3    = $_POST['group_3'];
        $group_4    = $_POST['group_4'];
        
        if($id)
        {
            $sql = "UPDATE `questionpapers` SET `title`='".$title."', `subject_id` = '".$subject_id."', `total_time` = '".$total_time."', `total_marks` = '".$total_marks."', 
                    `group_1`='".$group_1."', `group_2` = '".$group_2."', `group_3` = '".$group_3."', `group_4` = '".$group_4."'
                    WHERE `id`= '".$id."'";
            $result=$db->query($sql);
        
            if($result)
            {
                $msg = "Question Paper Updated.";
                echo "<script>window.location='addquestionpaper.php?id=".$id."';</script>";
            }
            else
            {
                $msg = "Error Occured";
            }   
        }
        else
        {
            $sql = "INSERT INTO `questionpapers` (`id`, `title`, `subject_id`, `total_time`, `total_marks`, `group_1`, `group_2`, `group_3`, `group_4`) VALUES (NULL, '".$title."', '".$subject_id."', '".$total_time."', '".$total_marks."','".$group_1."','".$group_2."','".$group_3."','".$group_4."');";
            $result=$db->query($sql);
        
            if($result)
            {
                $id = $db->lastinsered();
                $msg = "Question Paper Added.";
                echo "<script>window.location='addquestionpaper.php?id=".$id."';</script>";
            }
            else
            {
                $msg = "Error Occured";
            } 
        }
            
        return $msg;
    }
    
    function add_question_to_paper()
    {
        $db = new Database();
        $db->open();
        
        $question_paper_id = $_GET['question_paper_id'];
        $question_id       = $_GET['question_id'];
        $group_id          = $_GET['group_id'];
        
        $sql = "INSERT INTO `paper_questions` (`id`, `question_paper_id`, `question_id`, `group_id`) VALUES (NULL, '".$question_paper_id."', '".$question_id."', '".$group_id."');";
        $result=$db->query($sql);
    
        if($result)
        {
            $id = $db->lastinsered();
            $msg = "Question Added To Paper.";
            echo "<script>window.location='addquestionpaper.php?id=".$question_paper_id."&msg2=".$msg."';</script>";
        }
        else
        {
            $msg = "Error Occured";
            echo "<script>window.location='addquestionpaper.php?id=".$question_paper_id."&msg2=".$msg."';</script>";
        } 
    }
    
    function getQuestionPaperInfo($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "select a.*, b.subject_name from questionpapers as a 
                   LEFT JOIN subjects as b ON a.subject_id = b.id 
                   WHERE a.id = ".$id;
        $result = $db->query($sql);
        
        $row    = $db->fetchobject($result);
         
        return $row;
    }
    
    function getPaperQuestions($question_paper_id, $group_id = 0)
    {
        $db = new Database();
        $db->open();
        
        $extraSql = '';
        
        if($group_id)
        {
            $extraSql .= ' AND a.group_id = '.$group_id;
        }
        
        $sql    = "SELECT a.*,b.question, b.question_type, b.opt1, b.opt2, b.opt3, b.opt4, b.mark, c.unit_name from paper_questions as a
                   LEFT JOIN questions as b ON a.question_id = b.id   
                   LEFT JOIN units as c ON b.unit_id = c.id
                   WHERE a.question_paper_id = ".$question_paper_id." ".$extraSql;
        $result = $db->query($sql);
        
        $rows   = array();
        while($row = $db->fetcharray($result))
        {
            $rows[] = $row;
        }
         
        return $rows;
    }
    
    function remove_question_from_paper($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "DELETE FROM paper_questions WHERE id = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'Question Deleted';
        }
        else
        {
            return 'Question Not Deleted';
        }
    }
    
    function questionpapers()
    {
        $db = new Database();
        $db->open();
        
        $sql    = "SELECT a.*, b.subject_name from questionpapers as a 
                  LEFT JOIN subjects as b ON a.subject_id = b.id
                  ORDER BY a.id DESC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="6%">ID</th>
                <th width="18%">Subject Name</th>
                <th>Question Paper Title</th>
                <th width="10%">Total Time</th>
                <th width="8%">Total Marks</th>
                <th width="18%">Actions</th>
            </tr>
            <?php 
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['subject_name'];?></td>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['total_time'];?></td>
                    <td><?php echo $row['total_marks'];?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="addquestionpaper.php?id=<?php echo $row['id'];?>">Edit</a>
                        <a class="btn btn-sm btn-success" href="printquestionpaper.php?id=<?php echo $row['id'];?>" target="_blank">Print</a>
                        <a class="btn btn-sm btn-danger" href="questionpapers.php?task=delete_questionpaper&id=<?php echo $row['id'];?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    
    function deleteQuestionPaper($id)
    {
        $db = new Database();
        $db->open();
        
        $sql    = "DELETE FROM questionpapers WHERE id = ".$id;
        $result = $db->query($sql);
        
        $sql    = "DELETE FROM paper_questions WHERE question_paper_id = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'Question Paper Deleted';
        }
        else
        {
            return 'Question Paper Not Deleted';
        }
    }
    
    function auto_question_paper()
    {
        $db = new Database();
        $db->open();
        
        $msg = '';
        $class = '';
                    
        $id         = $_POST['id'];
        $title      = $_POST['title'];
        $subject_id = $_POST['subject_id'];
        $total_time = $_POST['total_time'];
        $total_marks= $_POST['total_marks'];
        $group_1    = $_POST['group_1'];
        $group_2    = $_POST['group_2'];
        $group_3    = $_POST['group_3'];
        $group_4    = $_POST['group_4'];
        
        $sql = "INSERT INTO `questionpapers` (`id`, `title`, `subject_id`, `total_time`, `total_marks`, `group_1`, `group_2`, `group_3`, `group_4`) 
                VALUES (NULL, '".$title."', '".$subject_id."', '".$total_time."', '".$total_marks."','".$group_1."','".$group_2."','".$group_3."','".$group_4."');";
        $result=$db->query($sql);
    
        if($result)
        {
            $id = $db->lastinsered();
            
            $group_1_marks      = $_POST['group_1_marks'];
            $group_1_questions  = $_POST['group_1_questions'];
            
            $question_ids = array();
            if($group_1_marks!='' && $group_1_questions!='')
            {
                $sql   = "SELECT * FROM `questions` WHERE `mark` = ".$group_1_marks." ORDER BY RAND() LIMIT ".$group_1_questions;
                $result=$db->query($sql);
                while($row = $db->fetcharray($result))
                {
                    $sql = "INSERT INTO `paper_questions` (`id`, `question_paper_id`, `question_id`, `group_id`) 
                            VALUES (NULL, '".$id."', '".$row['id']."', '1');";
                    $db->query($sql);
            
                    $question_ids[] = $row['id'];
                }
            }
            
            $group_2_marks      = $_POST['group_2_marks'];
            $group_2_questions  = $_POST['group_2_questions'];
            
            if($group_2_marks!='' && $group_2_questions!='')
            {
                if($question_ids)
                {
                    $extraSql = " AND `id` NOT IN (".implode(",", $question_ids).")";
                }
                
                $sql   = "SELECT * FROM `questions` WHERE `mark` = ".$group_2_marks." ".$extraSql." ORDER BY RAND() LIMIT ".$group_2_questions;
                $result=$db->query($sql);
                while($row = $db->fetcharray($result))
                {
                    $sql = "INSERT INTO `paper_questions` (`id`, `question_paper_id`, `question_id`, `group_id`) 
                            VALUES (NULL, '".$id."', '".$row['id']."', '2');";
                    $db->query($sql);
            
                    $question_ids[] = $row['id'];
                }
            }
            
            $group_3_marks      = $_POST['group_3_marks'];
            $group_3_questions  = $_POST['group_3_questions'];
            
            if($group_3_marks!='' && $group_3_questions!='')
            {
                if($question_ids)
                {
                    $extraSql = " AND `id` NOT IN (".implode(",", $question_ids).")";
                }
                
                $sql   = "SELECT * FROM `questions` WHERE `mark` = ".$group_3_marks." ".$extraSql." ORDER BY RAND() LIMIT ".$group_3_questions;
                $result=$db->query($sql);
                while($row = $db->fetcharray($result))
                {
                    $sql = "INSERT INTO `paper_questions` (`id`, `question_paper_id`, `question_id`, `group_id`) 
                            VALUES (NULL, '".$id."', '".$row['id']."', '3');";
                    $db->query($sql);
            
                    $question_ids[] = $row['id'];
                }
            }
            
            $group_4_marks      = $_POST['group_4_marks'];
            $group_4_questions  = $_POST['group_4_questions'];
            
            if($group_4_marks!='' && $group_4_questions!='')
            {
                if($question_ids)
                {
                    $extraSql = " AND `id` NOT IN (".implode(",", $question_ids).")";
                }
                
                $sql   = "SELECT * FROM `questions` WHERE `mark` = ".$group_4_marks." ".$extraSql." ORDER BY RAND() LIMIT ".$group_4_questions;
                $result=$db->query($sql);
                while($row = $db->fetcharray($result))
                {
                    $sql = "INSERT INTO `paper_questions` (`id`, `question_paper_id`, `question_id`, `group_id`) 
                            VALUES (NULL, '".$id."', '".$row['id']."', '4');";
                    $db->query($sql);
            
                    $question_ids[] = $row['id'];
                }
            }
            
            $msg = "Question Paper Added.";
            echo "<script>window.location='addquestionpaper.php?id=".$id."';</script>";
        }
        else
        {
            $msg = "Error Occured";
        } 
          
        return $msg;
    }
    
}
?>