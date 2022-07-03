<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>忘記密碼</title>
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <!-- 上方選單 -->
<nav>
    <?php include "./layout/header.php";?>
  </nav>

  <!-- 主要內容 -->
<div class="container">
  <form action="chk_acc.php" method="post">
    <h1>忘記密碼</h1>

    <div class="txtb" style="margin-top:15vh ;">
      <input type="text" name="acc">
      <span data-placeholder="忘記密碼的帳號"></span>
    </div>

    <div style="margin-top: 15vh;">
      <input type="submit" class="logbtn" value="檢查">
    </div>
    
  </form>
</div>

<script type="text/javascript">
  
    $(".txtb input").on("focus",function(){
      $(this).addClass("focus");
    });

    $(".txtb input").on("blur",function(){
      if($(this).val() == "")
      $(this).removeClass("focus");
    });
  </script>

<!-- 頁尾 -->
<?php include "./layout/footer.php";?>



</body>
</html>