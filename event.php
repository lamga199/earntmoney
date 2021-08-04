<?php
define('_IN_JOHNCMS', 1);
$headmod = 'event';
$textl='Event';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');

	?>
	<style>
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#999;color:#fff;width:120px;padding:5px;margin:auto">Events</div>
</div>	<div style="background:#000;text-align:left;;padding:10px; color:#fff;text-align:center">
<? if($usermain['rights']>=9) {?>
	  
	  <?
	  if(isset($_POST['event_on'])) {
		  $option=trim($_POST['option']);
		  mysql_query("UPDATE `cms_settings` SET `val` = '".$option."' WHERE `key` = 'event_on'");
		  echo '<div style="color:green">update success</div>'; 
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">On</option>
	  <option value="off">Off</option>
	  <input name="event_on" type="submit" style="background:#999;color:#fff;height:20px" value="APPLY"/>
	  </select>
	  </form>
	  <? }?>
<!--Reach 100 referrals to receive bonuses<br>Process...: <? echo $usermain['f1_act'];?>/100-->
Chưa có sự kiện
<?
if($set['event_on']=='on') {
if($usermain['f1_act']<100) { ?>
<h4 style="color:orange">Event EarntMoney</h4>
<? if(isset($_POST['gift'])) {?>
<h4 style="color:green">Sự kiện mới của EarntMoney đang được chuẩn bị</h4>
<? } else { ?>
<form method="post">
<input type="submit" class="cmt-to-login" name="gift" value="Tham gia sự kiện"/>
</form>
<? }
}
} else { ?>
<br>
<img src="/sr/img/lock.png" height="50"/><br>
<h4 style="color:red">This event was closed</h4>

<? } ?>
</div>
<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

