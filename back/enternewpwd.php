<?php
include_once("../api/base.php");


$pwd = $_POST['pwd'];

$lower_arr = array();
$lower = 'abcdefghijklmnopqrstuvwxyz';
for ($i = 0; $i < strlen($lower); $i++) {
    $lower_arr[] = substr($lower, $i, 1);
}
$upper_arr = array();
$upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
for ($i = 0; $i < strlen($upper); $i++) {
    $upper_arr[] = substr($upper, $i, 1);
}
$num_arr = array();
$num = '0123456789';
for ($i = 0; $i < strlen($num); $i++) {
    $num_arr[] = substr($num, $i, 1);
}

$pwdstr = array();
$hasLower = false;
$hasUpper = false;
$hasNum = false;
for ($i = 0; $i < strlen($pwd); $i++) {
    $str = substr($pwd, $i, 1);
    if (in_array($str, $lower_arr)) {
        $hasLower = true;
    }

    if (in_array($str, $upper_arr)) {
        $hasUpper = true;
    }

    if (in_array($str, $num_arr)) {
        $hasNum = true;
    }
}



if ($_POST['pwd'] == $_POST['re_pwd']) {
    if (strlen($pwd) > 8 && strlen($pwd) < 16) {
        if ($hasNum  && $hasUpper  && $hasLower) {
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
            print("<script type='text/javascript'>alert('密碼請包含大寫、小寫、數字');</script>");
        ?>
            <br><a href="../forgot.php">請重新輸入帳號、電子郵件</a>
        <?php
        }
    } else if (strlen($pwd) < 8) {
        print("<script type='text/javascript'>alert('密碼長度不能小於8');</script>");
        ?>
        <br><a href="../forgot.php">請重新輸入帳號、電子郵件</a>
    <?php
    } else {
        print("<script type='text/javascript'>alert('密碼長度不能大於16');</script>");
    ?>
        <br><a href="../forgot.php">請重新輸入帳號、電子郵件</a>
    <?php
    }
} else {
    print("<script type='text/javascript'>alert('密碼兩次不相同');</script>");
    ?>
    <br><a href="../forgot.php">請重新輸入帳號、電子郵件</a>
<?php
}
