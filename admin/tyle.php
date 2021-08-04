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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Cài đặt tỷ lệ vòng quay</div>
</div>
<div style="background:white;padding:10px;">
<?
if(isset($_POST['submit'])) {
	
	if(
	empty($_POST['roll1']) ||
	empty($_POST['roll2']) ||
	empty($_POST['roll3']) ||
	empty($_POST['roll4']) ||
	empty($_POST['roll5']) ||
	empty($_POST['roll6']) ||
	empty($_POST['roll7']))
	 {
		$error[]='Cài đặt không được thiếu nội dung nào';
	}
	if($rights<7) {
		$error[]='Người dùng không có thẩm quyền thao tác';
	}
	if(empty($error)) {
		 mysql_query("UPDATE `cms_settings` SET `val`='" . ($_POST['roll1']/100)."' WHERE `key` = 'roll1'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . ($_POST['roll2']/100)."' WHERE `key` = 'roll2'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . ($_POST['roll3']/100)."' WHERE `key` = 'roll3'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . ($_POST['roll4']/100)."' WHERE `key` = 'roll4'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . ($_POST['roll5']/100)."' WHERE `key` = 'roll5'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . ($_POST['roll6']/100)."' WHERE `key` = 'roll6'");
		 mysql_query("UPDATE `cms_settings` SET `val`='" . ($_POST['roll7']/100)."' WHERE `key` = 'roll7'");
		 
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
<label>Up 5% Money Atfriends</label>
<input name="roll1" value="<? echo $set['roll1']*100;?>" class="form-control"/>
<label>Up 10% Money Atfriends</label>
<input name="roll2" value="<? echo $set['roll2']*100;?>" class="form-control"/>
<label>Good luck</label>
<input name="roll3" value="<? echo $set['roll3']*100;?>" class="form-control"/>
<label>Card mobile 1K</label>
<input name="roll4" value="<? echo $set['roll4']*100;?>" class="form-control"/>
<label>Card mobile 10K</label>
<input name="roll5" value="<? echo $set['roll5']*100;?>" class="form-control"/>

<label>Card mobile 50K</label>
<input name="roll6" value="<? echo $set['roll6']*100;?>" class="form-control"/>

<label>Card mobile 100K</label>
<input name="roll7" value="<? echo $set['roll7']*100;?>" class="form-control"/>

<br>
<button type="submit" name="submit" class="btn btn-sm btn-primary">Lưu cài đặt</button>
</form>

  
  </div>
  </div>

  
  </div><?php require('../incfiles/end.php');?>
<?php } ?>