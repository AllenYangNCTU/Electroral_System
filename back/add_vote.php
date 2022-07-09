<!-- 新增表單傳送到處理頁面 -->
<form action="./api/add_vote.php" method="post">
  <div style="margin:1rem 20rem">
    <div>
      <select name="types" id="types">
        <?php
        $types = all("types");
        foreach ($types as $type) {
          echo "<option value='{$type['id']}'>";
          echo $type['name'];
          echo "</option>";
        }
        ?>
      </select>
    </div>
    <div class="vote-sub">
      <label for="subject">投票主題:</label>
      <input type="text" name="subject" id="subject">
      <input type="button" value="新增選項" onclick="addOption()"><br><br>
      <label for="">開始日期:</label>
      <input type="date" name="start" value="2022-01-01" id=""><br><br>
      <label for="">開始時間:</label>
      <input type="time" name="starttime" value="00:01:00.000" id=""><br><br>
      <label for="">結束日期:</label>
      <input type="date" name="end" value="2022-12-31" id=""><br><br>
      <label for="">結束時間:</label>
      <input type="time" name="endtime" value="00:02:00.000" id=""><br><br>
      <label for="">年齡限制:</label>
      <input type="number" name="agelimit" value="18" id=""><br><br>
      <label for="">年齡限制:</label>
      <input type="number" name="agelimit_below" value="" id=""><br><br>
    </div>
    <div id="selector" class="vote-sub">
      <input type="radio" name="multiple" value="0" checked>
      <label>單選</label>
      <input type="radio" name="multiple" value="1">
      <label>複選</label>
    </div>
    <div id="options" class="vote-sub">
      <div>
        <label>選項:</label>
        <input type="text" name="option[]">
      </div>
    </div>


    <div class="vote-sub">
      <input type="submit" class="logbtn" value="新增">
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