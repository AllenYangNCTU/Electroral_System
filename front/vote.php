<?php
include_once "./api/base.php";

$subject = find_something_in_table("subjects", $_GET['id']);
$opts = show_table_contents('options', ['subject_id' => $_GET['id']]);

// dd($subject);
// dd($opts);
?>
<h1><?= $subject['subject']; ?></h1>
<form action="./api/vote.php" method="post">
  <?php
  foreach ($opts as $opt) {
  ?>
    <div class="vote-item">
      <?php
      if ($subject['multiple'] == 0) { //單選題
      ?>
        <input type="radio" name="opt" value="<?= $opt['id']; ?>">
      <?php
      } else { //複選題
      ?>
        <input type="checkbox" name="opt[]" value="<?= $opt['id']; ?>">
      <?php
      }
      ?>
      <?= $opt['option']; ?>
    </div>
  <?php
  }
  ?>
  <div>
    <input type="submit" class="logbtn" value="投票">
  </div>
</form>