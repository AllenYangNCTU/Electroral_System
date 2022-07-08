<?php
include_once("../api/base.php");
?>
<h1 style="text-align: center">密碼驗證</h1>
<form action="./update_pwd_check.php" method="post">
    <!-- <p>使用者名稱</p> -->
    <input type="hidden" name="name" value="<?= $_GET['account']; ?>" id="" readonly>
    <p>舊密碼</p>
    <input type="password" name="oldpwd" id="">
    <p>新密碼(密碼請包含大寫、小寫、數字，且長度介於8~16)</p>
    <input type="password" name="pwd" id="">
    <p>再次輸入新密碼(密碼請包含大寫、小寫、數字，且長度介於8~16)</p>
    <input type="password" name="re_pwd" id=""><br>
    <button type="submit">送出</button>
</form>
<!-- <form action="" method="post"></form> -->