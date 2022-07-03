<?php
session_start();
unset($_SESSION['user']); //清除session狀態
header("location:index.php");
?>