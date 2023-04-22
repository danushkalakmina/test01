<?php
session_start();
ob_start();
if (!isset($_SESSION["admin-id"]) || empty($_SESSION["admin-id"])) {
    header("Location:login.php");
    return;
}

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
//error_reporting(E_ALL);
?>