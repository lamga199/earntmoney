<?php
define('_IN_JOHNCMS', 1);
$headmod = 'ruttien';
$textl='Withdrawal';
date_default_timezone_set('Asia/Ho_Chi_Minh');
require('incfiles/core.php');
require('incfiles/head.php');

if(empty($login)) {
header('location: /index.php');
} else { require('header.php');
?>

<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Withdrawal</div>
<div style="background-image:url('/sr/img/bg3.jpg');text-align:left;;padding:10px;">
<? 
if(isset($_POST['submit'])) {
$bank=isset($_POST['bank']) ? abs(intval($_POST['bank'])) : 0;
$code=isset($_POST['code']) ? abs(intval($_POST['code'])) : 0;
$coin=isset($_POST['coin']) ? abs(intval($_POST['coin'])) : 0;
$pass = isset($_POST['pass']) ? functions::check($_POST['pass']) : NULL;
if($usermain['xacthuc']==0) {
		$error[]='Tài khoản của bạn chưa được xác thực';
	}
	if($usermain['status']!=='actived') {
		$error[]='Tài khoản của bạn chưa được kích hoạt';
	}
	if(empty($pass)) {
		$error[]='Không để trống Mật khẩu';
	} else if ($pass && (mb_strlen($pass) < 3 || mb_strlen($pass) > 15)) {
        $error[] = 'Độ dài mật khẩu tài khoản không chính xác';
	} else if (md5(md5($pass)) != $usermain['password']) {
		$error[] = 'Mật khẩu không đúng';
	}
	if(empty($bank) || $bank<=0 || $bank>2 || $bank='') {
		$error[]='Do not empty Bank';
	}
	
	if($coin==0) {
		$error[]='Chưa nhập số tiền bạn muốn rút';
	}
	if($coin<0) {
		$error[]='Cảnh báo nhập sai, tài khoản sẽ bị khóa nếu cố tình vi phạm';
	}
	if($coin>$usermain['coin']) {
		$error[]='Số tiền bạn muốn rút vượt quá số tiền bạn có';
	}
	if($usermain['changebank']==0 && empty($usermain['paypal'])) {
		$error[]='Vui lòng thêm thông tin ngân hàng hoặc PayPal để thực hiện';
	}
	if($coin<50000) {
		$error[]='Số tiền rút về Ngân Hàng tối thiểu 50.000đ';
	}
	if(date("H",time()+$set['timeshift']*3600)<20 && date("H",time()+$set['timeshift']*3600)>21 || strtolower(date("l"))=='sunday') {
		$error[]='Withdrawals can only be made during 20:00 - 21:59 daily, except Sunday';
	}
	if($usermain['status']=='pending' || $usermain['status']=='banned' || $user_id==$set['admin_nhan_coin']) {
		$error[]='Tài khoản của bạn không thể thực hiện điều này';
	}
	if($countcheck=mysql_result(mysql_query("SELECT COUNT(*) FROM yeucaurut WHERE user = '".$user_id."' AND status = 'pending'"),0)>0) {
		$error[]='Bạn đang có một yêu cầu trước đó. Xin hãy chờ đợi!';
	}
	if($code!=$usermain['coderut']) {
		$error[]='Mã OTP không chính xác';
	}
	if($code==$usermain['coderut'] && time()>$usermain['timecoderut']) {
		$error[]='Mã xác thực đã hết hạn. Vui lòng thử lại';
	}
	if(empty($error)) {
		// cộng số yêu cầu rút tiền + 1 (yeucaurutcount + 1), code reset, time code reset
		mysql_query("UPDATE users SET
		yeucaurutcount = yeucaurutcount + 1,
		coderut = '',
		timecoderut = ''
		WHERE
		id = '".$user_id."'
		");
		
		// gửi thông tin yêu cầu rút đến admin
		mysql_query("INSERT INTO yeucaurut SET 
		user = '".$user_id."',
		admin = '".$set['admin_nhan_coin']."',
		coin = '".$coin."',
		coin_old = '".$usermain['coin']."',
		bank = '".$usermain['bank']."',
		namebank = '".$usermain['namebank']."',
		paypal = '".$usermain['paypal']."',
		stk = '".$usermain['stk']."',
		status = 'pending',
		time = '".time()."',
		timedone = '0',
		admin_duyet = '0'");
		$newid=mysql_insert_id();
		// cập nhật log cho user
		mysql_query("INSERT INTO log SET
		time = '".time()."',
		act = 'yeu cau rut coin',
		idtacdong = '".$user_id."',
		box = '".$user_id."',
		coin_minus = '".$coin."',
		boxid = '".$newid."',
		log = 'ID: $user_id yeu cau rut tiền về tài khoản ".($bank==1 ? 'ngân hàng' : 'paypal')." coin_minus = ".number_format($coin).", yeucaurutcount + 1 cho $user_id'
		");
		$newid=mysql_insert_id();
			function anchu($text,$so) {
				$countchu=strlen($text);
				$cuoi=substr($text, -$so);
				$kitu=$countchu-$so;
				for($i=0;$i<=$kitu;$i++) {
					echo '*';
				}
				echo $cuoi;
				
			}
	$subject = "You have successfully withdrawn";
$headers =  'From: '.$set['email'].'' . "\r\n" .
                    'Reply-To: '.$set['email'].'' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
$message = '<html><body style="color:#f2f2f2">';
$message .= '<div style="width:450px;margin:0 auto;max-width:100%">';
$message .= '<div style="border-top:2px solid red;background:#FBF8EF;color:orange;font-weight:bold;">';
$message .= '<img src="https://i.imgur.com/K5Gxwsu.png"/>EarntMoney Commercial Services</div>';
$message .= '<br><h4 style="color:orange">EarntMoney invoices</h4>';
$message .= 'Dear customers<br>Thank you for using EarntMoneys services';		
$message .= '<div style="margin:0 auto;">The Payment<br><b>'.number_format($coin).''.$set['donvi'].'</b></div>';
$message .= '<div style="color:#999"><b>INVOICE INFORMATION</b>';
$message .= '<div>Bank<div style="float:right;font-weight:bold;">'.$usermain['bank'].'</div></div>';
$message .= '<div>Acount number <div style="float:right;font-weight:bold;">'.anchu($usermain['stk'],3).'</div></div>';
$message .= '<div>ID <div style="float:right;font-weight:bold;">'.ancmnd($usermain['cmnd'],7).'</div></div>';
$message .= '<hr>';
$message .= '<div>Service <div style="float:right;font-weight:bold;">Withdrawal</div></div>';
$message .= '<div style="font-weight:bold;">Withdrawal money to the bank <div style="float:right;font-weight:normal">EarntMoney Services</div></div>';
$message .= '<div> Time<br>'.date("H:i:s",time()+73600).'<div style="float:right;font-weight:normal">Trading code<br>'.$newid.'</div></div>';
$message .= '<div style="color:#999"><b> TRANSACTION DETAILS</b></div>';
$message .= '<hr>';
$message .= '<div>Amount of money<div style="float:right;font-weight:bold;">'.number_format($coin).''.$set['donvi'].'</div></div>';
$message .= '<div>    Transaction fee <div style="float:right;font-weight:bold;">free</div></div>';
$message .= '<div style="color:black">Total <div style="float:right;font-weight:bold;">'.number_format($coin).''.$set['donvi'].'</div></div>';
$message .= '<div style="background:orange;color:white;padding:15px;text-align:center;">';
$message .= '<b>EarntMoney E-Commerce Service </b><br>(E Service )<br>USA.China.Vietnam.India.Canada <br>';
$message .= '<a href="'.$set['setmail1'].'>"><img src="https://i.imgur.com/RnJRR40.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail2'].'>"><img src="https://i.imgur.com/aoP8hqu.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail3'].'>"><img src="https://i.imgur.com/CBbdZeK.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail4'].'"><img src="https://i.imgur.com/oSG7cDS.png" height="20"/></a>';
$message .= '<hr style="color:#f2f2f2">		';								  
$message .= '<br>You received this message from your <b>EarntMoney</b> account<br>incoming mail when logging into accounts in many different devices</div>';
$message .= '</div></body></html>';



			$success = mail ($usermain['mail'],$subject,$message,$headers);
			?>
			
			<div class="alert alert-success" role="alert">
		Yêu cầu rút tiền thành công. Vui lòng chờ để được sử lý, bạn có thể theo dõi ở mục thông báo khi quá trình hoàn tất.
		</div>
			<?
	} else {
		
		?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
		 <div><a class="cmt-to-login" href="/yeucau.php">Thực hiện lại</a></div>
		<?
	}
} else {?>
<form method="post">
<table style="width:100%">
<tr>
<td style="width:50%">
<h4 style="height:25px;padding:5px;font-weight:normal;">Chọn ngân hàng liên kết</h4>


<select name="bank" style="width:100%;height:40px;background:#000;color:#fff;">

<?php if($usermain['changebank']>0) {?>
<option value="1"><?php echo $usermain['bank']; ?></option>
<? } ?>
<? if(!empty($usermain['paypal'])) { ?>
<option value="2">Paypal: <? echo $usermain['paypal'];?></option>
<? } ?>
</select>
<?php if($usermain['changebank']>0) {?>
<div><a  style="color:orange" href="/report.php?act=changebank">Cập nhật thông tin ngân hàng</a> - <a style="color:orange" href="/account.php">Cập nhật Email Paypal</a></div>
<?php } else { ?>
<div><a style="color:orange" href="/account.php">Cập nhật thông tin ngân hàng</a> - <a style="color:orange" href="/account.php">Cập nhật Email Paypal</a></div>
<? } ?>
</td>
<td style="width:50%"><h4 style="height:25px;padding:5px;font-weight:normal;">
Số tiền rút <span style="color:#ff00ff;text-lign:right">(Min: 50.000 <? echo $set['donvi'];?>)</span></h4>
<input name="coin" type="text" style="width:100%;height:40px;background:#000;color:#fff;" value="0"/>
<div>Nhập số tiền cần rút</div>
</td>
</tr>
<tr><td style="width:50%">
<h4 style="height:25px;padding:5px;font-weight:normal;">OTP</h4>
<a target="_blank" class="cmt-to-login" href="/getcoderut.php">send code</a><br>
<input name="code" type="text" style="width:100%;height:40px;background:#000;color:#fff;" value=""/>
</td>

<td style="width:50%">
<h4 style="height:25px;padding:5px;font-weight:normal;">Mật Khẩu</h4><br><br>
<input name="pass" type="text" style="width:100%;height:40px;background:#000;color:#fff;" value=""/>
</td>

</tr>
</table>
<br>
<center>
<button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
</form>

<? } ?>
<div style="margin-top:20px;padding:5px;border:1px dotted #999;"><span style="color:pink">Waring:</span> EarntMoney không chịu trách nhiệm về việc người dùng nhập sai thông tin hoặc mất do lỗi của người dùng</div>

</div>
</div>

<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<? } ?>