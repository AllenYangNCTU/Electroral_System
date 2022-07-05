<?php
include "./api/base.php"; //連線資料庫
$sql_test = "select count(acc) as number from `users` where acc = '{$_POST["acc"]}'";
$acc = $pdo->query($sql_test)->fetch(PDO::FETCH_ASSOC);
if (($_POST['pw'] == $_POST['re_pw']) && $acc['number'] == 0) {


    $pw = md5($_POST['pw']); //把密碼用MP5顯示
    $sql = "INSERT INTO `users` (`acc`,`pw`,`name`,`birthday`,`addr`,`email`,`passnote`) 
                    values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['birthday']}','{$_POST['addr']}','{$_POST['email']}','{$_POST['passnote']}');";

    $pdo->exec($sql);

    header_to("./login.php");
} else if (($_POST['pw'] != $_POST['re_pw']) && $acc['number'] == 0) {
    print("密碼前後不一致");
    header_to("./register_error.php");
} else if (($_POST['pw'] == $_POST['re_pw']) && $acc['number'] > 0) {
    print("此帳號已經存在，請重新註冊");
?>
    <br><a href="register.php">重新註冊</a>
<?php
} else if (($_POST['pw'] != $_POST['re_pw']) && $acc['number'] > 0) {
    print("密碼前後不一致，且帳號已經存在，請重新註冊");
?>
    <br><a href="register.php">重新註冊</a>
<?php
}
