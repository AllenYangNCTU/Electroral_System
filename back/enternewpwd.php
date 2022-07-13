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
            print("Reset Passwords successfully!");
?>
            <br><a href="../login.php">Back to login</a>
        <?php
        } else {
            print("<script type='text/javascript'>alert('Passwords have to contain at least one uppercase letter, lowercase letter and number');</script>");
        ?>
            <br><a href="../forgot.php">Back to Forgot Passords</a>
        <?php
        }
    } else if (strlen($pwd) < 8) {
        print("<script type='text/javascript'>alert('The length of passwords cannot be less than 8 characters');</script>");
        ?>
        <br><a href="../forgot.php">Back to Forgot Passords</a>
    <?php
    } else {
        print("<script type='text/javascript'>alert('The length of passwords cannot be greater than 16 chracters');</script>");
    ?>
        <br><a href="../forgot.php">Back to Forgot Passords</a>
    <?php
    }
} else {
    print("<script type='text/javascript'>alert('The password is inconsistent with the confirmation password you entered');</script>");
    ?>
    <br><a href="../forgot.php">Back to Forgot Passords</a>
<?php
}
