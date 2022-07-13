<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Passwords</title>
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <nav>
    <?php include "./layout/header.php"; ?>
  </nav>
  <div class="container">
    <form action="chk_acc.php" method="post">

      <h1>Forgot Passwords</h1>

      <label for="">Account:</label><br>
      <input type="text" name="acc"><br><br><br>

      <label for="">Email:</label><br>
      <input type="text" name="email"><br>

      <input type="submit" class="logbtn" value="Verify Account">
    </form>
  </div>
  <?php include "./layout/footer.php"; ?>
</body>

</html>