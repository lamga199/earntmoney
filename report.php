<?php
define('_IN_JOHNCMS', 1);
$headmod = 'report';
$textl='Report';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
?>

<?php 

if(empty($id)) {?>

<div style="color:#333;font-weight:bold;font-size:20px;text-align:center;background:#8000FF;height:35px;">SUPPORT</div>
	<div style="background:#fff;text-align:left;;padding:10px; color:#000;">
<div style=";border:1px solid #999;border-bottom:5px solid #999;;padding:15px;margin:10px;text-align:center;color:#999;">Hãy để EarntMoney hỗ trợ các vấn đề tốt hơn.
Vui lòng để lại phản hồi của bạn bên dưới</div>
<h2>               Bạn cần hỗ trợ?</h2>
<div style="padding:15px;margin:10px;border-top:3px solid #999;text-align:left;color:#999;">Để được hỗ trợ dịch vụ nhanh nhất và tốt nhất, <br>Vui lòng cung cấp sự cố của bạn, đính kèm ảnh chụp rõ ràng (nếu có)</div>
<h5 style="color:#999">Tối đa (500 ký tự)</h5>
<?
if($act=='changebank') {
	$name = '#Bank Change '.mt_rand(10000000,99999999).'';

} else {
	$name = '#Report Content '.mt_rand(10000000,99999999).'';
}

if(isset($_POST['submit'])) {
	$report = isset($_POST['report']) ? functions::checkin(mb_substr(trim($_POST['report']), 0, 500)) : '';
	
	if (mb_strlen($report) < 10 || mb_strlen($report) > 500) {
            $error[] = 'Content up to 10-500 characters';
	}
	$last=mysql_result(mysql_query("SELECT COUNT(*) FROM report WHERE uid_send = '".$user_id."' and type = 'report' and readed = 0"),0);
	if($last>0) {
		$error[] = 'We are working on your problem. Please wait after receiving help.';
	}
	 $check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check==true) {
	  $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	  $expensions= array("png","jpg");
		if(in_array($file_ext,$expensions)=== false){
         $error[]="Only image files are accepted.";
      }
      if ($file_size > 500000) {
         $error[]='The image is larger than 500Kb';
      }
	}
	  
		  

	  
	if (empty($error)) {
		if($check == true) {
	  $tenfile=substr(str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0 , 10);
	  move_uploaded_file($file_tmp,"sr/upload/".$tenfile.".".$file_ext."");
	  $tenfileanh=''.$tenfile.'.'.$file_ext.'';
	} else {
		$tenfileanh='';
	}
		mysql_query("INSERT INTO report SET
		name = '".mysql_real_escape_string($name)."',
		content = '".mysql_real_escape_string($report)."',
		uid_send = '".$user_id."',
		uid_nhan = '333333',
		time = '".time()."',
		time_update = '".time()."',
		readed = '0',
		type = 'report',
		send_read = '1',
		image = '".$tenfileanh."',
		ad_read = '0'");
		$newid=mysql_insert_id();
		$rep='Thank you for contacting us for help. Your request is being processed by EarntMoney. Please wait for a response from EarntMoney';
		mysql_query("INSERT INTO report SET
		name = '',
		content = '".mysql_real_escape_string($rep)."',
		uid_send = '333333',
		uid_nhan = '".$user_id."',
		time = '".time()."',
		time_update = '".time()."',
		readed = '0',
		type = 'reply',
		send_read = '0',
		id_box = '".$newid."',
		image = '',
		ad_read = '0'");
		?>
		<div class="alert alert-success" role="alert">
		Report success!
		</div>
		
		<?php
	} else { ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
?>
      <div>
	  
	  
	  <form method="post" name="form" class="form-group" enctype="multipart/form-data">
<div>
<textarea class="form-control" name="report" value="" placeholder="Nhập tin nhắn của bạn" style="height:100px;"></textarea>
<h3>Gửi ảnh</h3>
<label for="file-upload" class="custom-file-upload">
 <ion-icon name="camera-outline"></ion-icon>
</label>
<input id="file-upload" name="image" type="file"/>
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
</div>

<center><button type="submit" style="background:#ff8800;text-align:center;width:200px;" name="submit" class="cmt-to-login">GỬI YÊU CẦU</button></center></form>


</div>


<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">LỊCH SỬ HỖ TRỢ</h4>




	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `report` WHERE uid_send = '".$user_id."' and type = 'report'"), 0);
	 $req=mysql_query("SELECT * FROM `report` WHERE `uid_send` = $user_id and type = 'report' ORDER BY `readed` ASC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
?>

        <div style="background:#F2F2F2;color:#999;padding:10px;"><? echo ($res['system']=='on' ? '<img src="/sr/img/fire.png" height="25"/>' : 'me: ');?> 
		<?php echo ($res['send_read']==0 ? '<span style="color:red;">(new)</a>':'');?> 
		<a style=";color:#999;" href="/report.php?id=<? echo $res['id'];?>">
		<?php echo $res['content'];?></a></div>
		<div style="background:#D8D8D8;color:#999;padding:10px;">
		<? if($res['readed']==1) { ?><span style="color:green;">done</span><? } else { ?><span style="color:red;">pending</span><? } ?>
		Send: <?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?>
		Update: <?php echo date("H:i:s - d/m/Y",$res['time_update']+$set['timeshift']*3600);?></div>
      
		 
		 <?php
		 $i++; }
	 
	 ?>
  
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	
</div>
<? } ?>

<? } else { ?>
<?
$res=mysql_fetch_assoc(mysql_query("SELECT * FROM `report` WHERE `id` = $id AND uid_send = '".$user_id."'"));

if(empty($res['id'])) {
		header('location: /index.php');
	}
	mysql_query("UPDATE report SET 
		 send_read = '1'
		 WHERE id = '".$id."'");
?>
<div style="color:#333;font-weight:bold;font-size:20px;text-align:center;background:#8000FF;height:35px;">SUPPORT</div>
<div class="alert alert-success" role="alert" style="padding:15px; background:white;word-break: break-all;">
  <h4 class="alert-heading">
  <? if($res['readed']==1) { ?><span style="color:green;">done</span><? } else { ?><span style="color:red;">pending</span><? } ?>	
  <? echo ($res['system']=='on' ? '<img src="/sr/img/fire.png" height="25"/>' : '');?> <?php echo $res['name'];?></h4>
  <hr>
  <p class="mb-0">
  Time: <?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?>; Lastest reply at: <?php echo date("H:i:s - d/m/Y",$res['time_update']+$set['timeshift']*3600);?>

</p>

<?
if($res['system']=='off') { ?>

<div style="float:right;">
  <p style="max-width:60%;background:#CED8F6;color:black;border-radius:15px;padding:10px;">
  <? if(!empty($usermain['avatar'])) { ?>
  <img src="/sr/avt/<?php echo $usermain['avatar'];?>" height="25"/>
  <? } ?>
  <strong>me</strong>: <?php echo functions::checkout($res['content']);?>
  <? if(!empty($res['image'])) { ?>
<br><img src="/sr/upload/<? echo $res['image'];?>" style="max-width:90%;"/>
  <? } ?></p>  
<p class="mb-0" style="color:#999">
  <?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></p>
  </div><div style="clear:both;"></div>
<? } ?>
<?
if($res['system']=='on') { ?>

<div style="float:left;">
  <p style="background:#F6CECE;color:black;border-radius:15px;padding:10px;">
  <img src="/sr/img/fire.png" height="25"/>
  <strong>SYSTEM</strong>: <?php echo functions::checkout($res['content']);?>
  <? if(!empty($res['image'])) { ?>
<br><img src="/sr/upload/<? echo $res['image'];?>" style="max-width:90%;"/>
  <? } ?></p>  
<p class="mb-0" style="color:#999">
  <?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></p>
  </div><div style="clear:both;"></div>
<? } ?>
</div><div style="padding:15px;background:white;">
<?
	$totalrep=mysql_result(mysql_query("SELECT COUNT(*) FROM report WHERE id_box = '".$res['id']."' AND type = 'reply'"),0);
	$replylist=mysql_query("SELECT * FROM report WHERE id_box = '".$res['id']."' AND type = 'reply' ORDER BY time ASC");
	$i=1;
	while($rpl=mysql_fetch_assoc($replylist)) {
		?>
		
		<? if($rpl['uid_send']==$user_id) { ?>
		<div style="margin-bottom:10px;">
  <p style="float:right;max-width:60%;background:#CED8F6;color:black;border-radius:15px;padding:10px;">
  <? if(!empty($usermain['avatar'])) { ?>
  <img src="/sr/avt/<?php echo $usermain['avatar'];?>" height="25"/>
  <? } ?>
  <strong>me</strong>: <?php echo functions::checkout($rpl['content']);?>
  <? if(!empty($rpl['image'])) { ?>
<br><img src="/sr/upload/<? echo $rpl['image'];?>" style="max-width:90%;"/>
  <? } ?></p>  <div style="clear:both;"></div>
<p class="mb-0" style="float:right;color:#999">
  <?php echo date("H:i:s - d/m/Y",$rpl['time']+$set['timeshift']*3600);?></p>
  </div>
  
		<? } else {
		$useradmin=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$rpl['uid_send']."'"));	
			?>
		
			<div style="float:left;margin-bottom:10px;">
  <p style="max-width:60%;background:#fff;color:black;border-radius:15px;padding:10px;">
  
  <strong>EarntMoney</strong> 
  <?php echo date("H:i:s - d/m/Y",$rpl['time']+$set['timeshift']*3600);?>
  <table><tr><td><img src="/sr/avt/<?php echo $useradmin['avatar'];?>" height="25"/></td><td>
  <p class="mb-0" style="color:#999">
  <?php echo functions::checkout($rpl['content']);?>
  <? if(!empty($rpl['image'])) { ?>
<br><img src="/sr/upload/<? echo $rpl['image'];?>" style="max-width:90%;"/>
  <? } ?></p>  
</td></tr></table>
  </p>
  </div><div style="clear:both;"></div>
		<? } ?>
		<?
	}
?> </div>

<?
if(isset($_POST['sendreply'])) {
	$report = isset($_POST['reply']) ? functions::checkin(mb_substr(trim($_POST['reply']), 0, 500)) : '';
	
	if (mb_strlen($report) < 10 || mb_strlen($report) > 500) {
            $error[] = 'Content up to 10-500 characters';
	}
	$last=mysql_result(mysql_query("SELECT COUNT(*) FROM report WHERE uid_nhan = '".$user_id."' and type = 'reply' and id_box = '".$res['id']."'"),0);
	if($last<2) {
		$error[] = 'admin not reply, not spam report!';
	}
	
	 $check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check==true) {
	  $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	  $expensions= array("png","jpg");
		if(in_array($file_ext,$expensions)=== false){
         $error[]="Only image files are accepted.";
      }
      if ($file_size > 500000) {
         $error[]='The image is larger than 500Kb';
      }
	}
	  
		  

	  
	if (empty($error)) {
		if($check == true) {
	  $tenfile=substr(str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0 , 10);
	  move_uploaded_file($file_tmp,"sr/upload/".$tenfile.".".$file_ext."");
	  $tenfileanh=''.$tenfile.'.'.$file_ext.'';
	} else {
		$tenfileanh='';
	}
		mysql_query("INSERT INTO report SET
		content = '".mysql_real_escape_string($report)."',
		uid_send = '".$user_id."',
		uid_nhan = '".$res['uid_nhan']."',
		time = '".time()."',
		id_box = '".$res['id']."',
		type = 'reply',
		image = '".$tenfileanh."',
		comment = comment + 1");
		mysql_query("UPDATE report SET ad_read = 0, send_read = 1, comment = comment + 1, time_update = '".time()."' WHERE id = '".$res['id']."'");
		
		header('location: /report.php?id='.$id.'');
	} else { ?>
	
	<div class="alert alert-danger" role="alert" style="background:#fff;text-align:center;">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
?>
<div>
<? $lasts=mysql_result(mysql_query("SELECT COUNT(*) FROM report WHERE uid_nhan = '".$user_id."' and type = 'reply' and id_box = '".$res['id']."'"),0);

if($lasts>2) {
?>
<form method="post" class="form-group w-100" style="padding:10px;background:white;" enctype="multipart/form-data">
<textarea class="form-control" style="margin:20px;padding:10px;width:80%;height:100px" name="reply" placeholder="Enter your reply"></textarea>
<center><h3>Send Photo</h3>
<label for="file-upload" class="custom-file-upload">
 <ion-icon name="camera-outline"></ion-icon>
</label>
<input id="file-upload" name="image" type="file"/>
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
<br><br>
<button type="submit" name="sendreply" style="background:#ff8800;text-align:center;width:200px;" class=" cmt-to-login">SEND REPLY</button></center>
</form>
<? 
} else { ?>
<!--<div class="alert alert-danger" role="alert">
		<i class="fa fa-lock" aria-hidden="true"></i> Admin has blocked this report!
		</div>-->
<? } ?>



</div>
	
<? } ?>
<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>
