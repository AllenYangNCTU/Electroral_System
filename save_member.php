<?php
include_once "./api/base.php";

// $pw = md5($_POST['pw']);
$sql = "UPDATE `users`
      SET    `name`='{$_POST['name']}',
             `birthday`='{$_POST['birthday']}',
             `email`='{$_POST['email']}'
      WHERE  `id`='{$_POST['id']}'";
$pdo->exec($sql);
header_to("./member_center.php");
