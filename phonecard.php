<?php
define('_IN_JOHNCMS', 1);
$headmod = 'paycard';
$textl='Phone recharge card';
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Nạp thẻ điện thoại</div>
<div style="background-image:url('/sr/img/bg3.jpg');text-align:left;;padding:10px;">
<?
switch($act) {
	default:
	?>
	<table style="width:100%"><tr style="width:100%"><td style="width:50%">
<h4 style="height:25px;padding:5px;font-weight:normal;">Chọn nhà mạng</h4>
<form method="post"  action="phonecard.php?act=auth" class="">
<select name="game" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">Viettel</option>
<option value="2">Vinaphone</option>
<option value="3">Mobifone</option>

</select>
</td><td style="width:50%">

<h4 style="height:25px;padding:5px;font-weight:normal;">Số tiền cần nạp <span style="color:#ff00ff;text-lign:right">(Tối thiểu. 20.000đ)</span></h4>
<input type="text" id="one"  value="0" placeholder="" style="width:100%;height:40px;" name="cash"/>
<input type="hidden" id="two" name="two" value="0" placeholder="" style="float:right;width:40%;height:30px;" >
<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpaycard_on']=='on') { ?>
		three.value = src.value-((src.value/100)*5);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
</td></tr><tr style="width:100%"><td style="width:50%">
<h4 style="height:25px;padding:5px;font-weight:normal;">Chọn phương thức thanh toán</h4>
<select name="payment" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">Tiền chính</option>
<option value="2">Internet Banking ATM</option>
</select>
</td>

<td style="width:50%">
<h4 style="height:25px;padding:5px;font-weight:normal;">Số điện thoại cần nạp</h4>
<input type="text" value="" placeholder="Số điện thoại" style="width:100%;height:40px;" name="code"/>

</td></tr>
</table>

<div style="clear:both;"></div>


<center>
<h4 style="height:25px;padding:5px;font-weight:normal;">Tổng thanh toán</h4>
<?php if($set['kmpaycard_on']=='on') { ?>
Giảm 5% khi nạp tiền điện thoại tại EarntMoney.com
<? } ?>
<input type="text" id="three"  value="0" placeholder="" style="width:60%;height:40px;" name="three"/><br>
<button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
</center>


</form>

<? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['kmpaycard_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'kmpaycard_on'");
		  echo '<div style="color:green">update success</div>'; 
	  }
	  ?>
	  COUPON
	  <form method="post" action="phonecard.php">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="kmpaycard_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }?>
 
 


<? 
break;
case 'auth':

$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 1;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';




if($set['kmpaycard_on']=='on') {
	$pay=$cash-(($cash/100)*5);
} else {
	$pay=$cash;
}
$coin=$cash/1000;


if(empty($game) || $game<1 || $game>3) {
	$error[]='Package not true';
}
if(empty($code)) {
	$error[]='Bạn chưa nhập số điện thoại cần nạp';
}
if(empty($cash) || $cash<=0) {
	$error[]='Số tiền cần nạp không hợp lệ '.$coin.'';
}
if(empty($game) || $game<=0) {
	$error[]='You need select package';
}
if(empty($payment) || $payment<1 && $payment>2) {
	$error[]='Bạn cần chọn thanh toán';
}
if($cash>$usermain['coin'] || $cash<=0 || $pay<=0) {
	$error[]='Tài khoản của bạn không đủ số dư: '.$coin.'';
}
if(empty($error)) {
	if($game==1) {
	$gamename="Viettel";
}
if($game==2) {
	$gamename="Vinaphone";
}
if($game==3) {
	$gamename="Mobifone";
}

if($payment==1) {

	?>
	<h2>NẠP THẺ ĐIỆN THOẠI</h2>
	<?
	if(isset($_POST['submitok'])) {
$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 0;
if($set['kmpaycard_on']=='on') {
	$pay=$cash-(($cash/100)*5);
	$percentsale=5;
	$sale=$cash-$pay;
} else {
	$pay=$cash;
	$percentsale=0;
	$sale=$cash-$pay;
}
$coin=$cash/1000;
?>
	
	<div style=""><ion-icon name="mail-outline"></ion-icon> Your request to execute your transaction has been sent</div>
	
	
	<?
	mysql_query("UPDATE `users` SET `coin` = `coin` - '".$pay."' WHERE `id` = '".$user_id."'");
		mysql_query("INSERT INTO `paycard` SET
		`userid` = '".$usermain['id']."',
		`username` = '".mysql_real_escape_string($login)."',
		`gameid` = '".$game."',
		`gamename` = '".mysql_real_escape_string($gamename)."',
		`time` = '".time()."',
		`payment` = '".$payment."',
		`cash` = '".$cash."',
		`pay` = '".$pay."',
		`sale` = '".$sale."',
		`percentsale` = '".$percentsale."',
		`code` = '".mysql_real_escape_string($code)."',
		`note` = 'cash',
		`status` = 'pending'");
	$idnewog=mysql_insert_id();
		
		
	
			
	// ghi log
	$reportlog='user: '.$user_id.' pay phone card cash: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'payphonecard',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$pay."',
			namecard = '".mysql_real_escape_string($gamename)."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
	} else {?>
	Bạn đã chọn gói: <?php echo $gamename;?>: <? echo number_format($cash);?>đ<br> Tổng tiền cần thanh toán: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	<br>Tiền chính hiện có: <?php echo number_format($usermain['coin']);?><?php echo $set['donvi']; ?> - <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	
	<?
	if($usermain['coin']>=$cash) {
		?><span style="color:#ff00ff">(số dư đủ trả)</span><?
	} else {
		?><span style="color:blue">(not enough to pay)</span><?
	}
	?>
	<br>Số điện thoại: <?php echo $code;?><br>
	<center>Nhấp để xác nhận yêu cầu cho giao dịch trên<form method="post"  action="phonecard.php?act=auth" class="">
	<input type="hidden" name="cash" value="<? echo $cash; ?>"/>
	<input type="hidden" name="pay" value="<? echo $pay; ?>"/>
	<input type="hidden" name="code" value="<? echo $code; ?>"/>
	<input type="hidden" name="game" value="<? echo $game; ?>"/>
	<input type="hidden" name="payment" value="1"/>
	<input type="hidden" name="gamename" value="<? echo $gamename; ?>"/>
	<button type="image" name="submitok" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button></center>
</form>
	<? } ?>
<div style="color:#ffff00">Vui lòng kiểm tra đúng số điện thoại đối với nhà mạng Vina và Mobi số tiền nạp tối thiểu là 50.000đ. Yêu cầu sẽ được sử lý ngay khi bạn hoàn tất thanh toán.</div>
	<?
} elseif($payment==2) {
	
	?>
	<h2>PAY PHONE CARD WITH BANKING ATM</h2>
	<?
	if(isset($_POST['submitok'])) { 
	
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 0;
if($set['kmpaycard_on']=='on') {
	$pay=$cash-(($cash/100)*5);
	$percentsale=5;
	$sale=$cash-$pay;
} else {
	$pay=$cash;
	$percentsale=0;
	$sale=$cash-$pay;
}
$coin=$cash/1000;
?>
	
	<div style=""><ion-icon name="mail-outline"></ion-icon> Your request to execute your transaction has been sent</div>
	
	
	<?
		mysql_query("INSERT INTO `paycard` SET
		`userid` = '".$usermain['id']."',
		`username` = '".mysql_real_escape_string($login)."',
		`gameid` = '".$game."',
		`gamename` = '".mysql_real_escape_string($gamename)."',
		`time` = '".time()."',
		`payment` = '".$payment."',
		`cash` = '".$cash."',
		`pay` = '".$pay."',
		`sale` = '".$sale."',
		`percentsale` = '".$percentsale."',
		`code` = '".mysql_real_escape_string($code)."',
		`note` = 'atm',
		`status` = 'pending'");
				$idnewog=mysql_insert_id();
		
		
	
	
			
	// ghi log
	$reportlog='user: '.$user_id.' pay phone card ATM: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'payphonecard',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$pay."',
			namecard = '".mysql_real_escape_string($gamename)."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
	} else {?>
	You have selected package: <?php echo $gamename;?>; CASH: <? echo number_format($cash);?>; Total pay: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>

	<br>PHONE NUMBER: <?php echo $code;?><br>
	<div style="border: 1px dashed #999;padding:5px;margin:10px;">
	<div style="color:#ff00ff;font-weight:bold">Comercial Join Stock Bank TPBank - STK: 02312920601 NGUYEN DANG LAN</div>
	<div style="">
	<li>Carefully check the content before making a transfer</li>
	<li>Need payment: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>. Content: ID:<? echo $usermain['id'];?> Phone Recharge <? echo ceil($coin);?>k.</li>
	</div>
	</div>
	<center>Click to confirm the request for the above transaction<form method="post"  action="phonecard.php?act=auth" class="">
	<input type="hidden" name="cash" value="<? echo $cash; ?>"/>
	<input type="hidden" name="pay" value="<? echo $pay; ?>"/>
	<input type="hidden" name="code" value="<? echo $code; ?>"/>
	<input type="hidden" name="payment" value="2"/>
	<input type="hidden" name="game" value="<? echo $game; ?>"/>
	<input type="hidden" name="gamename" value="<? echo $gamename; ?>"/>
	<button type="image" name="submitok" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button></center></form>
	<? } ?>
<div style="color:#ffff00">Vui lòng kiểm tra đúng số điện thoại đối với nhà mạng Vina và Mobi số tiền nạp tối thiểu là 50.000đ. Yêu cầu sẽ được sử lý ngay khi bạn hoàn tất thanh toán.</div>
	<?
} else {
	?>
	
	
	<h2>Nạp tiền điện thoại</h2>
	
<div style="color:#ffff00">Vui lòng kiểm tra đúng số điện thoại đối với nhà mạng Vina và Mobi số tiền nạp tối thiểu là 50.000đ. Yêu cầu sẽ được sử lý ngay khi bạn hoàn tất thanh toán.</div>

<?
}
} else {
	
	?>
	
	
	<h2>NẠP TIỀN ĐIỆN THOẠI</h2>
	<div><ion-icon name="bug-outline"></ion-icon> Gặp lỗi nên không thể tiếp tục...</div>
	<div>
		<?php echo functions::display_error($error); ?>
		<a class="cmt-to-login" href="/phonecard.php">Nạp lại</a>
		</div>
<div style="color:#ffff00">Vui lòng kiểm tra đúng số điện thoại đối với nhà mạng Vina và Mobi số tiền nạp tối thiểu là 50.000đ. Yêu cầu sẽ được sử lý ngay khi bạn hoàn tất thanh toán.</div>

<?
}
break;
} 




?></div></div>	<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

