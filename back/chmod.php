<?php
include_once "../api/base.php";
if ($_GET['action'] == 'upgrade') {
    $sql = "UPDATE `users` 
    SET    `admin`= 1
    WHERE  `id`='{$_GET['id']}'";
} else {
    $sql = "UPDATE `users` 
    SET    `admin`= 0
    WHERE  `id`='{$_GET['id']}'";
}
$pdo->exec($sql);
header_to("../member_managements.php");
