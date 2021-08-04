<?php
define('_IN_JOHNCMS', 1);
$headmod = 'account';
$textl='Account';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#fff;color:#000">
<div style="background:#ff00ff;color:#fff;width:120px;padding:5px;margin:auto">Account</div>
</div>	<div style="background:#fff;text-align:left;;padding:10px; color:#000;">
<?php

?>




<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fe4a071df060f156a8fe2a7/1eqah5fhb';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->





<style>
.form-control {
height:30px;border:1px solid #999; border-radius:5px;	width:98%;padding:5px;
}
.memnutab {background:#F2F2F2;padding:5px;margin:4px}
</style>
<h2 style="background:#F3E2A9;padding:10px;margin:5px;color:black;text-align:center">Thông Tin</h2>
      <div style="padding-left:10px">
      <div style="text-align:left">
	  <table><tr><td>
<?php if(!empty($usermain['avatar'])) { ?>
    <img width="50" class="avatarcs" height="50" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="50" class="avatarcs" height="50" src="/sr/img/avt.png">
	  <?php } ?>
	  </td>
	  <td><b><?php echo $login;?>
	  </b><br>
	  <span style="color:grey;"><?php echo $usermain['mail'];?></span>
	  <br>
	  <? echo ($usermain['xacthuc']==1 ? '<b style="background:green;color:white;border-radius:10px;padding:1px 5px 1px 5px;">Đã xác thực</b>' : '<b style="border-radius:10px;padding:1px 5px 1px 5px;background:red;color:white;">Chưa xác thực</b>');?>
	  <div style="padding-left:10px"><a style="color:orange" href="?act=avt">Đổi ảnh đại diện</a></div>
	  
	  <!--<div style="padding-left:10px"><a style="color:orange" href="/thongtin.php">Change information</a></div>--><td></tr>
	  </table>
	  
	  
	  </div>
 
 
 
 
 <? if($set['admin_nhan_coin']!=$user_id || $rights<7) { ?>
 <? if($usermain['status']=='actived') { ?>
<div style="padding-left:10px"><label>Mã giới thiệu bạn bè</label><input name="refcode" id="refcode" value="<?php echo $set['homeurl'];?>/reg.php?id=<?php echo $usermain['id']; ?>" class="form-control"></div>
<script>
$('#refcode').click(function () {
    this.select();
});
</script>
 <? }} ?>
	  
	  <?
switch($act) {
	default:
	
	break;
	case 'avt':
	if(isset($_POST['submitavt'])) {
		$file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	  $expensions= array("gif","png");
		if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 500000){
         $errors[]='File size must be excately 500Kb';
      }
      if(empty($image))
		 $errors[]='No image file yet';
	  
	  $tenfile=substr(str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0 , 10);

if(!$error) {
	move_uploaded_file($file_tmp,"sr/avt/".$tenfile.".".$file_ext."");
	mysql_query("UPDATE `users` SET `avatar` = '".$tenfile.".".$file_ext."' WHERE `id` = '".$usermain['id']."'");
	// ghi log
	$reportlog='user: '.$user_id.' change avatar';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'changeavt',
			idtacdong = '".$id."',
			coin_bonus_add = '".$user_id."',
			log = '".$reportlog."',
			box = '".$user_id."'");
	echo "upload done <a href='?'>reload</a>";
		
	} else {
		?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	} } else {
	?>
	
	<div style="padding-left:10px">
	<form method="post" enctype="multipart/form-data">
	Select image to upload:
	<input type="file" name="image" id="image">
	<input type="submit" value="upload" name="submitavt" class="cmt-to-login">
</form>
	</div>
	
	
	<?
	}
	
	break;
	case 'info':
	if(isset($_POST['submit'])) {
	$name = isset($_POST['hoten']) ? functions::checkin(mb_substr(trim($_POST['hoten']), 0, 100)) : '';
	$mibile = isset($_POST['sdt']) ? functions::checkin(mb_substr(trim($_POST['sdt']), 0, 20)) : '';
	$namsinh = isset($_POST['namsinh']) ? intval($_POST['namsinh']) : 0;
	$paypal = isset($_POST['paypal']) ? functions::checkin(mb_substr(trim($_POST['paypal']), 0, 100)) : '';
	$cmnd = isset($_POST['cmnd']) ? functions::checkin(mb_substr(trim($_POST['cmnd']), 0, 100)) : '';
	$live = isset($_POST['live']) ? functions::checkin(mb_substr(trim($_POST['live']), 0, 100)) : '';
	
	if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $error[] = 'Full names exceed 100 characters';
	}
	if (mb_strlen($mibile) < 9 || mb_strlen($mibile) > 15) {
            $error[] = 'Phone number is incorrect';
	}
	if ($namsinh < 1960 || $namsinh>=2020) {
            $error[] = 'Year of birth is incorrect';
	}
	if (mb_strlen($live) < 0 || mb_strlen($live) > 100) {
            $error[] = 'Address up to 100 characters';
	}
	
	
	if($usermain['xacthuc']==1) {
		$error[] = 'This account is authenticated';
	}
	if (!$error) {
		mysql_query("UPDATE users SET
		imname = '".mysql_real_escape_string($name)."',
		mibile = '".mysql_real_escape_string($mibile)."',
		cmnd = '".mysql_real_escape_string($cmnd)."',
		yearofbirth = '".mysql_real_escape_string($namsinh)."',
		live = '".mysql_real_escape_string($live)."'
		WHERE id = '".$user_id."'");
		
			// ghi log
	$reportlog='user: '.$user_id.' update profile';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'updateprofile',
			idtacdong = '".$id."',
			coin_bonus_add = '".$user_id."',
			log = '".$reportlog."',
			box = '".$user_id."'");
		?>
		<div class="alert alert-success" role="alert" style="color:green;text-align:center;">
		Successful account information update! <a href="/account.php">Reload to see new information</a>
		</div>
		
		<?php
	} else { ?>
	
	<div class="alert alert-danger" role="alert" style="color:red;text-align:center;">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
	?>
<div style="padding-left:10px">
	  <form method="post" name="form" class="form-group">
	 <? if($usermain['xacthuc']==0) { ?>
<div style="padding-left:10px"><label>Fullname</label> <input name="hoten" value="<?php echo $usermain['imname']; ?>" class="form-control"/></div>
<div style="padding-left:10px"><label>Birth</label><input name="namsinh" value="<?php echo $usermain['yearofbirth']; ?>" class="form-control"/></div>
<div style="padding-left:10px"><label>Adress</label><input name="live" value="<?php echo $usermain['live']; ?>" class="form-control"/></div>
<div style="padding-left:10px"><label>Phone</label><input name="sdt" value="<?php echo $usermain['mibile']; ?>" class="form-control" ></div>
<div style="padding-left:10px"><label>Mail</label><input name="mail" value="<?php echo $usermain['mail']; ?>" class="form-control"></div>
	 <? } else {?>
<div style="padding-left:10px"><label>Fullname</label> <input name="hoten" value="<?php echo $usermain['imname']; ?>" class="form-control" disabled></div>
<div style="padding-left:10px"><label>Birth</label><input name="namsinh" value="<?php echo $usermain['yearofbirth']; ?>" class="form-control" disabled></div>
<div style="padding-left:10px"><label>Adress</label><input name="live" value="<?php echo $usermain['live']; ?>" class="form-control" disabled></div>
<div style="padding-left:10px"><label>Phone</label><input name="sdt" value="<?php echo $usermain['mibile']; ?>" class="form-control" disabled></div>

<div style="padding-left:10px"><label>Mail</label><input name="mail" value="<?php echo $usermain['mail']; ?>" class="form-control" ></div>
	 <? } ?>
<div style="padding-left:10px"></div>
<div style="padding-left:10px"><br><button class="cmt-to-login" type="submit" name="submit">Save</button></div></form>

</div>

<div style="clear:both"></div>

<? break;
} ?>
<br>
<h2 style="height:25px;background:#F3E2A9;padding:10px;margin:5px;color:black;text-align:center">Tiền Mặt Của Tôi</h2>
<table style="width:100%;font-weight:bold;">
<tr style="width:100%;color:green">
<td style="width:50%;">Tiền mặt chính:</td>
<td><?php echo number_format($usermain['coin']);?><?php echo $set['donvi']; ?></td>

</tr>
<tr style="width:100%;color:#FACC2E">
<td style="width:50%;">Tiền xem video:</td>
<td><?php echo number_format($usermain['videocoin']);?><?php echo $set['donvi']; ?></td>
<td><a href="/rut.php?act=video" class="cmt-to-login" style="color:white;background:#FACC2E;border:0px;;height:25px;">Rút tiền</td>
</tr>
<tr style="width:100%;color:#DF7401">
<td style="width:50%;">Tiền thưởng bạn bè:</td>
<td><?php echo number_format($usermain['coin_bonus']);?><?php echo $set['donvi']; ?></td>
<td><a href="/rut.php?act=diemdanh" class="cmt-to-login" style="color:white;background:#DF7401;border:0px;;height:25px;">Rút tiền</td>
</tr>
<tr style="width:100%;color:red">
<td style="width:50%;">Tiền thưởng 10%:</td>
<td><?php echo number_format($usermain['coin_lock']);?><?php echo $set['donvi']; ?></td>
<td><a href="/rut.php?act=bonus" class="cmt-to-login" style="color:white;background:red;border:0px;;height:25px;">Rút tiền</td>
</tr>
<? if($set['diemdanhngay']=='on') {?>
<tr style="width:100%;color:#F78181">
<td style="width:50%;">Bonus daily:</td>
<td><?php echo number_format($usermain['coinday']);?><?php echo $set['donvi']; ?></td>
<td><a href="/rut.php?act=daily" class="cmt-to-login" style="color:white;background:#F78181;border:0px;;height:25px;">Rút tiền</td>
</tr>
<? } ?>
</table>



<h2 style="height:25px;background:#F3E2A9;padding:10px;margin:5px;color:black;text-align:center" id="xacthuc">HỒ SƠ MẶC ĐỊNH</h2>

<div style="padding-left:10px">Account: <strong><?php echo $login;?></strong> - Status: <strong style="color:orange"><?php echo $usermain['status']; ?></strong> - ID: <strong style="color:black"><?php echo $usermain['id']; ?></strong></div>
<div style="padding-left:10px">Date register: <strong><?php echo date("H:i:s - d/m/Y",$usermain['datereg']+$set['timeshift']*3600);?></strong></div>
<div style="padding-left:10px">Date actived: <strong><?php echo date("H:i:s - d/m/Y",$usermain['timeactive']+$set['timeshift']*3600);?></strong></div>
<div style="padding-left:10px">ID Ref: <strong><?php echo $usermain['refid']; ?></strong></div>
<div style="padding-left:10px">ID Account active: <strong><?php echo $usermain['actid']; ?></strong></div>

<?
if($usermain['xacthuc']==0 && $usermain['yeucauxacthuc']==0) { ?>
<h4 class="memnutab">Xác minh tài khoản</h4>
<center>
<a href="/uploadcmnd.php"><img src="/sr/img/up2.png" height="70"/></a><br>
<i style="color:#999">Tải lên Thẻ căn cước của bạn, hoàn tất xác thực.</i><br><br>
<span style="color:#333">
Vui lòng thêm ảnh chụp Thẻ căn cước của bạn. Để tăng tính bảo mật cho mọi giao dịch. Và hoàn tất xác minh rằng tài khoản là của bạn.</span>
<br><button class="cmt-to-login" style="color:white;background:orange;border:0px"><a style="color:white;" href="/uploadcmnd.php">Tải lên hình ảnh xác thực của bạn ngay bây giờ</a></button>
</center>

<? } else { ?>
 <? if($usermain['yeucauxacthuc']==1 && $usermain['xacthuc']==0) { ?>
<h4 class="memnutab">Xác minh tài khoản</h4>
<center style="color:red;">
<img src="/sr/img/khien.png" height="50"/> <i>Chờ xác thực</i>
</center>

<? }else if ($usermain['yeucauxacthuc']==0 && $usermain['xacthuc']==1){ ?>
<h4 class="memnutab">Xác minh tài khoản</h4>
<center style="color:green;">
<img src="/sr/img/ok.png" height="50"/> <i>Tài khoản đã được xác thực</i>
</center>

<? } ?>
<? } ?>
<? if(empty($usermain['fbid'])) { ?>


<div style="padding-left:10px"><a style="color:orange" href="/password.php">Đổi mật khẩu</a></div>
<? } ?>
<h2 style="height:25px;background:#5F04B4;padding:10px;margin:5px;color:black;text-align:center">Thẻ quà tặng</h2>


<table style="width:100%;font-weight:bold;">
<tr style="width:100%;color:green">
<td style="width:50%;"><a href="/gift.php"><img src="/sr/img/image017.png"> Thẻ quà tặng</a></td>
<td style="width:50%;"><a href="/mycard.php"><img src="https://i.imgur.com/PlBnJNO.png" height="29.5"> Đổi thẻ điện thoại</a></td>
</tr>
</table>


<h2 style="height:25px;background:#999;padding:10px;margin:5px;color:black;text-align:center">Bank</h2>
<table style="width:100%;font-weight:bold;">
<tr style="width:100%;color:green">

<td style="width:50%;"><a href="/editbank.php"><img src="/sr/img/image021.png"/> Liên kết ngân hàng</a></td>

<td style="width:50%;"><a href="/editpaypal.php"><img src="/sr/img/image005.png" height="45"/> Liên kết PayPal</a></td>
</tr>
</table>

<h2 style="height:25px;background:#81DAF5;padding:10px;margin:5px;color:black;text-align:center">Hỗ trợ</h2>
<div style=" background:red;padding:3px;width:43px;color:black"><a href="/report.php"><img src="/sr/img/image025.png">Hỗ trợ</a></div>

<div>-Cần giúp đỡ hãy chọn vào <b style="color:#f00"> Hỗ trợ̉</b> để gửi yêu cầu. Hoặc liên hệ:<a href="mailto:service@earntmoney.com?subject=Feedback&body=Message">service@earntmoney.com<br></a>

-Chi tiết thể lệ và hướng dẫn kiếm tiền bạn có thể xem tại :    <a href="https://earntmoney.com/tem.php">www.earntmoney.com/huongdan</a><br>
-Liên hệ hỗ trợ EarntMoney qua:    <a href="https://www.facebook.com/EarntMoney">Facebook.com/EarntMoney VN</a>

</div>




  </div>
  
</div>
<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>
