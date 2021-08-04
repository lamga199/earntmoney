<?php
define('_IN_JOHNCMS', 1);
$headmod = 'transfer';
$textl='Transfer';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Transfer Cash Free</div>
<div style="background-image:url('/sr/img/bg3.jpg');background-repeat:x;text-align:left;;padding:10px;">
<div>Tiền mặt chính <div style="float:right;color:orange"><?php echo number_format($usermain['coin']);?> <?php echo $set['donvi']; ?></div></div><div style="clear:both;"></div>
<?

if(isset($_POST['submit'])) {
	$cash=isset($_POST['cash']) ? abs(intval($_POST['cash'])) : 0;
	$uid=isset($_POST['uid']) ? abs(intval($_POST['uid'])) : 0;
	$note = isset($_POST['note']) ? functions::checkin(mb_substr(trim($_POST['note']), 0, 100)) : '';
	if($cash<=0 || empty($cash)) {
		$error[]='Số tiền cần chuyển đang để trống';
	}
	if($uid<=0 || empty($uid)) {
		$error[]='Bạn chưa nhập ID cần chuyển';
	}
	if($check=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE id = '".$uid."' AND id != '".$usermain['id']."'"),0)!=1) {
		$error[]='ID bạn nhập không tồn tại';
	}
	if($usermain['coin']<$cash) {
		$error[]='Not enough money';
	}
	if($usermain['xacthuc']==0) {
		$error[]='Your account is not verified';
	}
	if($usermain['status']!=='actived') {
		$error[]='tài khoản chưa được kích hoạt';
	}
	if(empty($error)) {
		mysql_query("UPDATE users SET `coin` = `coin` - '".$cash."' WHERE `id` = '".$usermain['id']."'");
		mysql_query("UPDATE users SET `coin` = `coin` + '".$cash."' WHERE `id` = '".$uid."'");
		$usernhan=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHRE `id` = '".$uid."'"));
			// ghi log
	$reportlog='user: '.$user_id.' transfer '.number_format($cash).' money to user: '.$uid.' done!';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			`note` = '".mysql_real_escape_string($note)."',
			act = 'transfer',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$cash."',
			log = '".$reportlog."',
			box = '".$user_id."'");
			$newid=mysql_insert_id();
			
										

			$textnote='You have successfully transferred the amount of '.number_format($cash).' '.$set['donvi'].' to ID: "'.$uid.'". With the message "'.mysql_real_escape_string($note).'"';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$user_id."'");	
			
			
			$textnote='You have just received the money: '.number_format($cash).' '.$set['donvi'].' from the User ID: '.$user_id.'. With the message "'.mysql_real_escape_string($note).'"';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$uid."'");	
			
			
			
			
					// báo mail cho user được act
			$subject = "You receive the money transfer to";
$headers =  'From: '.$set['email'].'' . "\r\n" .
                    'Reply-To: '.$set['email'].'' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
			
