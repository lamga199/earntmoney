<?php

define('_IN_JOHNCMS', 1);

require('incfiles/core.php');
$textl = 'Register';
$headmod = 'registration';
require('incfiles/head.php');
require('header.php');


if(core::$user_id){
    header('Location: index.php');
}
?>
<div class="container">
<?php
// Если регистрация закрыта, выводим предупреждение
if (core::$deny_registration || !$set['mod_reg'] || core::$user_id) {
    echo '<p>' . $lng_reg['registration_closed'] . '</p>';
    require('incfiles/end.php');
    exit;
}
$refid = isset($_POST['refid']) ? abs(intval($_POST['refid'])) : false;
$agree = isset($_POST['agree']) ? abs(intval($_POST['agree'])) : 0;
$reg_nick = isset($_POST['nick']) ? trim($_POST['nick']) : '';
$lat_nick = functions::rus_lat(mb_strtolower($reg_nick));
$mail = isset($_POST['mail']) ? functions::checkin(mb_substr(trim($_POST['mail']), 0, 50)) : '';
$mibile = isset($_POST['mibile']) ? functions::checkin(mb_substr(trim($_POST['mibile']), 0, 20)) : '';
$reg_pass = isset($_POST['password']) ? trim($_POST['password']) : '';
$reg_name = isset($_POST['imname']) ? trim($_POST['imname']) : '';
$reg_about = isset($_POST['about']) ? trim($_POST['about']) : '';
$reg_sex = isset($_POST['sex']) ? functions::check(mb_substr(trim($_POST['sex']), 0, 2)) : '';

