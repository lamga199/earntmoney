<?php
define('_IN_JOHNCMS', 1);
$headmod = 'video';
$textl='Video';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights>=9) {
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Add video</div>

</div>
<div style="background:white">
<?
if(isset($_POST['submit'])) {
	$name = isset($_POST['name']) ? functions::checkin(mb_substr(trim($_POST['name']), 0, 200)) : '';
	$link = isset($_POST['link']) ? functions::checkin(mb_substr(trim($_POST['link']), 0, 200)) : '';
	$code = isset($_POST['code']) ? functions::checkin(mb_substr(trim($_POST['code']), 0, 200)) : '';
	$channel = isset($_POST['channel']) ? functions::checkin(mb_substr(trim($_POST['channel']), 0, 200)) : '';
	$channelname = isset($_POST['channelname']) ? functions::checkin(mb_substr(trim($_POST['channelname']), 0, 200)) : '';
	$long = isset($_POST['long']) ? intval($_POST['long']) : 0;
	$cash = isset($_POST['cash']) ? intval($_POST['cash']) : 0;
	$show = isset($_POST['show']) ? functions::checkin(mb_substr(trim($_POST['show']), 0, 200)) : '';
	if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $error[] = 'Full names exceed 100 characters';
	}
	if (mb_strlen($link) < 2 || mb_strlen($link) > 100) {
            $error[] = 'Full names exceed 100 characters';
	}
	if (mb_strlen($code) < 2 || mb_strlen($code) > 100) {
            $error[] = 'Full names exceed 100 characters';
	}
	if ($long < 0) {
            $error[] = 'Time watch can not <= -1';
	}
	if ($cash < 0) {
            $error[] = 'Cash can not < 0';
	}
	if (!$error) {
		mysql_query("INSERT INTO `video` SET
		`name` = '".mysql_real_escape_string($name)."',
		`link` = '".mysql_real_escape_string($link)."',
		`vidid` = '".mysql_real_escape_string($code)."',
		`long` = '".mysql_real_escape_string($long)."',
		`channel` = '".mysql_real_escape_string($channel)."',
		`channelname` = '".mysql_real_escape_string($channelname)."',
		`cash` = '".mysql_real_escape_string($cash)."',
		`time` = '".time()."',
		`user` = '".$usermain['id']."',
		`view` = '0',
		`show` = '".mysql_real_escape_string($show)."'");
		$newid=mysql_insert_id();
		header('location: /video.php?id='.$newid.'');
	} else {
		?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	}
	
}


?>
<form method="post">
<div><label>Name video</label><br><input name="name" value="" class="form-control"/></div>
<div><label>Link youtube</label><br><input name="link" value="" class="form-control"/></div>
<div><label>Link kênh</label><br><input name="channel" value="" class="form-control"/></div>
<div><label>Tên kênh</label><br><input name="channelname" value="" class="form-control"/></div>
<div><label>ID video</label><br><input name="code" value="" class="form-control"/></div>
<div><label>Time watch (sec)</label><br><input name="long" value="0" class="form-control"/></div>
<div><label>Cash/view</label><br><input name="cash" value="0" class="form-control"/></div>
<div><label>Show</label><br>
<select name="show" class="form-control">
<option value="on">Show</option>
<option value="off">Hidden</option>
</select>

</div><div style="margin:10px;padding:10px;text-align:center;">
<button class="cmt-to-login" type="submit" name="submit">Post</button></div>
</form>

</div>

<?php require('../incfiles/end.php');?>
<?php } ?>

