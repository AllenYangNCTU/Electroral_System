<?php
include_once "./api/base.php";
$statesql = "select secret from subjects where id = {$_GET['id']}";
$state = $pdo->query($statesql)->fetch(PDO::FETCH_ASSOC);
if ($state['secret']) {
    $sql = "update subjects set secret = 0 where id = {$_GET['id']}";
    $pdo->exec($sql);
} else {
    $sql = "update subjects set secret = 1 where id = {$_GET['id']}";
    $pdo->exec($sql);
}


header_to("./back.php");
