<?php
define('_IN_JOHNCMS', 1);
$headmod = 'payinternet';
$textl='Pay Internet';
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Pay Internet</div>
<div style="background-image:url('/sr/img/bg3.jpg');text-align:left;;padding:10px;">
<?
switch($act) {
	default:
	?>
<h4 style="height:25px;padding:5px;font-weight:normal;">Thanh toán Internet Viettel</h4>
<form method="post"  action="payinternet.php?act=auth" class="">
<select name="game" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">Viettel (ADSL/FTTH/NexTV)</option>

</select>
<h4 style="height:25px;padding:5px;font-weight:normal;">Phương thức thanh toán</h4>
<select name="payment" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">Main cash</option>
<option value="2">Banking ATM</option>
</select>

<h4 style="height:25px;padding:5px;font-weight:normal;">Mã khách hàng</h4>
<input type="text" value="" placeholder="Liên hệ Viettel để lấy mã khách hàng" style="width:100%;height:40px;" name="code"/>

<h4 style="height:25px;padding:5px;font-weight:normal;">Nhập số tiền cần thanh toán <span style="color:#ff00ff;text-lign:right">(Số tiền thanh toán phải là bội chẵn, nếu có thể vui lòng làm tròn số dư. Số dư tháng này sẽ được hoàn trừ vào tháng sau)</span></h4>
<input type="text" id="one"  value="0" placeholder="" style="width:100%;height:40px;" name="cash"/>
<input type="hidden" id="two" name="two" value="0" placeholder="" style="float:right;width:40%;height:30px;" >
<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpayinternet_on']=='on') { ?>
		three.value = src.value-((src.value/100)*10);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
<div style="clear:both;"></div>



<h4 style="height:25px;padding:5px;font-weight:normal;">Tổng tiền thanh toán</h4>
Giảm 10% khi thanh toán cước hóa đơn Internet tại Earntmoney.com
<input type="text" id="three"  value="0" placeholder="" style="width:100%;height:40px;" name="three"/>
<table style="width:100%">
<tr style="width:100%">
<td style="text-align:center;margin:auto;width:50%">
Mã giảm giá
<div style="border:1px solid #999;height:170;width:170;text-align:center">
<?php if($set['kmpayinternet_on']=='on') { ?>
<h2 style="color:#ff00ff;">-10%</h2>
<? } else { ?>
<h2 style="color:#ff00ff;">No coupon</h2>
<? } ?>
Viettel Internet<br>
Dịch vụ Viettel

</div>

</td>

<td style="text-align:center;margin:auto;width:50%">
<span style="color:yellow;text-align:center;margin:auto"></span><br/>

<button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
</form>
</td>

</tr>


</table>
<? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['kmpayinternet_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'kmpayinternet_on'");
		  echo '<div style="color:green">update success</div>'; 
	  }
	  ?>
	  COUPON
	  <form method="post" action="payinternet.php">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="kmpayinternet_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
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
$gamename = 'Viettel (ADSL/FTTH/NexTV)';



if($set['kmpayinternet_on']=='on') {
	$pay=$cash-(($cash/100)*10);
} else {
	$pay=$cash;
}
$coin=$cash/1000;
if(empty($code)) {
	$error[]='Chưa nhập mã khách hàng';
}
if(empty($cash) || $cash<=0) {
	$error[]='Bạn chưa nhập số tiền cần thanh toán '.$coin.'';
}
if(empty($game) || $game<=0) {
	$error[]='You need select package';
}
if(empty($payment) || $payment<1 && $payment>2) {
	$error[]='You need select payment';
}
if($cash>$usermain['coin'] || $cash<=0 || $pay<=0) {
	$error[]='Bạn không đủ số dư: '.$coin.'';
}
if(empty($error)) {

if($payment==1) {

	?>
	<h2>THANH TOÁN INTERNET</h2>
	<?
	if(isset($_POST['submitok'])) {
$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 1;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$gamename = 'Viettel (ADSL/FTTH/NexTV)';
if($set['kmpayinternet_on']=='on') {
	$pay=$cash-(($cash/100)*10);
	$percentsale=10;
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
		mysql_query("INSERT INTO `payinternet` SET
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
	$reportlog='user: '.$user_id.' pay internet main cash: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'payinternet',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$pay."',
			namecard = '".mysql_real_escape_string($gamename)."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
	
	} else {?>
	Bạn đã chọn gói: <?php echo $gamename;?> <? echo number_format($cash);?>đ<br> Tổng tiền thanh toán: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	<br>Tiền mặt chính: <?php echo number_format($usermain['coin']);?><?php echo $set['donvi']; ?> - <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	
	<?
	if($usermain['coin']>=$cash) {
		?><span style="color:#ff00ff">(đủ trả)</span><?
	} else {
		?><span style="color:blue">(không đủ trả)</span><?
	}
	?>
	<br>CODE: <?php echo $code;?><br>
	<center>Nhấp để xác nhận yêu cầu cho giao dịch trên<form method="post"  action="payinternet.php?act=auth" class="">
	<input type="hidden" name="cash" value="<? echo $cash; ?>"/>
	<input type="hidden" name="pay" value="<? echo $pay; ?>"/>
	<input type="hidden" name="code" value="<? echo $code; ?>"/>
	<input type="hidden" name="game" value="<? echo $game; ?>"/>
	<input type="hidden" name="payment" value="<? echo $payment; ?>"/>
	<input type="hidden" name="gamename" value="<? echo $gamename['name']; ?>"/>
	<button type="image" name="submitok" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button></center>
</form>
	<? } ?>
<div style="color:#ffff00">Vui lòng kiểm tra cẩn thận thông tin trước khi thực hiện giao dịch.Sẽ không thể hoàn lại tiền khi yêu cầu của bạn được gửi.</div>
	<?
} elseif($payment==2) {
	
	?>
	<h2>PAY INTERNET WITH BANKING ATM</h2>
	<?
	if(isset($_POST['submitok'])) { 
	
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 1;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$gamename = 'Viettel (ADSL/FTTH/NexTV)';
if($set['kmpayinternet_on']=='on') {
	$pay=$cash-(($cash/100)*10);
	$percentsale=10;
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
	
		mysql_query("INSERT INTO `payinternet` SET
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
	$reportlog='user: '.$user_id.' pay internet ATM: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'payinternet',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$pay."',
			namecard = '".mysql_real_escape_string($gamename)."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
	} else {?>
	You have selected package: <?php echo $gamename;?>; CASH: <? echo number_format($cash);?>; Total pay: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>

	<br>CODE: <?php echo $code;?><br>
	<div style="border: 1px dashed #999;padding:5px;margin:10px;">
	<div style="color:#ff00ff;font-weight:bold">TPBANK - STK: 02312920601 NGUYEN DANG LAN</div>
	<div style="">
	<li>Carefully check the content before making a transfer</li>
	<li>Need payment: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>. Content: ID:<? echo $usermain['id'];?> DK<? echo ceil($coin);?></li>
	</div>
	</div>
	<center>Click to confirm the request for the above transaction<form method="post"  action="payinternet.php?act=auth" class="">
	<input type="hidden" name="cash" value="<? echo $cash; ?>"/>
	<input type="hidden" name="pay" value="<? echo $pay; ?>"/>
	<input type="hidden" name="code" value="<? echo $code; ?>"/>
	<input type="hidden" name="game" value="<? echo $game; ?>"/>
	<input type="hidden" name="payment" value="<? echo $payment; ?>"/>
	<input type="hidden" name="gamename" value="<? echo $gamename['name']; ?>"/>
	<button type="image" name="submitok" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button></center></form>
	<? } ?>
<div style="color:#ffff00">Vui lòng kiểm tra cẩn thận thông tin trước khi thực hiện giao dịch.Sẽ không thể hoàn lại tiền khi yêu cầu của bạn được gửi.</div>
	<?
} else {
	?>
	
	
	<h2>PAY INTERNET</h2>
	
<div style="color:#ffff00">Vui lòng kiểm tra cẩn thận thông tin trước khi thực hiện giao dịch.Sẽ không thể hoàn lại tiền khi yêu cầu của bạn được gửi.</div>

<?
}
} else {
	
	?>
	
	
	<h2>THANH TOÁN INTERNET</h2>
	<div><ion-icon name="bug-outline"></ion-icon> Gặp lỗi nên không thể tiếp tục ...</div>
	<div>
		<?php echo functions::display_error($error); ?>
		<a class="cmt-to-login" href="/payinternet.php">Thanh toán lại</a>
		</div>
<div style="color:#ffff00">Vui lòng kiểm tra cẩn thận thông tin trước khi thực hiện giao dịch.Sẽ không thể hoàn lại tiền khi yêu cầu của bạn được gửi.</div>

<?
}
break;
} 




?></div></div>	<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

