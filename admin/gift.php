<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl='Gift';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights<9) {
header('location: /index.php');
} else { ?>
<?
require('../header.php');

	?>
	<div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
	<?php require('../uinfo.php');?>

<?php require('../topmenu.php');

$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `status` = 'pending' AND `code` = ''"),0);

?>
	<div style="color:#000;font-weight:bold;font-size:20px;text-align:center;background:#8000FF;height:28px;">REQUEST GIFT</div>
	<table style="border:1px solid #8000FF;width:100%;"><tr>
	<td style="border:1px solid #8000FF;width:50%;"><img src="/sr/img/Picture2.png"/> Danh sách yêu cầu trả thưởng(<? echo $total; ?>)</td>
	</tr></table>
	
<?php
if(isset($_POST['desubmit'])) {
	$gift = isset($_POST['check']) ? intval($_POST['check']) : 0;
	$cehg=mysql_fetch_assoc(mysql_query("SELECT * FROM `gift` WHERE `id` = '".$gift."'"));
	if ($cehg['gift']<=0 || empty($cehg['gift'])) {
            $error[] = 'Thiếu mã quà';
	}
	if ($cehg['gift']<=0 || $cehg['gift'] >=7) {
            $error[] = 'Mã quà không đúng';
	}
	if ($rights<9) {
            $error[] = 'Không có quyền duyệt quà';
	}
	if ($cehg['status']!='pending') {
            $error[] = 'Yêu cầu này không đang chờ duyệt';
	}
	if(empty($note)) {
		$error[] = 'Chưa nhập lí do từ chối';
	}
	if (!$error) {
		
		mysql_query("UPDATE `gift` SET
		`status` = 'disagree',
		`timeduyet` = '".time()."',
		`note` = '".mysql_real_escape_string($note)."'
		WHERE `id` = '".$cehg['id']."'");
		 mysql_query("UPDATE `log` SET `status` = 'disagree' WHERE `boxid` = '".$cehg['id']."'");
		 				

	 $note = 'Error when receiving gifts from the lucky wheel: '.$note.'';
	 mysql_query("INSERT INTO `news` SET 
	 `time` = '".time()."',
	 `name` = '".$note."',
	 `color` = 'red',
	 `text` = '".$note."',
	 `show` = 'on',
	 `type` = 'note',
	 `read` = '0',
	 `user` = '".$cehg['userid']."'");
		header('location: /admin/gift.php');
		
		
		
	} else { ?>
	
	<div class="alert alert-danger" style="color:red;text-align:center;" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
if(isset($_POST['submit'])) {
	
	$gift = isset($_POST['check']) ? intval($_POST['check']) : 0;
	$hethanthe = isset($_POST['hethanthe-'.$gift.'']) ? mb_substr(trim($_POST['hethanthe-'.$gift.'']), 0, 500) : '';
	$code = isset($_POST['code-'.$gift.'']) ? mb_substr(trim($_POST['code-'.$gift.'']), 0, 500) : '';
	$seri = isset($_POST['seri-'.$gift.'']) ? mb_substr(trim($_POST['seri-'.$gift.'']), 0, 500) : '';
	$mang = isset($_POST['mang-'.$gift.'']) ? mb_substr(trim($_POST['mang-'.$gift.'']), 0, 500) : '';
	$loaithe = isset($_POST['loaithe-'.$gift.'']) ? mb_substr(trim($_POST['loaithe-'.$gift.'']), 0, 500) : '';
	$cehg=mysql_fetch_assoc(mysql_query("SELECT * FROM `gift` WHERE `id` = '".$gift."'"));
	if ($cehg['gift']<=0 || empty($cehg['gift'])) {
            $error[] = 'Thiếu mã quà';
	}
	if ($cehg['gift']<=0 || $cehg['gift'] >=7) {
            $error[] = 'Mã quà không đúng';
	}
	if ($rights<9) {
            $error[] = 'Không có quyền duyệt quà';
	}
	if ($cehg['status']!='pending') {
            $error[] = 'Yêu cầu này không đang chờ duyệt';
	}
	if(empty($hethanthe) || empty($code) || empty($seri) || empty($mang) || empty($loaithe)) {
		$error[] = 'Chưa nhập đủ thông tin thẻ<br>Hết hạn: '.$_POST['hethanthe'].'<br>code: '.$code.'<br>seri: '.$seri.'<br>mang: '.$mang.'<br>loaithe: '.$loaithe.'<br>';
	}
	if (!$error) {
		
		mysql_query("UPDATE `gift` SET
		`status` = 'done',
		`timeduyet` = '".time()."',
		`hethanthe` = '".mysql_real_escape_string($hethanthe)."',
		`code` = '".mysql_real_escape_string($code)."',
		`seri` = '".mysql_real_escape_string($seri)."',
		`mang` = '".mysql_real_escape_string($mang)."',
		`loaithe` = '".mysql_real_escape_string($loaithe)."'
		WHERE `id` = '".$cehg['id']."'");
		 mysql_query("UPDATE `log` SET `status` = 'done' WHERE `boxid` = '".$cehg['id']."'");
		 				

	 $note = 'Congratulations. You have successfully exchanged a scratch card '.$loaithe.''.$set['donvi'].'.<br>Check out the gift box now.';
	 mysql_query("INSERT INTO `news` SET 
	 `time` = '".time()."',
	 `name` = '".$note."',
	 `text` = '".$note."',
	 `color` = '#A901DB',
	 `show` = 'on',
	 `type` = 'note',
	 `read` = '0',
	 `user` = '".$cehg['userid']."'");
		header('location: /admin/gift.php');
		
		
		
	} else { ?>
	
	<div class="alert alert-danger" style="color:red;text-align:center;" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
?>
	<form method="post">
<?
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `status` = 'pending' AND `code` = ''"),0);
$gif=mysql_query("SELECT * FROM `gift` WHERE `status` = 'pending' AND `code` = '' ORDER BY `timeuse` DESC LIMIT $start, $kmess");
$i=1;
while($gift=mysql_fetch_assoc($gif)) {
	?>
	<div style="margin:5px;padding:5px;border:dotted 1px #333;">
	<input type="radio" value="<? echo $gift['id'];?>" name="check"/> Loại thẻ: <? echo $gift['name'];?> - 
	Tài khoản yêu cầu <?php echo $gift['userid'];?>
	<br>Thời gian yêu cầu: <? echo date("H:i:s - d/m/y",$gift['timeuse']+$set['timeshift']*3600);?><br>
	Trạng thái: <? echo $gift['status'];?>
	<br><b>Chọn mạng</b> <select name="mang-<? echo $gift['id'];?>">
	<option value="viettel">Viettel</option>
	<option value="vinaphone">Vinaphone</option>
	<option value="mobifone">Mobifone</option>
	</select> <b>Mệnh giá</b> <select name="loaithe-<? echo $gift['id'];?>">
	
	<option value="10.000">10.000</option>
	<option value="50.000">50.000</option>
	<option value="100.000">100.000</option>
	</select> <br><b>Mã thẻ</b>
	<input type="text" value="" style="border:1px solid #999;height:20px;margin:5px;" name="code-<? echo $gift['id'];?>"/> 
	<b>Seri</b> 
	<input type="text" value="" style="border:1px solid #999;height:20px;margin:5px;" name="seri-<? echo $gift['id'];?>"/>
	 <b>Ngày hết hạn</b> <input type="text" style="border:1px solid #999;height:20px;margin:5px;width:80px;" value="" name="hethanthe-<? echo $gift['id'];?>"/></div>
	
	<?
	++$i;
	
}

?>
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>
<input style="margin:7px;background:#04B431;border-radius:10px;" type="submit" name="submit" class="cmt-to-login" value="Duyệt gửi thông tin thẻ"/>
<br>
<input class="cmt-to-login" style="border:1px solid #999;;border-radius:5px;" name="note" placeholder="Nhập lí do" type="text"/>
<input style="margin:7px;background:red;border-radius:10px;" type="submit" name="desubmit" class="cmt-to-login" value="Từ chối duyệt"/></form>
	</div>

<div style="max-width:640px;margin:0 auto">
<?
require('../botmenu.php');?></div>

<?php require('../incfiles/end.php');?>
<?php } ?>
