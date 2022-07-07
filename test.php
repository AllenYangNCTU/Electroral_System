<?php
include "./api/base.php";

$sqlmember_had_voted = "SELECT acc FROM users  WHERE id in (select user_id from logs where subject_id=2);";
$member_had_voted = $pdo->query($sqlmember_had_voted)->fetchAll(PDO::FETCH_ASSOC);
dd($member_had_voted);
