<?php
session_start(); //to ensure you are using same session
setcookie (session_id(), "", time() - 3600);
session_destroy();
session_write_close();
header("Location:login.php");
exit();
?>