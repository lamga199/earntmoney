<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl='Authentication';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');

	?>
	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
	<style>
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
				$('#blah').hide();
				 $('#loading').show();
				 setTimeout(function() {
  $('#loading').hide();
  $('#blah').show();
}, 2000);
				 
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	</script>
	
	
	<script>
function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
				$('#blah2').hide();
				 $('#loading2').show();
				 setTimeout(function() {
  $('#loading2').hide();
  $('#blah2').show();
}, 2000);
				 
                $('#blah2')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	</script>
	
	
	<div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
	<?php require('uinfo.php');?>

<?php require('topmenu.php');?>
	

	<?php if($usermain['xacthuc']==0) {?>
	<div style="color:#999;text-align:center">
	<img src="/sr/img/up2.png" height="50"/><br>Tài khoản của bạn không được xác thực
	</div>
	<? } ?>
	<table style="background:#F2F2F2;width:100%;padding:10px;"><tr style=";width:100%;">
	<td style=";width:20%;color:#999"><img src="/sr/img/ttt2.png" height="50"/></td><td>
					Theo luật pháp của nhiều quốc gia, để tăng cường bảo mật và sử dụng không hạn chế .Bạn có					
				thể cần xác minh danh tính của mình khi đăng nhập hoặc cố gắng thực hiện các hành động nhạy cảm.				

	</td></tr></table>
	<center>
	<img src="/sr/img/ttt.png" height="120"/>
	<br>
	<button class="cmt-to-login" style="color:white;background:white;border:1px solid orange"><a style="color:orange;" href="/thongtin.php">Cập nhật thông tin</a></button>
	<br>
	<hr style="margin:10px;width:50%;text-align:center;"></hr>
	



	
	<?
	
switch($act) {
	
	case 'upload1':
if(isset($_POST['submitcmnd1'])) {
	$check1 = getimagesize($_FILES["image1"]["tmp_name"]);
		if($check1==true) {
	  $file_name1 = $_FILES['image1']['name'];
      $file_size1 =$_FILES['image1']['size'];
      $file_tmp1 =$_FILES['image1']['tmp_name'];
      $file_type1=$_FILES['image1']['type'];
      $file_ext1=strtolower(end(explode('.',$_FILES['image1']['name'])));
	  $expensions1= array("png","jpg");
		if(in_array($file_ext1,$expensions1)=== false){
         $error[]="Chỉ chấp nhận file hình ảnh.";
      }
      if ($file_size1 > 6000000) {
         $error[]='Hình ảnh lớn hơn 500Kb';
      }
	}
	  if($check1 == false) {
		  $error[]='Không có hình ảnh';
	  }
	  $tenfile1=''.$usermain['id'].'_cmnd1';

if(!$error) {
	move_uploaded_file($file_tmp1,"sr/cmnd/".$tenfile1.".".$file_ext1."");
	mysql_query("UPDATE `users` SET `cmnd1` = '".$tenfile1.".".$file_ext1."' WHERE `id` = '".$usermain['id']."'");
		// ghi log
	$reportlog='user: '.$user_id.' change cmnd 1';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'change cmnd face 1',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$user_id."',
			log = '".$reportlog."',
			box = '".$user_id."'");
	header('location: /uploadcmnd.php');
	
		
	} else {
		?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	} }


		break;
		case 'upload2':

if(isset($_POST['submitcmnd2'])) {
	$check2 = getimagesize($_FILES["image2"]["tmp_name"]);
		if($check2==true) {
	  $file_name = $_FILES['image2']['name'];
      $file_size =$_FILES['image2']['size'];
      $file_tmp =$_FILES['image2']['tmp_name'];
      $file_type=$_FILES['image2']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image2']['name'])));
	  $expensions= array("png","jpg");
		if(in_array($file_ext,$expensions)=== false){
         $error[]="Chỉ chấp nhận file hình ảnh.";
      }
      if ($file_size > 6000000) {
         $error[]='Hình ảnh lớn hơn 500Kb';
      }
	}
	  if($check2 == false) {
		  $error[]='Không có hình ảnh';
	  }
	  $tenfile=''.$usermain['id'].'_cmnd2';

if(!$error) {
	move_uploaded_file($file_tmp,"sr/cmnd/".$tenfile.".".$file_ext."");
	mysql_query("UPDATE `users` SET `cmnd2` = '".$tenfile.".".$file_ext."' WHERE `id` = '".$usermain['id']."'");
		// ghi log
	$reportlog='user: '.$user_id.' change cmnd 2';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'change cmnd face 2',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$user_id."',
			log = '".$reportlog."',
			box = '".$user_id."'");
	header('location: /uploadcmnd.php');
		
	} else {
		?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	} }
	?>
	<?

	break;
	
}


