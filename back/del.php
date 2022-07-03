<?php
$subj=find("subjects",$_GET['id']);
?>

<div class="confirm" style="width:500px;margin:1rem auto;padding:2rem;">
  <h2 style="text-align: center;color:red; margin-bottom:2rem">你確定要刪除這份投票嗎</h2>
  <div style="margin-top: 2rem;">主題：</div>
  <div style="font-size:1.5rem;text-align:center;"><?=$subj['subject'];?></div>
  <br>
  <br>
  <div>
  <button class="logbtn" onclick="location.href='./api/del.php?table=subjects&id=<?=$_GET['id'];?>'">確定刪除</button>
    </div>
</div>