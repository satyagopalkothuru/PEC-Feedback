<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "feedback_app";

$conn = mysqli_connect($servername,$username,$password,$dbname);
session_start();
if(!isset($_SESSION['admin_id']))
{
    header("Location: /PEC Feedback/admin_login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Launch Survey</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
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
                <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin - Launch Survey</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        
        <form action="launch_servey.php" method="GET">
            <div class="d-flex justify-content-center"> 
                <table>
                    <tr>
                        <td>Year : </td>
                        <td>
                            <select class="form-select" name="year">
                                <option value="0" disabled selected>SELECT YEAR</option>
                                <option value="1">First Year</option>
                                <option value="2">Second Year</option>
                                <option value="3">Third Year</option>
                                <option value="4">Fourth Year</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Branch : </td>
                        <td>
                            <select class="form-select" name="branch">
                                <option value="0" disabled selected>SELECT BRANCH</option>
                                <option value="CSE1">CSE-1</option>
                                <option value="CSE2">CSE-2</option>
                                <option value="ECE1">ECE-1</option>
                                <option value="ECE2">ECE-2</option>
                                <option value="IT">IT</option>
                                <option value="EEE">EEE</option>
                                <option value="MECH">MECH</option>
                                <option value="CIVIL">CIVIL</option>
                                <option value="CYBERSECURITY">CYBER SECURITY</option>
                                <option value="AI">AI</option>
                            </select>
                        </td>
                    </tr>
                
                    <tr>
                        <td colspan=2><input class="btn form-control" id="submit" type="submit" value="Launch"></td>
                    </tr>
                </table>
            </div>
        </form>
        <br>
        <h1>Survey Launched</h1>
        <div class="d-flex justify-content-center">
        <table>
            <tr>
                <th>Year</th>
                <th>Branch</th>
                <th>Launched Date And Time</th>
            </tr>
                <?php
                        if($conn === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        else
                        {
                            mysqli_select_db($conn,"feedback_app");
                            $result = mysqli_query($conn,"SELECT * FROM servey");
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {
                                echo "<tr>";
                                echo "<td>" . $row['year'] . "</td>";
                                echo "<td>" . $row['branch'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td><a href='action.php?year=".$row['year']."&branch=".$row['branch']."'><img src='images/delete.svg' alt='delete'></a></td>";
                                echo "</tr>";
                            }
                        }
                ?>
        </table>
        </div>
    </body>
</html>
