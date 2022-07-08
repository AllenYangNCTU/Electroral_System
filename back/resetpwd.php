<?php
include_once "../api/base.php"; //連線資料庫
?>
<h1 style="text-align:center;">重設密碼</h1>
<form action="enternewpwd.php" method="post">
    <?php
    $username = $_GET['acc'];
    print("hello~~ " . $username . "<br>");
    ?>
    <!-- <p>username</p> -->
    <input type="hidden" name="username" value="<?= $_GET['acc']; ?>" id="" readonly></p>
    <p>密碼(密碼請包含大寫、小寫、數字，且長度介於8~16)</p><br>
    <input type="password" name="pwd" value="" id="">
    <p>再次輸入密碼(密碼請包含大寫、小寫、數字，且長度介於8~16)</p><br>
    <input type="password" name="re_pwd" value="" id="""><br>
    <button type=" submit" value="submit" onclick="location.href='./enternewpwd.php'">送出</button>
</form>