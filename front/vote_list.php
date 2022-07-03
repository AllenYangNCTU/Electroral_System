<?php
$p="";
if(isset($_GET['p'])){
  $p="&p={$_GET['p']}";
}
$querystr="";
if(isset($_GET['order'])){
  $querystr="&order={$_GET['order']}&type={$_GET['type']}";
}

$queryfilter="";
if(isset($_GET['filter'])){
  $queryfilter="&filter={$_GET['filter']}";
}

?>
<h1>投票列表</h1>
<!-- 分類 -->
<div id="list">
  <label for="types">分類</label>
    <select name="types" id="types" onchange="location.href=`?filter=${this.value}<?=$p;?><?=$querystr;?>`">
      <option value="0">全部</option>
      <?php
      $types=all("types");
      foreach($types as $type){
        $selected=(isset($_GET['filter']) && $_GET['filter']==$type['id'])?'selected':'';
        echo "<option value='{$type['id']}' $selected>";
        echo $type['name'];
        echo "</option>";
      }
      ?>
    </select>
  </div>

  <!-- 投票列表 -->
    <div>
  <ul class="list">
    <li class="list-header">
      <div>投票主題：</div>
      <!-- 單複選題排序 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
      <div><a href="?order=multiple&type=desc<?=$p;?><?=$queryfilter?>">單/複選題：</a></div>
      <?php
      } else {
      ?>
      <div><a href="?order=multiple&type=asc<?=$p;?><?=$queryfilter?>">單/複選題：</a></div>
      <?php
      }
      ?>

      <!-- 投票期間排序 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
      <div><a href="?order=end&type=desc<?=$p;?><?=$queryfilter?>">投票期間：</a></div>
      <?php
      } else {
      ?>
      <div><a href="?order=end&type=asc<?=$p;?><?=$queryfilter?>">投票期間：</a></div>
      <?php
      }
      ?>

      <!-- 剩餘天數排序 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
      <div><a href="?order=remain&type=desc<?=$p;?><?=$queryfilter?>">剩餘天數：</a></div>
      <?php
      }else{
      ?>
      <div><a href="?order=remain&type=asc<?=$p;?><?=$queryfilter?>">剩餘天數：</a></div>
      <?php
      }
      ?>

      <!-- 投票人數作排序 -->
      <?php
      if (isset($_GET['type']) && $_GET['type'] == 'asc') {
      ?>
        <div><a href='?order=total&type=desc<?=$p;?><?=$queryfilter?>'>投票人數：</a></div>
      <?php
      } else {
      ?>
        <div><a href='?order=total&type=asc<?=$p;?><?=$queryfilter?>'>投票人數：</a></div>
      <?php
      }
      ?>
      <!-- 投票人數排序結束 -->
    </li>
    <?php
    // 偵測是否需要排序
    $orderStr = '';
    if (isset($_GET['order'])) {
      $_SESSION['order']['col'] = $_GET['order'];
      $_SESSION['order']['type'] = $_GET['type'];

      if($_GET['order']=='remain'){
        $orderStr = "ORDER BY DATEDIFF(`end`,now()) {$_SESSION['order']['type']}";
      }else{
        $orderStr = "ORDER BY `{$_SESSION['order']['col']}` {$_SESSION['order']['type']}";
      }
    }
    // 建立分業所需的變數群
        
    $filter=[];
    if(isset($_GET['filter'])){
      if(!$_GET['filter']==0){
        $filter=['type_id'=>$_GET['filter']];
      }
    }

    $total= math('subjects','count','id',$filter);
    $div=10;//每頁有幾筆資料
    $pages=ceil($total/$div);//總頁數
    $now=isset($_GET['p'])?$_GET['p']:1;//如果沒有其他頁數就顯示第一頁
    $start=($now-1)*$div;
    $page_rows=" limit $start,$div";

    $subjects = all('subjects',$filter, $orderStr . $page_rows); //取得所有投票列表
    foreach ($subjects as $subject) { //使用迴圈印內容
      echo "<a href='?do=vote_result&id={$subject['id']}'>"; //要把投票帶去哪
      echo "<li class='list-items'>";
      echo "<div>{$subject['subject']}</div>"; //只取得欄位

      if ($subject['multiple'] == 0) {
        echo "<div class='text-center'>單選題</div>";
      } else {
        echo "<div class='text-center'>複選題</div>";
      }

      echo "<div class='text-center'>"; //投票開始與結束時間
      echo $subject['start'] . "~" . $subject['end'];
      echo "</div>";

      echo "<div class='text-center'>"; //投票剩餘天數
      $today = strtotime("now");
      $end = strtotime($subject['end']);
      if (($end - $today) > 0) { //如果投票還在進行
        $remain = floor(($end - $today) / (60 * 60 * 24));
        echo "倒數" . $remain . "天結束";
      } else { //如果投票已經截止
        echo "<span style='color:grey;'>投票已截止</span>";
      }
      echo "</div>";

      echo "<div class='text-center'>{$subject['total']}</div>"; //投票總人數
      echo "</li>";
      echo "</a>";
    }
    ?>

  </ul>
  <!-- 列表分頁頁碼 -->
    <div class="text-center">
      <?php
      if($pages > 1) {
        for($i=1;$i<=$pages;$i++){
          echo "<a href='?p={$i}{$querystr}{$queryfilter}'>&nbsp;";
          echo $i ;
          echo "&nbsp;</a>";
        }
      }

      ?>
    </div>
  
</div>