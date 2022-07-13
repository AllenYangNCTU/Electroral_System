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

      <label for="subject">Topic:</label>
      <input type="text" name="subject" id="subject">

      <input type="button" value="Add option" onclick="addOption()"><br><br>

      <label for="">Start Date:</label>
      <input type="date" name="start" value="2022-01-01" id=""><br><br>


      <label for="">Start Time:</label>
      <input type="time" name="starttime" value="00:01:00.000" id=""><br><br>

      <label for="">End Date:</label>
      <input type="date" name="end" value="2022-12-31" id=""><br><br>

      <label for="">End Time:</label>
      <input type="time" name="endtime" value="00:02:00.000" id=""><br><br>

      <label for="">Age lower limit:</label>
      <input type="number" name="agelimit" value="18" id=""><br><br>

      <label for="">Age upper limit:</label>
      <input type="number" name="agelimit_below" value="120" id=""><br><br>

    </div>
    <div id="selector" class="vote-sub">
      <input type="radio" name="multiple" value="0" checked>
      <label>Multiple-choice</label>

      <input type="radio" name="multiple" value="1">
      <label>Multiple-Answers</label>

    </div>
    <div id="options" class="vote-sub">
      <div>
        <label>Option:</label>
        <input type="text" name="option[]">
      </div>
    </div>


    <div class="vote-sub">
      <input type="submit" class="logbtn" value="Add new topic">
    </div>
  </div>

</form>

<script>
  function addOption() {
    let opt = `<div><label>Option:</label><input type="text" name="option[]"></div>`;
    let opts = document.getElementById('options').innerHTML;
    opts = opts + opt;
    document.getElementById('options').innerHTML = opts;
  }
</script>