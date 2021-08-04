<?php

defined('_IN_JOHNCMS') or die('Error: restricted access');
if(empty($login)) {?>
<?php require('header.php'); ?>


<?php
if(isset($_POST['submit'])) {
$error = array();
    $captcha = FALSE;
    $display_form = 1;
    $user_login = isset($_POST['n']) ? functions::check($_POST['n']) : NULL;
    $user_pass = isset($_POST['p']) ? functions::check($_POST['p']) : NULL;
    $user_mem = isset($_POST['mem']) ? 1 : 0;
    $user_code = isset($_POST['code']) ? trim($_POST['code']) : NULL;
    if ($user_pass && !$user_login)
        $error[] = 'Chưa nhập tên tài khoản';
    if ($user_login && !$user_pass)
        $error[] = 'Chưa nhập mật khẩu';
    if ($user_login && (mb_strlen($user_login) < 2 || mb_strlen($user_login) > 20))
        $error[] = 'Độ dài tài khoản không đúng';
    if ($user_pass && (mb_strlen($user_pass) < 3 || mb_strlen($user_pass) > 15))
        $error[] = 'Độ dài mật khẩu tài khoản không đúng';
    if (!$error && $user_pass && $user_login) {
        // Запрос в базу на юзера
        $req = mysql_query("SELECT * FROM `users` WHERE `name_lat`='" . functions::rus_lat(mb_strtolower($user_login)) . "' LIMIT 1");
        if (mysql_num_rows($req)) {
            $user = mysql_fetch_assoc($req);
            if ($user['id']) {
                if (md5(md5($user_pass)) == $user['password']) {
                    // Если логин удачный
                    $display_form = 0;
                    mysql_query("UPDATE `users` SET `failed_login` = '0' WHERE `id` = '" . $user['id'] . "'");
                    
                        if (isset($_POST['mem'])) {
                            $cuid = base64_encode($user['id']);
                            $cups = md5($user_pass);
                           
                            setcookie("cuid", $cuid, time() + 3600 * 24 * 365);
                            setcookie("cups", $cups, time() + 3600 * 24 * 365);
                            
                        }
                        // Установка данных сессии
						$token = base64_encode(random_bytes(10).rand());
						$_SESSION['agreepaypal']='refuse';
						$_SESSION['ubr']=trim($token);
                        $_SESSION['uid'] = $user['id'];
                        $_SESSION['ups'] = md5(md5($user_pass));
                       
					   mysql_query("UPDATE `users` SET `token` = '" . $token . "' WHERE `id` = '" . $user['id'] . "'");
                        mysql_query("UPDATE `users` SET `sestime` = '" . time() . "' WHERE `id` = '" . $user['id'] . "'");
						if ($user['browser'] != $agn) {
		 mysql_query("UPDATE `users` SET `browser` = '" . mysql_real_escape_string($agn) . "', `brnew` = '1' WHERE `id` = '" . $user['id'] . "'");
	

	
						
						function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}
	

$header =  'From: '.$set['email'].'' . "\r\n" .
                    'Reply-To: '.$set['email'].'' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
			$mail = $usermain['mail'];
			$subject = "EarntMoney account security warning!";
			$message = '<html><body style="color:#f2f2f2">';
			$message .= '<div style="width:100%;max-width:500px;height:50px;border-top:2px solid orange;background:#F8ECE0;color:black;font-size:20px;font-weight:bold;vertical-align:middle;">';
			$message .= '<img src="https://i.imgur.com/y62gBfT.png" height="40"/> EarntMoney Commercial Services</div>';
$message .= '<h3 style="color:orange">EarntMoney account security warning!</h3>';
$message .= '<br>Dear customers<br>';	
$message .= '<br> Your EarntMoney account '.obfuscate_email($usermain['mail']).' has been successfully<br>ogged in on another device<br>';				
$message .= '<table style="width:100%"><tr style="width:100%"><td style="width:50%">TIME:<br>	';		
$message .= '<b style="color:orange">'.date("H:i:s d/m/Y",time()+7*3600).'</b></td>';
$message .= '<td style="width:50%">DEVICE:<br><b style="color:orange">'.$usermain['browser'].'</b></td></tr></table>';
$message .= '<br>For safety if its not done by you. Chances are your account was already being used		';			
$message .= 'by someone to sign in to your EarntMoney account.	';				
$message .= '<br>Check your activity and sign in EarntMoney to <b>Change your Password</b> right	';				
$message .= 'away to proactively protect your account!<br>';
$message .= 'If you need further assistance, please contact customer service and send inquiry	';				
$message .= 'to: <b style="color:orange">'.$set['email'].'</b><br><br><br>		';	
$message .= '<a href="'.$set['homeurl'].'" style="margin:10px;border:0px; background:orange;color:white;padding:10px;border-radius:5px;">Sign in now</a>	';
$message .= '<br><br><br><b>Please Note</b>: EarntMoney absolutely does not require you to provide a Password or an	';				
$message .= 'authentication code (OTP), please do not share it with anyone including EarntMoney				';	
$message .= 'counselors in any case.					';
$message .= '<br>Best regards<br>EarntMoney software development team		';
$message .= '<div style="background:orange;color:white;padding:15px;text-align:center;">';
$message .= '<b>EarntMoney E-Commerce Service </b><br><br>USA.China.Vietnam.India.Canada <br>';
$message .= '<a href="'.$set['setmail1'].'>"><img src="https://i.imgur.com/RnJRR40.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail2'].'>"><img src="https://i.imgur.com/aoP8hqu.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail3'].'>"><img src="https://i.imgur.com/CBbdZeK.png" height="20"/></a>';
$message .= '<a href="'.$set['setmail4'].'"><img src="https://i.imgur.com/oSG7cDS.png" height="20"/></a>';
$message .= '<hr style="color:#f2f2f2">		';								  
$message .= '<br>You received this message from your <b>EarntMoney</b> account<br>incoming mail when logging into accounts in many different devices</div>';
			$message .= '</body></html>';
			
			$success = mail ($mail,$subject,$message,$header);
			} else {
				mysql_query("UPDATE `users` SET `brnew` = '0' WHERE `id` = '".$user['id']."'");
			}
			
			
                        $set_user = unserialize($user['set_user']);
                        if($user['rights>7']) {
                            header('Location: /admin/index.php');
                        } else {
                        
                            header('Location: /index.php');
                        }
                    
                } else {
                    if ($user['failed_login'] < 3) {
                        mysql_query("UPDATE `users` SET `failed_login` = '" . ($user['failed_login'] + 1) . "' WHERE `id` = '" . $user['id'] . "'");
                    }
                    $error[] = 'Thông tin tài khoản không đúng';
                }
            }
        } else {
            $error[] = 'Thông tin tài khoản không đúng';
        }
	}
	if ($error)
            echo functions::display_error($error);
}

