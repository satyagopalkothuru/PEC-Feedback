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
        <title>Admin Check Feedback</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="css/feedback.css">
        <link rel="shortcut icon" type="image/jpg" href="images/pec_fav.jpg"/>

        <script src="//code.jquery.com/jquery-3.5.1.js"></script>
        <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="//raw.githubusercontent.com/bpampuch/pdfmake/master/build/pdfmake.min.js"></script>
        <script src="//raw.githubusercontent.com/bpampuch/pdfmake/master/build/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

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
                <h1>Admin Check Feedback</h1>
                <a href="logout.php"><button class="btn btn-danger">Logout &nbsp <img src="images/logout.svg"/></button></a>
            </div>
        </nav>
        <br>
        <form  method="POST">
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
                        <td colspan=2><input class="btn form-control" id="submit" type="submit" value="Check"></td>
                    </tr>
                </table>
            </div>
        </form>
        <br>
        <hr>
        <br>
        <script>
            var subject_arr=[];
            function add_ele(ele)
            {
                subject_arr.push(ele);
            }
        </script>
        <?php
            if(isset($_POST['year']) && isset($_POST['branch']))
            {
                echo "<h1>Feedback Given By " . $_POST['year'] ."<sup>th</sup>-Year (". $_POST['branch'] .")</h1>";
                $subq = mysqli_query($conn,"SELECT distinct subject FROM feedback_table where  branch='".$_POST['branch']."' and year='".$_POST['year']."' order by subject");
                while($sub = mysqli_fetch_array($subq,MYSQLI_ASSOC))
                {
                    echo "<script>add_ele('".$sub["subject"]."');</script>";
                }
            }
        ?>
        <div class="d-flex justify-content-center flex-wrap">
        <table>
            <?php
                 
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
                            $over_all_count=0;
                            $ques_ids = mysqli_query($conn,"SELECT distinct qid FROM feedback_table where subject ='".$row['subject']."'");
                            $t_score=0;
                            $count1=0;
                            $fac=mysqli_query($conn,"SELECT distinct faculty_name FROM feedback_table where  branch='".$_POST['branch']."' and year='".$_POST['year']."' and subject='".$row['subject']."' order by subject");
                            $fac_req=mysqli_fetch_array($fac,MYSQLI_ASSOC);
                            echo "<br>";
                            echo '<table id="'.$row['subject'].'"  class="display nowrap" width="45%">';
                                
                                echo "<thead>
                                 <tr>                                   
                                 <th>Question</th>
                                 <th>Score</th>
                                 <th>Excellent</th>
                                 <th>Good</th>
                                 <th>Average</th>
                                 <th>Poor</th>
                                 </tr></thead><tbody><tr><td><h1>Subject : ".str_replace("_"," ",$row['subject'])."</h1></td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td></tr>";
                                 echo "<tr><td><h1>Faculty : ". $fac_req['faculty_name']."</h1></td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td></tr>
                                 <tr><td><h1>Year/Branch : ". $_POST['year']."-".$_POST['branch']."</h1></td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td><td> &nbsp </td></tr>";
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

                                    $present_count=$total_a['count(*)']+$total_b['count(*)']+$total_c['count(*)']+$total_d['count(*)'];
                                    $over_all_count=$over_all_count+$present_count;
                                    $total_score=(4*$total_a['count(*)']+3*$total_b['count(*)']+2*$total_c['count(*)']+$total_d['count(*)'])/$present_count;
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
                                echo "<td><h2>" . substr(strval($t_score/$count1), 0, 5). "</h2></td>";
                                echo "<td> &nbsp </td>";
                                echo "<td> &nbsp </td>";
                                echo "<td> &nbsp </td>";
                                echo "<td> &nbsp </td>";
                                echo "</tr>";
                                
                                echo "<tr>
                                    <td><h1>Comments Given</h1></td>
                                    <td> &nbsp </td>
                                    <td> &nbsp </td>
                                    <td> &nbsp </td>
                                    <td> &nbsp </td>
                                    <td> &nbsp </td>
                                </tr>";
                                $comments_res= mysqli_query($conn,"SELECT * FROM comments_table where year='".$_POST['year']."' and branch='".$_POST['branch']."' and subject='".$row['subject']."'");
                                while($comms=mysqli_fetch_array($comments_res,MYSQLI_ASSOC))
                                {
                                    echo "<tr>";
                                    echo "<td>" . $comms['comment'] . "</td>";
                                    echo "<td> &nbsp </td>
                                    <td> &nbsp </td>
                                    <td> &nbsp </td>
                                    <td> &nbsp </td>
                                    <td> &nbsp </td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            echo "<br><i>Number of students given feedback: &nbsp</i> <b>&nbsp".$over_all_count/$count1."</b>";
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
    subject_arr.forEach(downloadfun);
    
    function downloadfun(value){
        $(document).ready(actual(value));
    }
    function actual(value) {
            $('#'+value).DataTable( {
                'searching':false,
                'paging':false,
                'ordering':false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print',
                    {
                        extend: 'pdf',
                        customize: function ( doc ) {
                            doc.content.splice( 1, 0, {
                                margin: [ 0, 0, 0, 12 ],
                                alignment: 'center',
                                
                                image: 'data:image/png;base64,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'
                            } );
                        }
                    }
                ]
            } );
        } 
</script>