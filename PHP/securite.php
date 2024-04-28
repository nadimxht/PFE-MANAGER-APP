<?php
session_start();
if (!isset($_SESSION['user'])) 
    {
    $_SESSION['info'] = "Acces non autorisé";
    header("location:index.php");
    }