?><div class="main"><?php
$error = array();
if (isset($_POST['submit'])) {
    // Принимаем переменные
    
    if($agree!=1) {
        
         $error['agreeerror'][] = 'You do not agree to the terms';
    }

	
	
	if (empty($mail)) {
        $error['mail'][] = 'Email not entered';
    } elseif (mb_strlen($mail) < 5 || mb_strlen($mail) > 50) {
        $error['mail'][] = 'Email length is incorrect';
    }
	
	
    // Проверка Логина
    if (empty($reg_nick)) {
        $error['login'][] = 'Do not enter your account name';
    } elseif (mb_strlen($reg_nick) < 2 || mb_strlen($reg_nick) > 15) {
        $error['login'][] = 'Wrong account name length';
    }
	

$req = mysql_query("SELECT * FROM `users` WHERE `name_lat`='" . mysql_real_escape_string($lat_nick) . "'");
        if (mysql_num_rows($req) != 0) {
            $error['login'][] = 'This account already exists';
        }
    // Проверка пароля
    if (empty($reg_pass)) {
        $error['password'][] = 'No password entered';
    } elseif (mb_strlen($reg_pass) < 3 || mb_strlen($reg_pass) > 10) {
        $error['password'][] = 'Wrong password length';
    }

    if (preg_match('/[^\dA-Za-z]+/', $reg_pass)) {
        $error['password'][] = 'There are forbidden characters';
    }
   // check tài khoản giới thiệu có tồn tại không
   if($id) {
		$req2 = mysql_query("SELECT * FROM `users` WHERE `id`='" . $id . "'");
        if (mysql_num_rows($req2) == 0) {
            $error['refid'][] = 'Referral account does not exist';
        }
		$req3 = mysql_query("SELECT * FROM `banrefid` WHERE `refid`='" . $id . "'");
        if (mysql_num_rows($req3) != 0) {
            $error['refid'][] = 'RefID is prohibited';
        }
		$reqx = mysql_query("SELECT * FROM `users` WHERE `id`='" . $id . "' AND `status` = 'actived'");
        if (mysql_num_rows($reqx) == 0) {
            $error['refid'][] = 'The RefID is locked and cannot be used';
        }
   } else if($refid) {
		$req2 = mysql_query("SELECT * FROM `users` WHERE `id`='" . $refid . "'");
        if (mysql_num_rows($req2) == 0) {
            $error['refid'][] = 'Referral account does not exist';
        }
		$req3 = mysql_query("SELECT * FROM `banrefid` WHERE `refid`='" . $refid . "'");
        if (mysql_num_rows($req3) != 0) {
            $error['refid'][] = 'RefID is prohibited';
        }
		$reqx = mysql_query("SELECT * FROM `users` WHERE `id`='" . $refid . "' AND `status` = 'actived'");
        if (mysql_num_rows($reqx) == 0) {
            $error['refid'][] = 'The RefID is locked and cannot be used';
        }
   }

		$req5 = mysql_query("SELECT * FROM `users` WHERE `mail`='" . mysql_real_escape_string($mail) . "'");
        if (mysql_num_rows($req5) != 0) {
            $error['mail'][] = 'Email registered';
        }

   

    if($error) {
		
	} else {
    
        $pass = md5(md5($reg_pass));
        $reg_name = functions::check(mb_substr($reg_name, 0, 100));

        // Проверка, занят ли ник
        
		
    
    
        if($id) {
			$ref=$id;
		} elseif($refid) {
			$ref=$refid;
		} else {
			$ref=0;
		}
		$rand=mt_rand(100000, 999999);
        mysql_query("INSERT INTO `users` SET
            `name` = '" . mysql_real_escape_string($lat_nick) . "',
            `name_lat` = '" . mysql_real_escape_string($lat_nick) . "',
            `password` = '" . mysql_real_escape_string($pass) . "',
            `imname` = '$reg_name',
            `rights` = '0',
            `ip` = '" . core::$ip . "',
            `ip_via_proxy` = '" . core::$ip_via_proxy . "',
            `browser` = '" . mysql_real_escape_string($agn) . "',
            `datereg` = '" . time() . "',
            `lastdate` = '" . time() . "',
            `sestime` = '" . time() . "',
			`mail` = '" . mysql_real_escape_string($mail) . "',
			`mibile` = '" . mysql_real_escape_string($mibile) . "',
            `status` = 'notauth',
			`changebank` = '0',
			`luotquay` = 5,
			`luotxemvideongay` = 5,
			`preg` = '1',
			`actid` = '0',
			`coin` = '0',
			`code_register` = '".$rand."',
			`refid` = '".$ref."'
        ") or exit(__LINE__ . ': ' . mysql_error());
        $usid = mysql_insert_id();
			
			// báo mail cho user được act
			$subject = "Earnmoney successfully registered an account";
			$message = '<div style="width:300px;max-width:100%;height:150px;border:1px solid pink;padding:20px;margin:20px;text-align:center;font-weight:bold">';
$message .= '<img src="https://i.imgur.com/p8Ke0sB.png" height="40"/>User ID: '.$usid.' Account: '.$last_nick.' Enter the code and follow the instructions to activate your account.';
$message .= '<br>';
$message .= 'Your code<br><center><div style="margin:0 auto;border:1px solid #999;padding:5px;margin: 5px;width:100px;">'.$rand.'</div></center>';
$message .= '</div>';
$headers =  'From: '.$set['email'].'' . "\r\n" .
                    'Reply-To: '.$set['email'].'' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
			$success = mail ($mail,$subject,$message,$headers);
			
			
			
			// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'register',
			idtacdong = '".$usid."',
			log = 'notauth',
			box = '".$usid."'");
		//note 
		if($refid>0) {
			$textnote='User ID: '.$usid.' Have successfully registered an account with you as a referrer';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$refid."'");
		}
			// cộng số f1 cho nick ref

		
        // đăng ký thành công
		
        ?>
		<div class="cmt-popup" style="text-align:center">
		<div class="cmt-popup-pad cmt-popup-top">
                <img  height="60" src="/sr/img/favicon.png">
        </div>
		<h4>Active your account</h4>
		<blockquote class="blockquote">
  <p class="mb-0">The email address is associated with the account, we will send a 6-digits confirmation code</p>
</blockquote>
<div class="cmt-to-login-pad cmt-popup-center">
                <a class="cmt-to-login" href="/">Login to active</a>
            </div>
</div>
<?php
        exit;
}
}	

