<?php
include_once "../api/base.php";
?>
<h1 style="text-align:center;">Reset Passwords</h1>
<form action="enternewpwd.php" method="post">
    <?php
    $username = $_GET['acc'];
    print("hello~~ " . $username . "<br>");
    ?>

    <input type="hidden" name="username" value="<?= $_GET['acc']; ?>" id="" readonly></p>
    <p>Passwords(Contain at least one uppercase character, lowercase character and number && 8 <= length <=16 )</p><br>
            <input type="password" name="pwd" value="" id="">

            <p>Confirm Passwords(Contain at least one uppercase character, lowercase character and number && 8 <= length <=16 )</p><br>
                    <input type="password" name="re_pwd" value="" id="""><br>

    <button type=" submit" value="submit" onclick="location.href='./enternewpwd.php'">Submit</button>
</form>