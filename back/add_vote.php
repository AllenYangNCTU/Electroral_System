<!-- 新增表單傳送到處理頁面 -->
<form action="./api/add_vote.php" method="post">
  <div style="margin:1rem 20rem">
  <!-- 做分類 -->
  <div>
    <select name="types" id="types">
      <?php
      $types=all("types");
      foreach($types as $type){
        echo "<option value='{$type['id']}'>";
        echo $type['name'];
        echo "</option>";
      }
      ?>
    </select>
  </div>
  <!-- 投票項目及主題 -->

  <div class="vote-sub">
    <label for="subject">投票主題:</label>
    <input type="text" name="subject" id="subject">
    <input type="button" value="新增選項" onclick="addOption()"> <!-- 點下這個按鈕 執行addOption的內容 -->
  </div>
  <div id="selector"  class="vote-sub">
    <input type="radio" name="multiple" value="0" checked>
    <label>單選</label>
    <input type="radio" name="multiple" value="1">
    <label>複選</label>
  </div>
  <div id="options"  class="vote-sub">
    <div>
      <label>選項:</label>
      <input type="text" name="option[]">
    </div>
  </div>

  
  <div  class="vote-sub">
      <input type="submit" class="logbtn" value="新增">
    </div>
  </div>

</form>

<script>
  function addOption(){
    let opt=`<div><label>選項:</label><input type="text" name="option[]"></div>`;
    let opts=document.getElementById('options').innerHTML;//取得ID為option的HTML節點 增加 並改變他
    opts=opts+opt;
    document.getElementById('options').innerHTML=opts;
  }
</script>