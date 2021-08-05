<?php
  
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "feedback_app";
    session_start();
    
    $conn = mysqli_connect($servername,$username,$password,$dbname);
        
    // Checking connection
    if($conn === false)
    {
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }
        
    
    if(isset($_POST['adminid']) && isset($_POST['pswd']) && $_POST['adminid']!='')
    {
        
        
        $adminid =  $_POST['adminid'];
        $pswd =  $_POST['pswd'];
        
        $query="SELECT * FROM admin where admin_id='".$adminid."' and password='".$pswd."'";

        $sql=mysqli_query($conn,$query);  
        $numrows=mysqli_num_rows($sql); 
        $admin_details = mysqli_fetch_array($sql,MYSQLI_ASSOC);
        if($numrows==1){
            $_SESSION['admin_id']=$_POST['adminid'];
            $_SESSION['branch']=$admin_details['branch'];
            echo $admin_details;
            echo "<script>alert('Logged in successfully.');</script>"; 
            header("Location: /PEC Feedback/admin_home.php");
        } 
        else
        {
            echo "<script>alert('Enter valid login details');</script>";
        }
    }
    mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
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
        <h1>Admin Login</h1>
        
        <form method="POST">
            <div class="d-flex justify-content-center">
                <table>
                    <tr>
                        <td><label for="admin_id" class="form-label">Admin ID :</label> </td>
                        <td><input type="text" id="admin_id" name="adminid" placeholder="Enter Your ID" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td><label for="pwd" class="form-label">Password : </label></td>
                        <td><input id="pwd" class="form-control" type="password" placeholder="Enter Password" name="pswd" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input  class="btn form-control" id="submit" type="submit" value="Login"></td>
                    </tr>
                </table>
            </div>
            <br>
        </form>
    </body>
</html>