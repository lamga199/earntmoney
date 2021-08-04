<?php
define('_IN_JOHNCMS', 1);
$headmod = 'paygame';
$textl='Pay Games';
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Pay Games</div>
<div style="background-image:url('/sr/img/bg3.jpg');text-align:left;;padding:10px;">
<?
switch($act) {
	default:
	?>
<h4 style="height:25px;padding:5px;font-weight:normal;">Chọn GAME cần nạp Viettel (sms 9029)</h4>
<form method="post"  action="paygame.php?act=auth" class="">
<select name="game" style="width:100%;height:40px;background:#000;color:#fff;">
<?php
$games=mysql_query("SELECT * FROM game ORDER BY `id` ASC");
while($game=mysql_fetch_assoc($games)) { ?>
	<option value="<?php echo $game['id'];?>"><?php echo $game['name'];?></option>
<?php
}

?>

</select>
<h4 style="height:25px;padding:5px;font-weight:normal;">PHƯƠNG THỨC THANH TOÁN</h4>
<select name="payment" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">Tiền chính</option>
<option value="2">Internet Banking ATM</option>
</select>

<h4 style="height:25px;padding:5px;font-weight:normal;">MÃ CODE vui lòng kiểm tra tại napthe.vn</h4>
<input type="text" value="" placeholder="Ví dụ:GARENA DK10 LQ 4906000131523105700" style="width:100%;height:40px;" name="code"/>

<h4 style="height:25px;padding:5px;font-weight:normal;"> SỐ TIỀN CẦN NẠP <span style="color:#ff00ff;text-lign:right">(Mênh giá đầu chữ GARENA DK10 = 10.000<?php echo $set['donvi'];?>)</span></h4>
<input type="text" id="one"  value="0đ" placeholder="" style="width:100%;height:40px;" name="cash"/>
<input type="hidden" id="two" name="two" value="0" placeholder="" style="float:right;width:40%;height:30px;" >
<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpaygame_on']=='on') { ?>
		three.value = src.value-((src.value/100)*12);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
<div style="clear:both;"></div>
<span style="color:red">Tối thiểu 10.000<?php echo $set['donvi'];?> - Tối đa 500.000<?php echo $set['donvi'];?></span>


<h4 style="height:25px;padding:5px;font-weight:normal;">Tổng tiền thanh toán</h4>
Giảm 12% khi nạp GAME tại EarntMoney.com
<input type="text" id="three"  value="0" placeholder="" style="width:100%;height:40px;" name="three"/>
<table style="width:100%">
<tr style="width:100%">
<td style="text-align:center;margin:auto;width:50%">
mã giảm giá
<div style="border:1px solid #999;height:170;width:170;text-align:center">
<?php if($set['kmpaygame_on']=='on') { ?>
<h2 style="color:#ff00ff;">-12%</h2>
<? } else { ?>
<h2 style="color:#ff00ff;">No coupon</h2>
<? } ?>
Nạp game qua Earntmoney.com<br>
Tối đa 500.000<?php echo $set['donvi'];?>/giao dịch.

</div>

</td>

<td style="text-align:center;margin:auto;width:50%">
<span style="color:yellow;text-align:center;margin:auto">Kiểm tra mã Code của bạn tại trang web: <a href="https://napthe.vn">napthe.vn</a> </span><br/>

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
	  if(isset($_POST['kmpaygame_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'kmpaygame_on'");
		  echo '<div style="color:green">update success</div>'; 
	  }
	  ?>
	  COUPON
	  <form method="post" action="paygame.php">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="kmpaygame_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
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

if($set['kmpaygame_on']=='on') {
	$pay=$cash-(($cash/100)*12);
} else {
	$pay=$cash;
}
$coin=$cash/1000;
$gamename=mysql_fetch_assoc(mysql_query("SELECT * FROM game WHERE `id` = '".$game."'"));
if(empty($code)) {
	$error[]='Chưa nhập CODE nạp GAME vui lòng kiểm tra tại napthe.vn';
}
if(empty($cash) || $cash<=0) {
	$error[]='Chưa nhập số tiền cần nạp '.$coin.'';
}
if(empty($game) || $game<=0) {
	$error[]='You need select game';
}
if(empty($payment) || $payment<1 && $payment>2) {
	$error[]='You need select payment';
}
if($cash>$usermain['coin'] || $cash<=0 || $pay<=0) {
	$error[]='Sai số tiền: '.$coin.'';
}
if(empty($error)) {
if($payment==1) {

	?>
	<h2>NẠP GAME QUA NHÀ CUNG CẤP VIETTEL</h2>
	<?
	if(isset($_POST['submitok'])) {
$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 0;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$gamename = isset($_POST['gamename']) ? functions::checkin(mb_substr(trim($_POST['gamename']), 0, 200)) : '';
if($set['kmpaygame_on']=='on') {
	$pay=$cash-(($cash/100)*12);
	$percentsale=12;
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
		mysql_query("INSERT INTO `paygame` SET
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
	$reportlog='user: '.$user_id.' pay game main cash: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'paygame',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$pay."',
			namecard = '".mysql_real_escape_string($gamename)."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
	} else {?>
	Bạn đã chọn thanh toán game: <?php echo $gamename['name'];?> <? echo number_format($cash);?>đ<br> Tổng tiền thanh toán: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	<br>Tiền mặt chính: <?php echo number_format($usermain['coin']);?><?php echo $set['donvi']; ?> - <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	
	<?
	if($usermain['coin']>=$cash) {
		?><span style="color:#ff00ff">(đủ trả)</span><?
	} else {
		?><span style="color:blue">(not enough to pay)</span><?
	}
	?>
	<br>CODE: <?php echo $code;?><br>
	<center>Nhấp để xác nhận yêu cầu cho giao dịch trên<form method="post"  action="paygame.php?act=auth" class="">
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
<div style="color:#ffff00">Vui lòng kiểm tra cẩn thận trước khi giao dịch số dư không thể hoàn trả khi yêu cầu đã được xác nhận.</div>
	<?
} elseif($payment==2) {
	
	?>
	<h2>NẠP GAME TRẢ QUA INTERNET BACKING</h2>
	<?
	if(isset($_POST['submitok'])) { 
	
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 0;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$gamename = isset($_POST['gamename']) ? functions::checkin(mb_substr(trim($_POST['gamename']), 0, 200)) : '';
if($set['kmpaygame_on']=='on') {
	$pay=$cash-(($cash/100)*12);
	$percentsale=12;
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
	
		mysql_query("INSERT INTO `paygame` SET
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
		
	
		
	
			
	// ghi log
	$reportlog='user: '.$user_id.' pay game ATM: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'paygame',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$pay."',
			namecard = '".mysql_real_escape_string($gamename)."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
			
	} else {?>
	Bạn đã chọn thanh toán GAME: <?php echo $gamename['name'];?> <? echo number_format($cash)?>đ <br> Tổng tiền thanh toán: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>

	<br>CODE: <?php echo $code;?><br>
	<div style="border: 1px dashed #999;padding:5px;margin:10px;">
	<div style="color:#ff00ff;font-weight:bold">Ngân hàng TMCP TPBank - STK: 02312920601 NGUYEN DANG LAN</div>
	<div style="">
	<li>Carefully check the content before making a transfer</li>
	<li>Số tiền cần thanh toán: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>. Nội dung: ID:<? echo $usermain['id'];?> DK<? echo ceil($coin);?></li>
	</div>
	</div>
	<center>Nhấp để xác nhận yêu cầu cho giao dịch trên<form method="post"  action="paygame.php?act=auth" class="">
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
<div style="color:#ffff00">Vui lòng kiểm tra kỹ trước khi thực hiện. Số dư không thể hoàn khi yêu cầu được gửi.</div>
	<?
} else {
	?>
	
	
	<h2>NẠP GAME</h2>
	
<div style="color:#ffff00">>Vui lòng kiểm tra kỹ trước khi thực hiện. Số dư không thể hoàn khi yêu cầu được gửi.</div>

<?
}
} else {
	
	?>
	
	
	<h2>PAY GAME</h2>
	<div><ion-icon name="bug-outline"></ion-icon> Gặp lỗi nên không thể tiếp tục...</div>
	<div>
		<?php echo functions::display_error($error); ?>
		<a class="cmt-to-login" href="/paygame.php">Retry</a>
		</div>
<div style="color:#ffff00">>Vui lòng kiểm tra kỹ trước khi thực hiện. Số dư không thể hoàn khi yêu cầu được gửi.</div>

<?
}
break;
} 




?></div></div>	<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

