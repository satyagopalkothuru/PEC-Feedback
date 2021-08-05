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
    if($conn === false)
    {
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }
    if(isset($_POST['pswd']))
    {
        $pswd =  $_POST['pswd'];
        
        $query="SELECT * FROM admin where admin_id='".$_SESSION['admin_id']."' and password='".$pswd."'";

        $sql=mysqli_query($conn,$query);  
        $numrows=mysqli_num_rows($sql); 

        if($numrows==1){
            
                $query1 = "TRUNCATE TABLE feedback_table where branch like '".$_SESSION['branch']."%';";
                mysqli_query($conn, $query1);
                $query2 = "TRUNCATE TABLE comments_table where branch like '".$_SESSION['branch']."%';";
                mysqli_query($conn, $query2);
                echo "<script>alert('Deleted Successfully');</script>";
            
        } 
        else
        {
            echo "<script>alert('Enter valid login details');</script>";
        }
    }
  
?>



<!DOCTYPE html>

<html>
    <head>
        <title>PEC Delete Feedback</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/feedback.css">
        <link rel="shortcut icon" type="image/jpg" href="images/pec_fav.jpg"/>
        <script>
            var r = confirm("Note: This action can delete entire feedback given till now");
            if (r == false) {
                location.href = 'admin_home.php';
            }
        </script>
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
            <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin is Deleting Feedback</h1>
            <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
        </div>
    </nav>
    <br>
    <form method="POST">
        <br>
        
        <h1>*** Note: This action can delete entire feedback given till now. ***</h1>
        <br>
            <div class="d-flex justify-content-center">
                
                <table>
                    <tr>    
                        <td><label for="pwd" class="form-label">Confirm Password : </label></td>
                        <td><input id="pwd" class="form-control" type="password" placeholder="Enter Password" name="pswd" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn btn-danger" type="submit" id="submit" value="Delete Feedback"></td>
                    </tr>
                </table>
            </div>
            <br>
        </form>
    </body>
</html>

<?php
    if(isset($_SESSION['admin_id']))
    {
        $abc=$_SESSION['admin_id'];
        $dateandtime=date("Y-m-d h:i:sa");
        $q="INSERT INTO deleted_table  VALUES ('$abc','$dateandtime')";
        $s=mysqli_query($conn,$q);
    }
       
    mysqli_close($conn);
?>