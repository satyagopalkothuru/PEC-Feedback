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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Manage Question</title>
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
                <h1><?php echo strtoupper($_SESSION['branch']); ?> Admin - Manage Questions</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        
        <form action="change_questions.php" method="post">
            <?php
                
                // Checking connection
                if($conn === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                
                
                if(isset($_POST['question_id']) && $_POST['question_id']!=0)
                {
                    $question_id =  $_POST['question_id'];
                    $new_question =  $_POST['new_question'];
                    
                    $query="SELECT * FROM questions_table where question_id='".$question_id."' and question='".$new_question."'";
                    $sql=mysqli_query($conn,$query);  
                    $numrows=mysqli_num_rows($sql);
                    if ($numrows==0)
                    {
                        // Performing insert query 
                        $sql = "INSERT INTO questions_table  VALUES ('$question_id','$new_question')";
                        
                        if(mysqli_query($conn, $sql)){
                            echo    '<script type="text/javascript">
                                        alert("Added successfully");
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
                                        alert("Already exists in the Database.");
                                    </script>';
                        }
                }
                
            ?>
            <div class="d-flex justify-content-center">
                <table>
                    <tr>
                        <td>Question ID : </td>
                        <td><input class="form-control" type="number" placeholder="Enter Question ID" name="question_id"></td>
                    </tr>
                    <tr>
                        <td>New Question : </td>
                        <td><input class="form-control" type="text" placeholder="Enter Question" name="new_question"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn form-control" id="submit" type="submit" value="Add Question"></td>
                    </tr>
                </table>
            </div>
        </form>
       
        <hr>
        <br>
        <h1>Available Questions</h1>
        <div class="d-flex justify-content-center">
        <table>
            <tr>
                <th>Question ID</th>
                <th>Question</th>
            </tr>
                <?php
                        if($conn === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        else
                        {
                            mysqli_select_db($conn,"feedback_app");
                            $result = mysqli_query($conn,"SELECT * FROM questions_table order by question_id");
                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {
                                echo "<tr>";
                                echo "<td>" . $row['question_id'] . "</td>";
                                echo "<td>" . $row['question'] . "</td>";
                                echo "<td><a href='action.php?qid=".$row['question_id']."'><img src='images/delete.svg' alt='delete'></a></td>";
                                echo "</tr>";
                            }
                        }
                ?>
        </table>
        </div>
        <?php
            mysqli_close($conn);
        ?>
    </body>
</html>

