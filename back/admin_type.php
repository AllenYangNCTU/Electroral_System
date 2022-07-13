<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>

<body>




  <form action="./api/add_type.php" method="post">
    <div style="margin-left:20rem;margin-top:4rem">
      <label for="name">Create Type</label>
      <input type="text" name="typename" id="name">
    </div>
    <div>
      <input type="submit" class="logbtn" value="Submit">
    </div>
  </form>
  <?php
  include_once "./api/base.php";

  $sql_show_types = "select name from types where 1";
  $show_types = $pdo->query($sql_show_types)->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table>
    <tr>
      <td>Type Name</td>
      <td>Delete</td>
    </tr>
    <?php
    foreach ($show_types as $show_type) {
    ?>
      <tr>
        <td>
          <?php
          print($show_type['name'] . " ");
          ?>
        </td>
        <td>

          <button onclick="location.href='../api/delete_type.php?name=<?= $show_type['name']; ?>'">delete this type</button>
        </td>
      <?php
      print("<br>");
    }
      ?>
      </tr>

  </table>
</body>

</html>