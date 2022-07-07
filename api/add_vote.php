<!-- 儲存vote -->
<?php
include_once "base.php"; //引入資料庫function

$subject = $_POST['subject']; //接收表單傳來的投票主題內容

$add_subject = [ //建立資料庫內容
  'subject' => $subject,
  'type_id' => $_POST['types'],
  'multiple' => $_POST['multiple'],
  'start' => $_POST['start'],
  'end' => $_POST['end'],
  'starttime' => $_POST['starttime'],
  'endtime' => $_POST['endtime'],
];

update_or_insert_contents_in_table('subjects', $add_subject); //儲存

$id = find_something_in_table('subjects', ['subject' => $subject])['id']; // 取得資料庫內此筆儲存檔案的id

if (isset($_POST['option'])) {
  foreach ($_POST['option'] as $opt) {
    if ($opt != "") { //避免空選項
      $add_option = [
        'option' => $opt,
        'subject_id' => $id
      ];
      update_or_insert_contents_in_table("options", $add_option);
    }
  }
}

header_to('../back.php');

?>