<?php
    session_start();
    if (isset($_GET['intellect'])) {
        $_SESSION['idEChec'] = $_GET['intellect'];
        header ("location: ./register.php");
      }
?>