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
        <title>PEC Online Feedback System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/feedback.css"/>
        <link rel="shortcut icon" type="image/jpg" href="images/pec_fav.jpg"/>
        <script type="text/javascript">
            isselectedsub=0;
            function enable(){
                if(isselectedsub==1)
                {
                    document.getElementById("disable").style.display="block";
                }
                else{
                    alert("Select a subject to give Feedback");
                }
            }   
            function assign(){
                isselectedsub=1;
                var v=document.getElementById('subject').value;
                v=v.split('#');
                document.getElementById('s1').innerHTML=v[0]+" - "+v[1];
            }
            function submitted()
            {
                location.href = 'student_feedback.php';
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
        <h1>Online Feedback System - Student Portal</h1>
        <?php
            $servey_res = mysqli_query($conn,"SELECT * FROM servey");
            $lser = mysqli_fetch_array($servey_res,MYSQLI_ASSOC);
            $y=$lser['year'];
            $b=$lser['branch'];
            $arr=["I","II","III","IV"];
            if (isset($b)){
                echo "<h1>Year/Branch : ".$arr[$y-1]."-".strtoupper($b)."</h1>";
            }
        ?>
        <form method="post">
            <div class="d-flex justify-content-center">
            <table>
                <tr>
                    <td>Subject : </td>
                    <td>
                        <select class="form-select" name="subject" id="subject" onchange="assign()">
                                <option value="" disabled selected>SELECT</option>
                                <?php
                                     if($conn === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }
                                    else
                                    {
                                        mysqli_select_db($conn,"feedback_app");
                                        $result = mysqli_query($conn,"SELECT * FROM faculty_table where year='".$y."' and branch='".$b."' ");
                                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                        {
                                            
                                            echo "<option value='".$row['subject']."#".$row['faculty_name']."'>".$row['subject']." --> ".$row['faculty_name']."</option>";                                           
                                        }
                                    }

                                ?>

                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" ><a class="btn btn-danger" onclick="enable()">Give Feedback</a></td>
                </tr>
            </table>
            </div>
            <br>
            <hr>
            <br>
            <div id="disable">
                <?php
                    if(isset($y) && isset($b))
                    {
                        $arr=['st','nd','rd','th'];
                        echo "<h1> ".$y."<sup>".$arr[$y-1]."</sup> - ".$b."</h1>";
                    }
                ?>
                <h1 id="s1"></h1>
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
                                    $result = mysqli_query($conn,"SELECT * FROM questions_table");
                                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    {
                                        echo "<tr>";
                                        echo "<td>" . $row['question'] . "</td>";
                                        echo "<td><input class='form-check-input' type='radio' name='".$row['question_id']."' value='4'></td>
                                        <td><input class='form-check-input' type='radio' name='".$row['question_id']."' value='3'></td>
                                        <td><input class='form-check-input' type='radio' name='".$row['question_id']."' value='2'></td>
                                        <td><input class='form-check-input' type='radio' name='".$row['question_id']."' value='1'></td>";
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
    else if(isset($y) && isset($b) && isset($_POST['subject']))
    {
        mysqli_select_db($conn,"feedback_app");
        
        $iparr = explode ("#", $_POST['subject']); 

        $year=$y;
        $branch=$b;
        $subject=$iparr[0];
        $faculty_name=$iparr[1];
        $feed_count=0;
        $total_questions=0;
        $qs = mysqli_query($conn,"SELECT * FROM questions_table");
        while($eq = mysqli_fetch_array($qs,MYSQLI_ASSOC))
        {
            $qid=$eq["question_id"];
            if(isset($_POST[$qid]))
            {
                $feed_count=$feed_count+1;
            }
            $total_questions=$total_questions+1;
        }

        if($feed_count==$total_questions)
        {
            $questions = mysqli_query($conn,"SELECT * FROM questions_table");
            while($eachquestion = mysqli_fetch_array($questions,MYSQLI_ASSOC))
            {
                $qid=$eachquestion["question_id"];
                if(isset($_POST[$qid]))
                {
                    $q_score=$_POST[$qid];
                    if($q_score!=0)
                    {
                        $result = mysqli_query($conn,"INSERT INTO feedback_table  VALUES ('$faculty_name','$year','$branch','$subject','$qid','$q_score')");
                        
                    }
                }
            }
            
            if(isset($_POST['comm']))
            {
                $comm=str_replace("'","`",$_POST['comm']);
                
                if($comm!='')
                {
                    $res = mysqli_query($conn,"INSERT INTO comments_table  VALUES ('$faculty_name','$year','$branch','$subject','$comm')");
                    if(!$res)
                    {
                        echo '<script>alert("Failed to store your feedback");</script>';
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