<?php
    
    session_start();
    
    unset($_SESSION['login']);

    Header("location: /equipe-moveis/VIEW/index.php"); 
?>