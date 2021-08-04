<?php
define('_IN_JOHNCMS', 1);
$headmod = 'video';
$textl='MANAGER';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights<9) {
header('location: /index.php');
} else {
require('../header.php');

	?>
	<style>
.form-control {
height:30px;border:1px solid #999; border-radius:5px;	width:95%;padding:5px;margin:5px;
}
.memnutab {background:#F2F2F2;padding:5px;margin:4px}
</style>
	<style>
	label {font-weight:bold;margin:5px;}
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Cài đặt hệ thống</div>
</div>
<div style="background:white;padding:10px;">
<?
if(isset($_POST['submit'])) {
	
	if(
	empty($_POST['copyright']) ||
	empty($_POST['vndus']) ||
	empty($_POST['buyvndus']) ||
	empty($_POST['paypalact']) ||
	empty($_POST['maxvideopending']) ||
	empty($_POST['maxvideoact']) ||
	empty($_POST['videoruttien']) ||
	empty($_POST['salepaypalchuaxacthuc']) ||
	empty($_POST['salepaypalxacthuc']) ||
	empty($_POST['setmail1']) ||
	empty($_POST['setmail2']) ||
	empty($_POST['setmail3']) ||
	empty($_POST['setmail4']) ||
	empty($_POST['tienquay']) ||
	empty($_POST['email']) ||
	empty($_POST['donvi']) ||
	empty($_POST['mamat']) ||
	empty($_POST['fanpage']) ||
	empty($_POST['support_phone']) ||
	empty($_POST['coinact']) ||
	empty($_POST['thucoinreg']) ||
	empty($_POST['f1coinreg']) ||
	empty($_POST['bonusdiemdanh']) ||
	empty($_POST['donvi']) ||
	empty($_POST['diemdanhngay']) ||
	empty($_POST['peopleactivedindaytobonusdiemdanh']) || 
	empty($_POST['coin_diemdanhday_1ref']) || 
	empty($_POST['videoruttien']) || 
	empty($_POST['coin_diemdanhday_0ref']) ||
	empty($_POST['maxvideopending']) ||
	empty($_POST['maxvideoact']) ||
	empty($_POST['video1dayact']) ||
	empty($_POST['video1daypending']) ||
	empty($_POST['daydiemdanhduocrut'])
	) {
		$error[]='Cài đặt không được thiếu nội dung nào';
	}
	if($rights<7) {
		$error[]='Người dùng không có thẩm quyền thao tác';
	}
	if(empty($error)) {
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['maxvideopending']) . "' WHERE `key` = 'maxvideopending'");
		  mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['maxvideoact']) . "' WHERE `key` = 'maxvideoact'");
		  mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['video1dayact']) . "' WHERE `key` = 'video1dayact'");
		  mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['video1daypending']) . "' WHERE `key` = 'video1daypending'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['videoruttien']) . "' WHERE `key` = 'videoruttien'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['setmail1']) . "' WHERE `key` = 'setmail1'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['setmail2']) . "' WHERE `key` = 'setmail2'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['setmail3']) . "' WHERE `key` = 'setmail3'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['setmail4']) . "' WHERE `key` = 'setmail4'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['tienquay']) . "' WHERE `key` = 'tienquay'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['vndus']) . "' WHERE `key` = 'vndus'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['buyvndus']) . "' WHERE `key` = 'buyvndus'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['paypalact']) . "' WHERE `key` = 'paypalact'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['maxvideopending']) . "' WHERE `key` = 'maxvideopending'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['maxvideoact']) . "' WHERE `key` = 'maxvideoact'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['salepaypalchuaxacthuc']) . "' WHERE `key` = 'salepaypalchuaxacthuc'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['salepaypalxacthuc']) . "' WHERE `key` = 'salepaypalxacthuc'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['copyright']) . "' WHERE `key` = 'copyright'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['email']) . "' WHERE `key` = 'email'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['donvi']) . "' WHERE `key` = 'donvi'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['mamat']) . "' WHERE `key` = 'mamat'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . $_POST['fanpage'] . "' WHERE `key` = 'fanpage'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['support_phone']) . "' WHERE `key` = 'support_phone'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['coinact']) . "' WHERE `key` = 'coinact'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['thucoinreg']) . "' WHERE `key` = 'thucoinreg'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['f1coinreg']) . "' WHERE `key` = 'f1coinreg'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['bonusdiemdanh']) . "' WHERE `key` = 'bonusdiemdanh'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['donvi']) . "' WHERE `key` = 'donvi'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['peopleactivedindaytobonusdiemdanh']) . "' WHERE `key` = 'peopleactivedindaytobonusdiemdanh'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['daydiemdanhduocrut']) . "' WHERE `key` = 'daydiemdanhduocrut'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['diemdanhngay']) . "' WHERE `key` = 'diemdanhngay'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['coin_diemdanhday_1ref']) . "' WHERE `key` = 'coin_diemdanhday_1ref'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . functions::check($_POST['coin_diemdanhday_0ref']) . "' WHERE `key` = 'coin_diemdanhday_0ref'");
		
		?>
		<div class="alert alert-success" role="alert">
		Lưu cài đặt thành công!
		</div>
		<?
	} else {
		?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
		<?
	}
	
}

?>
<form method="post">
<label>Tiêu đề trang</label>
<input name="copyright" value="<? echo $set['copyright'];?>" class="form-control"/>
<label>Email admin</label>
<input name="email" value="<? echo $set['email'];?>" class="form-control"/>
<label>Đơn vị tiền</label>
<input name="donvi" value="<? echo $set['donvi'];?>" class="form-control"/>
<label>Mật mã thanh toán</label>
<input name="mamat" value="<? echo $set['mamat'];?>" class="form-control"/>
<label>Link Fanpage</label>
<input name="fanpage" value="<? echo $set['fanpage'];?>" class="form-control"/>

