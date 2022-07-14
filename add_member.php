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
$today = strtotime('now');
$birthday = strtotime($_POST['birthday']);
if ($acc['number'] == 0) {
    if ($_POST['pw'] == $_POST['re_pw']) {
        if (strlen($pwd) >= 8 && strlen($pwd) <= 16) {
            if ($hasNum  && $hasUpper  && $hasLower) {
                if ($birthday < $today) {

                    $pw = md5($_POST['pw']);
                    $sql = "INSERT INTO `users` (`acc`,`pw`,`name`,`birthday`,`email`) 
                        values('{$_POST['acc']}','$pw','{$_POST['name']}','{$_POST['birthday']}','{$_POST['email']}');";
                    $pdo->exec($sql);

                    header_to("./login.php");
                } else if ($birthday > $today) {
                    print("<script type='text/javascript'>alert('Birthday cannot be later than today');</script>");
?>
                    <br><a href="register.php">Back to Register Page</a>
                <?php
                }
            } else {
                print("<script type='text/javascript'>alert('Passwords have to contain at least one uppercase letter, lowercase letter and number');</script>");
                ?>
                <br><a href="register.php">Back to Register Page</a>
            <?php
            }
        } else if (strlen($pwd) < 8) {
            print("<script type='text/javascript'>alert('The length of passwords cannot be less than 8 characters.');</script>");
            ?>
            <br><a href="register.php">Back to Register Page</a>
        <?php
        } else {
            print("<script type='text/javascript'>alert('The length of passwords cannot be greater than 16 chracters');</script>");
        ?>
            <br><a href="register.php">Back to Register Page</a>
        <?php
        }
    } else {
        print("<script type='text/javascript'>alert('The password is inconsistent with the confirmation password you entered');</script>");
        ?>
        <br><a href="register.php">Back to Register Page</a>
    <?php
    }
} else {
    print("<script type='text/javascript'>alert('Account had been registered');</script>");
    ?>
    <br><a href="register.php">Back to Register Page</a>
<?php
}
