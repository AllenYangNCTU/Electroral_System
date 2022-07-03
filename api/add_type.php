<?php
include_once "base.php";
// 建議先檢查分類名稱 是否有重覆
update_or_insert_contents_in_table('types',['name'=>$_POST['name']]); // 更新types表, name欄 放入 POST帶來的name值

header_to("../back.php");
