<?php
include "../api/base.php";
$undosql = "UPDATE `options` SET `total` = total - 1  WHERE id in (SELECT option_id FROM `logs` WHERE user_id = (select id from `users` where acc = '{$_SESSION['user']}') and subject_id='{$_GET['id']}'); UPDATE subjects set total = total - 1  where id='{$_GET['id']}'; delete from `logs` where subject_id='{$_GET['id']}' and `user_id`=(select id from `users` where acc = '{$_SESSION['user']}')";
$pdo->exec($undosql);
header_to("../index.php?do=vote_result&id={$_GET['id']}");
