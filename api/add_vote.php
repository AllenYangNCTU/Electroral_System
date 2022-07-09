<?php
include_once "base.php";

$subject = $_POST['subject'];
$add_subject = [
  'subject' => $subject,
  'type_id' => $_POST['types'],
  'multiple' => $_POST['multiple'],
  'start' => $_POST['start'],
  'end' => $_POST['end'],
  'starttime' => $_POST['starttime'],
  'endtime' => $_POST['endtime'],
  'age_limit' => $_POST['agelimit'],
  'age_limit_below' => $_POST['agelimit_below'],
];
update_or_insert_contents_in_table('subjects', $add_subject);
$id = find_something_in_table('subjects', ['subject' => $subject])['id'];
if (isset($_POST['option'])) {
  foreach ($_POST['option'] as $opt) {
    if ($opt != "") {
      $add_option = [
        'option' => $opt,
        'subject_id' => $id
      ];
      update_or_insert_contents_in_table("options", $add_option);
    }
  }
}
header_to('../back.php');
