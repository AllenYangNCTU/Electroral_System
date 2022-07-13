<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member register</title>
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    .container {
      width: 100vh;
    }

    h1 {
      line-height: 0.5rem;
    }

    .txtb {
      margin: 2rem 8rem;
    }

    .txtb input {
      margin-top: 0.3vh;
      height: 20px;
    }

    .logbtn {
      margin-top: 5vh;
    }

    .container {
      overflow: scroll;
    }
  </style>
</head>

<body>
  <nav>
    <?php include "./layout/header.php"; ?>
  </nav>
  <div class="container">

    <form action="./add_member.php" method="post">

      <h1>Member Register</h1><br><br>

      <label for="">Account</label><br>
      <input type="text" name="acc"><br><br><br>

      <label for="">Passwrods(contain at least one uppercase character, lowercase character and number && 8 <= length <=16 )</label><br>
          <input type="password" name="pw"><br><br><br>

          <label for="">Confirm Passwrods(contain at least one uppercase character, lowercase character and number && 8 <= length <=16 )</label><br>
              <input type="password" name="re_pw"><br><br><br>

              <label for="">Name</label><br>
              <input type="text" name="name"><br><br><br>

              <label for="">Birthday</label><br>
              <input type="date" name="birthday"><br><br><br>

              <label for="">email</label><br>
              <input type="email" name="email"><br><br><br>

              <div>
                <input type="submit" class="logbtn" value="Submit">
              </div>
    </form>
  </div>
  <?php include "./layout/footer.php"; ?>
</body>

</html>