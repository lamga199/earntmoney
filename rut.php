<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl='Get';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');
?><div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
<style>
hr { color:#999}
</style>
<?php require('uinfo.php');?>
<?php require('topmenu.php');?>
	<?
	switch($act) { 
	case 'video':
	?>
	
<div style="margin:10px;padding:10px;text-align:center;border:1px solid #999;color:orange;margin-bottom:20px;">
<span class=" border-tien diemdanh"><img src="/sr/img/mmo.jpg"/>Video: <?php echo number_format($usermain['videocoin']);?> <?php echo $set['donvi']; ?> </span>
<br>Video Cash<hr>
<div style="text-align:left">
	  <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" class="avatarcs" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" class="avatarcs" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:black"> <?php echo $usermain['name'];?></b>
</div>
<hr>
<?
if(isset($_POST['submit'])) {
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
	$pass = isset($_POST['pass']) ? functions::checkin(mb_substr(trim($_POST['pass']), 0, 200)) : '';
	if(empty($cash)) {
		$error[]='Tiền mặt trống';
	}
	if(empty($pass)) {
		$error[]='Bạn chưa nhập mật khẩu hoặc nhập sai mật khẩu';
	}
	if(md5(md5($pass)) !== $usermain['password']) {
		$error[]='Mật khẩu không đúng';
	}
if($usermain['videocoin']<$cash) {
	$error[]='Vượt quá số tiền bạn có';
}
	if($cash<$set['videoruttien']) {
	$error[]='Số tiền rút tối thiểu là 50.000đ';
}
if($usermain['xacthuc']==0 || $usermain['status']!=='actived') {
	$error[]='Your account is not authenticated or has not been activated';
}
if(empty($error)) {
	mysql_query("UPDATE `users` SET `coin` = `coin` + '".$cash."', `videocoin` = `videocoin` - '".$cash."' WHERE `id` = '".$usermain['id']."'");
	//update log
	$reportlog='user: '.$user_id.' rút số tiền '.number_format($cash).' từ tiền video về tiền chính.';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'rutvideocoin',
			idtacdong = '".$user_id."',
			coin_add = '".$cash."',
			videocoin_minus = '".$cash."',
			log = '".$reportlog."',
			status = 'success',
			box = '".$user_id."'");
			echo '<div style="color:green;">Rút tiền thành công về tài khoản chính</div>';
} else {
	echo functions::display_error($error);
}
}
?>
<form method="post">
<table><tr>

<td style="font-weight:bold;color:black;width:20%;">Tiền mặt</td><td style="width:50%;"><input  type="text" id="one" name="cash" value="" placeholder="Số tiền có thể rút <? echo number_format($usermain['videocoin']);?> <? echo $set['donvi'];?>" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;"/></td><td style="width:20%"><input type="password" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;" name="pass" placeholder="Password"/></td></tr></table>
<hr>

<div style="text-align:left;color:black;">Rút tối thiểu: <? echo number_format($set['videoruttien']);?> <? echo $set['donvi'];?></div>
<hr>
<div style="text-align:left;color:black;">Tổng tiền rút: <input value="0" style="font-weight:bold;color:orange" id="two" /> </div>
<hr>
<br>
<button class="cmt-to-login"  style="border:0px;border-radius:0px;background:#5882FA;color:white; " name="submit">Rút về tiền chính</button>
</form>
</div>

<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpaygame_on']=='on') { ?>
		three.value = src.value-((src.value/100)*12);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
<?
break;
case 'bonus':
?>
	
<div style="margin:10px;padding:10px;text-align:center;border:1px solid #999;color:orange;margin-bottom:20px;">
<span class=" border-tien diemdanh"><img src="/sr/img/mmo.jpg"/>Bonus 10%:: <?php echo number_format($usermain['coin_lock']);?> <?php echo $set['donvi']; ?> </span>
<br>Bonus 10% Cash<hr>
<div style="text-align:left">
	  <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" class="avatarcs" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" class="avatarcs" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:black"> <?php echo $usermain['name'];?></b>
</div>
<hr>
<?
if(isset($_POST['submit'])) {
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
	$pass = isset($_POST['pass']) ? functions::checkin(mb_substr(trim($_POST['pass']), 0, 200)) : '';
	if(empty($cash)) {
		$error[]='Tiền mặt trống';
	}
	if(empty($pass)) {
		$error[]='Bạn chưa nhập mật khẩu hoặc nhập sai mật khẩu';
	}
	if(md5(md5($pass)) !== $usermain['password']) {
		$error[]='Mật khẩu không đúng';
	}
if($usermain['coin_lock']<$cash) {
	$error[]='Vượt quá số tiền bạn có';
}
	if($cash<50000) {
	$error[]='Số tiền rút tối thiểu là 50.000đ';
}
if($usermain['xacthuc']==0 || $usermain['status']!=='actived') {
	$error[]='Your account is not authenticated or has not been activated';
}
if(empty($error)) {
	mysql_query("UPDATE `users` SET `coin` = `coin` + '".$cash."', `coin_lock` = `coin_lock` - '".$cash."' WHERE `id` = '".$usermain['id']."'");
	//update log
	$reportlog='user: '.$user_id.' rút số tiền '.number_format($cash).' từ tiền video về tiền chính.';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'rutcoinlock',
			idtacdong = '".$user_id."',
			coin_add = '".$cash."',
			coin_lock_minus = '".$cash."',
			log = '".$reportlog."',
			status = 'success',
			box = '".$user_id."'");
			echo '<div style="color:green;">Rút tiền thành công về tài khoản chính</div>';
} else {
	echo functions::display_error($error);
}
}
?>
<form method="post">
<table><tr>

<td style="font-weight:bold;color:black;width:20%;">Tiền mặt</td>
<td style="width:50%;"><input  type="text" id="one" name="cash" value="" placeholder="Số tiền của bạn <? echo number_format($usermain['coin_lock']);?> <? echo $set['donvi'];?>" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;"/></td><td style="width:20%">
<input type="password" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;" name="pass" placeholder="Password"/></td></tr></table>
<hr>

<div style="text-align:left;color:black;">Rút tối thiểu: 50,000 <? echo $set['donvi'];?></div>
<hr>
<div style="text-align:left;color:black;">Tổng tiền rút: <input value="0" style="font-weight:bold;color:orange" id="two" /> </div>
<hr>
<br>
<button class="cmt-to-login"  style="border:0px;border-radius:0px;background:#5882FA;color:white; " name="submit">Rút về tiền chính</button>
</form>
</div>

<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpaygame_on']=='on') { ?>
		three.value = src.value-((src.value/100)*12);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
<?
break;

case 'diemdanh':
?>
	
<div style="margin:10px;padding:10px;text-align:center;border:1px solid #999;color:orange;margin-bottom:20px;">
<span class=" border-tien diemdanh"><img src="/sr/img/mmo.jpg"/>Money Atfriends: <?php echo number_format($usermain['coin_bonus']);?> <?php echo $set['donvi']; ?> </span>
<br>Money Atfriends Cash<hr>
<div style="text-align:left">
	  <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" class="avatarcs" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" class="avatarcs" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:black"> <?php echo $usermain['name'];?></b>
</div>
<hr>
<?
if(isset($_POST['submit'])) {
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
	$pass = isset($_POST['pass']) ? functions::checkin(mb_substr(trim($_POST['pass']), 0, 200)) : '';
	if(empty($cash)) {
		$error[]='Tiền mặt trống';
	}
	if(empty($pass)) {
		$error[]='Bạn chưa nhập mật khẩu hoặc nhập sai mật khẩu';
	}
	if(md5(md5($pass)) !== $usermain['password']) {
		$error[]='Mật khẩu không đúng';
	}
if($usermain['coin_bonus']<$cash) {
	$error[]='Vượt quá số tiền bạn có';
}
	if($cash<50000) {
	$error[]='Số tiền rút tối thiểu là 50.000đ';
}
if($usermain['xacthuc']==0 || $usermain['status']!=='actived') {
	$error[]='Your account is not authenticated or has not been activated';
}
if(empty($error)) {
	mysql_query("UPDATE `users` SET `coin` = `coin` + '".$cash."', `coin_bonus` = `coin_bonus` - '".$cash."' WHERE `id` = '".$usermain['id']."'");
	//update log
	$reportlog='user: '.$user_id.' rút số tiền '.number_format($cash).' từ tiền video về tiền chính.';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'rutcoinbonus',
			idtacdong = '".$user_id."',
			coin_add = '".$cash."',
			coin_bonus_minus = '".$cash."',
			log = '".$reportlog."',
			status = 'success',
			box = '".$user_id."'");
			echo '<div style="color:green;">Rút tiền thành công về tài khoản chính</div>';
} else {
	echo functions::display_error($error);
}
}
?>
<form method="post">
<table><tr>

<td style="font-weight:bold;color:black;width:20%;">Tiền mặt</td>
<td style="width:50%;"><input  type="text" id="one" name="cash" value="" placeholder="Số tiền có thể rút <? echo number_format($usermain['coin_bonus']);?> <? echo $set['donvi'];?>" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;"/></td><td style="width:20%">
<input type="password" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;" name="pass" placeholder="Password"/></td></tr></table>
<hr>

<div style="text-align:left;color:black;">Rút tối thiểu: 50,000 <? echo $set['donvi'];?></div>
<hr>
<div style="text-align:left;color:black;">Tổng tiền rút: <input value="0" style="font-weight:bold;color:orange" id="two" /> </div>
<hr>
<br>
<button class="cmt-to-login"  style="border:0px;border-radius:0px;background:#5882FA;color:white; " name="submit">Rút về tiền chính</button>
</form>
</div>

<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpaygame_on']=='on') { ?>
		three.value = src.value-((src.value/100)*12);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
<?
break;

case 'daily':
?>
	
<div style="margin:10px;padding:10px;text-align:center;border:1px solid #999;color:orange;margin-bottom:20px;">
<span class=" border-tien diemdanh"><img src="/sr/img/mmo.jpg"/>Bonus daily: <?php echo number_format($usermain['coinday']);?> <?php echo $set['donvi']; ?> </span>
<br>Bonus daily Cash<hr>
<div style="text-align:left">
	  <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" class="avatarcs" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" class="avatarcs" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:black"> <?php echo $usermain['name'];?></b>
</div>
<hr>
<?
if(isset($_POST['submit'])) {
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
	$pass = isset($_POST['pass']) ? functions::checkin(mb_substr(trim($_POST['pass']), 0, 200)) : '';
	if(empty($cash)) {
		$error[]='Tiền mặt trống';
	}
	if(empty($pass)) {
		$error[]='Bạn chưa nhập mật khẩu hoặc nhập sai mật khẩu';
	}
	if(md5(md5($pass)) !== $usermain['password']) {
		$error[]='Mật khẩu không đúng';
	}
if($usermain['coinday']<$cash) {
	$error[]='Vượt quá số tiền bạn có';
}
	if($cash<50000) {
	$error[]='Số tiền rút tối thiểu là50.000đ';
}
if($usermain['xacthuc']==0 || $usermain['status']!=='actived') {
	$error[]='Your account is not authenticated or has not been activated';
}
if(empty($error)) {
	mysql_query("UPDATE `users` SET `coin` = `coin` + '".$cash."', `coinday` = `coinday` - '".$cash."' WHERE `id` = '".$usermain['id']."'");
	//update log
	$reportlog='user: '.$user_id.' rút số tiền '.number_format($cash).' từ tiền video về tiền chính.';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'rutcoinday',
			idtacdong = '".$user_id."',
			coin_add = '".$cash."',
			coinday_minus = '".$cash."',
			log = '".$reportlog."',
			status = 'success',
			box = '".$user_id."'");
			echo '<div style="color:green;">Rút tiền thành công về tài khoản chính</div>';
} else {
	echo functions::display_error($error);
}
}
?>
<form method="post">
<table><tr>

<td style="font-weight:bold;color:black;width:20%;">Tiền mặt</td>
<td style="width:50%;"><input  type="text" id="one" name="cash" value="" placeholder="Số tiền có thể rút <? echo number_format($usermain['coinday']);?> <? echo $set['donvi'];?>" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;"/></td><td style="width:20%">
<input type="password" style="height:20px;width:90%;padding:5px;border-radius:4px;border:1px solid #f2f2f2;" name="pass" placeholder="Password"/></td></tr></table>
<hr>

<div style="text-align:left;color:black;">Rút tối thiểu: 50,000 <? echo $set['donvi'];?></div>
<hr>
<div style="text-align:left;color:black;">Tổng tiền rút: <input value="0" style="font-weight:bold;color:orange" id="two" /> </div>
<hr>
<br>
<button class="cmt-to-login"  style="border:0px;border-radius:0px;background:#5882FA;color:white; " name="submit">Rút về tiền chính</button>
</form>
</div>

<script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
		<?php if($set['kmpaygame_on']=='on') { ?>
		three.value = src.value-((src.value/100)*12);
	<? } else { ?>
	three.value = src.value;
	<? } ?>
    });
	
	
};

</script>
<?

break;

	}















require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>
