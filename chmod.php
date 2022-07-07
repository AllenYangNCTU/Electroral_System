<?php
print("hello world");
include "./api/base.php";
$sqlclose = "UPDATE subjects SET switch = 0 WHERE id = {$_GET['id']}";
$sqlopen = "UPDATE subjects SET switch = 1 WHERE id = {$_GET['id']}";
$sql = "select `switch` from subjects where id = {$_GET['id']}";
$state = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

if ($state['switch']) {
    $pdo->exec($sqlclose);
    header_to("./back.php");
} else {
    $pdo->exec($sqlopen);
    header_to("./back.php");
}