?>
<style>
.h3.headline-brand, h3.headline-brand {
    font-size: 2.5rem;
    line-height: 2.25rem;
}
#create-account-link {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
	font-size:20px;
	margin-top:10px;
}
 #create-account-link p {
    margin-right: 5px;
    margin-bottom: 0px;
}
#login-panel #new-ux a {
    cursor: pointer;
}
label {
    display: inline-block;
    margin-bottom: .25rem;
    font-weight: var(--z2343f,700);
	font-size:18px;
}
.form-control {
    display: block !important;
    min-height: 40px !important;
    width: 100% !important;
    padding: .375rem .75rem !important;
    font-size: 16px !important;
    font-weight: var(--bxjxgl,500) !important;
    line-height: 1.5rem !important;
    color: #2b2b2b !important;
    background-color: #fff !important;
    background-image: none;
    background-clip: padding-box !important;
    border: .0625rem solid #d4dbe0 !important;
    vertical-align: middle !important;
    border-radius: 0;
    box-shadow: none !important;
    transition: .3s all ease-in-out !important;
}
.cmt-popup-pad-login{
	padding:0px 50px 20px 50px;
}
.login_socail a{
	display:inline-block;
	width:50%;
	float:left;
}
#social-logo {
    display: block;
    position: relative;
    height: 20px;
    margin-right: 8px;
}
#social-logo {
    width: 15px;
}
.ux-btn-set.ux-btn-split .ux-btn-set-item {
    width: 100%;
    
}
.ux-btn-set.ux-btn-split .ux-btn-set-item {
    display: flex;
    flex-grow: 1;
    justify-content: center;
    align-items: center;
	background:none;
	border:3px solid #000;
	width:98%;
}
.alternative-login-button {
    min-height: 40px;
}
#google-btn-txt {
    color: black!important;
}
</style>
<div class="main">
    <div class="cmt-popup" style="max-width:640px;margin:auto">
		
        <form method="post">
            <div class="cmt-popup-pad cmt-popup-top" style="padding-bottom:0px;">
                <img  height="60" src="/sr/img/logonew.png">
                <h3 class="m-b-md m-t-sm headline-brand">ĐĂNG NHẬP</h3>
				<div id="create-account-link"><p>Bạn là thành viên mới của EarntMoney?</p><a target="_self" id="create_account" href="/reg.php">Tạo tài khoản</a></div>
            </div>
            <div class="cmt-popup-pad-login">
                <div class="input" style="padding-bottom:0px;">
					<label for="username" id="label-username">Tên tài khoản </label>
                    <input class="form-control" type="text" id="n" name="n" placeholder="" value="" required>
                  
                </div>
                <div class="input">
					<label for="username" id="label-username">Mật khẩu</label>
					<div style="float:right;" id="showpass" onclick="showpass()" name="showpass"><ion-icon name="eye-outline"></ion-icon> hiện</div>
					<div style="float:right; display:none;"  id="hidepass" onclick="hidepass()" name="hidepass" style=""><ion-icon name="eye-off-outline"></ion-icon> ẩn</div>
					
						<input class="form-control" type="password" id="inputPassword" name="p" placeholder="" value="" required>
                    
                </div>
				<div class="input" style="padding-bottom:0px;">
					<button style="color: #fff!important; background: #111!important;padding-bottom:10px; padding-top:10px;" type="submit" name="submit" class="cmt-btn cmt-auth-submit"><strong>LOGIN</strong></button>
				</div>
				<div class="input" style="padding-bottom:0px;">
				<!--	<p id="text-social-button-divider" style="text-align:center;font-size:16px;">Or sign in with</p>-->
				</div>
				<div class="input">
				<div class="ux-btn-set ux-btn-split login_socail" role="group">
				    <!-- đăng nhập bằng face và google--> 
				<!--<a href="<? echo $loginUrl;?>"><button target="_top" tabindex="0" class="btn btn-default ux-btn-set-item alternative-login-button" id="facebook_auth" type="button" aria-label="Hoặc đăng nhập với Facebook"><svg id="social-logo" class="fb-logo" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1600 1600"><path d="m1600 800c0-441.828125-358.17188-800-800-800-441.828125 0-800 358.171875-800 800 0 399.30313 292.548437 730.26563 675 790.28125v-559.03125h-203.125v-231.25h203.125v-176.25c0-200.5 119.434375-311.25 302.171875-311.25 87.526565 0 179.078125 15.625 179.078125 15.625v196.875h-100.87812c-99.379692 0-130.37188 61.667187-130.37188 124.932812v150.067188h221.875l-35.46875 231.25h-186.40625v559.03125c382.45156-60.01562 675-390.97812 675-790.28125" fill="#1877f2"></path><path d="m1146.875 800h-221.875v-150.067188c0-63.265625 30.992188-124.932812 130.37187-124.932812h100.87813v-196.875s-91.55156-15.625-179.078125-15.625c-182.7375 0-302.171875 110.75-302.171875 311.25v176.25h-203.125v231.25h203.125v559.03125c40.729687 6.39063 82.475 9.71875 125 9.71875s84.270313-3.32812 125-9.71875v-559.03125h186.40625z" fill="#fff"></path></svg><span id="facebook-btn-txt">Facebook</span></button></a>
				<a href="<? echo $loginUrl_google;?>"><button target="_top" tabindex="0" class="btn btn-default ux-btn-set-item alternative-login-button" id="google_auth" type="button" aria-label="Hoặc đăng nhập với Google"><svg id="social-logo" class="google-logo" version="1.1" x="0px" y="0px" viewBox="0 0 533.5 544.3"><g><path class="google-st0" d="M533.5,278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1,33.8-25.7,63.7-54.4,82.7v68h87.7 C503.9,431.2,533.5,361.2,533.5,278.4z"></path><path class="google-st1" d="M272.1,544.3c73.4,0,135.3-24.1,180.4-65.7l-87.7-68c-24.4,16.6-55.9,26-92.6,26c-71,0-131.2-47.9-152.8-112.3 H28.9v70.1C75.1,486.3,169.2,544.3,272.1,544.3z"></path><path class="google-st2" d="M119.3,324.3c-11.4-33.8-11.4-70.4,0-104.2V150H28.9c-38.6,76.9-38.6,167.5,0,244.4L119.3,324.3z"></path><path class="google-st3" d="M272.1,107.7c38.8-0.6,76.3,14,104.4,40.8l0,0l77.7-77.7C405,24.6,339.7-0.8,272.1,0C169.2,0,75.1,58,28.9,150 l90.4,70.1C140.8,155.6,201.1,107.7,272.1,107.7z"></path></g></svg><span id="google-btn-txt">Google</span></button></a>-->
				</div>
				</div>
				<p>
				
			    
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
            </div>
		</form>	
		<br style="clear:both;">
		<div class="cmt-popup-pad-login">
			<p id="recovery-links">Cần tìm <a style="" target="_top" id="forgot_password" class="text-primary-o" href="/resetpassword.php">mật khẩu của bạn</a>?</p>
		</div>
            
        
        <div class="cmt-popup-loading">
            <div class="cssload-spin-box"></div>
        </div>
    </div>
