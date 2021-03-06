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
      $sql = "select id from `users` where acc = '{$_SESSION['user']}'";
      $user_id = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
      $log = [
        'user_id' => $user_id['id'],
        'subject_id' => $subject['id'],
        'option_id' => $option['id']
      ];
      update_or_insert_contents_in_table("logs", $log);
    }
  } else {
    $option = find_something_in_table("options", $_POST['opt']);
    $option['total']++;
    update_or_insert_contents_in_table("options", $option);
    $subject = find_something_in_table("subjects", $option['subject_id']);
    $subject['total']++;
    update_or_insert_contents_in_table("subjects", $subject);

    $sql = "select id from `users` where acc = '{$_SESSION['user']}'";
    $user_id = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $log = [
      'user_id' => $user_id['id'],
      'subject_id' => $subject['id'],
      'option_id' => $option['id']
    ];
    update_or_insert_contents_in_table("logs", $log);
  }
}

header_to("../index.php?do=vote_result&id={$option['subject_id']}");
