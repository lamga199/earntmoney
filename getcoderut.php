<?php
define('_IN_JOHNCMS', 1);
$headmod = 'getcoderut';
$textl='CODE';
require('incfiles/core.php');
$usermain=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$user_id."'"));
if(empty($login) || $usermain['status']=='pending' || $usermain['status']=='banned' || empty($usermain['mail'])) {
header('location: /index.php');
}
if($usermain['timecoderut']<time()) {
$rand=mt_rand(1000, 9999);
// cập nhật code và thời gian vào users
// thời gian + 5 phút = hạn update vào timecoderut
mysql_query("UPDATE users SET
coderut = '".$rand."',
timecoderut = '".(time()+300)."'
WHERE id = '".$user_id."'");
			
			
			// báo mail cho user được act
			$subject = "Earnmoney sends the verification code: $rand";
			$message = '<div style="width:300px;max-width:100%;height:150px;border:1px solid pink;padding:20px;margin:20px;text-align:center;font-weight:bold">';
$message .= '<img src="https://i.imgur.com/p8Ke0sB.png" height="40"/>You have requested a verification code to withdraw money on Earnmoney';
$message .= 'Code deadline in 5 minutes.<br>';
$message .= 'Authentication code is<br><center><div style="margin:0 auto;border:1px solid #999;padding:5px;margin: 5px;width:100px;">'.$rand.'</div></center>';
$message .= '</div>';
$headers =  'From: '.$set['email'].'' . "\r\n" .
                    'Reply-To: '.$set['email'].'' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
			$success = mail ($usermain['mail'],$subject,$message,$headers);
			
			
		
?>
<!DOCTYPE html>
<html lang="vi">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="MobileOptimized" content="width">
<meta content="yes" name="apple-mobile-web-app-capable">
<title>Get verification code</title>
<body>
<div>Authentication code has been sent to the mail: <? echo $usermain['mail'];?>, The code is valid for 5 minutes.</div>
</body>
</html>
<? } else {
	?>
<!DOCTYPE html>
<html lang="vi">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="MobileOptimized" content="width">
<meta content="yes" name="apple-mobile-web-app-capable">
<title>Get verification code</title>
<body>
<div>The verification code sent to your email has not expired. After 5 minutes can request a new code.</div>
</body>
</html>
<?
}