</div>



</body></html>
	  <?php } else { 
	  require('header.php');
	  if(empty($usermain['mail'])) { 
	  ?>
	   <div class="main" style="width:100%;;max-width:100%;margin:auto">
	  
	  <div style="background:#fff">
	   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="cmt-popup-pad cmt-popup-top">
                <img  height="60" src="/sr/img/favicon.png">
                <h4 style="color:black">You need have an email</h4>
				<blockquote class="blockquote;margin:0 auto;text-align:center;">
				
  <p class="mb-0">Cập nhật Gmail của bạn để có thể sử dụng tài khoản</p>
  
			
</blockquote>
            </div>
      </div>
	  <div  style="text-align:center;margin:0 auto">
	  <?
	  if(isset($_POST['submit'])) {
		  $mail = isset($_POST['mail']) ? functions::checkin(mb_substr(trim($_POST['mail']), 0, 100)) : '';
		  if (mb_strlen($mail) < 5 || mb_strlen($mail) > 100) {
            $error[] = 'Email not correct';
	}
	$countmail=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `mail` = '".mysql_real_escape_string($mail)."' AND `id` != '".$user_id."'"),0);
	if(!empty($countmail) && $countmail>0) {
		$error[] = 'This Email registered on website';
	}
	if(empty($error)) {
		  mysql_query("UPDATE `users` SET `mail` = '".mysql_real_escape_string($mail)."' WHERE `id` = '".$usermain['id']."'");
		header('location: /');  
	} else {
		
		?>
	
	<div class="alert alert-danger" role="alert" style="color:red;text-align:center;">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	}
	  }
	  ?>
	  <form method="post" style="">
		<input style="padding:5px;border:1px solid #999;border-radius:5px;height:25px;width:300px;;margin:10px;" name="mail" type="text" value="" placeholder="input your email"/><br>
		<button type="submit" name="submit" class="cmt-btn cmt-auth-submit" style="width:120px;">Update mail</button><br><br>
		
		</form>
	  </div>
	  
	  </div>
	   </div>
	  <?
	  exit;
	  }
	  ?>
	  <div class="main" style="width:640px;max-width:100%;margin:auto">
	  
	  <div style="background:#E0F8F1">
	  
	  <?php require('uinfo.php');?>
            </div>
	   <?php require('topmenu.php');?>
	  
	  
	  
	  
	  <div class="cmt-popup-pad cmt-popup-top" style="background:#fff">
	DANH SÁCH NHIỆM VỤ  <? //echo $_SESSION['ubr'];?>
	  <table id="MyTable" name="MyTable" style="margin:0 auto;">
	  <tr style="width:100%;margin:10px;">

	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($usermain['status']=='pending') { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image043.png" height="60" style="filter: grayscale(100%);"/>
	  <div style="position: absolute;top: 25%;left: 30%;color:red">kích hoạt</div>
	  </div>Nhiệm vụ mới
	  <?
	  } else {  
	  if($set['bonusdaily_on']=='on') { ?>
	  <a href="/diemdanhday.php">
	  <img src="/sr/img/image043.png" height="60"/><br>Nhiệm vụ mới
	  </a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image043.png" height="60" style="filter: grayscale(100%);"/>
	  <div style="position: absolute;top: 25%;left: 30%;color:red">Sắp ra mắt</div>
	  </div>Nhiệm vụ mới
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['bonusdaily_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'bonusdaily_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="bonusdaily_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }
	  
	  }?>
	  </td>
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($usermain['status']=='pending') { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image045.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">kích hoạt</div>
	  </div>Thưởng bạn bè
	  <? } else { ?>
	  <?php if($set['diemdanh_on']=='on') { ?>
	  <a href="/diemdanh.php">
	  <img src="https://i.imgur.com/nNn45CU.png" height="60"/><br>Thưởng bạn bè</a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="https://i.imgur.com/nNn45CU.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Kết thúc</div>
	  </div>Thưởng bạn bè
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['diemdanh_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'diemdanh_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="diemdanh_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }}?>
	  </td>
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($usermain['status']=='pending') { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image047.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">kích hoạt</div>
	  </div>Quay may mắn
	  <? } else { ?>
	  <?php if($set['vongquay_on']=='on') { ?>
	  <a href="/roll.php">
	  <img src="/sr/img/image047.png" height="60"/><br>LucKy
	  </a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image047.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Bảo trì</div>
	  </div>Quay may mắn
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['vongquay_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'vongquay_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="vongquay_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }}?>
	  </td>
	  </tr>
	  <tr style="width:100%;margin:10px;">
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($set['paypaltrade_on']=='on') { ?>
	 
	  <a href="/paypal.php"><img onclick="paypal()" src="/sr/img/image051.png" height="60" /><br>Mua Bán PayPal</a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image051.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Bảo trì</div>
	  </div>Mua Bán PayPal
	 
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['paypaltrade_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'paypaltrade_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="paypaltrade_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }?>
	   
	  </td>
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($usermain['status']=='pending') { ?>
	   <div style="position: relative">
	  <img src="/sr/img/image053.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">kích hoạt</div>
	  </div>Nạp Game SMS
	  <? } else { ?>
	  <?php if($set['paygame_on']=='on') { ?>
	  <a href="/paygame.php">
	  <img src="/sr/img/image053.png" height="60"/><br>Nạp Game SMS</a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image053.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Bảo trì</div>
	  </div>Nạp Game SMS
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['paygame_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'paygame_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="paygame_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }}?>
	  
	  </td>
	  
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($usermain['status']=='pending') { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image055.png" height="20" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">kích hoạt</div>
	  </div>Thanh toán K+
	  <? } else { ?>
	  <?php if($set['payk_on']=='on') { ?>
	  <a href="/payk.php">
	  <img src="/sr/img/image055.png" height="20"/><br>Thanh toán K+</a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image055.png" height="20" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Bảo trì</div>
	  </div>Thanh toán K+
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['payk_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'payk_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="payk_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }}?>
	  </td>
	  </tr>
	  <tr style="width:100%;margin:10px;">
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($set['video_on']=='on') { ?>
	  <a href="/video.php">
	  <img src="/sr/img/image061.png" height="60"/><br>Kiếm tiền Video</a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image061.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Bảo trì</div>
	  </div>Watch Video
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['video_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'video_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="video_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }?>
	  </td>
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($usermain['status']=='pending') { ?>
	   <div style="position: relative">
	  <img src="/sr/img/image057.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">kích hoạt</div>
	  </div>Thanh toán Internet
	  <? } else { ?>
	  <?php if($set['payinternet_on']=='on') { ?>
	  <a href="/payinternet.php">
	  <img src="/sr/img/image057.png" height="60"/><br>Thanh toán Internet</a>
	  <? } else { ?>
	  <div style="position: relative">
	  <img src="/sr/img/image057.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Bảo trì</div>
	  </div>Pay Internet
	  <? } ?>
	  <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['payinternet_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'payinternet_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="payinternet_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }}?>
	  </td>
	  <td style="width:200px;max-width:33%;padding:10px;">
	  <?php if($set['phonecard_on']=='on') { ?>
	  <a href="/phonecard.php">
	  <img src="/sr/img/image059.png" height="60"/><br>Nạp tiền điện thoại</a>
	  <? } else { ?>
	  <div style="position: relative">
	   <img src="/sr/img/image059.png" height="60" style="filter: grayscale(100%);"/><div style="position: absolute;top: 25%;left: 30%;color:red">Bảo trì</div>
	  </div>Nạp tiền điện thoại
	   <? } ?>
	   <? if($usermain['rights']>=9) {?>
	  <br><br>
	  <?
	  if(isset($_POST['phonecard_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'phonecard_on'");
		 header('location: /');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="phonecard_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }?>
	  </td>
	  </tr>
	  </table>
	  
	  </div>
	  
	  
	  
	   <?php require('botmenu.php');?>
	  
	  <?php
	  
	  
	 
	  ?>
	  


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fe4a071df060f156a8fe2a7/1eqah5fhb';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<?php } ?>
