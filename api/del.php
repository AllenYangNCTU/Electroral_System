<?php
include_once "base.php";

$table = $_GET['table'];
$id = $_GET['id'];
if ($table == 'subjects') {
  delete($table, $id);
  delete('options', ['subject_id' => $id]);
} else {
  delete($table, $id);
}
header_to("../back.php");
