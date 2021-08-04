<?php
define('_IN_JOHNCMS', 1);
$headmod = 'payk';
$textl='Pay K+';
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Pay K+</div>
<div style="background-image:url('/sr/img/bg3.jpg');text-align:left;;padding:10px;">
<?
switch($act) {
	default:
	?>
<h4 style="height:25px;padding:5px;font-weight:normal;">Extend K +</h4>
<form method="post"  action="payk.php?act=auth" class="">
<select name="game" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">1 month (145K)</option>
<option value="2">2 months (290K)</option>
<option value="3">3 months (435K)</option>
<option value="4">6 months (870K)</option>
<option value="5">1 year (1500K)</option>

</select>
<h4 style="height:25px;padding:5px;font-weight:normal;">Payments</h4>
<select name="payment" style="width:100%;height:40px;background:#000;color:#fff;">
<option value="1">Main cash</option>
<option value="2">Banking ATM</option>
</select>

<h4 style="height:25px;padding:5px;font-weight:normal;">Subscription code</h4>
<input type="text" value="" placeholder="Subscription code" style="width:100%;height:40px;" name="code"/>

<h4 style="height:25px;padding:5px;font-weight:normal;">Cash <span style="color:#ff00ff;text-lign:right">(Earntmoney)</span></h4>
<input type="text" id="one"  value="0" placeholder="" style="width:100%;height:40px;" name="cash"/>
<input type="hidden" id="two" name="two" value="0" placeholder="" style="float:right;width:40%;height:30px;" >
<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpayk_on']=='on') { ?>
		three.value = src.value-((src.value/100)*5);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
<div style="clear:both;"></div>



<h4 style="height:25px;padding:5px;font-weight:normal;">Total Pay</h4>
Discount 5% when depositing via Earntmoney.com
<input type="text" id="three"  value="0" placeholder="" style="width:100%;height:40px;" name="three"/>
<table style="width:100%">
<tr style="width:100%">
<td style="text-align:center;margin:auto;width:50%">
Coupon
<div style="border:1px solid #999;height:170;width:170;text-align:center">
<?php if($set['kmpayk_on']=='on') { ?>
<h2 style="color:#ff00ff;">-5%</h2>
<? } else { ?>
<h2 style="color:#ff00ff;">No coupon</h2>
<? } ?>
Earntmoney K+<br>
payment and entertainment

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
	  if(isset($_POST['kmpayk_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'kmpayk_on'");
		  echo '<div style="color:green">update success</div>'; 
	  }
	  ?>
	  COUPON
	  <form method="post" action="payk.php">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="kmpayk_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
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




if($set['kmpayk_on']=='on') {
	$pay=$cash-(($cash/100)*5);
} else {
	$pay=$cash;
}
$coin=$cash/1000;

if($game==1 && $cash!=145000) {
	$error[]='Cash not true with package';
}
if($game==2 && $cash!=290000) {
	$error[]='Cash not true with package';
}
if($game==3 && $cash!=435000) {
	$error[]='Cash not true with package';
}
if($game==4 && $cash!=870000) {
	$error[]='Cash not true with package';
}
if($game==5 && $cash!=1500000) {
	$error[]='Cash not true with package';
}
if(empty($code)) {
	$error[]='You need have CODE';
}
if(empty($cash) || $cash<=0) {
	$error[]='You need input Cash '.$coin.'';
}
if(empty($game) || $game<=0) {
	$error[]='You need select package';
}
if(empty($payment) || $payment<1 && $payment>2) {
	$error[]='You need select payment';
}
if($cash>$usermain['coin'] || $cash<=0 || $pay<=0) {
	$error[]='Overload coin: '.$coin.'';
}
if(empty($error)) {
	if($game==1) {
	$cash=145000;
	$gamename="1 month 145K";
}
if($game==2) {
	$cash=290000;
	$gamename="2 months 290K";
}
if($game==3) {
	$cash=435000;
	$gamename="3 months 435K";
}
if($game==4) {
	$cash=870000;
	$gamename="6 months 870K";
}
if($game==5) {
	$cash=1500000;
	$gamename="1 year 1500K";
}
if($payment==1) {

	?>
	<h2>PAY K+ WITH MAIN CASH</h2>
	<?
	if(isset($_POST['submitok'])) {
$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 1;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$gamename = isset($_POST['gamename']) ? functions::checkin(mb_substr(trim($_POST['gamename']), 0, 200)) : '';
if($set['kmpayk_on']=='on') {
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
		mysql_query("INSERT INTO `payk` SET
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
	$reportlog='user: '.$user_id.' pay k+ main cash: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'payk',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$pay."',
			namecard = '".mysql_real_escape_string($gamename)."',
			log = '".$reportlog."',
			boxid = '".$idnewog."',
			status = 'pending',
			box = '".$user_id."'");
	} else {?>
	You have selected package: <?php echo $gamename;?>; CASH: <? echo number_format($cash);?>; Total pay: <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	<br>Main cash: <?php echo number_format($usermain['coin']);?><?php echo $set['donvi']; ?> - <? echo number_format(ceil($pay));?><? echo $set['donvi'];?>
	
	<?
	if($usermain['coin']>=$cash) {
		?><span style="color:#ff00ff">(enough to pay)</span><?
	} else {
		?><span style="color:blue">(not enough to pay)</span><?
	}
	?>
	<br>CODE: <?php echo $code;?><br>
	<center>Click to confirm the request for the above transaction<form method="post"  action="payk.php?act=auth" class="">
	<input type="hidden" name="cash" value="<? echo $cash; ?>"/>
	<input type="hidden" name="pay" value="<? echo $pay; ?>"/>
	<input type="hidden" name="code" value="<? echo $code; ?>"/>
	<input type="hidden" name="game" value="<? echo $game; ?>"/>
	<input type="hidden" name="payment" value="<? echo $payment; ?>"/>
	<input type="hidden" name="gamename" value="<? echo $gamename; ?>"/>
	<button type="image" name="submitok" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button></center>
</form>
	<? } ?>
<div style="color:#ffff00">admin will approve the transaction and subtract your main account balance at the time of transaction approval.</div>
	<?
} elseif($payment==2) {
	
	?>
	<h2>PAY K+ WITH BANKING ATM</h2>
	<?
	if(isset($_POST['submitok'])) { 
	
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
$game=isset($_POST['game']) ? abs(intval($_POST['game'])) : 0;
$payment=isset($_POST['payment']) ? abs(intval($_POST['payment'])) : 1;
$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
$gamename = isset($_POST['gamename']) ? functions::checkin(mb_substr(trim($_POST['gamename']), 0, 200)) : '';
if($set['kmpayk_on']=='on') {
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
	
		mysql_query("INSERT INTO `payk` SET
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
	$reportlog='user: '.$user_id.' pay k+ ATM: '.mysql_real_escape_string($gamename).': payment: '.$payment.', cash: '.$cash.', pay: '.$pay.', sale: '.$sale.', percentsale: '.$percentsale.', code: '.$code.'';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'payk',
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
	<center>Click to confirm the request for the above transaction<form method="post"  action="payk.php?act=auth" class="">
	<input type="hidden" name="cash" value="<? echo $cash; ?>"/>
	<input type="hidden" name="pay" value="<? echo $pay; ?>"/>
	<input type="hidden" name="code" value="<? echo $code; ?>"/>
	<input type="hidden" name="game" value="<? echo $game; ?>"/>
	<input type="hidden" name="payment" value="<? echo $payment; ?>"/>
	<input type="hidden" name="gamename" value="<? echo $gamename; ?>"/>
	<button type="image" name="submitok" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button></center></form>
	<? } ?>
<div style="color:#ffff00">admin will approve the transaction and subtract your main account balance at the time of transaction approval.</div>
	<?
} else {
	?>
	
	
	<h2>PAY K+</h2>
	
<div style="color:#ffff00">admin will approve the transaction and subtract your main account balance at the time of transaction approval.</div>

<?
}
} else {
	
	?>
	
	
	<h2>PAY K+</h2>
	<div><ion-icon name="bug-outline"></ion-icon> Have error so can not continue...</div>
	<div>
		<?php echo functions::display_error($error); ?>
		<a class="cmt-to-login" href="/payk.php">Retry</a>
		</div>
<div style="color:#ffff00">admin will approve the transaction and subtract your main account balance at the time of transaction approval.</div>

<?
}
break;
} 




?></div></div>	<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