$message = '<html><body style="color:#f2f2f2"><div style="width:450px;max-width:100%;margin:0 auto;"><img src="https://i.imgur.com/p8Ke0sB.png" height="40"/>';
$message .= '<br><h2>You get money from ID: '.$usermain['id'].' </h2><br>';
$message .= '<div style="color:#999"><b>TRANSACTION DETAILS</b>';
$message .= '<div>Amount received <div style="float:right;font-weight:bold;">'.number_format($cash).'</div></div>';
$message .= '<div>Trading code <div style="float:right;font-weight:bold;">'.number_format($newid).'</div></div>';
$message .= '<div>: <div style="float:right;font-weight:bold;"></div></div>';
$message .= '<hr>';
$message .= '<b>SENDER INFORMATION</b>';
$message .= '<div>Sender <div style="float:right;font-weight:bold;">'.$usermain['imname'].'</div></div>';
$message .= '<div>Phone number of the sender <div style="float:right;font-weight:bold;">'.$usermain['mibile'].'</div></div>';
$message .= '<div>Message <div style="float:right;font-weight:bold;">'.$note.'</div></div><hr></div>';
$message .= '<div style="color:black">Check your EarntMoney account balance.<br><Br>';
$message .= 'If you havent received the money in your EarntMoney account yet. Please contact customer service immediately at: '.$set['email'].'';
$message .= '<Br><a href="'.$set['homeurl'].'/"><img src="https://i.imgur.com/lbIpEVp.png"/></a>';
$message .= '<div><i>Best regards<br>EarntMoney software development team</i></div></div>';
$message .= '<div style="background:#f2f2f2;color:#333;padding:15px;text-align:center;">';
$message .= '<a href="'.$set['setmail1'].'>"><img src="https://i.imgur.com/RnJRR40.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail2'].'>"><img src="https://i.imgur.com/aoP8hqu.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail3'].'>"><img src="https://i.imgur.com/CBbdZeK.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail4'].'"><img src="https://i.imgur.com/oSG7cDS.png" height="20"/></a>';					  
$message .= '<br>This email is used for your EarntMoney account. When there is a balance';
$message .= 'transaction you will receive this notification letter USA.China.Vietnam.India.Canada</div>';
$message .= '</div></body></html>';
			
			$success = mail ($usernhan['mail'],$subject,$message,$headers);
			
		?>
		<div style=""><ion-icon name="mail-outline"></ion-icon> Your transfer was done! It's free</div><br>
		<a class="cmt-to-login" href="/transfer.php">Retry</a>
		<div style="color:#ffff00">admin sẽ kiểm tra lại giao dịch. Nếu bị phát hiện gian lận, tài khoản sẽ bị khóa ngay lập tức.</div>
		<?
		
	} else {
		?>
		<div>
		<?php echo functions::display_error($error); ?>
		<a class="cmt-to-login" href="/transfer.php">Retry</a>
		</div>
		<div style="color:#ffff00">admin sẽ kiểm tra lại giao dịch. Nếu bị phát hiện gian lận, tài khoản sẽ bị khóa ngay lập tức.</div>
		<?
	}
} else {
?><form method="post">
<div style="clear:both;"></div><div>ID cần chuyển<div style="float:right;color:orange"><input type="text" name="uid" value="" style="height:30px;border-radius:5px;margin:5px;" placeholder="Nhập ID cần chuyển"/></div></div>
<div style="clear:both;"></div>
<div>Nhập số tiền cần chuyển <div style="float:right;color:orange"><input type="text" value="0" name="cash" style="height:30px;border-radius:5px;margin:5px;" id="cashs" placeholder="Input Cash"/></div></div>
<br>
Nghi chú<br>
<input type="text" value="" name="note" style="width:100%;height:30px;border-radius:5px;margin:5px;" id="note" placeholder="Nhập ghi chú của bạn"/><br>
<span style="color:red">Chọn nhanh</span>
<br>
<br>
<div style="text-align:center">
<span onclick="one()" class="cmt-to-login">+1.000<?php echo $set['donvi']; ?></span>
<span onclick="onex()" class="cmt-to-login">+10.000<?php echo $set['donvi']; ?></span>
<span onclick="onexx()" class="cmt-to-login">+50.000<?php echo $set['donvi']; ?></span>
<span onclick="onexxx()" class="cmt-to-login">+100.000<?php echo $set['donvi']; ?></span>
<span onclick="onexxxx()" class="cmt-to-login">+500.000<?php echo $set['donvi']; ?></span>
<script>
function one() {
	var src = document.getElementById("cashs");
	src.value = 1000;	
}
function onex() {
	var src = document.getElementById("cashs");
	src.value = 10000;	
}
function onexx() {
	var src = document.getElementById("cashs");
	src.value = 50000;	
}
function onexxx() {
	var src = document.getElementById("cashs");
	src.value = 100000;	
}function onexxxx() {
	var src = document.getElementById("cashs");
	src.value = 500000;	
}
</script>
<br>

<button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
</form>

</div>
<? } ?>
<br>
</div></div>	<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

