<?php
include_once "./api/base.php"; //連線資料庫

$pw = md5($_POST['pw']);
$sql = "UPDATE `users` -- 更新資料表
      SET    `pw`='$pw',
             `name`='{$_POST['name']}',
             `birthday`='{$_POST['birthday']}',
             `addr`='{$_POST['addr']}',
             `email`='{$_POST['email']}'
      WHERE  `id`='{$_POST['id']}'";

$pdo->exec($sql);

header_to("./member_center.php"); // 更新完導向會員頁
