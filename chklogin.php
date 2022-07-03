<?php
include "./api/base.php";//連線資料庫

$acc=$_POST['acc'];
$pw=md5($_POST['pw']);//接收帳號密碼並且把密碼改成MD5

$sql="SELECT count(*) FROM `users` WHERE `acc`='$acc' && `pw`='$pw'";//尋找資料表的acc跟pw是否相符
$chk=$pdo->query($sql)->fetchColumn();

$error='';

if($chk){//如果資料庫有這一筆資料的話就是Ture
  $_SESSION['user']=$acc;//記錄使用者是誰 傳值到登入頁面
  header("location:member_center.php");// 登入成功導向會員頁
}else{
  $error="帳號密碼錯誤";
  header("location:login.php?error=$error");// 登入失敗回到登入頁
}
?>