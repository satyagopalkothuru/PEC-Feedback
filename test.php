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
        <title>PEC Online Feedback Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/feedback.css"/>
        <link rel="shortcut icon" type="image/jpg" href="images/pec_fav.jpg"/>

        <script javascript>
                    year_val=0,branch_val="",sub="",staff="";
                    function reload1()
                    {
                        year_val=document.getElementById('y').value;
                        branch_val=document.getElementById('b').value;
                        self.location='student_feedback.php?b='+branch_val+'&y='+year_val;
                        
                    }
                    function reload2()
                    {
                        sub=document.getElementById('subject').value;
                        self.location=self.location+'&s='+sub;
                    }
                    function reload3()
                    {
                        staff=document.getElementById('fname').value;
                        self.location=self.location+'&fname='+staff;
                    }
                    
                    function enable(){
                        document.getElementById("disable").style.display="block";
                    }
                     function show1(a,b)
                    {
                        document.getElementById("y").value=a;
                        var get_index1=document.getElementById("y").options[document.getElementById("y").selectedIndex].index;
                        document.getElementById("y").options[get_index1].selected = 'selected';
                        document.getElementById("b").value=b;
                        var get_index2=document.getElementById("b").options[document.getElementById("b").selectedIndex].index;
                        document.getElementById("b").options[get_index2].selected = 'selected';
                        year_val=document.getElementById('y').value;
                        branch_val=document.getElementById('b').value;
                    }
                    function show2(a,b,c){
                        document.getElementById("y").value=a;
                        var get_index1=document.getElementById("y").options[document.getElementById("y").selectedIndex].index;
                        document.getElementById("y").options[get_index1].selected = 'selected';
                        document.getElementById("b").value=b;
                        var get_index2=document.getElementById("b").options[document.getElementById("b").selectedIndex].index;
                        document.getElementById("b").options[get_index2].selected = 'selected';
                        document.getElementById("subject").value=c;
                        var get_index3=document.getElementById("subject").options[document.getElementById("subject").selectedIndex].index;
                        document.getElementById("subject").options[get_index3].selected = 'selected';
                        year_val=document.getElementById('y').value;
                        branch_val=document.getElementById('b').value;
                    }
                    function show3(a,b,c,d){
                        document.getElementById("y").value=a;
                        var get_index1=document.getElementById("y").options[document.getElementById("y").selectedIndex].index;
                        document.getElementById("y").options[get_index1].selected = 'selected';
                        document.getElementById("b").value=b;
                        var get_index2=document.getElementById("b").options[document.getElementById("b").selectedIndex].index;
                        document.getElementById("b").options[get_index2].selected = 'selected';
                        document.getElementById("subject").value=c;
                        var get_index3=document.getElementById("subject").options[document.getElementById("subject").selectedIndex].index;
                        document.getElementById("subject").options[get_index3].selected = 'selected';
                        document.getElementById("fname").value=d;
                        var get_index4=document.getElementById("fname").options[document.getElementById("fname").selectedIndex].index;
                        document.getElementById("fname").options[get_index4].selected = 'selected';
                        year_val=document.getElementById('y').value;
                        branch_val=document.getElementById('b').value;
                    }
                    
                </script>
    </head>
    <body>
        <div class="bg-text">
        <header>
            <div class="d-flex justify-content-center">
                <img src="images/logo.png" alt="PEC logo">
                <img src="images/naac-logo.png" alt="Naac">
            </div>
        </header>
        <h1>Online Feedback Form - Student Portal</h1>
        <form method="post" >
            <div class="d-flex justify-content-center">
            <table>
                <tr>
                    <td>Year : </td>
                    <td>
                      <select class="form-select" name="year" id="y" >
                              <option value="0" disabled selected>SELECT</option>
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
                        <select class="form-select" name="branch" id="b" onchange="reload1()" >
                            <option value="" disabled selected>SELECT</option>
                            <option value="cse1">CSE1</option>
                            <option value="cse2">CSE2</option>
                            <option value="ece1">ECE1</option>
                            <option value="ece2">ECE2</option>
                            <option value="it">IT</option>
                            <option value="eee">EEE</option>
                            <option value="mech">MECH</option>
                            <option value="civil">CIVIL</option>
                            <option value="CYBERSECURITY">CYBER SECURITY</option>
                            <option value="AI">AI</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Subject : </td>
                    <td>
                        <select class="form-select" name="subject" id="subject" onchange="reload2()" >
                                <option value="" disabled selected>SELECT</option>
                                <?php
                                     if($conn === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }
                                    else
                                    {
                                        mysqli_select_db($conn,"feedback_app");
                                        $result = mysqli_query($conn,"SELECT distinct subject FROM faculty_table where year='".$_GET['y']."' and branch='".$_GET['b']."' ");
                                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                        {
                                            
                                            echo "<option value='".$row['subject']."'>".$row['subject']."</option>";                                           
                                        }
                                    }

                                ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Faculty Name : </td>
                    <td>
                        <select class="form-select" name="facultyname" id="fname" onchange="reload3()" >
                                <option value="" disabled selected>SELECT</option>
                                <?php
                                     if($conn === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }
                                    else
                                    {
                                        mysqli_select_db($conn,"feedback_app");
                                        $result = mysqli_query($conn,"SELECT * FROM faculty_table where year='".$_GET['y']."' and branch='".$_GET['b']."' and subject='".$_GET['s']."'");
                                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                        {
                                            
                                            echo "<option value='".$row['faculty_name']."'>".$row['faculty_name']."</option>";
                                           
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
                <table>
                    <?php
                        if(isset($_GET['y']) && isset($_GET['b']) && isset($_GET['s']) && isset($_GET['fname']))
                        {
                            $arr=['st','nd','rd','th'];
                            echo "<h1> ".$_GET['y']."<sup>".$arr[$_GET['y']-1]."</sup> - ".$_GET['b']." - ".$_GET['s']." - ".$_GET['fname']."</h1>";
                        }
                    ?>
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
                            <td colspan=4><textarea name="comment" cols="100%" rows="4" placeholder="Enter your comments..."></textarea></td>
                        </tr>
                        <tr>
                            <td colspan=5><input class="btn form-control" id="submit"  type="submit" value="Post"></td>
                        </tr>
                </table>
            </div>
            <br>
        </form>
        </div>
    </body>
</html>
<?php
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else if(isset($_GET['y']) && isset($_GET['b']) && isset($_GET['s']) && isset($_GET['fname']))
    {
        mysqli_select_db($conn,"feedback_app");
        $faculty_name=$_GET['fname'];
        $year=$_GET['y'];
        $branch=$_GET['b'];
        $subject=$_GET['s'];
        // echo $_POST['comment'];
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
        if(isset($_POST['comment']))
        {
            $comment=$_POST['comment'];
            if($comment!='')
            {
                $res = mysqli_query($conn,"INSERT INTO comments_table  VALUES ('$faculty_name','$year','$branch','$subject','$comment')");
                if(!$res)
                {
                    echo "<script>alert('failed to store in database')</script>";
                }
            }   
        }
        
    }
    
    if(isset($_GET['y']) && isset($_GET['b']) && isset($_GET['s']) && isset($_GET['fname']))
    {
        echo "<script>show3('".$_GET['y']."','".$_GET['b']."','".$_GET['s']."','".$_GET['fname']."')</script>";
    }
    else if(isset($_GET['y']) && isset($_GET['b']) && isset($_GET['s']))
    {
        echo "<script>show2('".$_GET['y']."','".$_GET['b']."','".$_GET['s']."')</script>";
    }
    else if(isset($_GET['y']) && isset($_GET['b']))
    {
        echo "<script>show1('".$_GET['y']."','".$_GET['b']."')</script>";
    }
        

    mysqli_close($conn);
?>