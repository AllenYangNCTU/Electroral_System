<?php
include_once "base.php";
$sql = "select count(name) as number from types where `name` = '{$_POST["typename"]}'";
$num = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
if ($num['number'] == 0) {
    update_or_insert_contents_in_table('types', ['name' => $_POST['typename']]);
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
