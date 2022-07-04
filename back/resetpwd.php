<?php
include_once "../api/base.php"; //連線資料庫
// dd($_GET);
?>
<form action="resetpwd.php" method="post">
    <p>pwd</p><br>
    <input type="password" name="pwd" value="pwd" placeholder="password" id="">
    <p>repwd</p><br>
    <input type="password" name="re_pwd" value="re_pwd" placeholder="reenter password" id=""">
</form>
<?php
// if ($_GET['action'] == 'upgrade') {
//     $sql = "UPDATE `users` -- 更新資料表
//     SET    `admin`= 1
//     WHERE  `id`='{$_GET['id']}'";
// } else {
//     $sql = "UPDATE `users` -- 更新資料表
//     SET    `admin`= 0
//     WHERE  `id`='{$_GET['id']}'";
// }

// $pdo->exec($sql);

// header_to("../member_managements.php");
