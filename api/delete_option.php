<?php
include_once "./base.php";
$id = $_GET['id'];
$option = $_GET['option'];
$subject_id = $_GET['subject_id'];
$total = $_GET['total'];
$sql_multiple = "select multiple from subjects where id=$subject_id";
$multiple = $pdo->query($sql_multiple)->fetch(PDO::FETCH_ASSOC);


if (!$multiple['multiple']) {
    $sql_subjects_single_delete = "update subjects set total = (total - $total) where id=$subject_id";
    $pdo->exec($sql_subjects_single_delete);

    $sql_options_single_delete = "delete from options where id=$id";
    $pdo->exec($sql_options_single_delete);

    $sql_logs_single_delete = "delete from logs where option_id=$id";
    $pdo->exec($sql_logs_single_delete);

    header_to("../back.php?do=edit&id=$subject_id");
} else if ($multiple['multiple']) {

    $sql_options_multiple_delete = "delete from options where id=$id";
    $pdo->exec($sql_options_multiple_delete);

    $sql_logs_multiple_delete = "delete from logs where option_id=$id";
    $pdo->exec($sql_logs_multiple_delete);

    $sql_subjects_multiple_delete = "update subjects set total = (select count(distinct user_id) from logs where subject_id=$subject_id) where id=$subject_id";
    $pdo->exec($sql_subjects_multiple_delete);

    header_to("../back.php?do=edit&id=$subject_id");
}
