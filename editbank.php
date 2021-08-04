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
	<img src="/sr/img/image021.png" height="20"/> Liên Kết Ngân Hàng
	<? } else { ?>
	
	<img src="/sr/img/image021.png" height="20"/> <? echo $usermain['bank'];?>
	<? } ?>
	</div>


	<?

if($usermain['xacthuc']==1 || $usermain['yeucauxacthuc']==1) {
	?>
	 <div><input type="text" name="bank" placeholder="Name of the international bank" value="<? echo $usermain['bank'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;" disabled></div>
	<?
	
} else {
	if(isset($_POST['videoadmin'])) {
		$bank = isset($_POST['bank']) ? functions::checkin(mb_substr(trim($_POST['bank']), 0, 100)) : '';
	$stk = isset($_POST['stk']) ? functions::checkin(mb_substr(trim($_POST['stk']), 0, 20)) : '';
	$namebank = isset($_POST['namebank']) ? functions::checkin(mb_substr(trim($_POST['namebank']), 0, 100)) : '';
	$bankcode = isset($_POST['bankcode']) ? functions::checkin(mb_substr(trim($_POST['bankcode']), 0, 100)) : '';
	$idbank = isset($_POST['idbank']) ? functions::checkin(mb_substr(trim($_POST['idbank']), 0, 100)) : '';
		if (mb_strlen($bank) < 0 || mb_strlen($bank) > 100) {
            $error[] = 'Your bank account is required, up to 100 characters';
	}
	if (mb_strlen($stk) < 0 || mb_strlen($stk) > 100) {
            $error[] = 'Your bank account is required, up to 100 characters';
	}
	if (mb_strlen($namebank) < 0 || mb_strlen($namebank) > 100) {
            $error[] = 'Your bank account is required, up to 100 characters';
	}
	
	$countbank1=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `stk` = '".$stk."' AND `id` != '".$usermain['id']."' AND `xacthuc` = '1'"),0);
	if($countbank1>0) {
		$error[] = 'Số tài khoản này đã được liên kết ';
	}
	
	
$countbank=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `bank` = '".mysql_real_escape_string($bank)."' AND `stk` = '".mysql_real_escape_string($stk)."' AND `namebank` = '".mysql_real_escape_string($namebank)."' AND `xacthuc` = '1'"),0);
	if(!empty($bank) && !empty($stk) && !empty($namebank) && $countbank>1) {
		$error[] = 'This ID Bank exceeds 1 registered accounts';
	}
	if (!$error) {
		mysql_query("UPDATE users SET
		bank = '".mysql_real_escape_string($bank)."',
		stk = '".mysql_real_escape_string($stk)."',
		namebank = '".mysql_real_escape_string($namebank)."',
		bankcode = '".mysql_real_escape_string($bankcode)."',
		idbank = '".mysql_real_escape_string($idbank)."',
		changebank = 1
		WHERE id = '".$user_id."'");
		
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
	  <input type="text" name="bank" placeholder="Tên ngân hàng quốc tế" value="<? echo $usermain['bank'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>
	  <input type="text" name="stk" placeholder="Số tài khoản" value="<? echo $usermain['stk'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>
	 <!-- <input type="text" name="bankcode" placeholder=" Mã Swift code" value="<? echo $usermain['bankcode'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>-->
	 <input type="text" name="namebank" placeholder="Tên chủ tài khoản" value="<? echo $usermain['namebank'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>
	 <!--<input type="text" name="idbank" placeholder="IDentity Card" value="<? echo $usermain['idbank'];?>" style="width:90%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;"/>-->
	  <div style="width:90%;padding:5px;background:#f2f2f2;color:black;margin:5px;text-align:left;"><b style="color:red">Lưu ý</b> :Vui lòng cập nhật thông tin tài khoản chính xác.
Không thể thay đổi mục này sau khi tài khoản được xác minh				
</div>
	  <button name="videoadmin" class="cmt-to-login" style="color:white;background:orange;border:0px; width:150px;">Update</button></center>
	  </form>

<?php
}

require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>