?>

<style>
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>
<?
	if(empty($usermain['cmnd1'])) {
	?>
	<div style="padding-left:10px">
	<? if($usermain['xacthuc']==0 && $usermain['yeucauxacthuc']==0) { ?>
	<div style="padding-left:10px">
	<form method="post" action="?act=upload1" enctype="multipart/form-data">
	
<label for="file-upload" class="custom-file-upload" style="font-size:20px;text-align:center;">
 <img id="blah" src="#" style="display:none;height:50px;max-height:50px;" lt="your image" />
 <img id="loading" src="/sr/img/loading.gif" style="display:none;height:50px;max-height:50px;" lt="loading" />
 
 <br><img src="/sr/img/camera.png"/>
</label>
 
<input id="file-upload" onchange="readURL(this);" name="image1" type="file"/>


	<input type="submit" value="tải lên" name="submitcmnd1" style="border-radius:5px;background:green;color:white;" class="cmt-to-login">
</form>
	</div>
	<? } ?>
	</div>
	<?
} else {
	?>
	<div style="padding-left:10px"> <strong><img id="myImg" src="/sr/cmnd/<? echo $usermain['cmnd1'];?>" height="50"/></strong></div>
	<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span style="margin-top:100px;" class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
	<? if($usermain['xacthuc']==0 && $usermain['yeucauxacthuc']==0) { ?>
	<div style="padding-left:10px">
	<form method="post" action="?act=upload1" enctype="multipart/form-data">
	
<label for="file-upload" class="custom-file-upload" style="font-size:20px;text-align:center;">
 <img id="blah" src="#" style="display:none;height:50px;max-height:50px;" lt="your image" />
 <img id="loading" src="/sr/img/loading.gif" style="display:none;height:50px;max-height:50px;" lt="loading" />
 
 <br><img src="/sr/img/camera.png"/>
</label>
 
<input id="file-upload" onchange="readURL(this);" name="image1" type="file"/>


	<input type="submit" value="tải lên" name="submitcmnd1" style="border-radius:5px;background:green;color:white;" class="cmt-to-login">
</form>
	</div>
<? }} ?>

<style>
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style><?
	if(empty($usermain['cmnd2'])) {
	?>
	<div style="padding-left:10px">
	<? if($usermain['xacthuc']==0 && $usermain['yeucauxacthuc']==0) { ?>
	<div style="padding-left:10px">
	<form method="post" action="?act=upload2" enctype="multipart/form-data">
<label for="file-upload2" class="custom-file-upload" style="font-size:20px;text-align:center;">
 <img id="blah2" src="#" style="display:none;height:50px;max-height:50px;" lt="your image" />
 <img id="loading2" src="/sr/img/loading.gif" style="display:none;height:50px;max-height:50px;" lt="loading" />
 
 <br><img src="/sr/img/camera.png"/>
</label>
 
<input id="file-upload2" onchange="readURL2(this);" name="image2" type="file"/>


	<input type="submit" value="tải lên" name="submitcmnd2" style="border-radius:5px;background:green;color:white;" class="cmt-to-login">
</form>
	</div>
	<? } ?>
	</div>
	<?
} else {
	?>
	<div style="padding-left:10px"><strong><img id="myImg2" src="/sr/cmnd/<? echo $usermain['cmnd2'];?>" height="50"/></strong></div>
	<div id="myModal2" class="modal2">

  <!-- The Close Button -->
  <span style="margin-top:100px;" class="close2">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content2" id="img02">

  <!-- Modal Caption (Image Text) -->
  <div id="caption2"></div>
</div><? if($usermain['xacthuc']==0 && $usermain['yeucauxacthuc']==0) { ?>
	<div style="padding-left:10px">
	<form method="post" action="?act=upload2" enctype="multipart/form-data">
	
<label for="file-upload2" class="custom-file-upload" style="font-size:20px;text-align:center;">
 <img id="blah2" src="#" style="display:none;height:50px;max-height:50px;" lt="your image" />
 <img id="loading2" src="/sr/img/loading.gif" style="display:none;height:50px;max-height:50px;" lt="loading" />
 
 <br><img src="/sr/img/camera.png"/>
</label>
 
<input id="file-upload2" onchange="readURL2(this);" name="image2" type="file"/>


	<input type="submit" value="upload" name="submitcmnd2" style="border-radius:5px;background:green;color:white;" class="cmt-to-login">
</form>
	</div>
<? }} ?>
<br><br>
	<?
