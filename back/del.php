<?php
$subj = find("subjects", $_GET['id']);
?>
<div class="confirm" style="width:500px;margin:1rem auto;padding:2rem;">
  <h2 style="text-align: center;color:red; margin-bottom:2rem">Do you sure to delete this topic?</h2>
  <div style="margin-top: 2rem;">Topic：</div>
  <div style="font-size:1.5rem;text-align:center;"><?= $subj['subject']; ?></div>
  <br>
  <br>
  <div>
    <button class="logbtn" onclick="location.href='./api/del.php?table=subjects&id=<?= $_GET['id']; ?>'">Confirm to Delete</button>
  </div>
</div>