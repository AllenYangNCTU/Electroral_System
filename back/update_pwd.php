<?php
include_once("../api/base.php");
?>
<h1 style="text-align: center">Password Verification</h1>
<form action="./update_pwd_check.php" method="post">
    <!-- <p>使用者名稱</p> -->
    <input type="hidden" name="name" value="<?= $_GET['account']; ?>" id="" readonly>
    <p>Old Passwords</p>
    <input type="password" name="oldpwd" id="">
    <p>New Passwords(Contain at least one uppercase character, lowercase character and number && 8 <= length <=16 )</p>
            <input type="password" name="pwd" id="">
            <p>Confirm New Passwrods(Contain at least one uppercase character, lowercase character and number && 8 <= length <=16 )</p>
                    <input type="password" name="re_pwd" id=""><br><br><br>
                    <button type="submit">Submit</button>
</form>
<!-- <form action="" method="post"></form> -->