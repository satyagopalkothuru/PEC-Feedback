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

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    
    // Checking connection
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    // Taking faculty details from the form data
    if(isset($_POST['adminid']) && $_POST['new_pswd']!='')
    {
        $admin_id =  $_POST['adminid'];
        $old_pwd =  $_POST['old_pwd'];
        $new_pwd = $_POST['new_pswd'];
        $confirm_pwd = $_POST['confirm_pswd'];
        if($new_pwd==$confirm_pwd)
        {
            $query="SELECT * FROM admin where admin_id='".$admin_id."' and password='".$old_pwd."'";
            $sql=mysqli_query($conn,$query);  
            $numrows=mysqli_num_rows($sql);
            if ($numrows==1)
            { 
                
                $sql = "UPDATE admin set password= '".$new_pwd."' where admin_id='".$admin_id."'";
                if(mysqli_query($conn, $sql)){
                    echo    '<script type="text/javascript">
                                alert("Updated successfully");
                            </script>';

                } 
                else
                {
                    echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
                }
            }
            else
            {
                echo    '<script type="text/javascript">
                            alert("Details not exists");
                        </script>';
            }
        }
        else
            {
                echo    '<script type="text/javascript">
                            alert("Confirm Password and New Password Must be same.");
                        </script>';
            }
    }
    else
            {
                echo    '<script type="text/javascript">
                            alert("Please fill all details.");
                        </script>';
            }
    
    mysqli_close($conn);
        
            ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Change Password</title>
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
                <a href="admin_home.php"><button class="btn btn-danger"><img src="images/home.svg"/> &nbsp Home</button></a>
                <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin - Change Password</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        
        <form method="POST">
            <div class="d-flex justify-content-center">
                <table>
                    <tr>
                        <td>Admin ID : </td>
                        <td><input class="form-control" type="text" name="adminid"></td>
                    </tr>
                    <tr>
                        <td>Old Password : </td>
                        <td><input class="form-control" type="password" name="old_pwd"></td>
                    </tr>
                    <tr>
                        <td>New Password : </td>
                        <td><input class="form-control" type="password" name="new_pswd"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password : </td>
                        <td><input class="form-control" type="password" name="confirm_pswd"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn form-control" id="submit" type="submit" value="Update"></td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>