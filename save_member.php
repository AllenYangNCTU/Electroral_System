<?php
include_once "./api/base.php";

$pw = md5($_POST['pw']);
$sql = "UPDATE `users`
      SET    `pw`='$pw',
             `name`='{$_POST['name']}',
             `birthday`='{$_POST['birthday']}',
             `addr`='{$_POST['addr']}',
             `email`='{$_POST['email']}'
      WHERE  `id`='{$_POST['id']}'";
$pdo->exec($sql);
header_to("./member_center.php");
