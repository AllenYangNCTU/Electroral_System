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
      <label for="subject">投票主題:</label>
      <input type="text" name="subject" id="subject" value="<?= $subj['subject']; ?>">
      <input type="button" value="新增選項" onclick="addOption()"><br><br>
      <label for="">開始時間:</label>
      <input type="date" name="start" value="<?= $subj['start']; ?>" id=""><br><br>
      <label for="">結束時間:</label>
      <input type="date" name="end" value="<?= $subj['end']; ?>" id="">
      <input type="hidden" name="subject_id" value="<?= $subj['id']; ?>">
    </div>
    <div id="selector" class="vote-sub">
      <input type="radio" name="multiple" value="0" <?= ($subj['multiple'] == 0) ? 'checked' : ''; ?>>
      <label>單選</label>
      <input type="radio" name="multiple" value="1" <?= ($subj['multiple'] == 1) ? 'checked' : ''; ?>>
      <label>複選</label>
    </div>
    <div id="options" class="vote-sub">
      <?php
      foreach ($opts as $opt) {
      ?>
        <div>
          <label>選項:</label>
          <input class="vote-sub" type="text" name="option[<?= $opt['id']; ?>]" value="<?= $opt['option']; ?>">
        </div>
      <?php
      }
      ?>
    </div>
    <div class="vote-sub">
      <input type="submit" class="logbtn" style="margin-top:1rem" value="變更">
    </div>
  </div>
</form>

<script>
  function addOption() {
    let opt = `<div><label>選項:</label><input type="text" name="option[]"></div>`;
    let opts = document.getElementById('options').innerHTML;
    opts = opts + opt;
    document.getElementById('options').innerHTML = opts;
  }
</script>