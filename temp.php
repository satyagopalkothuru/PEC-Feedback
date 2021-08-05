<!DOCTYPE html>
<html>
    <head>
        <title>Admin Check Feedback</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="css/feedback.css">
        <link rel="shortcut icon" type="image/jpg" href="images/pec_fav.jpg"/>

        <script src="//code.jquery.com/jquery-3.5.1.js"></script>
        <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    </head>
    <body>
        <header>
            <div class="d-flex justify-content-center">
                <img src="images/logo.png" alt="PEC logo">
                <img src="images/naac-logo.png" alt="Naac">
            </div>
        </header>
        <nav class="navbar">
            <div class="container-fluid">
                <a href="admin_home.php"><button class="btn btn-danger"><img src="images/home.svg"/> &nbsp Home</button></a>
                <h1>Admin Check Feedback</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        <form action="check_feedback.php" method="POST">
            <div class="d-flex justify-content-center"> 
                <table>
                    <tr>
                        <td>Year : </td>
                        <td>
                            <select class="form-select" name="year">
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
                            <select class="form-select" name="branch">
                                <option value="0" disabled selected>SELECT</option>
                                <option value="cse1">CSE-1</option>
                                <option value="cse2">CSE-2</option>
                                <option value="ece1">ECE-1</option>
                                <option value="ece2">ECE-2</option>
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
                        <td colspan=2><input class="btn form-control" id="submit" type="submit" value="Check"></td>
                    </tr>
                </table>
            </div>
        </form>
        <br>
        <hr>
        <br>
        <?php
            if(isset($_POST['year']) && isset($_POST['branch']) && $_POST['year']!=0)
            {
                echo "<h1>Feedback Given By " . $_POST['year'] ."<sup>th</sup>-Year (". $_POST['branch'] .")</h1>";
            }
        ?>
        <div class="d-flex justify-content-evenly flex-wrap">
        <table>
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
                
                if($conn === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                else
                {
                    if(isset($_POST['year']) && isset($_POST['branch']) && $_POST['year']!=0)
                    {
                        mysqli_select_db($conn,"feedback_app");
                        $result = mysqli_query($conn,"SELECT distinct subject FROM feedback_table where  branch='".$_POST['branch']."' and year='".$_POST['year']."' order by subject");
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                            $ques_ids = mysqli_query($conn,"SELECT distinct qid FROM feedback_table where subject ='".$row['subject']."'");
                            $t_score=0;
                            $count1=0;
                            echo "<td colspan=6><h1>Subject : ". $row['subject']."</h1></td>";
                            echo '<table id="table_download" width="45%">';
                                echo "<thead>
                                 <tr>                                   
                                 <th>Question</th>
                                 <th>Score</th>
                                 <th>Excellent</th>
                                 <th>Good</th>
                                 <th>Average</th>
                                 <th>Poor</th>
                                 </tr></thead><tbody>";
                                while($q_id=mysqli_fetch_array($ques_ids,MYSQLI_ASSOC))
                                {
                                    $total_a=0;
                                    $total_b=0;
                                    $total_c=0;
                                    $total_d=0;
                                    $questions=mysqli_query($conn,"SELECT question FROM questions_table where question_id ='".$q_id['qid']."'");
                                    $req_ques=mysqli_fetch_array($questions,MYSQLI_ASSOC);

                                    $totala=mysqli_query($conn,"SELECT count(*)  FROM feedback_table where qid ='".$q_id['qid']."' and subject='".$row['subject']."' and score='4'");
                                    $total_a=mysqli_fetch_array($totala,MYSQLI_ASSOC);
                                    $totalb=mysqli_query($conn,"SELECT count(*)  FROM feedback_table where qid ='".$q_id['qid']."' and subject='".$row['subject']."' and score='3'");
                                    $total_b=mysqli_fetch_array($totalb,MYSQLI_ASSOC);
                                    $totalc=mysqli_query($conn,"SELECT count(*)  FROM feedback_table where qid ='".$q_id['qid']."' and subject='".$row['subject']."' and score='2'");
                                    $total_c=mysqli_fetch_array($totalc,MYSQLI_ASSOC);
                                    $totald=mysqli_query($conn,"SELECT count(*)  FROM feedback_table where qid ='".$q_id['qid']."' and subject='".$row['subject']."' and score='1'");
                                    $total_d=mysqli_fetch_array($totald,MYSQLI_ASSOC);

                                    $total_score=(4*$total_a['count(*)']+3*$total_b['count(*)']+2*$total_c['count(*)']+$total_d['count(*)'])/($total_a['count(*)']+$total_b['count(*)']+$total_c['count(*)']+$total_d['count(*)']);
                                    $t_score=$t_score+$total_score;
                                    $count1=$count1+1;
                                    echo "<tr>";
                                    echo "<td>" . $req_ques['question'] . "</td>";
                                    echo "<td>" . substr(strval($total_score), 0, 5) . "</td>";
                                    echo "<td>" . $total_a['count(*)'] . "</td>";
                                    echo "<td>" . $total_b['count(*)'] . "</td>";
                                    echo "<td>" . $total_c['count(*)'] . "</td>";
                                    echo "<td>" . $total_d['count(*)'] . "</td>";
                                    echo "</tr>";
                                }  
                                echo "<tr>";
                                echo "<td><h2> Overall Total Score </h2></td>";
                                echo "<td colspan=5><h2>" . substr(strval($t_score/$count1), 0, 5). "</h2></td>";
                                echo "</tr>";
                                echo "<tr>
                                    <td colspan=6><h1>Comments Given</h1></td>
                                </tr>";
                                $comments_res= mysqli_query($conn,"SELECT * FROM comments_table where year='".$_POST['year']."' and branch='".$_POST['branch']."' and subject='".$row['subject']."'");
                                while($comms=mysqli_fetch_array($comments_res,MYSQLI_ASSOC))
                                {
                                    echo "<tr>";
                                    echo "<td colspan=6>" . $comms['comment'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            echo "<br>";
                        }
                    }
                }
                mysqli_close($conn);
            ?>
            </div>
        </table>
    </body>
</html>
<script>
$(document).ready(function() {
    $('#table_download').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>