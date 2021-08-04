<?php
define('_IN_JOHNCMS', 1);
$headmod = 'report';
$textl='Mail';
require('../incfiles/core.php');

require('../incfiles/head.php');
if(empty($login) && $rights<=9) {
header('location: /index.php');
} else { ?>
<?
require('../header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto;background:#fff">
 <script src="/ckeditor/ckeditor.js"></script>
<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php require('../topmenu.php');?>
<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">Spam mail</h4>
<?
if(isset($_POST['submit'])) {
	$check1 = getimagesize($_FILES["image1"]["tmp_name"]);
		if($check1==true) {
	  $file_name1 = $_FILES['image1']['name'];
      $file_size1 =$_FILES['image1']['size'];
      $file_tmp1 =$_FILES['image1']['tmp_name'];
      $file_type1=$_FILES['image1']['type'];
      $file_ext1=strtolower(end(explode('.',$_FILES['image1']['name'])));
	  $expensions1= array("png","jpg");
		if(in_array($file_ext1,$expensions1)=== false){
         $error[]="Only accept file image.";
      }
      if ($file_size1 > 500000) {
         $error[]='The image is larger than 500Kb';
      }
	}
	  if($check1 == false) {
		  $error[]='No picture';
	  }
	  
	$text=$_POST['text'];
	if(!empty($text) && $check1 == true) {
		 $tenfile1=substr(str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0 , 10);
		move_uploaded_file($file_tmp1,"../sr/news/".$tenfile1.".".$file_ext1."");
		
	$subject = "Message from Earntmoney";
$headers =  'From: '.$set['email'].'' . "\r\n" .
                    'Reply-To: '.$set['email'].'' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
	
	
	$userall=mysql_query("SELECT * FROM `users` WHERE `mail` != ''");
	while($all=mysql_fetch_assoc($userall)) {
		$message = '<html style="background:#f2f2f2;"><body style="background:#f2f2f2;margin:5px;"><div style="margin:0 auto;max-width:100%;width:500px;background:white"><i style="color:#999">Thank you for choosing EarntMoney</i><div style="padding:10px;margin:5px;background:white;">';
		$message .='<img src="'.$set['homeurl'].'/sr/news/'.$tenfile1.'.'.$file_ext1.'" style="width:100%"/>';
		$message .=''.$text.'';
		$message .= '<div style="background:orange;color:white;padding:15px;text-align:center;">';
$message .= '<div style="text-align:center;padding-top:20px;">';
$message .= '<a href="'.$set['homeurl'].'/reg.php"><img src="https://i.imgur.com/Ue75UH4.png"/></a></div></div><div style="text-align:center;color:#555;">';
$message .= '<table  style=";margin:0 auto;width:640px"><tr style=";margin:0 auto;width:640px"><td style="width:25%">';
$message .= '<a href="'.$set['setmail1'].'" style="color:#555"><img src="https://i.imgur.com/RnJRR40.png" height="20"/>Website</a></td><td style="width:25%">';
$message .= '<a href="'.$set['setmail2'].'" style="color:#555"><img src="https://i.imgur.com/aoP8hqu.png" height="20"/>Facebook</a></td><td style="width:25%">';
$message .= '<a href="'.$set['setmail3'].'" style="color:#555"><img src="https://i.imgur.com/CBbdZeK.png" height="20"/>Email</a></td><td style="width:25%">';
$message .= '<a href="'.$set['setmail4'].'" style="color:#555"><img src="https://i.imgur.com/oSG7cDS.png" height="20"/>Youtube</a></td>';
$message .= '</tr></table><h5>E-COMMERCIAL SERVICES EARNTMONEY (E_SERVICE)</h5>USA.China.Vietnam.India.Canada<br>';
$message .= 'Contact: '.$set['email'].'<br><a style="color:#555" href="'.$set['homeurl'].'/reg.php">Sign up to receive deals</a>';		
$message .= '</div></body></html>';
		
		
		
		$success = mail($all['mail'],$subject,$message,$headers);
		if($success)
{
echo "Email Sent Successfully";
}
else

{
echo "Mail Failed";
}
	}
	echo 'Đã gửi thành công!';
	} else {
		echo 'Mail trống nội dung hoặc thiếu ảnh hoặc ảnh lớn hơn 500Kb sai định dạng!';
	}
	}

?>
<form method="post" style="margin:0 auto;"  enctype="multipart/form-data">
 <div style="padding-left:10px">

	Chọn ảnh:
	<input type="file" name="image1" id="image1">

	</div>
<textarea name="text" id="editor1" col="10" style="height:200px;width:80%;padding:5px;margin:15px;border:1px solid #999; border-radius:5px;" value="" placeholder="Nhập nội dung mail không được
sử dụng các dấu ngoặc, nháy đơn, nháy kép, chấm phẩy."></textarea>
<button name="submit" style="margin:15px;width:150px;" class="cmt-to-login">Gửi</button>
</form>
   <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
<?
require('../botmenu.php');?></div>
<?
require('../incfiles/end.php');
}
?>
