<?php
include_once("../api/base.php");
// dd($_POST);
if ($_POST['pwd'] == $_POST['re_pwd']) {
    // print($_POST['pwd']);
    // dd($_GET);
    // print($_POST['username']);
    // print(md5($_POST['pwd']));
    $newpwd = md5($_POST['pwd']);
    $sql = "UPDATE `users`
    SET    `pw`= '{$newpwd}'
    WHERE  `acc`='{$_POST['username']}'";


    // print($sql);
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