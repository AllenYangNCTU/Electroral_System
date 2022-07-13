<?php
include_once "base.php";
$sql = "select count(name) as number from types where `name` = '{$_POST["typename"]}'";
$num = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
if ($num['number'] == 0) {
    update_or_insert_contents_in_table('types', ['name' => $_POST['typename']]);
    print("Create type： " . $_POST['typename'] . " successfully！");
?>
<?php
    header_to("../back.php?do=admin_type");
} else if ($num['number'] > 0) {
    print("This type already exists in the database");
?>
    <br><a href="../back.php?do=admin_type">Back</a>
<?php
} else {
    print("error");
?>
    <br><a href=".../back.php?do=admin_type">Back</a>
<?php
}
