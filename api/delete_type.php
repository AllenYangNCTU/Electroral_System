<?php
include_once "./base.php";


$sql_check_delete = "select count(id) as num from subjects where type_id = (select id from types where name = '{$_GET["name"]}')";
$check_delete = $pdo->query($sql_check_delete)->fetchAll(PDO::FETCH_ASSOC);
if (!$check_delete[0]['num']) {
    $sql_delete_type = "delete from types where name = '{$_GET["name"]}'";
    $pdo->exec($sql_delete_type);
    header_to("../back.php?do=admin_type");
} else {
    print("Cannot delete this type, because it does exist in subject");
?>
    <br><a href="../back.php?do=admin_type">Back</a>
<?php
}
