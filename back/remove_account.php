<?php
include_once "../api/base.php";
$id = $_GET['id'];
$sql = "DELETE FROM `users` WHERE `id`='$id'";
$pdo->exec($sql);
unset($_SESSION['user']);
header_to("../member_managements.php");
