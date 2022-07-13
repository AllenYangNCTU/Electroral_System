<?php
include_once "base.php";

$subject_id = $_POST['subject_id'];
$new_subject = $_POST['subject'];
$subject = find('subjects', $subject_id);
$subject['subject'] = $new_subject;
$subject['type_id'] = $_POST['types'];

update_or_insert_contents_in_table('subjects', $subject);

$opts = show_table_contents("options", ['subject_id' => $subject_id]);

foreach ($_POST['option'] as $key => $opt) {
  $exist = false;
  foreach ($opts as $ot) {
    if ($ot['id'] == $key) {
      $exist = true;
      break;
    }
  }

  if ($exist) {
    $ot['option'] = $opt;
    update_or_insert_contents_in_table("options", $ot);
  } else {
    $add_option = [
      'option' => $opt,
      'subject_id' => $subject_id
    ];
    update_or_insert_contents_in_table("options", $add_option);
  }
}

$sql = "update subjects set age_limit_below = '{$_POST['age_limit_below']}', age_limit = '{$_POST['age_limit']}', start = '{$_POST['start']}', end = '{$_POST['end']}', starttime = '{$_POST['start_time']}', endtime = '{$_POST['end_time']}' where id = '{$_POST['subject_id']}'";
$pdo->exec($sql);

header_to('../back.php');