switch($act) {
	case 'requestxt':
	
	if(empty($usermain['cmnd']) || empty($usermain['cmnd1']) || empty($usermain['ngaycapcmnd']) || empty($usermain['noicapcmnd']) || empty($usermain['cmnd2'])) {
$error[]='Chưa cập nhật thông tin hoặc tải ảnh xác thực';
	}
	
	if(empty($usermain['bank']) || empty($usermain['namebank']) || empty($usermain['stk'])) {
		$error[]='Chưa liên kết tài khoản ngân hàng';
	}
	if($usermain['status']!=='actived') {
		//$error[]='Your account not actived';
	}
	if(empty($usermain['paypal'])) {
		$error[]='Chưa liên kết Paypal';
	}
	if(empty($error)) {
		mysql_query("UPDATE `users` SET `yeucauxacthuc` = '1',`timeyeucauxacthuc` = '".time()."' WHERE `id` = '".$user_id."'");
		header('location: /account.php#xacthuc');
	
	} else { ?>
		<div style="color:red"> <? echo functions::display_error($error); ?></div><?
	}
	break;
}
?>
	
	<!--You need to enter all correct information before requesting authentication. All information cannot be changed after account verification is successful!. <a href="/thongtin.php">Input your information</a>
	
	<? echo ($usermain['xacthuc']==1 ? '[authenticated]' : '[Not yet authentic][<a href="?act=requestxt" class="btn-to-login">Request now</a>]');?></div>-->
	
	<button style="background:orange" class="cmt-to-login"><a href="?act=requestxt" style="color:white">Xác thực tài khoản</a></button><br>
	<span style="color:red"><?php echo $usermain['tuchoixacthuc'];?>/3</span><br>
	<span style=""><b style="color:red">Warning:</b> <i style="color:#999">Để hạn chế gian lận. Tài khoản tự động bị khóa vĩnh viễn sau ba lần xác minh không thành công</i></span>
	</center>
	
<?
require('botmenu.php');?>
<Script>
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
<Script>
var modal2 = document.getElementById("myModal2");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img2 = document.getElementById("myImg2");
var modalImg2 = document.getElementById("img02");
var captionText2 = document.getElementById("caption2");
img2.onclick = function(){
  modal2.style.display = "block";
  modalImg2.src = this.src;
  captionText2.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal2.style.display = "none";
}
</script>
<style>
#myImg,#myImg2 {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover,#myImg2:hover {opacity: 0.7;}

/* The Modal (background) */
.modal,.modal2 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content,.modal-content2 {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption,#caption2 {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content,.modal-content2, #caption,#caption2{
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close,.close2 {
  position: absolute;
top:-40px;
  right: 50%;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,.close2:hover,
.close:focusm,close2:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content,.modal-content2 {
    width: 100%;
  }
}
</style>
<?php require('incfiles/end.php');?>
<?php } ?>
