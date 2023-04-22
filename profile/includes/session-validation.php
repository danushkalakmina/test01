<?php
session_start();
ob_start();
if (!isset($_SESSION["user-id"]) || empty($_SESSION["user-id"]) || !isset($_SESSION["company-id"]) || empty($_SESSION["company-id"])) {
    header("Location:login.php");
    return;
}
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
//error_reporting(E_ALL);
?>