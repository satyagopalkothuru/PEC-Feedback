<?php
    session_start();    
    if(isset($_SESSION['admin_id'])==False)
    {
        header("Location: /PEC Feedback/admin_login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/feedback.css">
        <link rel="shortcut icon" type="image/jpg" href="images/pec_fav.jpg"/>
    </head>
    <body>
        <header>
            <div class="d-flex justify-content-center shadow-sm h-md-250">
                <img src="images/logo.png" alt="PEC logo">
                <img src="images/naac-logo.png" alt="Naac">
            </div>
        </header>
        
        <br>
        <nav class="navbar">
            <div class="container-fluid">
                <button class="btn btn-danger" disabled><img src="images/home.svg"/> &nbsp Home</button>
                <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin Home</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        
        <div class="d-flex row content">
				<div class="d-flex justify-content-center">
					<div class="button-wrapper btn-fill-space">
						<a class="btn btn-lg btn-danger" href="select_launch_servey.php">Launch Survey</a>
						<a class="btn btn-lg btn-danger" href="check_feedback.php">Check Feedback</a>
						<a class="btn btn-lg btn-danger" href="check_faculty_feedback.php">Check Facultywise Feedback</a>
					</div>
				</div>
                <div class="d-flex justify-content-center">
					<div class="button-wrapper btn-fill-space">
						<a class="btn btn-lg btn-danger" href="manage_staff.php">Manage Staff</a>
						<a class="btn btn-lg btn-danger" href="manage_subjects.php">Manage Subject</a>
						<a class="btn btn-lg btn-danger" href="change_questions.php">Change Question</a>
						<a class="btn btn-lg btn-danger" href="change_password.php">Change Password</a>
					</div>
				</div>
                
                <hr>
                <br>
                <div class="d-flex justify-content-center">
					<div class="button-wrapper btn-fill-space">
						<a class="btn btn-lg btn-danger" href="manage_interviewees.php">Manage Interviewees</a>
						<a class="btn btn-lg btn-danger" href="demo_question.php">Select Demo Questions</a>
						<a class="btn btn-lg btn-danger" href="check_demo_feedback.php">Check Demo Feedback</a>
					</div>
				</div>
                <div class="d-flex justify-content-center">
					<div class="button-wrapper btn-fill-space">
						<a class="btn btn-lg btn-danger" href="delete_feedback.php">Delete Whole Feedback</a>
					</div>
				</div>
			</div>
            <hr>
            <p class="d-flex justify-content-center"><a href="madeby.html">Designed By...</a></p>
    </body>
</html>