<?php
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "feedback_app";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PEC Online Feedback System for Demo Classes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/feedback.css"/>
        <link rel="shortcut icon" type="image/jpg" href="images/pec_fav.jpg"/>
        <script type="text/javascript">

            function submitted()
            {
                location.href = 'demo_feedback.php';
                window.open("success.html","");
            }
        </script>
    </head>
    <body>
        <div class="bg-text">
        <header>
            <div class="d-flex justify-content-center shadow-sm h-md-250">
                <img src="images/logo.png" alt="PEC logo">
                <img src="images/naac-logo.png" alt="Naac">
            </div>
        </header>
        <br>
        <h1>Online Feedback System for Demo Classes - Student Portal</h1>
        
        <form method="post">
            <?php
                if($conn === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                else
                {
                    mysqli_select_db($conn,"feedback_app");
                    $q_result = mysqli_query($conn,"SELECT * FROM manage_interviewees");
                    $i_row = mysqli_fetch_array($q_result,MYSQLI_ASSOC);
                    echo "<h1>Give Feedback to <i>".$i_row['name']." - ".$i_row['branch']." - ".$i_row['topic']."</i></h1>";
                    $iname=$i_row['name'];
                    $ibranch=$i_row['branch'];
                    $itopic=$i_row['topic'];
                    if($iname=="" && $ibranch=="" && $itopic=="")
                    {
                        echo "<script>alert('Demo Survey is not launched');</script>";
                        echo "<style>table{display:none;}</style>";
                    }
                }
            ?>
            <div class="d-flex justify-content-center">
                <table>
                    <tr>
                        <th></th>
                        <th>Excellent</th>
                        <th>Good</th>
                        <th>Average</th>
                        <th>Poor</th>
                    </tr>
                        <?php                            
                                if($conn === false){
                                    die("ERROR: Could not connect. " . mysqli_connect_error());
                                }
                                else
                                {
                                    mysqli_select_db($conn,"feedback_app");
                                    $result = mysqli_query($conn,"SELECT * FROM demo_questions where isselected='1'");
                                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $row['question'] . "</td>";
                                        echo "<td><input class='form-check-input' type='radio' name='".$row['ques_id']."' value='4'></td>
                                        <td><input class='form-check-input' type='radio' name='".$row['ques_id']."' value='3'></td>
                                        <td><input class='form-check-input' type='radio' name='".$row['ques_id']."' value='2'></td>
                                        <td><input class='form-check-input' type='radio' name='".$row['ques_id']."' value='1'></td>";
                                        echo "</tr>";
                                    }
                                }
                        ?>
                        <tr>
                            <td>Comments :</td>
                            <td colspan=4><textarea name="comm" cols="100%" rows="4" placeholder="Enter your comments..."></textarea></td>
                        </tr>
                        <tr>
                            <td colspan=5><input class="btn form-control" id="submit" name="submitted" type="submit" value="Post"></td>
                        </tr>
                </table>
            </div> 
            <br>
        </form>
        </div>
        <p class="d-flex justify-content-center"><a href="madeby.html">Designed By...</a></p>
    </body>
</html>

<?php
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else if(isset($_POST['submitted']))
    {
        mysqli_select_db($conn,"feedback_app");
        $qq_result = mysqli_query($conn,"SELECT * FROM manage_interviewees");
        $ii_row = mysqli_fetch_array($qq_result,MYSQLI_ASSOC);
        $sn=$ii_row['serialno'];

        $feed_count=0;
        $total_questions=0;
        $qs = mysqli_query($conn,"SELECT * FROM demo_questions where isselected='1'");
        while($eq = mysqli_fetch_array($qs,MYSQLI_ASSOC))
        {
            $qid=$eq["ques_id"];
            if(isset($_POST[$qid]))
            {
                $feed_count=$feed_count+1;
            }
            $total_questions=$total_questions+1;
        }

        if($feed_count==$total_questions)
        {
            $questions = mysqli_query($conn,"SELECT * FROM demo_questions where isselected='1'");
            while($eachquestion = mysqli_fetch_array($questions,MYSQLI_ASSOC))
            {
                $qid=$eachquestion["ques_id"];
                if(isset($_POST[$qid]) && isset($iname) && isset($ibranch) && isset($itopic))
                {
                    $q_score=$_POST[$qid];
                    if($q_score!=0)
                    {
                        $result = mysqli_query($conn,"INSERT INTO demo_feedback_table  VALUES ('$sn','$iname','$ibranch','$itopic','$qid','$q_score')");
                        
                    }
                }
                else{
                    echo "<script>alert('Demo Survey is not launched');</script>";
                }
            }
            
            if(isset($_POST['comm']))
            {
                $comm=str_replace("'","`",$_POST['comm']);
                
                if($comm!='')
                {
                    $res = mysqli_query($conn,"INSERT INTO comments_table  VALUES ('$sn','','','demo','$comm')");
                    if(!$res)
                    {
                        echo '<script>alert("Failed to store");</script>';
                    }
                }   
            }
            echo "<script>submitted();</script>";
        }
        else
        {
            echo "<script>alert('Answer to all feedback question');</script>";
        }
        
        
    }
    mysqli_close($conn);
?>