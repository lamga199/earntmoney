<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl='Notice';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');

	?><div class="main">
    <div class="cmt-popup" style="background:#f2f2f2;max-width:640px;margin:auto">

	<div style="color:#000;font-weight:bold;font-size:14px;text-align:left;padding:5px;;background:#5F04B4;color:white;height:28px;">
	<a href="/" style="padding:3px;border:1px solid #fff;color:white;margin:2px;"><</a> 
	Notificaton</div>
	<div style="color:#999;height:3px;"></div>

<?
if($id) {
	switch($act) {
		default:
		
	$newsin=mysql_fetch_assoc(mysql_query("SElECT * FROM `news` WHERE `id` = '".$id."'"));
	mysql_query("UPDATE `news` SET `view` = '".$newsin['view'].",".$user_id."' WHERE `id` = '".$id."'");
	if($newsin['image']) { ?>
	<img src="/sr/news/<? echo $newsin['image'];?>" style="width:100%"/>
	<? } ?>
	<div style="color:#000;font-weight:bold;font-size:14px;text-align:left;padding:5px;;background:#5F04B4;color:white;height:28px;">
	<div style="float:right"><img src="/sr/img/image071.png" height="30"/></div></div>
	<div style="padding:10px;background:white;padding-bottom:20px;"><? echo $newsin['text'];?>
	<? if(!empty($newsin['namelink'])) { ?>
	<div style="text-align:center;"><a class="cmt-to-login" href="<? echo $newsin['link'];?>" style="
	border-radius:5px;background:#5F04B4;color:white;margin:0 auto;text-align:center;margin:5px;
	padding:10px;">
	<? echo $newsin['namelink'];?></a></div>
	<? } ?></div>
	<?
	if($rights>=9) {
	?>
<div style="margin:10px;padding:5px;background:#999">

<a class="cmt-to-login" href="?act=del&id=<? echo $id;?>">Xóa nội dung này</a>
</div>

<?	
		
	}
	break;
	case 'del':
	mysql_query("DELETE FROM `news` WHERE `id` = '".$id."'");
	header('location: /');
	
	break;
	case 'read':
	mysql_query("UPDATE `news` SET `read` = 1 WHERE `id` = '".$id."'");
	header('location: /notice.php');
	
	break;
	
	}
} else {
switch($act) {
	default:
	case 'note':
	?><div style="background:#E0E6F8;color:#333;text-align:center;border-bottom:2px solid #5F04B4">
<div style="margin:10px;padding:10px;">
<a href="#" style="border-bottom:1px solid #5F04B4;padding-right:4px;color:#333;">Thông báo của bạn 
<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? echo $not=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'note' AND `user` = '".$user_id."' AND `read` = '0'"),0); ?>
</span>
</span></a>
<a href="/notice.php?act=pro" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Khuyến mãi 
<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>

</a>
<a href="/notice.php?act=news" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Tin tức 

<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'news'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>

</a>
<div style="float:right"><a href="notice.php?act=search"><img src="https://i.imgur.com/U00O9Tw.png" height="20"/></a></div>
</div>

</div>

<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `user` = '".$user_id."' AND `type` = 'note'"),0);
$notice=mysql_query("SELECT * FROM `news` WHERE `user` = '".$user_id."' AND `type` = 'note' ORDER BY `id` DESC LIMIT $start,$kmess");
while($note=mysql_fetch_assoc($notice)) { ?>
<div style="background:#E0E6F8;border-bottom:1px solid #5F04B4;;padding:10px;text-align:left;">
<span style="color: <? echo $note['color'];?>">
Earntmoney: <? echo date(" Y/m/d - H:i:s",$note['time']+7*3600); ?><br>
<? echo $note['text'];?>
</span>
<? if($note['read']==0) { ?>
<div style="float:right;"><a href="?act=read&id=<? echo $note['id'];?>" style="color:red">■</a></div>
<? } ?>
</div>

<? } ?>

<?
if($total>$kmess) { ?>
<div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?act=note&', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>

<?

break;
case 'pro':
?><div style="background:#E0E6F8;color:#333;text-align:center;border-bottom:2px solid #5F04B4">
<div style="margin:10px;padding:10px;">
<a href="/notice.php" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Thông báo của bạn <span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? echo $not=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'note' AND `user` = '".$user_id."' AND `read` = '0'"),0); ?>
</span>
</span></a>
<a href="#" style="border-bottom:1px solid #5F04B4;padding-right:4px;color:#333;">Khuyến mãi 
<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>
</a>
<a href="/notice.php?act=news" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Tin tức <span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'news'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span></a>
<div style="float:right"><a href="notice.php?act=searchpro"><img src="https://i.imgur.com/U00O9Tw.png" height="20"/></a></div>
</div>
</div>

<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion' AND `thang` = '".date("m",time())."'"),0);
$notice=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion' AND `thang` = '".date("m",time())."' ORDER BY `id` DESC LIMIT $start,$kmess");
while($note=mysql_fetch_assoc($notice)) { ?>
<div style="background:#E0E6F8;border-bottom:1px solid #5F04B4;;padding:10px;text-align:left;">
<a style="color: #A901DB" href="/notice.php?id=<? echo $note['id'];?>">
<? echo $note['name'];?></a><ion-icon name="time-outline"></ion-icon>
<br><span style="color:#999;font-size:11px;"><? echo date(" Y/m/d - H:i:s",$note['time']+7*3600); ?></span>

 <? $tach=explode(",",$note['view']);
	if (!in_array($user_id, $tach))
  {
	  ?>
<div style="float:right;"><a href="#" style="color:red">■</a></div>
<? } ?>
</div>

<? } ?>

<?
if($total>$kmess) { ?>
<div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?act=pro&', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>

<?

break;
case 'searchpro':
?><div style="background:#E0E6F8;color:#333;text-align:center;border-bottom:2px solid #5F04B4">
<div style="margin:10px;padding:10px;">
<a href="/notice.php" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Thông báo của bạn <span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? echo $not=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'note' AND `user` = '".$user_id."' AND `read` = '0'"),0); ?>
</span>
</span></a>
<a href="#" style="border-bottom:1px solid #5F04B4;padding-right:4px;color:#333;">Khuyến mãi


<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>


</a>
<a href="/notice.php?act=news" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Tin tức 


<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'news'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>


</a>
<div style="float:right"><a href="notice.php?act=searchpro"><img src="https://i.imgur.com/U00O9Tw.png" height="20"/></a></div>
</div>
</div>

<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion'"),0);
$notice=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion' ORDER BY `id` DESC LIMIT $start,$kmess");
while($note=mysql_fetch_assoc($notice)) { ?>
<div style="background:#E0E6F8;border-bottom:1px solid #5F04B4;;padding:10px;text-align:left;">
<a style="color: #A901DB" href="/notice.php?id=<? echo $note['id'];?>">
<? echo $note['name'];?></a><ion-icon name="time-outline"></ion-icon>
<br><span style="color:#999;font-size:11px;"><? echo date(" Y/m/d - H:i:s",$note['time']+7*3600); ?></span>

 <? $tach=explode(",",$note['view']);
	if (!in_array($user_id, $tach))
  {
	  ?>
<div style="float:right;"><a href="#" style="color:red">■</a></div>
<? } ?>
</div>

<? } ?>

<?
if($total>$kmess) { ?>
<div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?act=searchpro&', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>

<?

break;
case 'news':
?><div style="background:#E0E6F8;color:#333;text-align:center;border-bottom:2px solid #5F04B4">
<div style="margin:10px;padding:10px;">
<a href="/notice.php" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Thông báo của bạn <span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? echo $not=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'note' AND `user` = '".$user_id."' AND `read` = '0'"),0); ?>
</span>
</span></a>
<a href="/notice.php?act=pro" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Khuyến mãi


<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>

</a>
<a href="#" style="border-bottom:1px solid #5F04B4;padding-right:4px;color:#333;">Tin tức 

<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'news'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>

</a>
<div style="float:right"><a href="notice.php?act=searchnews"><img src="https://i.imgur.com/U00O9Tw.png" height="20"/></a></div>
</div>
</div>

<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news' AND `thang` = '".date("m",time())."'"),0);
$notice=mysql_query("SELECT * FROM `news` WHERE `type` = 'news' AND `thang` = '".date("m",time())."' ORDER BY `id` DESC LIMIT $start,$kmess");
while($note=mysql_fetch_assoc($notice)) { ?>
<div style="background:#E0E6F8;border-bottom:1px solid #5F04B4;;padding:10px;text-align:left;">
<a style="color: #A901DB" href="/notice.php?id=<? echo $note['id'];?>">
<? echo $note['name'];?></a><ion-icon name="time-outline"></ion-icon>
<br><span style="color:#999;font-size:11px;"><? echo date(" Y/m/d - H:i:s",$note['time']+7*3600); ?></span>

 <? $tach=explode(",",$note['view']);
	if (!in_array($user_id, $tach))
  {
	  ?>
<div style="float:right;"><a href="#" style="color:red">■</a></div>
<? } ?>
</div>

<? } ?>

<?
if($total>$kmess) { ?>
<div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?act=news&', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>
<?
break;
case 'searchnews':
?><div style="background:#E0E6F8;color:#333;text-align:center;border-bottom:2px solid #5F04B4">
<div style="margin:10px;padding:10px;">
<a href="/notice.php" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Thông báo của bạn <span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? echo $not=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'note' AND `user` = '".$user_id."' AND `read` = '0'"),0); ?>
</span>
</span></a>
<a href="/notice.php?act=pro" style="border-bottom:0px solid #5F04B4;padding-right:4px;color:#333;">Khuyến mãi 


<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>

</a>
<a href="#" style="border-bottom:1px solid #5F04B4;padding-right:4px;color:#333;">Tin tức 

<span style="background:red;text-align:center;border-radius:20px;">
<span style="color:white;font-size:10px;font-weight:bold;margin:3px;">
<? 
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news' AND `thang` = '".date("m",time())."'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'news'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
echo $tong-$cong;
?>
</span>
</span>

</a>
<div style="float:right"><a href="notice.php?act=searchnews"><img src="https://i.imgur.com/U00O9Tw.png" height="20"/></a></div>
</div>
</div>

<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news'"),0);
$notice=mysql_query("SELECT * FROM `news` WHERE `type` = 'news' ORDER BY `id` DESC LIMIT $start,$kmess");
while($note=mysql_fetch_assoc($notice)) { ?>
<div style="background:#E0E6F8;border-bottom:1px solid #5F04B4;;padding:10px;text-align:left;">
<a style="color: #A901DB" href="/notice.php?id=<? echo $note['id'];?>">
<? echo $note['name'];?></a><ion-icon name="time-outline"></ion-icon>
<br><span style="color:#999;font-size:11px;"><? echo date(" Y/m/d - H:i:s",$note['time']+7*3600); ?></span>

 <? $tach=explode(",",$note['view']);
	if (!in_array($user_id, $tach))
  {
	  ?>
<div style="float:right;"><a href="#" style="color:red">■</a></div>
<? } ?>
</div>

<? } ?>

<?
if($total>$kmess) { ?>
<div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?act=searchnews&', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>
<?
break;
}
}
?>
</div>
</div>

<?php

require('incfiles/end.php');?>
<?php } ?>
