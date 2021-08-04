<?php
define('_IN_JOHNCMS', 1);
$headmod = 'kplus';
$textl='MANAGER';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights<9) {
header('location: /index.php');
} else {
require('../header.php');

	?>
	<style>
.form-control {
height:30px;border:1px solid #999; border-radius:5px;	width:95%;padding:5px;margin:5px;
}
.memnutab {background:#F2F2F2;padding:5px;margin:4px}
</style>
	<style>
	label {font-weight:bold;margin:5px;}
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Duyệt thanh toán KPLUS</div>
</div>
<div style="background:white;padding:10px;">
<?php
 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `payk` WHERE `status` = 'pending'"), 0);
 
 if(isset($_POST['submit'])) {
	 $check=isset($_POST['check']) ? abs(intval($_POST['check'])) : 0;
	 $text = isset($_POST['text']) ? functions::checkin(mb_substr(trim($_POST['text']), 0, 5000)) : '';
	 $duyet = isset($_POST['duyet']) ? functions::checkin(mb_substr(trim($_POST['duyet']), 0, 100)) : 'ok';
	 $checkon=mysql_fetch_assoc(mysql_query("SELECT * FROM `payk` WHERE `id` = '".$check."'"));
	 
	 if($check==0 || !$checkon['id']) {
		$error[]='Empty ID'; 
	 }
	 if(empty($duyet) || empty($text)) {
		 $error[]='Empty content'; 
	 }
	 if(empty($error)) {
		 
	// cập nhật report
	$boxid=mysql_fetch_assoc(mysql_query("SELECT * FROM `report` WHERE `connect` = '".$check."'"));
	mysql_query("INSERT INTO report SET
		content = '".mysql_real_escape_string($text)."',
		uid_send = '".$user_id."',
		uid_nhan = '".$checkon['uid']."',
		time = '".time()."',
		id_box = '".$boxid['id']."',
		type = 'reply',
		comment = comment + 1");
		
	
	
		mysql_query("UPDATE report SET ad_read = 1, send_read = 0, comment = comment + 1, time_update = '".time()."' WHERE id = '".$boxid['id']."'");
	 
	 if($duyet=='ok') {
		 mysql_query("UPDATE `payk` SET
	`timeduyet` = '".time()."',
	`admin` = '".$user_id."',
	`status` = 'done'
	WHERE `id` = '".$checkon['id']."'");
	 mysql_query("UPDATE `log` SET `status` = 'done' WHERE `boxid` = '".$checkon['id']."'");
	 $note = 'Congratulations. K + payment request has been successful';
	 mysql_query("INSERT INTO `news` SET 
	 `time` = '".time()."',
	 color = '#A901DB',
	 `name` = '".$note."',
	 `text` = '".$note."',
	 `show` = 'on',
	 `type` = 'note',
	 `read` = '0',
	 `user` = '".$checkon['uid']."'");
	 ?>
	 
	 <div>Đã duyệt thẻ thành công!</div>
	 <?
	 } else {
		 mysql_query("UPDATE `payk` SET
	`timeduyet` = '".time()."',
	`admin` = '".$user_id."',
	`status` = 'dissagree'
	WHERE `id` = '".$checkon['id']."'");
		mysql_query("UPDATE `log` SET `status` = 'no' WHERE `boxid` = '".$checkon['id']."'");
		if($checkon['note']=='cash') {
		mysql_query("UPDATE `users` SET `coin` = `coin` + '".$checkon['pay']."' WHERE `id` = '".$checkon['userid']."'");
		}
		$note = 'Error! K + payment request has been declined, your balance will be refunded. Please check again';
	 mysql_query("INSERT INTO `news` SET 
	 `time` = '".time()."',
	 `name` = '".$note."',
	 `color` = 'red',
	 `text` = '".$note."',
	 `show` = 'on',
	 `type` = 'note',
	 `read` = '0',
	 `user` = '".$checkon['uid']."'");
	 ?><div>Đã từ chối duyệt yêu cầu mua thẻ này!</div><?
	 }
 } else {
	 ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	 
 }
 }
?>
<div style="text-align:center"><h4>Danh sách chờ (<? echo $total;?>)</h4></div>
<table style="border-collapse: collapse;width:100%;max-width:100%;">
<form method="post">
<tr>
<td class="bang">UID</td>
<td class="bang">Time</td>
<td class="bang">Gói cước</td>
<td class="bang">Code</td>
<td class="bang">Nạp</td>
<td class="bang">Thanh toán</td>
<td class="bang">Status</td>
<td class="bang">Duyệt</td>
</tr>

  <?php
	
	 $req=mysql_query("SELECT * FROM `payk` ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 $userfe=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['userid']."'"));
		 ?>
		 <tr>
        <td class="bang"><?php echo $userfe['id'];?></td>
        <td class="bang"><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td class="bang"><?php echo $res['gamename'];?></td>
		<td class="bang"><?php echo $res['code'];?></td>
		<td class="bang"><?php echo number_format($res['cash']);?></td>
		<td class="bang"><?php echo number_format($res['pay']);?></td>
		<td class="bang"><?php echo $res['status'];?></td>
		<td class="bang"><? if($res['status']!=='done' && $res['status']!=='dissagree') { ?><input type="radio" name="check" value="<?echo $res['id'];?>"/> <? } ?></td>
      </tr>
		
		 
		 <?php
	 $i++; } ?>

</table>

<div style="padding:10px;">
<select name="duyet">
<option value="ok">Duyệt</option>
<option value="no">Từ chối</option>
</select>
<br>
<textarea style="width:100%;padding:5px;height:70px;" value="" name="text" placeholder="Nội dung gửi kèm"></textarea>
<input type="submit" name="submit" value="Thực hiện" style="" class="cmt-to-login"/>
</form>
</div>
    <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	
</form>
</div>
<? } ?>

<h4 class="memnutab">Note</h4>

<div><i class="text-muted">Ngay khi yêu cầu mua tiền sẽ bị trừ, nếu không duyệt yêu cầu tiền sẽ hoàn lại tài khoản.</div>

</div>



</div>
<?php require('../incfiles/end.php');?>
<?php } ?>





























