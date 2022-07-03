<!-- 上方選單顯示 -->
<?php
if (isset($_SESSION['user'])) {
  if ($_SESSION['user'] == 'admin') {
?>
    <a href="back.php">管理投票</a>
    <a href="logout.php">登出</a><!-- 如果有登入資料就顯示登出 -->
    <a href="member_center.php">會員中心</a>
  <?php
  } else {
  ?>
    <a href="logout.php">登出</a><!-- 如果有登入資料就顯示登出 -->
    <a href="member_center.php">會員中心</a>
  <?php
  }
} else {
  ?>
  <a href="login.php">登入</a>
  <!-- 如果沒有登入資料就顯示登入 -->
<?php
}
?>