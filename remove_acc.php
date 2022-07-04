<?php

include_once "./api/base.php";

$id = $_GET['id'];
$sql = "DELETE FROM `users` WHERE `id`='$id'";
$pdo->exec($sql);

unset($_SESSION['user']); //要把session登出

header_to("./index.php");
