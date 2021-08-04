<?php
define('_IN_JOHNCMS', 1);
$headmod = 'report';
$textl='Video';
require('../incfiles/core.php');
$userkhach=mysql_fetch_assoc(mysql_query("SELECT *FROM `users` WHERE `id` = '".$id."'"));
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
<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">TÌM TÀI KHOẢN</h4>
<form method="post" style="margin:0 auto;">
<input name="idnickinput" style="padding:5px;margin:15px;border:1px solid #999; border-radius:15px;" value="" placeholder="Nhập tên video hoặc ID"/>
<button name="submitsearchidnick" class="cmt-to-login">Tìm</button>
</form>
  <?


if(isset($_POST['hide_tim'])) {
	if(isset($_POST['tim'])) {
	foreach($_POST['tim'] as $videochecks){
		
					mysql_query("UPDATE `video` SET `show` = 'off' WHERE `id` = '".$videochecks."'");
					}
	}
	
	header('location: /admin/video.php');
}
if(isset($_POST['show_tim'])) {
	if(isset($_POST['tim'])) {
	foreach($_POST['tim'] as $videochecks){
					mysql_query("UPDATE `video` SET `show` = 'on' WHERE `id` = '".$videochecks."'");
					}
	}
	
	header('location: /admin/video.php');
}
if(isset($_POST['delete_tim'])) {
	if(isset($_POST['tim'])) {
	foreach($_POST['tim'] as $videochecks){
					mysql_query("DELETE FROM `video` WHERE `id` = '".$videochecks."'");
					}
	}
	
	header('location: /admin/video.php');
}
	  if(isset($_POST['videoadmin'])) {
		  $option=trim($_POST['option']);
		  $delete=trim($_POST['delete']);
		  $maxvideopending=trim($_POST['maxvideopending']);
		  $maxvideoact=trim($_POST['maxvideoact']);
		  
		 
		  if($delete=='off') {
			  mysql_query("DELETE FROM `video`");
			 // header('location: /admin/video.php');
		  }
		  if($option=='off') {
			  mysql_query("UPDATE `video` SET `show` = 'off'");
			  //header('location: /admin/video.php');
		  } else {
			  mysql_query("UPDATE `video` SET `show` = 'on'");
		  }
		  echo '<div style="color:green"><center>update success</center></div>'; 
	  }
	  ?>
	  <form method="post"style="margin:0 auto;">
	  <select name="delete" style="padding:5px;margin:15px;border:1px solid #999; border-radius:15px;">
	  <option value="on">Giữ tất cả video</option>
	  <option value="off">Xóa tất cả video</option>
	  </select>
	  <select name="option" style="padding:5px;margin:15px;border:1px solid #999; border-radius:15px;">
	  <option value="on">Hiện tất cả video</option>
	  <option value="off">Ẩn tất cả video</option>
	  </select>
	
<center>
	  <button name="videoadmin" class="cmt-to-login">Lưu</button></center>
	  </form>
<div style="margin:15px;">


<form method="post"><?

if(isset($_POST['submitsearchidnick'])) {
	 $idnick=isset($_POST['idnickinput']) ? trim($_POST['idnickinput']) : '';
	 $check=mysql_query("SELECT * FROM video WHERE `name` LIKE '%$idnick%' OR `id` = '".$idnick."'");
	 while($videocheck=mysql_fetch_assoc($check)) {
	 ?>
	 <? if(!$is_mobile) { ?>
<div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $videocheck['id'];?>"><img src="https://img.youtube.com/vi/<? echo $videocheck['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $videocheck['id'];?>"><? echo $videocheck['name'];?> (<? echo ($videocheck['show']=='on' ? '<b style="color:green">Hiện</b>' : '<b style="color:red">Ẩn</b>');?>)</a></h4>
<? } ?>
Sec require: <? echo $videocheck['long'];?>

<br>

Cash: <? echo number_format($videocheck['cash']);?><? echo $videocheck['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$videocheck['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
<br><input type="checkbox" name="tim[]" value="<? echo $vidcheck['id'];?>"/></td>
</tr></table>
</div>
<? } else { ?>
	 <div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $videocheck['id'];?>"><img src="https://img.youtube.com/vi/<? echo $videocheck['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $videocheck['id'];?>"><? echo $videocheck['name'];?> ID: <? echo $videocheck['id'];?></a></h4>
<? } ?>
Sec require: <? echo $videocheck['long'];?>

<br>

Cash: <? echo number_format($videocheck['cash']);?><? echo $set['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$videocheck['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
<br><input type="checkbox" name="tim[]" value="<? echo $videocheck['id'];?>"/></td>
</tr></table>
</div>
	 <?
}
	 }
}

