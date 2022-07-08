<?php
include_once("../api/base.php");
if ($_POST['pwd'] == $_POST['re_pwd']) {
    $newpwd = md5($_POST['pwd']);
    $sql = "UPDATE `users`
    SET    `pw`= '{$newpwd}'
    WHERE  `acc`='{$_POST['username']}'";
    $pdo->exec($sql);
    print("密碼重設成功");
?>
    <br><a href="../login.php">返回登入</a>
<?php
} else {
    print("密碼前後不一致");
?>
    <br><a href="./resetpwd.php">返回</a>
<?php
}
?>