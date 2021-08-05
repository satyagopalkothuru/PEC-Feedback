<?php
    session_start();
    session_destroy();
    header("Location: /PEC Feedback/index.php");
?>