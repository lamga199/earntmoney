<?php
define('_IN_JOHNCMS', 1);
$headmod = 'report';
$textl='User';
require('../incfiles/core.php');
$userkhach=mysql_fetch_assoc(mysql_query("SELECT *FROM `users` WHERE `id` = '".$id."'"));
require('../incfiles/head.php');
if(empty($login) && $rights<=9) {
header('location: /index.php');
} else { ?>
<?
require('../header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto;background:#fff">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php require('../topmenu.php');?>
<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">Chỉnh sửa thông tin</h4>

<?
if(isset($_POST['submit'])) {
	$name = isset($_POST['hoten']) ? functions::checkin(mb_substr(trim($_POST['hoten']), 0, 100)) : '';
	$mibile = isset($_POST['sdt']) ? functions::checkin(mb_substr(trim($_POST['sdt']), 0, 20)) : '';
	$namsinh = isset($_POST['namsinh']) ? intval($_POST['namsinh']) : 0;
	$mail = isset($_POST['mail']) ? functions::checkin(mb_substr(trim($_POST['mail']), 0, 40)) : '';
	$live = isset($_POST['live']) ? functions::checkin(mb_substr(trim($_POST['live']), 0, 100)) : '';
	$bank = isset($_POST['bank']) ? functions::checkin(mb_substr(trim($_POST['bank']), 0, 100)) : '';
	$stk = isset($_POST['stk']) ? functions::checkin(mb_substr(trim($_POST['stk']), 0, 20)) : '';
	$namebank = isset($_POST['namebank']) ? functions::checkin(mb_substr(trim($_POST['namebank']), 0, 100)) : '';
	$paypal = isset($_POST['paypal']) ? functions::checkin(mb_substr(trim($_POST['paypal']), 0, 100)) : '';
	$cmnd = isset($_POST['cmnd']) ? functions::checkin(mb_substr(trim($_POST['cmnd']), 0, 100)) : '';
	$ngaycapcmnd = isset($_POST['ngaycapcmnd']) ? functions::checkin(mb_substr(trim($_POST['ngaycapcmnd']), 0, 100)) : '';
	$noicapcmnd = isset($_POST['noicapcmnd']) ? functions::checkin(mb_substr(trim($_POST['noicapcmnd']), 0, 100)) : '';
	$ngaysinh = isset($_POST['ngaysinh']) ? functions::checkin(mb_substr(trim($_POST['ngaysinh']), 0, 100)) : '';
	$thangsinh = isset($_POST['thangsinh']) ? functions::checkin(mb_substr(trim($_POST['thangsinh']), 0, 100)) : '';
	$city = isset($_POST['city']) ? functions::checkin(mb_substr(trim($_POST['city']), 0, 100)) : '';
	$duong = isset($_POST['duong']) ? functions::checkin(mb_substr(trim($_POST['duong']), 0, 100)) : '';
	$luotquay = isset($_POST['luotquay']) ? functions::checkin(mb_substr(trim($_POST['luotquay']), 0, 100)) : '';
	
	$coin = isset($_POST['coin']) ? intval($_POST['coin']) : 0;
	$coin_bonus = isset($_POST['coin_bonus']) ? intval($_POST['coin_bonus']) : 0;
	$coin_lock = isset($_POST['coin_lock']) ? intval($_POST['coin_lock']) : 0;
	$coinday = isset($_POST['coinday']) ? intval($_POST['coinday']) : 0;
	$coin_diemdanhday_1ref = isset($_POST['coin_diemdanhday_1ref']) ? intval($_POST['coin_diemdanhday_1ref']) : 0;
	$coin_diemdanhday_0ref = isset($_POST['coin_diemdanhday_0ref']) ? intval($_POST['coin_diemdanhday_0ref']) : 0;
	$turndd = isset($_POST['turndd']) ? functions::checkin(mb_substr(trim($_POST['turndd']), 0, 100)) : '';
	
	if($coin<0 || 
	$coin_bonus<0 || 
	$coin_lock<0 ||
	$coinday<0 ||
	$coin_diemdanhday_1ref<0 ||
	$coin_diemdanhday_0ref<0 ||
	empty($turndd)) {
	   $error[] = 'Không được nhập các số liệu âm'; 
	}
	
	
	if (mb_strlen($name) > 100) {
            $error[] = 'Họ tên vượt quá 100 kí tự';
	}
	//if (mb_strlen($mibile) < 9 || mb_strlen($mibile) > 15) {
    //        $error[] = 'Số điện thoại không đúng';
	//}

	if (mb_strlen($live) < 0 || mb_strlen($live) > 100) {
            $error[] = 'Địa chỉ tối đa 100 kí tự';
	}
	
	if (!$error) {
		mysql_query("UPDATE users SET
		imname = '".mysql_real_escape_string($name)."',
		yearofbirth = '".mysql_real_escape_string($namsinh)."',
		live = '".mysql_real_escape_string($live)."',
		bank = '".mysql_real_escape_string($bank)."',
		stk = '".mysql_real_escape_string($stk)."',
		namebank = '".mysql_real_escape_string($namebank)."',
		mibile = '".mysql_real_escape_string($mibile)."',
		mail = '".mysql_real_escape_string($mail)."',
		coin = '".mysql_real_escape_string($coin)."',
		coin_bonus = '".mysql_real_escape_string($coin_bonus)."',
		coin_lock = '".mysql_real_escape_string($coin_lock)."',
		coinday = '".mysql_real_escape_string($coinday)."',
		coin_diemdanhday_1ref = '".mysql_real_escape_string($coin_diemdanhday_1ref)."',
		coin_diemdanhday_0ref = '".mysql_real_escape_string($coin_diemdanhday_0ref)."',
		turndd = '".mysql_real_escape_string($turndd)."',
		ngaysinh = '".mysql_real_escape_string($ngaysinh)."',
		thangsinh = '".mysql_real_escape_string($thangsinh)."',
		duong = '".mysql_real_escape_string($duong)."',
		city = '".mysql_real_escape_string($city)."',
		luotquay = '".mysql_real_escape_string($luotquay)."',
		cmnd = '".mysql_real_escape_string($cmnd)."',
		ngaycapcmnd = '".mysql_real_escape_string($ngaycapcmnd)."',
		noicapcmnd = '".mysql_real_escape_string($noicapcmnd)."',
		paypal = '".mysql_real_escape_string($paypal)."'
		WHERE id = '".$userkhach['id']."'");
		?>
		<div class="alert alert-success" role="alert">
		Cập nhật thông tin tài khoản thành công!
		</div>
		
		<?php
	} else { ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
?>
<h4>Thông tin tài khoản: <?php echo $userkhach['name'];?></h4>

      <div class="table-responsive" style="padding:10px;">
	  <form method="post" name="form" class="form-group">


<div><b>Họ và tên</b><input name="hoten" value="<?php echo $userkhach['imname']; ?>" class="form-control"/></div>
<div><b>Ngày tháng năm sinh</b><br>

<input name="ngaysinh" value="<?php echo $userkhach['ngaysinh']; ?>" style="width:60px" class="form-control"/>/
<input name="thangsinh" value="<?php echo $userkhach['thangsinh']; ?>" style="width:60px" class="form-control"/>/
<input name="namsinh" value="<?php echo $userkhach['yearofbirth']; ?>" style="width:60px" class="form-control"/>

</div>
<div><b>Địa chỉ </b><input name="live" value="<?php echo $userkhach['live']; ?>" class="form-control"/></div>
<div><b>Địa chỉ quận</b><input name="duong" value="<?php echo $userkhach['duong']; ?>" class="form-control"/></div>
<div><b>Địa chỉ thành phố</b><input name="city" value="<?php echo $userkhach['city']; ?>" class="form-control"/></div>
<div><b>Số điện thoại</b><input name="sdt" value="<?php echo $userkhach['mibile']; ?>" class="form-control" ></div>
<div><b>Địa chỉ mail</b><input name="mail" value="<?php echo $userkhach['mail']; ?>" class="form-control" ></div>
<h2>Thông tin tài khoản</h2>
<div><b>Tiền chính</b><input name="coin" value="<?php echo $userkhach['coin']; ?>" class="form-control"/></div>
<div><b>Tiền điểm danh</b><input name="coin_bonus" value="<?php echo $userkhach['coin_bonus']; ?>" class="form-control"/></div>
<div><b>Nhận 10%</b><input name="coin_lock" value="<?php echo $userkhach['coin_lock']; ?>" class="form-control"/></div>
<div><b>Tiền thưởng ngày</b><input name="coinday" value="<?php echo $userkhach['coinday']; ?>" class="form-control" ></div>
<div><b>Tiền thưởng khi có >1ref (Khi giá trị ô này = 0 thì tiền thưởng được đặt theo mặc định là <? echo number_format($set['coin_diemdanhday_1ref']);?>)</b><input name="coin_diemdanhday_1ref" value="<?php echo $userkhach['coin_diemdanhday_1ref']; ?>" class="form-control" ></div>
<div><b>Tiền thưởng khi có 0 ref (Khi giá trị ô này = 0 thì tiền thưởng được đặt theo mặc định là <? echo number_format($set['coin_diemdanhday_0ref']);?>)</b><input name="coin_diemdanhday_0ref" value="<?php echo $userkhach['coin_diemdanhday_0ref']; ?>" class="form-control" ></div>
<div><b>Lượt quay</b><input name="luotquay" value="<?php echo $userkhach['luotquay']; ?>" class="form-control" ></div>
<b>Bật tắt điểm danh ngày</b>
<select name="turndd" class="form-control">
    <option value="on" <? echo ($userkhach['turndd']=='on' ? ' selected="selected" ' : '');?>>Bật</option>
    <option value="off" <? echo ($userkhach['turndd']=='off' ? ' selected="selected" ' : '');?>>Tắt</option>
</select>
<h5>Thông tin CMND</h5>
<div><b>Số CMND</b><input name="cmnd" value="<?php echo $userkhach['cmnd']; ?>" class="form-control"/></div>
<div><b>Ngày cấp</b><input name="ngaycapcmnd" value="<?php echo $userkhach['ngaycapcmnd']; ?>" class="form-control"/></div>
<div><b>Nơi cấp</b><input name="noicapcmnd" value="<?php echo $userkhach['noicapcmnd']; ?>" class="form-control"/></div>



<h5>Thông tin ngân hàng</h5>
<div><b>Tên ngân hàng</b><input name="bank" value="<?php echo $userkhach['bank']; ?>" class="form-control"/></div>
<div><b>Số tài khoản</b><input name="stk" value="<?php echo $userkhach['stk']; ?>" class="form-control"/></div>
<div><b>Họ tên chủ tài khoản</b><input name="namebank" value="<?php echo $userkhach['namebank']; ?>" class="form-control"/></div>
<div><b>Địa chỉ paypal</b><input name="paypal" value="<?php echo $userkhach['paypal']; ?>" class="form-control"/></div>

<br><div><center>
		  <button name="submit" class="cmt-to-login" style="color:white;background:orange;border:0px; width:150px;">Lưu lại</button></center>
		 </div></form><br>
</div>

<?php require('../incfiles/end.php');?>
<?php } ?>
