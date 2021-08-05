<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "feedback_app";

$conn = mysqli_connect($servername,$username,$password,$dbname);
session_start();
    if(isset($_GET['year']) && isset($_GET['branch']))
    {
        $year=$_GET['year'];
        $branch=$_GET['branch'];
        $d=date("Y-m-d h:i:sa");
        // $servey_res = mysqli_query($conn,"TRUNCATE TABLE servey");
        $servey_res = mysqli_query($conn,"INSERT INTO servey VALUES ('$year','$branch','$d')");
        if($servey_res)
        {
            echo "<script> alert(Survey Launched); </script>";
        }
        
    }
    header("Location: /PEC Feedback/select_launch_servey.php");

    mysqli_close($connect);
?>
