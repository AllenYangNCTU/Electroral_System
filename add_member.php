<?php
include "./api/base.php";
$sql_test = "select count(acc) as number from `users` where acc = '{$_POST["acc"]}'";
$acc = $pdo->query($sql_test)->fetch(PDO::FETCH_ASSOC);
$pwd = $_POST['pw'];

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
$today = date('now');
$birthday = strtotime($_POST['birthday']);
if ($acc['number'] == 0) {
    if ($_POST['pw'] == $_POST['re_pw']) {
        if (strlen($pwd) > 8 && strlen($pwd) < 16) {
            if ($hasNum  && $hasUpper  && $hasLower) {
                if ($birthday < $today) {
                    $pw = md5($_POST['pw']);
                    $sql = "INSERT INTO `users` (`acc`,`pw`,`name`,`birthday`,`addr`,`email`,`passnote`) 
                        values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['birthday']}','{$_POST['addr']}','{$_POST['email']}','{$_POST['passnote']}');";
                    $pdo->exec($sql);
                    header_to("./login.php");
                } else {
                    print("<script type='text/javascript'>alert('生日不能大於今日');</script>");
?>
                    <br><a href="register.php">重新註冊</a>
                <?php
                }
            } else {
                print("<script type='text/javascript'>alert('密碼請包含大寫、小寫、數字');</script>");
                ?>
                <br><a href="register.php">重新註冊</a>
            <?php
            }
        } else if (strlen($pwd) < 8) {
            print("<script type='text/javascript'>alert('密碼長度不能小於8');</script>");
            ?>
            <br><a href="register.php">重新註冊</a>
        <?php
        } else {
            print("<script type='text/javascript'>alert('密碼長度不能大於16');</script>");
        ?>
            <br><a href="register.php">重新註冊</a>
        <?php
        }
    } else {
        print("<script type='text/javascript'>alert('密碼兩次不相同');</script>");
        ?>
        <br><a href="register.php">重新註冊</a>
    <?php
    }
} else {
    print("<script type='text/javascript'>alert('此使用者名稱已被註冊');</script>");
    ?>
    <br><a href="register.php">重新註冊</a>
<?php
}
