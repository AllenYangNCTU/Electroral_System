<?php
include_once "base.php";



$sql_delete_logs = "delete from logs where subject_id = {$_GET['id']}";
$pdo->exec($sql_delete_logs);









$table = $_GET['table'];
$id = $_GET['id'];
if ($table == 'subjects') {
  delete($table, $id);
  delete('options', ['subject_id' => $id]);
} else {
  delete($table, $id);
}

header_to("../back.php");
