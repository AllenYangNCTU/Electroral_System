<?php
include "./api/base.php";
$acc = $_POST['acc'];
$pw = md5($_POST['pw']);
$user_verification = $_POST['verification'];
$verification_string = $_POST['verification_string'];
$sql = "SELECT count(*) FROM `users` WHERE `acc`='$acc' && `pw`='$pw'";
$chk = $pdo->query($sql)->fetchColumn();
$error = '';
if ($user_verification == $verification_string) {
  if ($chk) {
    $_SESSION['user'] = $acc;
    header_to("./member_center.php");
  } else {
    $error = "Account or Passwords error!";
    header_to("./login.php?error=$error");
  }
} else if (!empty($user_verification) && $user_verification != $verification_string) {
  $error = "Verification error";
  header_to("./login.php?error=$error");
} else {
  header_to("./login.php");
}