?> 




    <div class="cmt-popup" style="max-width:640px;margin:auto;">
       
            <div class="cmt-popup-pad cmt-popup-top">
                <img width="60" height="60" src="/sr/img/favicon.png">
                <h1>Register account</h1>
            </div>
			<center>Bạn đã có tài khoản <a href="/">ĐĂng nhập</a></center>
						 <form  id="cmt-register-form" method="post">
            <div class="cmt-popup-pad">
                
                <div class="input">
				
                    <input type="email" name="mail" placeholder="Email" value="<?php echo htmlspecialchars($mail);?>" required>
                    <span class="cmt-input-bd">
					<?php echo (isset($error['mail']) ? '<span class="alert-danger"><small>' . implode('<br />', $error['mail']) . '</small></span><br />' : ''); ?>
					
					</span>
                                        <i class="iconfont icon-email"></i>
                </div>
				<div class="input">
				
                    <input type="text" name="nick" placeholder="Tên tài khoản" value="<?php echo htmlspecialchars($reg_nick);?>" <?php echo (isset($error['login']) ? ' style="background-color: #FFCCCC"' : '');?>  required>
                    <span class="cmt-input-bd"><?php echo (isset($error['login']) ? '<span class="alert-danger"><small>' . implode('<br />', $error['login']) . '</small></span><br />' : '');?></span>
					                    <i class="iconfont icon-account"></i>
                </div>
                <div class="input">
				
                    <input type="text" name="password" placeholder="Mật khâu" value="<?php echo htmlspecialchars($reg_pass);?>" <?php echo (isset($error['password']) ? ' style="background-color: #FFCCCC"' : '');?>  required>
                    <span class="cmt-input-bd"><?php echo (isset($error['password']) ? '<span class="alert-danger"><small>' . implode('<br />', $error['password']) . '</small></span><br />' : '');?></span>
                                        <i class="iconfont icon-password"></i>
                    
                </div>
				<p>
				<div id="showpass" onclick="showpass()" name="showpass"><ion-icon name="eye-outline"></ion-icon> show password</div>
			    <div id="hidepass" onclick="hidepass()" name="hidepass" style="display:none;"><ion-icon name="eye-off-outline"></ion-icon> hide password</div>
				</p>
               <script>
	                         function showpass() {
								 $("#showpass").hide();
	                             $("#hidepass").show();
	                             var x = document.getElementById("inputPassword");
                                    if (x.type === "password") {
                                 x.type = "text";
                                 }
							 }
							 function hidepass() {
								  $("#showpass").show();
	                             $("#hidepass").hide();
	                             var x = document.getElementById("inputPassword");
                                    if (x.type === "text") {
                                 x.type = "password";
                                 }
								 
							 }
	                     </script>
				<input type="checkbox" checked="checked" name="agree" value="1" class="form-check-input"> Tôi đông ý với <a href='/tem.php' target='_blank'>Điều khoản& Điều kiện</a> and <a href="/chinhsach.php">Quyền riêng tư</a> 
				<span class="cmt-input-bd">
					
					<?php echo (isset($error['agreeerror']) ? '<span class="alert-danger"><small>' . implode('<br />', $error['agreeerror']) . '</small></span>' : '');?>
					</span>

                
            </div>
            <div class="cmt-popup-error"></div>
            <div class="cmt-submit-pad">
                <button type="submit" name="submit" class="cmt-btn cmt-auth-submit">Register</button>
            </div>
			</form>
            <div class="cmt-popup-agree">Nếu tạo tài khoản đồng ý với <a href='/qd.php' target='_blank'>Điều khoản & Điều kiện</a> và <a href="">Chính sách bảo mật </a> của EarntMoney.</div>
			
            <div class="cmt-to-login-pad cmt-popup-center">
                <a class="cmt-to-login" href="/">Login</a>
            </div>
        
        <div class="cmt-popup-loading">
            <div class="cssload-spin-box"></div>
        </div>
    </div>
</div>

</div>
<?php
require('incfiles/end.php');
