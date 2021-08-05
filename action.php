<?php
session_start();
    if(!isset($_SESSION['admin_id']))
    {
        header("Location: /PEC Feedback/admin_login.php");
    }
 
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "feedback_app";

    $connect = mysqli_connect($servername,$username,$password,$dbname);
    
    if(isset($_GET['instance']))
    {
        $query = "DELETE FROM faculty_table where facultyid = '".$_GET['instance']."' ";
        mysqli_query($connect, $query);
        header("Location: /PEC Feedback/manage_staff.php");

    }
    if(isset($_GET['year']) && isset($_GET['branch']))
    {
        $query = "DELETE FROM servey where year = '".$_GET['year']."' and branch= '". $_GET['branch'] ."' ";
        mysqli_query($connect, $query);
        header("Location: /PEC Feedback/select_launch_servey.php");

    }
    if(isset($_GET['sid']))
    {
        $query = "DELETE FROM subjects_table where subject_id = '".$_GET['sid']."' ";
        mysqli_query($connect, $query);
        header("Location: /PEC Feedback/manage_subjects.php");

    }
    if(isset($_GET['qid']))
    {
        $query = "DELETE FROM questions_table where question_id = '".$_GET['qid']."' ";
        mysqli_query($connect, $query);
        header("Location: /PEC Feedback/change_questions.php");

    }
    if(isset($_GET['demoqid']))
    {
        $query = "DELETE FROM demo_questions where ques_id = '".$_GET['demoqid']."' ";
        mysqli_query($connect, $query);
        header("Location: /PEC Feedback/demo_question.php");

    }
    if(isset($_GET['demoselectedqid']))
    {
        $query = "UPDATE demo_questions SET isselected = '0' WHERE ques_id = '".$_GET['demoselectedqid']."'";
        mysqli_query($connect, $query);
        header("Location: /PEC Feedback/demo_question.php");

    }
    if(isset($_GET['interviewee']))
    {
        $query = "DELETE FROM manage_interviewees where serialno = '".$_GET['interviewee']."' ";
        mysqli_query($connect, $query);
        header("Location: /PEC Feedback/manage_interviewees.php");

    }
    mysqli_close($connect);
?>
