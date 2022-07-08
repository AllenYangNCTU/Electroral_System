<?php
include_once("../api/base.php");
$sql = "select pw from `users` where `acc`='{$_POST['name']}'";
$md5pwd = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

if ((md5($_POST['oldpwd']) == $md5pwd['pw']) && ($_POST['pwd'] == $_POST['re_pwd'])) {
    $newpwd = md5($_POST['pwd']);
    $sql = "UPDATE `users`
    SET    `pw`= '{$newpwd}'
    WHERE  `acc`='{$_POST['name']}'";
    $pdo->exec($sql);
    print("密碼修改成功");
?>
    <a href="../login.php">重新登入</a>
<?php
} else if (md5($_POST['oldpwd']) != $md5pwd['pw']) {
    print("舊密碼錯誤");
?>
    <a href="./update_pwd.php">返回</a>
<?php
} else if ($_POST['pwd'] != $_POST['re_pwd']) {
    print("兩次輸入的密碼不同");
?>
    <a href="./update_pwd.php">返回</a>
<?php
} else {
    print("error!");
?>
    <a href="./update_pwd.php">返回</a>
<?php
}
