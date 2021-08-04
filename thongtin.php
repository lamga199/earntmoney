<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl='Information';
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
	

	
	<?
	if(isset($_POST['submit'])) {
	$name = isset($_POST['hoten']) ? functions::checkin(mb_substr(trim($_POST['hoten']), 0, 100)) : '';
	$mibile = isset($_POST['sdt']) ? functions::checkin(mb_substr(trim($_POST['sdt']), 0, 20)) : '';
	$mail = isset($_POST['mail']) ? functions::checkin(mb_substr(trim($_POST['mail']), 0, 100)) : '';
	$namsinh = isset($_POST['namsinh']) ? intval($_POST['namsinh']) : 0;
	$paypal = isset($_POST['paypal']) ? functions::checkin(mb_substr(trim($_POST['paypal']), 0, 100)) : '';
	$live = isset($_POST['live']) ? functions::checkin(mb_substr(trim($_POST['live']), 0, 100)) : '';
	$ngaysinh = isset($_POST['ngaysinh']) ? functions::checkin(mb_substr(trim($_POST['ngaysinh']), 0, 100)) : '';
	$thangsinh = isset($_POST['thangsinh']) ? functions::checkin(mb_substr(trim($_POST['thangsinh']), 0, 100)) : '';
	$live = isset($_POST['live']) ? functions::checkin(mb_substr(trim($_POST['live']), 0, 100)) : '';
	$cmnd = isset($_POST['cmnd']) ? functions::checkin(mb_substr(trim($_POST['cmnd']), 0, 100)) : '';
	$ngaycmnd = isset($_POST['ngaycmnd']) ? functions::checkin(mb_substr(trim($_POST['ngaycmnd']), 0, 100)) : '';
	$thangcmnd = isset($_POST['thangcmnd']) ? functions::checkin(mb_substr(trim($_POST['thangcmnd']), 0, 100)) : '';
	$namcmnd = isset($_POST['namcmnd']) ? functions::checkin(mb_substr(trim($_POST['namcmnd']), 0, 100)) : '';
	$noicapcmnd = isset($_POST['noicapcmnd']) ? functions::checkin(mb_substr(trim($_POST['noicapcmnd']), 0, 100)) : '';
	$city = isset($_POST['city']) ? functions::checkin(mb_substr(trim($_POST['city']), 0, 100)) : '';
	$duong = isset($_POST['duong']) ? functions::checkin(mb_substr(trim($_POST['duong']), 0, 100)) : '';
		if (mb_strlen($cmnd) <= 0 || mb_strlen($cmnd) > 100) {
            $error[] = 'Your IDentity Card account is required, up to 100 characters';
	}
	if(empty($ngaycmnd) || empty($thangcmnd) || empty($namcmnd)) {
		$error[] = 'Your date of IDentity Card empty';
	} else {
		$ngaycapcmnd=''.$ngaycmnd.'/'.$thangcmnd.'/'.$namcmnd.'';
	}
	
	if(empty($cmnd)) {
		$error[] = 'Your IDentity Card empty';
	}
	if (mb_strlen($ngaycapcmnd) <= 0 || mb_strlen($ngaycapcmnd) > 100) {
            $error[] = 'Your date account is required, up to 100 characters';
	}
	if (mb_strlen($noicapcmnd) <= 0 || mb_strlen($noicapcmnd) > 100) {
            $error[] = 'Your location account is required, up to 100 characters';
	}
	$countcmnd=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `cmnd` = '".$cmnd."'"),0);
	if(!empty($cmnd) && $countcmnd>3) {
		$error[] = 'This ID number exceeds 3 registered accounts';
	}
	if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $error[] = 'Full names exceed 100 characters';
	}
	if (mb_strlen($mibile) < 9 || mb_strlen($mibile) > 15) {
            $error[] = 'Phone number is incorrect';
	}
	if (mb_strlen($mail) < 5 || mb_strlen($mail) > 100) {
            $error[] = 'Email not correct';
	}
	$countmail=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `mail` = '".mysql_real_escape_string($mail)."' AND `id` != '".$user_id."'"),0);
	if(!empty($countmail) && $countmail>0) {
		$error[] = 'This Email registered on website';
	}
	
	if ($namsinh < 1960 || $namsinh>=2020) {
            $error[] = 'Year of birth is incorrect';
	}
	if (mb_strlen($live) <= 0 || mb_strlen($live) > 100) {
            $error[] = 'Address up to 100 characters';
	}
	if (mb_strlen($city) <= 0 || mb_strlen($city) > 100) {
            $error[] = 'City not empty and up to 100 characters';
	}
	if (mb_strlen($duong) <= 0 || mb_strlen($duong) > 100) {
            $error[] = 'District not empty and up to 100 characters';
	}
	
	if($usermain['xacthuc']==1) {
		$error[] = 'This account is authenticated';
	}
	if (!$error) {
		
		mysql_query("UPDATE users SET
		imname = '".mysql_real_escape_string($name)."',
		mibile = '".mysql_real_escape_string($mibile)."',
		mail = '".mysql_real_escape_string($mail)."',
		cmnd = '".mysql_real_escape_string($cmnd)."',
		yearofbirth = '".mysql_real_escape_string($namsinh)."',
		live = '".mysql_real_escape_string($live)."',
		cmnd = '".mysql_real_escape_string($cmnd)."',
		ngaycapcmnd = '".mysql_real_escape_string($ngaycapcmnd)."',
		noicapcmnd = '".mysql_real_escape_string($noicapcmnd)."',
		ngaysinh = '".mysql_real_escape_string($ngaysinh)."',
		thangsinh = '".mysql_real_escape_string($thangsinh)."',
		city = '".mysql_real_escape_string($city)."',
		duong = '".mysql_real_escape_string($duong)."'
		WHERE id = '".$user_id."'");
		if($countcmnd==0) {
			mysql_query("UPDATE users SET `cmndfirst` = '1' WHERE `id` = '".$user_id."'");
		} else {
			mysql_query("UPDATE users SET `cmndfirst` = '0' WHERE `id` = '".$user_id."'");
		}
			// ghi log
	$reportlog='user: '.$user_id.' update profile';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'updateprofile',
			idtacdong = '".$id."',
			coin_bonus_add = '".$user_id."',
			log = '".$reportlog."',
			box = '".$user_id."'");
		header('location: /uploadcmnd.php');
	} else { ?>
	
	<div class="alert alert-danger" role="alert" style="color:red;text-align:center;">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
	?>
<div style="padding-left:10px;margin-top:10px;">
	  <form method="post" name="form" class="form-group">
	 <? if($usermain['xacthuc']==0) { ?>
<div style="padding-left:10px"><b>Họ Và Tên *</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="hoten" value="<?php echo $usermain['imname']; ?>" class="form-control"/></div>
<div style="padding-left:10px"><b>Ngày sinh</b><br>
<center>
<input style="width:40px;height:40px;border-radius:0px;border:1px solid #58ACFA;" type="text" id="1" maxlength="2" name="ngaysinh" value="<?php echo $usermain['ngaysinh']; ?>" class="form-control"/>
 / <input style="width:40px;height:40px;border-radius:0px;border:1px solid #58ACFA;" type="text" id="2" maxlength="2" name="thangsinh" value="<?php echo $usermain['thangsinh']; ?>" class="form-control"/>
 / <input style="width:40px;height:40px;border-radius:0px;border:1px solid #58ACFA;" type="text" id="3" maxlength="4" name="namsinh" value="<?php echo $usermain['yearofbirth']; ?>" class="form-control"/>
</center></div>
<script>
$(document).ready(function(){
    $('input').keyup(function(){
        if($(this).val().length==$(this).attr("maxlength")){
            var i = $('input').index(this);
            $('input').eq(i+1).focus();
        }
    });
});
</script>
<div style="padding-left:10px"><b>CMND,Thẻ căn cước</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="cmnd" value="<?php echo $usermain['cmnd']; ?>" class="form-control"/></div>
<div style="padding-left:10px"><b>Ngày cấp</b><br>
<?
$pieces = explode("/", $usermain['ngaycapcmnd']);

?><center>
<input style="width:40px;height:40px;border-radius:0px;border:1px solid #58ACFA;" type="text" maxlength="2" id="5" name="ngaycmnd" value="<?php echo $pieces[0]; ?>" class="form-control"/>
 / <input style="width:40px;height:40px;border-radius:0px;border:1px solid #58ACFA;" type="text" maxlength="2" id="6" name="thangcmnd" value="<?php echo $pieces[1]; ?>" class="form-control"/>
 / <input style="width:40px;height:40px;border-radius:0px;border:1px solid #58ACFA;" type="text" maxlength="4" id="7" name="namcmnd" value="<?php echo $pieces[2]; ?>" class="form-control"/>
</center></div>


<div style="padding-left:10px"><b>Nơi cấp</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="noicapcmnd" value="<?php echo $usermain['noicapcmnd']; ?>" class="form-control" ></div>
<div style="padding-left:10px"><b>E Mail</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="mail" value="<?php echo $usermain['mail']; ?>" class="form-control" ></div>


<div style="padding-left:10px"><b>Địa chỉ </b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="live" value="<?php echo $usermain['live']; ?>" class="form-control"></div>
<table style="margin:0 auto;">
<tr>
<td>
<div style="padding-left:10px"><b>Tỉnh/ thành phố </b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="city" value="<?php echo $usermain['city']; ?>" class="form-control"></div>
</td><td>/</td><td>
<div style="padding-left:10px"><b>Quận/Huyện </b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="duong" value="<?php echo $usermain['duong']; ?>" class="form-control"></div>
</td>
</tr></table>
<div style="padding-left:10px"><b>Số điện thoại</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="sdt" value="<?php echo $usermain['mibile']; ?>" class="form-control"></div>


	 <? } else {?>
<div style="padding-left:10px"><b>Fullname</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="hoten" value="<?php echo $usermain['imname']; ?>" class="form-control" disabled></div>
<div style="padding-left:10px"><b>Date of birth</b><br>

<input style="width:40px;border-radius:20px;border:1px solid #f2f2f2;" type="text" maxlength="2" name="ngaysinh" value="<?php echo $usermain['ngaysinh']; ?>" class="form-control"disabled>
 / <input style="width:40px;border-radius:20px;border:1px solid #f2f2f2;" type="text" maxlength="2" name="thangsinh" value="<?php echo $usermain['thangsinh']; ?>" class="form-control"disabled>
 / <input style="width:40px;border-radius:20px;border:1px solid #f2f2f2;" type="text" maxlength="4" name="namsinh" value="<?php echo $usermain['yearofbirth']; ?>" class="form-control"disabled></div>


<div style="padding-left:10px"><b>IDentity Card</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="cmnd" value="<?php echo $usermain['cmnd']; ?>" class="form-control"disabled></div>
<div style="padding-left:10px"><b>Liciense date</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="ngaycapcmnd" value="<?php echo $usermain['ngaycapcmnd']; ?>" class="form-control" disabled></div>
<div style="padding-left:10px"><b>Location</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="noicapcmnd" value="<?php echo $usermain['noicapcmnd']; ?>" class="form-control" disabled></div>
<div style="padding-left:10px"><b>Adress</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="live" value="<?php echo $usermain['live']; ?>" class="form-control" disabled></div>
<div style="padding-left:10px"><b>Phone</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="sdt" value="<?php echo $usermain['mibile']; ?>" class="form-control" disabled></div>

<div style="padding-left:10px"><b>Mail</b><br><input style="width:80%;border-radius:20px;border:1px solid #f2f2f2;" name="mail" value="<?php echo $usermain['mail']; ?>" class="form-control" disabled></div>

	 <? } ?>
<div style="padding-left:10px"></div>
<div style="padding-left:10px"><br>
<center>

<button style="background:#071418;color:white" class="cmt-to-login" type="submit" name="submit">Done</button>
</center>
</div></form>
<br><br>
</div>

<div style="clear:both"></div>
	
	
	
	</div>
<?php require('incfiles/end.php');?>
<?php } ?>
