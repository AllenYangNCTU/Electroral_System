<?php
include_once "./base.php";
print($_GET['name']);
$sql_delete_type = "delete from types where name = '{$_GET["name"]}'";
$pdo->exec($sql_delete_type);
header_to("../back.php?do=admin_type");
