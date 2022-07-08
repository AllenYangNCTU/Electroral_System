<?php
include_once "./api/base.php";
$statesql = "SELECT secret FROM subjects WHERE id = {$_GET['id']}";
$state = $pdo->query($statesql)->fetch(PDO::FETCH_ASSOC);
if ($state['secret']) {
    $sql = "UPDATE subjects SET secret = 0 WHERE id = {$_GET['id']}";
    $pdo->exec($sql);
} else {
    $sql = "UPDATE subjects SET secret = 1 WHERE id = {$_GET['id']}";
    $pdo->exec($sql);
}
header_to("./back.php");
