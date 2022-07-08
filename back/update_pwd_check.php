<?php
include_once("../api/base.php");
$sql = "select pw from `users` where `acc`='{$_POST['name']}'";
$md5pwd = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);







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
if (md5($_POST['oldpwd']) == $md5pwd['pw']) {


    if ($_POST['pwd'] == $_POST['re_pwd']) {
        if (strlen($pwd) > 8 && strlen($pwd) < 16) {
            if ($hasNum  && $hasUpper  && $hasLower) {
                $newpwd = md5($_POST['pwd']);
                $sql = "UPDATE `users`
            SET    `pw`= '{$newpwd}'
            WHERE  `acc`='{$_POST['name']}'";
                $pdo->exec($sql);
                print("密碼修改成功");
?>
                <a href="../login.php">重新登入</a>
            <?php
            } else {
                print("<script type='text/javascript'>alert('密碼請包含大寫、小寫、數字');</script>");
            ?>
                <a href="../member_center.php">返回</a>
            <?php
            }
        } else if (strlen($pwd) < 8) {
            print("<script type='text/javascript'>alert('密碼長度不能小於8');</script>");
            ?>
            <a href="../member_center.php">返回</a>
        <?php
        } else {
            print("<script type='text/javascript'>alert('密碼長度不能大於16');</script>");
        ?>
            <a href="../member_center.php">返回</a>
        <?php
        }
    } else {
        print("<script type='text/javascript'>alert('密碼兩次不相同');</script>");
        ?>
        <a href="../member_center.php">返回</a>
    <?php
    }
} else {
    print("<script type='text/javascript'>alert('舊密碼錯誤');</script>");
    ?>
    <a href="../member_center.php">返回</a>
<?php
}

?>