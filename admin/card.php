<?php
define('_IN_JOHNCMS', 1);
$headmod = 'video';
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Duyệt mua thẻ cào</div>
</div>
<div style="background:white;padding:10px;">
<?php
 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `muacard` WHERE `status` = 'pending'"), 0);

?>
<div style="color:#000;font-weight:bold;font-size:20px;text-align:center;background:#8000FF;height:28px;">Duyệt mua thẻ cào</div>
	<table style="border:1px solid #8000FF;width:100%;"><tr>
	<td style="border:1px solid #8000FF;width:50%;"><img src="/sr/img/Picture2.png"/> Danh sách chờ(<? echo $total; ?>)</td>
	</tr></table>
	
	
<?php
if(isset($_POST['submit'])) {
	$gift = isset($_POST['check']) ? intval($_POST['check']) : 0;
	
	$cehg=mysql_fetch_assoc(mysql_query("SELECT * FROM `muacard` WHERE `id` = '".$gift."'"));
	if ($cehg['id']<=0 || empty($cehg['id'])) {
            $error[] = 'Error id empty';
	}
	
	if ($rights<9) {
            $error[] = 'Error user';
	}
	if ($cehg['status']!='pending') {
            $error[] = 'Yêu cầu này không đang chờ duyệt';
	}

	if (!$error) {
		
		mysql_query("UPDATE `muacard` SET
		`status` = 'done',
		`timeduyet` = '".time()."'
		WHERE `id` = '".$cehg['id']."'");
		
		
		$textnote='Congratulations. You have successfully redeemed scratch cards, check your gift cards.';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$cehg['uid']."'");
		
		 mysql_query("UPDATE `log` SET `status` = 'done' WHERE `boxid` = '".$cehg['id']."'");
	 for($a=1;$a<=$cehg['amount'];$a++) {
		 if(isset($_POST['code-'.$cehg['id'].'-'.$a.''])) {
		 mysql_query("INSERT INTO `datamuacard` SET
		 `hethanthe` = '".mysql_real_escape_string($_POST['hethanthe-'.$cehg['id'].'-'.$a.''])."',
		`code` = '".mysql_real_escape_string($_POST['code-'.$cehg['id'].'-'.$a.''])."',
		`seri` = '".mysql_real_escape_string($_POST['seri-'.$cehg['id'].'-'.$a.''])."',
		`time` = '".time()."',
		`idmuacard` = '".$cehg['id']."',
		`userid` = '".$cehg['uid']."',
		`network` = '".$cehg['network']."',
		`card` = '".$cehg['card']."',
		`cash` = '".$cehg['cash']."'
		");

	 }}
		?>
		<div class="alert alert-success" style="color:green;text-align:center;" role="alert">
		Duyệt thẻ thành công, thẻ được chuyển đến phần quà của user.
		</div>
		
		<?php
		
		
		
	} else { ?>
	
	<div class="alert alert-danger" style="color:red;text-align:center;" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
?>
	<form method="post">
<?
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `muacard` WHERE `status` = 'pending' AND `code` = ''"),0);
$gif=mysql_query("SELECT * FROM `muacard` WHERE `status` = 'pending' AND `code` = '' ORDER BY `id` DESC LIMIT $start, $kmess");
$i=1;
while($gift=mysql_fetch_assoc($gif)) {
	?>
	<div style="margin:5px;padding:5px;border:dotted 1px #333;"><input type="radio" value="<? echo $gift['id'];?>" name="check"/> Loại thẻ: <? echo $gift['network'];?> <? echo $gift['card'];?>K - 
	Tài khoản yêu cầu <?php echo $gift['uid'];?>
	<br>Thời gian yêu cầu: <? echo date("H:i:s - d/m/y",$gift['time']+$set['timeshift']*3600);?><br>
	Trạng thái: <? echo $gift['status'];?>
	<br>Số lượng:  <? echo $gift['amount'];?>
	<br>
	<?
	for($a=1;$a<=$gift['amount'];$a++) { ?>
<div>Thẻ số <? echo $a; ?> <? echo $gift['network'];?> <? echo $gift['card'];?>K<br><b>Mã thẻ</b> 
<input type="text" value="" style="border:1px solid #999;height:20px;margin:5px;" name="code-<? echo $gift['id'];?>-<?php echo $a; ?>"/> <b>Seri</b> 
	<input type="text" value="" style="border:1px solid #999;height:20px;margin:5px;" name="seri-<? echo $gift['id'];?>-<?php echo $a; ?>"/>
	 <b>Ngày hết hạn</b> <input type="text" style="border:1px solid #999;height:20px;margin:5px;width:80px;" value="" name="hethanthe-<? echo $gift['id'];?>-<?php echo $a; ?>"/></div>
	<? } ?>
	 </div>
	
	<?
	++$i;
	
}

?>
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>
<input style="margin:7px;background:#04B431;border-radius:10px;" type="submit" name="submit" class="cmt-to-login" value="Duyệt gửi thông tin thẻ"/></form>
	</div>
	
	
	
	
	


</div>



<?php require('../incfiles/end.php');?>
<?php } ?>





























