<!-- 上方選單顯示 -->
<?php
if (isset($_SESSION['user'])) {
  $sql = "select admin  from `users` where acc='{$_SESSION['user']}'";
  $admin = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  if ($admin['admin'] == 1) {
?>
    <a href="back.php">管理投票</a>
    <a href="logout.php">登出</a><!-- 如果有登入資料就顯示登出 -->
    <a href="member_center.php">會員中心</a>
    <a href="member_managements.php">會員列表</a>
  <?php
  } else {
  ?>
    <a href="logout.php">登出</a><!-- 如果有登入資料就顯示登出 -->
    <a href="member_center.php">會員中心</a>
  <?php
  }
} else {
  ?>
  <a href="login.php">會員登入</a>

  <a href="register.php">還沒有會員？註冊</a>
  <!-- 如果沒有登入資料就顯示登入 -->
<?php
}
?>