<label>Số điện thoại support</label>
<input name="support_phone" value="<? echo $set['support_phone'];?>" class="form-control"/>

<label>Số tiền kích hoạt nick</label>
<input name="coinact" value="<? echo $set['coinact'];?>" class="form-control"/>

<label>Kích hoạt nick chia cho admin</label>
<input name="thucoinreg" value="<? echo $set['thucoinreg'];?>" class="form-control"/>

<label>Kích hoạt nick chia cho user</label>
<input name="f1coinreg" value="<? echo $set['f1coinreg'];?>" class="form-control"/>

<label>Tiền điểm danh</label>
<input name="bonusdiemdanh" value="<? echo $set['bonusdiemdanh'];?>" class="form-control"/>

<label>Đơn vị tiền</label>
<input name="donvi" value="<? echo $set['donvi'];?>" class="form-control"/>

<label>Số tài khoản F1 kích hoạt trong ngày để nhận thưởng hoa hồng</label>
<input name="peopleactivedindaytobonusdiemdanh" value="<? echo $set['peopleactivedindaytobonusdiemdanh'];?>" class="form-control"/>


<label>Số ngày điểm danh để được rút</label>
<input name="daydiemdanhduocrut" value="<? echo $set['daydiemdanhduocrut'];?>" class="form-control"/>
<label>Số tiền tối thiểu rút video</label>
<input name="videoruttien" value="<? echo $set['videoruttien'];?>" class="form-control"/>

<label>Bật tắt điểm danh ngày</label>
<select name="diemdanhngay" class="form-control">
    <option value="on" <? echo ($set['diemdanhngay']=='on' ? ' selected="selected" ' : '');?>>Bật</option>
    <option value="off" <? echo ($set['diemdanhngay']=='off' ? ' selected="selected" ' : '');?>>Tắt</option>
</select>
<label>Số tiền thưởng khi đã có ref</label>
<input name="coin_diemdanhday_1ref" value="<? echo $set['coin_diemdanhday_1ref'];?>" class="form-control"/>
<label>Số tiền thưởng khi chưa có ref</label>
<input name="coin_diemdanhday_0ref" value="<? echo $set['coin_diemdanhday_0ref'];?>" class="form-control"/>
<label>Giá bán ra Paypal</label>
<input name="vndus" value="<? echo $set['vndus'];?>" class="form-control"/>
<label>Giá mua vào Paypal</label>
<input name="buyvndus" value="<? echo $set['buyvndus'];?>" class="form-control"/>
<label>Số paypal để kích hoạt nick</label>
<input name="paypalact" value="<? echo $set['paypalact'];?>" class="form-control"/>
<label>Lượt xem lại tối đa trên 1 video cho nick đã kích hoạt</label>
<input name="maxvideoact" value="<? echo $set['maxvideoact'];?>" class="form-control"/>
<label>Lượt xem lại tối đa trên 1 video cho nick chưa kích hoạt</label>
<input name="maxvideopending" value="<? echo $set['maxvideopending'];?>" class="form-control"/>
<label>Cài đặt rút tiền video tối thiểu</label>
<input name="videoruttien" value="<? echo $set['videoruttien'];?>" class="form-control"/>
<label>Lượt bán paypal 1 ngày cho nick chưa xác thực</label>
<input name="salepaypalchuaxacthuc" value="<? echo $set['salepaypalchuaxacthuc'];?>" class="form-control"/>
<label>Lượt bán paypal 1 ngày cho nick đã xác thực</label>
<input name="salepaypalxacthuc" value="<? echo $set['salepaypalxacthuc'];?>" class="form-control"/>
<label>Tiền để quay 1 lượt vòng may mắn</label>
<input name="tienquay" value="<? echo $set['tienquay'];?>" class="form-control"/>
<label>Link URL icon 1 mail</label>
<input name="setmail1" value="<? echo $set['setmail1'];?>" class="form-control"/>
<label>Link URL icon 2 mail</label>
<input name="setmail2" value="<? echo $set['setmail2'];?>" class="form-control"/>
<label>Link URL icon 3 mail</label>
<input name="setmail3" value="<? echo $set['setmail3'];?>" class="form-control"/>
<label>Link URL icon 4 mail</label>
<input name="setmail4" value="<? echo $set['setmail4'];?>" class="form-control"/>

<label>Lượt xem lại 1 video nick đã kích hoạt</label>
<input name="maxvideoact" value="<? echo $set['maxvideoact'];?>" class="form-control"/>
<label>Lượt xem lại 1 video nick chưa kích hoạt</label>
<input name="maxvideopending" value="<? echo $set['maxvideopending'];?>" class="form-control"/>
<label>Lượt xem video 1 ngày nick đã kích hoạt</label>
<input name="video1dayact" value="<? echo $set['video1dayact'];?>" class="form-control"/>
<label>Lượt xem video 1 ngày nick chưa kích hoạt</label>
<input name="video1daypending" value="<? echo $set['video1daypending'];?>" class="form-control"/>
<br>
<a href="/password.php">Đổi mật khẩu admin</a><br><br>
<button type="submit" name="submit" class="cmt-to-login">Lưu cài đặt</button>
</form>

  
  </div>
  </div>

  
  </div><?php require('../incfiles/end.php');?>
<?php } ?>