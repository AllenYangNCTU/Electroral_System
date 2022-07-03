<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員註冊</title>
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    .container{
    width: 100vh;
    }
    h1{
  line-height: 0.5rem;
}
.txtb{
  margin: 2rem 8rem;
}
.txtb input{
  margin-top: 0.3vh;
  height: 20px;
}
.logbtn{
  margin-top: 5vh;
}
  </style>
</head>
<body>
  <!-- 上方選單 -->
<nav>
    <?php include "./layout/header.php";?>
  </nav>
  <!-- 主要內容 -->
<div class="container">
  
  <form action="./add_member.php" method="post">
    <h1>會員註冊</h1>

    <div class="txtb">
      <input type="text" name="acc" id="">
      <span data-placeholder="帳號"></span>
    </div>
    <div class="txtb">
      <input type="password" name="pw" id="">
      <span data-placeholder="密碼"></span>
    </div>
    <div class="txtb">
      <input type="text" name="name" id="">
      <span data-placeholder="名字"></span>
    </div>
    <div class="txtb">
      <input type="date" name="birthday" id="">
      <span data-placeholder="生日"></span>
    </div>
    <div class="txtb">
      <input type="text" name="addr" id="">
      <span data-placeholder="住址"></span>
    </div>
    <div class="txtb">
      <input type="email" name="email" id="">
      <span data-placeholder="e-mail"></span>
    </div>
    <div class="txtb">
      <input type="passnote" name="passnote" id="">
      <span data-placeholder="密碼提示"></span>
    </div>

    <div>
      <input type="submit" class="logbtn" value="送出">
    </div>

  </form>
</div>
<!-- 頁尾 -->
<?php include "./layout/footer.php";?>

<script type="text/javascript">
    $(".txtb input").on("focus",function(){
      $(this).addClass("focus");
    });

    $(".txtb input").on("blur",function(){
      if($(this).val() == "")
      $(this).removeClass("focus");
    });
  </script>
  
</body>
</html>