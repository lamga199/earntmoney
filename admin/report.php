<?php
define('_IN_JOHNCMS', 1);
$headmod = 'report';
$textl='Report';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights<=9) {
header('location: /index.php');
} else { ?>
<?
require('../header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto;background:#fff">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php require('../topmenu.php');?>
<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">REQUEST SUPPORT</h4>

<? if(empty($id)) { ?>


	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `report` WHERE uid_nhan = '".$user_id."' and type = 'report'"), 0);
	 $req=mysql_query("SELECT * FROM `report` WHERE `uid_nhan` = $user_id and type = 'report' ORDER BY `time_update` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
?>

        <div style="background:#F2F2F2;color:#999;padding:10px;">
		<?php echo ($res['ad_read']==0 ? '<span style="color:red;">(chưa đọc)</a>':'');?>
		
		
		<a style=";color:#999;" href="report.php?id=<? echo $res['id'];?>">
		<? echo ($res['system']=='on' ? '<img src="/sr/img/fire.png" height="25"/> System auto send request for User ID: '.$res['uid_send'].': ' : 'User ID: '.$res['uid_send'].' send request: ');?> 
		<?php echo ($res['send_read']==0 ? '(new)':'');?> 
		
		<?php echo $res['name'];?><br><?php echo substr($res['content'],0,100);?>...</a></div>
		<div style="background:#D8D8D8;color:#999;padding:10px;border-bottom:5px solid #333">
		Status: <? if($res['readed']==1) { ?><span style="color:green;font-weight:bold;">done</span><? } else { ?><span style="color:red;font-weight:bold;">pending</span><? } ?>
		Send: <?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?> / 
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
<? }
} else { ?>
<?
$res=mysql_fetch_assoc(mysql_query("SELECT * FROM `report` WHERE `id` = $id"));
	if(empty($res['id'])) {
		header('location: /index.php');
	}
	$useradmin1=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['uid_send']."'"));	
mysql_query("UPDATE report SET 
		 ad_read = '1'
		 WHERE id = '".$id."'");
		 ?>

<div class="alert alert-success" role="alert" style="padding:15px; background:white;word-break: break-all;">
  <h4 class="alert-heading">Tình trạng xử lý: 
  <? if($res['readed']==1) { ?><span style="color:green;">done</span><? } else { ?><span style="color:red;">pending</span><? } ?>	
  <? echo ($res['system']=='on' ? '<img src="/sr/img/fire.png" height="25"/>' : '');?> <?php echo $res['name'];?></h4>
  
  <hr>
  <p class="mb-0" 
>
  Time: <?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?> / Lastest reply at: <?php echo date("H:i:s - d/m/Y",$res['time_update']+$set['timeshift']*3600);?>
<form method="post" action="/admin/search.php">
  <input type="hidden" name="idnickinput" value="<? echo $res['uid_send'];?>"/>
  <button type="submit" name="submitsearchidnick" class="cmt-to-login">Kiểm tra lịch sử hoạt động</button>
  </form>
  <?
  	 if(isset($_POST['xuly'.$res['id'].''])) {
	 
	 if($res['readed']==1) {
		 $error[]='Trạng thái không chính xác';
	 }

	 if(empty($error)) {
		
		
		
		 // update status report readed 0 -> 1
		 mysql_query("UPDATE report SET 
		 readed = '1',
		 admin_xuly = '".$user_id."'
		 WHERE id = '".$res['id']."'");
		 //write log
		mysql_query("INSERT INTO log SET
		time = '".time()."',
		act = 'report id: ".$res['id']." done',
		idtacdong = '".$res['uid_send']."',
		box = '".$res['uid_send']."',
		log = 'ID: $user_id xử lý report id: ".$res['id']." done của uid: ".$res['uid_send']."'
		");
		
		  ?>
		<div class="alert alert-success" role="alert">
		Đã xử lý xong!
		</div>
		<?
	 } else {
		 ?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
		 <div><span class="text-muted"><a href="/admin/report.php" class="btn btn-primary"><i class="fa fa-retweet" aria-hidden="true"></i> Tải lại</a></span></div>
		<?
	 }
	 
 } else {
 ?>

<div style="float:right;margin:20px;">
<form class="btn-group" method="post">
<button class="cmt-to-login" style="height:30px;" type="submit" name="xuly<?php echo $res['id']; ?>">Duyệt xong</button>
</form> </div>
 <? }?>
</p>
<div style="margin-bottom:10px;"></div>
<?
if($res['system']=='off') { ?>

<div style="float:left;">
  <p style="max-width:60%;background:#FAFAFA;color:black;border-radius:15px;padding:10px;">
  <? if(!empty($useradmin1['avatar'])) { ?><img src="/sr/avt/<?php echo $useradmin1['avatar'];?>" height="25"/> <? } ?>
  <strong><? echo $res['uid_send'];?></strong>: <?php echo functions::checkout($res['content']);?>
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
	$replylist=mysql_query("SELECT * FROM report WHERE id_box = '".$res['id']."' AND type = 'reply' ORDER BY time ASC ");
	$i=1;
	while($rpl=mysql_fetch_assoc($replylist)) {
		?>
		<? if($rpl['uid_send']==$user_id) { ?>
		<div style="margin-bottom:10px;">
  <p style="float:right;max-width:60%;background:#CED8F6;color:black;border-radius:15px;padding:10px;">
  <img src="/sr/avt/<?php echo $usermain['avatar'];?>" height="25"/>
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
  <p style="max-width:60%;background:#FAFAFA;color:black;border-radius:15px;padding:10px;">
  <img src="/sr/avt/<?php echo $useradmin['avatar'];?>" height="25"/>
  <strong><? echo $useradmin['name'];?></strong>: <?php echo functions::checkout($rpl['content']);?>
  <? if(!empty($rpl['image'])) { ?>
<br><img src="/sr/upload/<? echo $rpl['image'];?>" style="max-width:90%;"/>
  <? } ?></p>  
<p class="mb-0" style="color:#999">
  <?php echo date("H:i:s - d/m/Y",$rpl['time']+$set['timeshift']*3600);?></p>
  </div>
		<? } ?><div style="clear:both;"></div>
		<?
	}
?> </div>

<?
if(isset($_POST['sendreply'])) {
	$report = isset($_POST['reply']) ? functions::checkin(mb_substr(trim($_POST['reply']), 0, 500)) : '';
	
	if (mb_strlen($report) < 10 || mb_strlen($report) > 500) {
            $error[] = 'Nội dung tối đa 10-500 kí tự';
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
	  move_uploaded_file($file_tmp,"../sr/upload/".$tenfile.".".$file_ext."");
	  $tenfileanh=''.$tenfile.'.'.$file_ext.'';
	} else {
		$tenfileanh='';
	}
		mysql_query("INSERT INTO report SET
		content = '".mysql_real_escape_string($report)."',
		uid_send = '".$user_id."',
		uid_nhan = '".$res['uid_send']."',
		time = '".time()."',
		id_box = '".$res['id']."',
		type = 'reply',
		image = '".$tenfileanh."',
		comment = comment + 1");
		mysql_query("UPDATE report SET ad_read = 1, send_read = 0, comment = comment + 1, time_update = '".time()."', `status` = 'processing'		WHERE id = '".$res['id']."'");
		
		header('location: /admin/report.php?id='.$id.'');
	} else { ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
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





<? } ?>
<?php require('../botmenu.php');?></div>

<?php require('../incfiles/end.php');?>
<?php } ?>
