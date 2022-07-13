<?php
$id = $_GET['id'];
$subj = find('subjects', $id);
$opts = all('options', ['subject_id' => $id]);
?>
<form action="./api/edit_vote.php" method="post">
  <div style="margin:1rem 20rem">
    <div>
      <select name="types" id="types">
        <?php
        $types = all("types");
        foreach ($types as $type) {
          $selected = ($subj['type_id'] == $type['id']) ? 'selected' : '';
          echo "<option value='{$type['id']}' $selected>";
          echo $type['name'];
          echo "</option>";
        }
        ?>
      </select>
    </div>
    <div class="vote-sub">
      <label for="subject">Topic:</label>
      <input type="text" name="subject" id="subject" value="<?= $subj['subject']; ?>">

      <input type="button" value="add option" onclick="addOption()"><br><br>

      <label for="">Start Date:</label>
      <input type="date" name="start" value="<?= $subj['start']; ?>" id=""><br><br>

      <label for="">End Date:</label>
      <input type="date" name="end" value="<?= $subj['end']; ?>" id=""><br><br>

      <label for="">Start Time:</label>
      <input type="time" name="start_time" value="<?= $subj['starttime']; ?>" id=""><br><br>

      <label for="">End Time:</label>
      <input type="time" name="end_time" value="<?= $subj['endtime']; ?>" id=""><br><br>

      <label for="">Age lower limit:</label>
      <input type="number" name="age_limit" value="<?= $subj['age_limit']; ?>" id=""><br><br>

      <label for="">Age upper limit:</label>
      <input type="number" name="age_limit_below" value="<?= $subj['age_limit_below']; ?>" id="">

      <input type="hidden" name="subject_id" value="<?= $subj['id']; ?>">
    </div>


    <div id="selector" class="vote-sub">
      <input type="radio" name="multiple" value="0" <?= ($subj['multiple'] == 0) ? 'checked' : ''; ?>>
      <label>Multiple-choice</label>
      <input type="radio" name="multiple" value="1" <?= ($subj['multiple'] == 1) ? 'checked' : ''; ?>>
      <label>Multiple-Answers</label>
    </div>


    <div id="options" class="vote-sub">
      <?php
      foreach ($opts as $opt) {
      ?>
        <div>
          <label>Option:</label>
          <input class="vote-sub" type="text" name="option[<?= $opt['id']; ?>]" value="<?= $opt['option']; ?>">
          <!-- <button onclick="location.href='./api/delete_option.php'">delete option</button> -->
        </div>
      <?php
      }
      ?>
    </div>
    <div class="vote-sub">
      <input type="submit" class="logbtn" style="margin-top:1rem" value="Change">
    </div>
  </div>
</form>
<?php
foreach ($opts as $opt) {
?>
  <div>
    <label>Option:</label>
    <input class="vote-sub" type="text" name="option[<?= $opt['id']; ?>]" value="<?= $opt['option']; ?>">
    <button onclick="location.href='./api/delete_option.php?id=<?= $opt['id'] ?>&option=<?= $opt['option']; ?>&subject_id=<?= $opt['subject_id'] ?>&total=<?= $opt['total'] ?>'">delete option</button>
  </div>
<?php
}
?>

<script>
  function addOption() {
    let opt = `<div><label>Option:</label><input type="text" name="option[]"></div>`;
    let opts = document.getElementById('options').innerHTML;
    opts = opts + opt;
    document.getElementById('options').innerHTML = opts;
  }
</script>