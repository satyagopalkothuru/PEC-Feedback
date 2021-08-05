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
    if(isset($_POST['name']) && isset($_POST['no']) && isset($_POST['branch']) && isset($_POST['topic']))
    {
        
        $name =  $_POST['name'];
        $topic = $_POST['topic'];
        $serialno =  $_POST['no'];
        $branch = $_POST['branch'];
        
        
        $sql = "INSERT INTO manage_interviewees  VALUES ('$serialno','$name','$branch','$topic')";
            
        if(mysqli_query($conn, $sql)){
            echo    '<script type="text/javascript">
                                        confirm("Added successfully");
                                    </script>';
            header("Location: /PEC Feedback/manage_interviewees.php");
 
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
        <title>Admin Manage Interviewees</title>
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
                <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin - Manage Interviewees</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        
        
        <form action="manage_interviewees.php" method="post">
            <div class="d-flex justify-content-center">
                <table>
                    <tr>
                        <td>Interviewee Serial Number : </td>
                        <td><input class="form-control" type="number" name="no" placeholder="Enter Serial Number" required></td>
                    </tr>
                    <tr>
                        <td>Interviewee Name : </td>
                        <td><input class="form-control" type="text" name="name" placeholder="Enter Name" required></td>
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
                        <td>Topic :</td>
                        <td><input class="form-control" type="text" name="topic" placeholder="Enter Topic" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn form-control btn-danger" id="submit" type="submit" value="Add Interviewee"></td>
                    </tr>
                </table>
            </div>
        </form>
        <br>
        <hr>
        <br>
        <h1>Available Interviewees Details</h1>
        <div class="d-flex justify-content-center">
            <table id="editable_table">
                <tr>
                    <th>Serial No.</th>
                    <th>Interviewee Name</th>
                    <th>Branch</th>
                    <th>Topic</th>
                </tr>
                        <?php
                            if($conn === false){
                                die("ERROR: Could not connect. " . mysqli_connect_error());
                            }
                            else
                            {
                                mysqli_select_db($conn,"feedback_app");
                                $result = mysqli_query($conn,"SELECT distinct * FROM manage_interviewees");
                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                    echo "<tr>";
                                    echo "<td>" . $row['serialno'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['branch'] . "</td>";
                                    echo "<td>" . $row['topic'] . "</td>";
                                    echo "<td><a href='action.php?interviewee=".$row['serialno']."'><img src='images/delete.svg' alt='delete'></a></td>";
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