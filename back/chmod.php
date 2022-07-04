<?php
include_once "../api/base.php"; //連線資料庫
// dd($_GET);
if ($_GET['action'] == 'upgrade') {
    $sql = "UPDATE `users` -- 更新資料表
    SET    `admin`= 1
    WHERE  `id`='{$_GET['id']}'";
} else {
    $sql = "UPDATE `users` -- 更新資料表
    SET    `admin`= 0
    WHERE  `id`='{$_GET['id']}'";
}

$pdo->exec($sql);

header_to("../member_managements.php");
