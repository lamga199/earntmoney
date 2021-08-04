<?php
define('_IN_JOHNCMS', 1);
$headmod = 'card';
$textl='Card';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Card Exchange</div>
<div style="background-image:url('/sr/img/bg3.jpg');background-repeat:x;text-align:left;;padding:10px;">
<?

if(isset($_POST['submit'])) {
	$card=isset($_POST['card']) ? abs(intval($_POST['card'])) : 0;
	$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
	$amount=isset($_POST['amount']) ? abs(intval($_POST['amount'])) : 0;
	if($game==1) {
		$network='Viettel';	
		}
		if($game==2) {
		$network='Vinaphone';	
		}
		if($game==3) {
		$network='Mobifone';	
		}
	if($card<=0 || empty($card)) {
		$error[]='Can not empty card';
	}
	if($game<=0 || empty($game)) {
		$error[]='Can not empty network';
	}
	if($amount<=0 || empty($amount)) {
		$error[]='Không thể để trống số tiền';
	}
	$cash=($card*1000)*$amount;
	$pay=$cash;
	if($usermain['coin']<($pay)) {
		$error[]='Tài khoản của bạn không đủ số dư';
	}
	if($usermain['xacthuc']==0) {
		$error[]='Your account is not verified';
	}
	if($usermain['status']!=='actived') {
		$error[]='Tài khoản của bạn chưa được kích hoạt';
	}
	if(empty($error)) {
		mysql_query("UPDATE `users` SET `coin` = `coin` - '".$pay."' WHERE `id` = '".$user_id."'");
		
		mysql_query("INSERT INTO `muacard` SET
		`network` = '".mysql_real_escape_string($network)."',
		`card` = '".$card."',
		`cash` = '".$cash."',
		`pay` = '".$pay."',
		`uid` = '".$usermain['id']."',
		`time` = '".time()."',
		`amount` = '".$amount."',
		`status` = 'pending'");
		$idnewog=mysql_insert_id();
		
		// ghi log
	$reportlog='user: '.$user_id.' buy card: '.mysql_real_escape_string($network).': type card: '.$card.', cash: '.$cash.', pay: '.$pay.', amount: '.$amount.'.';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'buycard',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$cash."',
			namecard = '".mysql_real_escape_string($network)."',
			typecard = '".$card."',
			amount = '".$amount."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
		?>
		<div style=""><ion-icon name="mail-outline"></ion-icon> Yêu cầu đổi thẻ thành công:<br>
		Nhà mạng: <? echo $network;?>, Số lượng: <? echo $amount;?> x Mệnh giá: <? echo number_format($cash);?> = <? echo number_format($pay);?>đ</div><br>
		<a class="cmt-to-login" href="/card.php">Retry</a>
		<div style="color:#ffff00">Thẻ cào sau khi đổi sẽ nằm ở mục Thẻ Của Tôi.</div>
		<?
		
	} else {
		?>
		<div>
		<?php echo functions::display_error($error); ?><br>
		Yêu cầu của bạn không thành công, hãy thử lại<br>
		Nhà mạng: <? echo $network;?>, Số lượng: <? echo $amount;?> x Mệnh giá: <? echo number_format($cash);?> = <? echo number_format($pay);?>đ
		<a class="cmt-to-login" href="/card.php">Retry</a>
		</div>
		<div style="color:#ffff00">Thẻ cào sau khi đổi sẽ nằm ở mục Thẻ Của Tôi.</div>
		<?
	}
} else {
?>




<form method="post"  class="">
<table style="width:100%">
<tr>
<td style="width:50%">
Chọn nhà mạng<br>
<select name="game" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">Viettel</option>
<option value="2">Vinaphone</option>
<option value="3">Mobifone</option>
</select>
</td>
<td style="width:50%">
Số lượng<br>
<input name="amount" type="text" style="width:100%;height:40px;background:#000;color:#fff;" value="0"/>
</td>
</tr>
<tr><td style="width:50%">
Chọn mệnh giá<br>
<select name="card" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="10">10.000</option>
<option value="20">20.000</option>
<option value="50">50.000</option>
<option value="100">100.000</option>
<option value="200">200.000</option>
<option value="500">500.000</option>
<option value="1000">1.000.000</option>
</select>
</td></tr>
</table>
<br>
<center>
<button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
</form>
</center>
<? } ?>
</div>
<div style="color:#ffff00">Hãy kiểm tra trong phần Đổi Thẻ Điện Thoại.</div>

<br>
</div>	<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

