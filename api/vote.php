<?php
// 紀錄投票結果
include_once "base.php";

if (isset($_POST['opt'])) {

  if (is_array($_POST['opt'])) {
    foreach ($_POST['opt'] as $key => $opt) {
      $option = find_something_in_table("options", $opt);
      $option['total']++;
      update_or_insert_contents_in_table("options", $option);
      if ($key == 0) {
        $subject = find_something_in_table("subjects", $option['subject_id']);
        $subject['total']++;
        update_or_insert_contents_in_table("subjects", $subject);
      }
      // $log = [
      //   'user_id' => (isset($_SESSION['user'])) ? $_SESSION['user'] : 0,
      //   'subject_id' => $subject['id'],
      //   'option_id' => $option['id']
      // ];
      // update_or_insert_contents_in_table("logs", $log);
    }
  } else {
    //單選題
    $option = find_something_in_table("options", $_POST['opt']);
    $option['total']++;
    update_or_insert_contents_in_table("options", $option);
    $subject = find_something_in_table("subjects", $option['subject_id']);
    $subject['total']++;
    update_or_insert_contents_in_table("subjects", $subject);
    // $log = [
    //   'user_id' => (isset($_SESSION['user'])) ? $_SESSION['user'] : 0,
    //   'subject_id' => $subject['id'],
    //   'option_id' => $option['id']
    // ];
    // update_or_insert_contents_in_table("logs", $log);
  }
}
header_to("../index.php?do=vote_result&id={$option['subject_id']}");
