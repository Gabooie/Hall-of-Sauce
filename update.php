<?php
    session_start();
    if($_POST['volume']) {
        $_SESSION['volume'] =$_POST['volume'];
        echo 'Success';
    }
?>