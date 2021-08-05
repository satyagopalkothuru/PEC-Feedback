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

  if(isset($_POST['s_id']) && isset($_POST['sub']))
  {
      $sub_id =  $_POST['s_id'];
      
      $subjt = $_POST['sub'];
      $subjt=str_replace(' ', '_', $subjt);

      $sql = "INSERT INTO subjects_table  VALUES ('$sub_id','$subjt')";
          
      if(mysqli_query($conn, $sql)){
          echo    '<script type="text/javascript">
                                      confirm("Added successfully");
                                  </script>';
          header("Location: /PEC Feedback/manage_subjects.php");

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
      <title>Admin Manage Subjects</title>
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
                <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin - Manage Subjects</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
      <br>
      
      <form action="manage_subjects.php" method="post">
          <div class="d-flex justify-content-center">
              <table>
                    <tr>
                        <td>Subject ID : </td>
                        <td><input class="form-control" type="text" placeholder="Enter Subject ID" name="s_id" required></td>
                    </tr>
                    <tr>
                        <td>Subject :</td>
                        <td><input class="form-control" type="text" placeholder="Enter Subject" name="sub" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn btn-danger" id="submit" type="submit" value="Add subject"></td>
                    </tr>
              </table>
          </div>
      </form>
      <br>
      <hr>
      <br>
      <h1>Available Subject Details</h1>
      <div class="d-flex justify-content-center">
          <table>
              <tr>
                  <th>Subject ID</th>
                  <th>Subject</th>
              </tr>
                  <?php
                          if($conn === false){
                              die("ERROR: Could not connect. " . mysqli_connect_error());
                          }
                          else
                          {
                              mysqli_select_db($conn,"feedback_app");
                              $result = mysqli_query($conn,"SELECT * FROM subjects_table");
                              while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                              {
                                  echo "<tr>";
                                  echo "<td>" . $row['subject_id'] . "</td>";
                                  echo "<td>" . str_replace("_"," ",$row['subject']) . "</td>";
                                  echo "<td><a href='action.php?sid=".$row['subject_id']."'><img src='images/delete.svg' alt='delete'></a></td>";
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