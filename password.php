<?php
define('_IN_JOHNCMS', 1);
$headmod = 'video';
$textl='Password';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login) && $rights<9) {
header('location: /index.php');
} else {
require('header.php');

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
<?php require('uinfo.php');?>
</div>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Change password</div>
</div>
<div style="background:white;padding:10px;">
<?
if(isset($_POST['submit'])) {
	$passcu = isset($_POST['passcu']) ? trim($_POST['passcu']) : '';
	$passmoi = isset($_POST['passmoi']) ? trim($_POST['passmoi']) : '';
	if(md5(md5($passcu))!=$usermain['password']) {
		$error[]='Old password is incorrect';
	}
	if(empty($passcu) || empty($passmoi)) {
		$error[]='Missing input';
	}
	if (preg_match('/[^\dA-Za-z]+/', $passcu)) {
        $error[] = 'There are forbidden characters';
    }
	if (preg_match('/[^\dA-Za-z]+/', $passmoi)) {
        $error[] = 'There are forbidden characters';
    }
	if (mb_strlen($passcu) < 3 || mb_strlen($passcu) > 10) {
        $error[] = 'Wrong old password length';
    }
	if (mb_strlen($passmoi) < 3 || mb_strlen($passmoi) > 10) {
        $error[] = 'New password length wrong';
    }
	if($passcu==$passmoi) {
		$error[] = 'The old password is the same as the new one';
	}
	if(empty($error)) {
		
		mysql_query("UPDATE users SET password = '".md5(md5($passmoi))."' WHERE id = '".$user_id."'");
		
		// báo mail cho user được act
			$subject = "Earnmoney sends a new password: $passmoi";
			$message = '<div style="width:300px;max-width:100%;height:150px;border:1px solid pink;padding:20px;margin:20px;text-align:center;font-weight:bold">';
$message .= '<img src="https://i.imgur.com/p8Ke0sB.png" height="40"/>User name: '.$usermain['name'].' ID: '.$usermain['id'].' Has been asked to change password successfully. Please change';
$message .= 'the new password within 24h to protect your account.<br>';
$message .= 'Your new password<br><center><div style="margin:0 auto;border:1px solid #999;padding:5px;margin: 5px;width:100px;">'.$passmoi.'</div></center>';
$message .= '</div>';
$headers =  'From: '.$set['email'].'' . "\r\n" .
                    'Reply-To: '.$set['email'].'' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
			$success = mail ($usermain['mail'],$subject,$message,$headers);
			
		?>
			<div class="alert alert-success" role="alert">
		Password successfully changed! please exit the login session to try again.
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
<h5>Old password</h5>
<input class="form-control" name="passcu" id="passcu" value="" placeholder=""/><br>
<h5>New password</h5>
<input class="form-control" name="passmoi" id="passmoi" value="" placeholder=""/><br>
<button class="cmt-to-login" name="submit" type="submit">Change</button> 
</form>

<div style="clear:both;"></div>

<br>
<a href="/resetpassword.php">Forgot password?</a>
<div><i class="text-muted">Only contact the above information when really necessary, other contents can be reported to the admin via <a href="/report.php">report page</a></i></div>

  </div></div>
</div>
    
      
<?php require('incfiles/end.php');?>
<?php } ?>
