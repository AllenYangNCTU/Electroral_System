<?php
include_once "base.php";
// 建議先檢查分類名稱 是否有重覆
// dd($_POST);
$sql = "select count(name) as number from types where `name` = '{$_POST["typename"]}'";
$num = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
// dd($sql);
// dd($num['number']);
if ($num['number'] == 0) {
    update_or_insert_contents_in_table('types', ['name' => $_POST['typename']]); // 更新types表, name欄 放入 POST帶來的name值
    print("新增類別： " . $_POST['typename'] . " 成功！");
?>
    <br><a href="../back.php">返回</a>
<?php
} else if ($num['number'] > 0) {
    print("此類別已存在，請選擇不同的類別新增");
?>
    <br><a href="../back.php">返回</a>
<?php

} else {
    print("error");
?>
    <br><a href="../back.php">返回</a>
<?php
}
