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
    
  // Taking faculty details from the form data
    if(isset($_POST['year']) && $_POST['year']!=0)
    {
        
        $faculty_name =  $_POST['faculty_name'];
        $subject = $_POST['subject'];
        $year =  $_POST['year'];
        $branch = $_POST['branch'];
        $faculty_id =  strval($_POST['year']).strval($_POST['branch']).strval($_POST['subject']);
        
        $sql = "INSERT INTO faculty_table  VALUES ('$faculty_id','$faculty_name','$year','$branch','$subject')";
            
        if(mysqli_query($conn, $sql)){
            echo    '<script type="text/javascript">
                                        confirm("Added successfully");
                                    </script>';
            header("Location: /PEC Feedback/manage_staff.php");
 
        } 
        else
        {
            echo "ERROR: Sorry $sql. ". mysqli_error($conn);
        }
        
    }
?>
  

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Manage Staff</title>
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
                <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin - Manage Staff</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        
        
        <form action="manage_staff.php" method="post">
            <div class="d-flex justify-content-center">
                <table>
                    <tr>
                        <td>Staff Name : </td>
                        <td><input class="form-control" type="text" name="faculty_name" placeholder="Enter Name" required></td>
                    </tr>
                    
                    <tr>
                        <td>Year : </td>
                        <td>
                        <select class="form-select" name="year" required>
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
                        <select class="form-select" name="branch" required>
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
                        <td>Subject :</td>
                        <td>
                            <select class="form-select" name="subject" required>
                                <option value="0" disabled selected>SELECT SUBJECT</option>
                                <?php
                                    if($conn === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }
                                    else
                                    {
                                        mysqli_select_db($conn,"feedback_app");
                                        $sub_s = mysqli_query($conn,"SELECT * FROM subjects_table");
                                        while($rec = mysqli_fetch_array($sub_s,MYSQLI_ASSOC))
                                        {
                                            echo "<option value='".$rec['subject']."'>".$rec['subject']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn form-control btn-danger" id="submit" type="submit" value="Add Staff"></td>
                    </tr>
                </table>
            </div>
        </form>
        <br>
        <hr>
        <br>
        <h1>Available Faculty Details</h1>
        <div class="d-flex justify-content-center">
            <table id="editable_table">
                <tr>
                    <th>Faculty Name</th>
                    <th>Year</th>
                    <th>Branch</th>
                    <th>Subject</th>
                </tr>
                        <?php
                            if($conn === false){
                                die("ERROR: Could not connect. " . mysqli_connect_error());
                            }
                            else
                            {
                                mysqli_select_db($conn,"feedback_app");
                                $result = mysqli_query($conn,"SELECT distinct * FROM faculty_table order by year,branch");
                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                    echo "<tr>";
                                    echo "<td>" . $row['faculty_name'] . "</td>";
                                    echo "<td>" . $row['year'] . "</td>";
                                    echo "<td>" . $row['branch'] . "</td>";
                                    echo "<td>" . str_replace("_"," ",$row['subject']) . "</td>";
                                    echo "<td><a href='action.php?instance=".$row['facultyid']."'><img src='images/delete.svg' alt='delete'></a></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
            </table>
        </div>
    </body>
</html>
<?php
// Close connection
    mysqli_close($conn);
?>