?></div><div style="clear:both"></div>
<?
if(isset($_POST['submitsearchidnick'])) { ?>

<!--<div style="margin:10px;"><input type="checkbox" onClick="toggletim(this)" /> Đánh dấu tất cả<br/></div>
<button class="cmt-to-login" name="hide_tim">Ẩn</button>
<button class="cmt-to-login" name="show_tim">Hiện</button>
<button class="cmt-to-login" name="delete_tim">Xóa</button>
</form>
<script>
function toggletim(source) {
  checkboxes = document.getElementsByName('tim[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>-->
<? } ?>
<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">VIDEO ĐANG HIỆN</h4>
<?
if(isset($_POST['hide_hien'])) {
	if(isset($_POST['hien'])) {
	foreach($_POST['hien'] as $videocheck){
					mysql_query("UPDATE `video` SET `show` = 'off' WHERE `id` = '".$videocheck."'");
					}
	}
	header('location: /admin/video.php');
}
if(isset($_POST['delete_hien'])) {
	if(isset($_POST['hien'])) {
	foreach($_POST['hien'] as $videocheck){
					mysql_query("DELETE FROM `video` WHERE `id` = '".$videocheck."'");
					}
	}
	header('location: /admin/video.php');
}
?>
<form method="post">
<div style="margin:15px;">
<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `video` WHERE `show` = 'on'"),0);
$video=mysql_query("SELECT * FROM `video` WHERE `show` = 'on' ORDER BY `id` DESC LIMIT $start, $kmess");
while($vid=mysql_fetch_assoc($video)) {?>
<? if(!$is_mobile) { ?>
<div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $vid['id'];?>"><img src="https://img.youtube.com/vi/<? echo $vid['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $vid['id'];?>"><? echo $vid['name'];?></a></h4>
<? } ?>
Sec require: <? echo $vid['long'];?>

<br>

Cash: <? echo number_format($vid['cash']);?><? echo $set['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$vid['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
<br><input type="checkbox" name="hien[]" value="<? echo $vid['id'];?>"/></td>
</tr></table>

</div>
<? } else { ?>
<div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $vid['id'];?>"><img src="https://img.youtube.com/vi/<? echo $vid['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $vid['id'];?>"><? echo $vid['name'];?> ID: <? echo $vid['id'];?></a></h4>
<? } ?>
Sec require: <? echo $vid['long'];?>

<br>

Cash: <? echo number_format($vid['cash']);?><? echo $set['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$vid['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
<br><input type="checkbox" name="hien[]" value="<? echo $vid['id'];?>"/></td>
</tr></table>

</div>
<? } ?><? } ?>

   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	
</div>
<? } ?>

<div style="clear:both"></div></div>
<?
if($total>0) { ?>

<div style="margin:10px;"><input type="checkbox" onClick="toggle(this)" /> Đánh dấu tất cả<br/></div>
<button class="cmt-to-login" name="hide_hien">Ẩn</button>
<button class="cmt-to-login" name="delete_hien">Xóa</button>
</form>
<script>
function toggle(source) {
  checkboxes = document.getElementsByName('hien[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<? } ?>

<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">VIDEO ĐANG ẨN</h4>
<?
if(isset($_POST['hide_an'])) {
	if(isset($_POST['an'])) {
	foreach($_POST['an'] as $videocheck){
					mysql_query("UPDATE `video` SET `show` = 'on' WHERE `id` = '".$videocheck."'");
					}
	}
	header('location: /admin/video.php');
}
if(isset($_POST['delete_an'])) {
	if(isset($_POST['an'])) {
	foreach($_POST['an'] as $videocheck){
					mysql_query("DELETE FROM `video` WHERE `id` = '".$videocheck."'");
					}
	}
	header('location: /admin/video.php');
}
?>
<form method="post">
<div style="margin:15px;">
<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `video` WHERE `show` = 'off'"),0);
$video=mysql_query("SELECT * FROM `video` WHERE `show` = 'off' ORDER BY `id` DESC LIMIT $start, $kmess");
while($vid=mysql_fetch_assoc($video)) {?>
<? if(!$is_mobile) { ?>
<div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $vid['id'];?>"><img src="https://img.youtube.com/vi/<? echo $vid['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $vid['id'];?>"><? echo $vid['name'];?></a></h4>
<? } ?>
Sec require: <? echo $vid['long'];?>

<br>

Cash: <? echo number_format($vid['cash']);?><? echo $set['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$vid['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
<br><input type="checkbox" name="an[]" value="<? echo $vid['id'];?>"/></td>
</tr></table>

</div>
<? } else { ?>
<div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $vid['id'];?>"><img src="https://img.youtube.com/vi/<? echo $vid['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $vid['id'];?>"><? echo $vid['name'];?> ID: <? echo $vid['id'];?></a></h4>
<? } ?>
Sec require: <? echo $vid['long'];?>

<br>

Cash: <? echo number_format($vid['cash']);?><? echo $set['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$vid['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
<br><input type="checkbox" name="an[]" value="<? echo $vid['id'];?>"/></td>
</tr></table>

</div>
<? } ?><? } ?>

   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	
</div>
<? } ?>

<div style="clear:both"></div></div>
<?
if($total>0) { ?>

<div style="margin:10px;"><input type="checkbox" onClick="togglean(this)" /> Đánh dấu tất cả<br/></div>
<button class="cmt-to-login" name="hide_an">Hiện</button>
<button class="cmt-to-login" name="delete_an">Xóa</button>
</form>
<script>
function togglean(source) {
  checkboxes = document.getElementsByName('an[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<? } ?><?
require('../botmenu.php');?></div>
<?
require('../incfiles/end.php');
}
?>
