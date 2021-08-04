<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl='Paypal';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');

	?>
	<div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
	<?php require('uinfo.php');?>

<?php require('topmenu.php');?>
	<div style="color:#000;font-weight:bold;font-size:20px;text-align:center;background:#999;height:28px;">BANK</div>
	<div style="color:orange;font-weight:bold;font-size:20px;text-align:center;background:#fff;height:28px;border-bottom:3px solid #999">
	<? if(empty($usermain['paypal'])) { ?>
	<img src="/sr/img/image005.png" height="20"/> Liên kết PayPal
	
	<img src="/sr/img/image005.png" height="20"/> <? echo $usermain['paypal'];?>
	<? } ?>
	</div>
	

	<?php if(empty($usermain['paypal'])) {?>
	<div style="color:#999;text-align:center">
	<img src="/sr/img/image005.png" height="50"/><br>Bạn không có tài khoản PayPal
	</div>
	<? } ?>
	<?
	if(isset($_POST['videoadmin'])) {
		
		$paypal = isset($_POST['name']) ? functions::checkin(mb_substr(trim($_POST['name']), 0, 100)) : '';
		$paypalid = isset($_POST['paypalid']) ? functions::checkin(mb_substr(trim($_POST['paypalid']), 0, 100)) : '';
		$paypalfullname = isset($_POST['paypalfullname']) ? functions::checkin(mb_substr(trim($_POST['paypalfullname']), 0, 100)) : '';
		if (mb_strlen($paypal) < 0 || mb_strlen($paypal) > 100) {
            $error[] = 'Paypal is only from 0 to 100 characters';
		}
		if (mb_strlen($paypalfullname) < 0 || mb_strlen($paypalfullname) > 100) {
           // $error[] = 'Paypal full name is only from 0 to 100 characters';
		}
	$countcmnd=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `paypal` = '".mysql_real_escape_string($paypal)."' AND `id` != '".$usermain['id']."' AND `xacthuc` = '1'"),0);
	if($countcmnd>=1) {
		$error[] = 'Email này đã được dùng cho một tài khoản khác';
	}
	if($usermain['xacthuc']==1) {
		$error[] = 'This account is authenticated';
	}
	if (!$error) {
		mysql_query("UPDATE `users` SET 
		`paypal` = '".mysql_real_escape_string($paypal)."',
		`paypalid` = '".mysql_real_escape_string($paypalid)."',
		`paypalfullname` = '".mysql_real_escape_string($paypalfullname)."'
		WHERE `id` = '".$usermain['id']."'");
		header('location: /uploadcmnd.php');
		?>
		
		
		<?php
	} else {
		
		?>
	
	<div class="alert alert-danger" role="alert" style="color:red;text-align:center;">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	}
	}

	?>
	 <form method="post">
<center>
	  <? if($usermain['xacthuc']==0 && $usermain['yeucauxacthuc']==0) { ?>
	  <input type="text" name="name" placeholder="Email PayPal" value="<? echo $usermain['paypal'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>
	  <!--<input type="text" name="paypalid" placeholder="IDentily card" value="<? echo $usermain['paypalid'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>
	  <input type="text" name="paypalfullname" placeholder="Fullname of account holder" value="<? echo $usermain['paypalfullname'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>-->
	  <? } else { ?>
	 <input type="text" name="name" placeholder="Via paypal mail" value="<? echo $usermain['paypal'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;" disabled>
	 <!-- <input type="text" name="paypalid" placeholder="IDentily card" value="<? echo $usermain['paypalid'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;" disabled>
	  <input type="text" name="paypalfullname" placeholder="Fullname of account holder" value="<? echo $usermain['paypalfullname'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;" disabled>-->
	  <? } ?><? if($usermain['xacthuc']==0 && $usermain['yeucauxacthuc']==0) { ?>
	  <div style="width:90%;padding:5px;background:#f2f2f2;color:black;margin:5px;text-align:left;"><b style="color:red">Lưu ý</b> : Nếu bạn không có tài khoản PayPal hãy nhập Email của bạn.			
</div>
	  <button name="videoadmin" class="cmt-to-login" style="color:white;background:orange;border:0px; width:150px;">Update</button></center>
	  <? } ?></form>

<?php

require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>
