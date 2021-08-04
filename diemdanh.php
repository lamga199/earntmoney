<?php
define('_IN_JOHNCMS', 1);
$headmod = 'diemdanh';
$textl='Money Atfriends';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');
	?>
	  <!-- đăng nhập-->
 <div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Money Atfriends</div>

<?php
mysql_query("UPDATE `gift` SET `status` = 'used' WHERE ".time()." >= `exp` AND `userid` = '".$user_id."' AND `status` = 'using'");
mysql_query("UPDATE `gift` SET `status` = 'expired' WHERE ".time()." >= `exp` AND `userid` = '".$user_id."' AND `status` != 'used'");
$checkgift=mysql_fetch_assoc(mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'using' AND `gift` = '2' AND ".time()." < `exp` OR `userid` = '".$user_id."' AND `status` = 'using' AND `gift` = '3' AND ".time()." < `exp`"));
if($checkgift['id']) {
	if($checkgift['gift']==2) {
		$cashbonus=$set['bonusdiemdanh']+(($set['bonusdiemdanh']/100)*5);
}
if($checkgift['gift']==3) {
		$cashbonus=$set['bonusdiemdanh']+(($set['bonusdiemdanh']/100)*10);
}
} else {
	
	$cashbonus=$set['bonusdiemdanh'];
}
?>

<div style="background:#000;color:#fff;">
  <p class="mb-0">Số lần nhận tiền cùng bạn bè không giới hạn trong ngày. Mỗi lần giới thiệu thành công sẽ nhận được thêm  20.000đ tiền bạn bè (Kết thúc 03/01/2020)<br><p class="text-danger">Tổng số lần nhận trong ngày của bạn là:  <? echo $usermain['countdd'];?>/<? echo $usermain['f1onday'];?></p></p>
  <footer class="blockquote-footer"><cite title="Source Title">Mỗi lần nhận được tiền thưởng   +<?php echo number_format($cashbonus);?><?php echo $set['donvi'];?>
  <?
  if($checkgift['id']) {
	 if($checkgift['gift']==2) {
		echo '(Bonus gift: + '.number_format(($set['bonusdiemdanh']/100)*5).''.$set['donvi'].')';
}
if($checkgift['gift']==3) {
		echo '(Bonus gift: + '.number_format(($set['bonusdiemdanh']/100)*10).''.$set['donvi'].')';
} 
  }
  ?>
  </cite></footer>
</div>
<?
if($usermain['countdd']<$usermain['f1onday']) {
	if(isset($_POST['submit'])) {
if($usermain['countdd']>=$usermain['f1onday']) {
	$error[]='You have exceeded the Money Atfriends count';
}
if($set['admin_nhan_coin']==$user_id || $rights>=7) {
	$error[]='This account is prohibited from taking Money Atfriends';
}
if($usermain['xacthuc']==0) {
	$error[]='Unauthenticated account cannot take Money Atfriends';
}
if(empty($error)) {

	// cộng cho tài khoản coin_bonus số tiền thưởng
		mysql_query("UPDATE users SET
		coin_bonus = coin_bonus + '".$cashbonus."',
		diemdanh = '".time()."', countdd = countdd + 1,
		totalearndd  = totalearndd + '".$cashbonus."',
		totaldd = totaldd + 1 WHERE id = '".$user_id."'");
		// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'add coin_bonus diem danh',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$cashbonus."',
			log = '".$usermain['f1onday']." register and actived on day',
			box = '".$user_id."'");
			?>
			<div class="alert alert-success" role="alert">
		Congratulations on your Money Atfriends and receipt <? echo $cashbonus;?><? echo $set['donvi'];?> roll Money Atfriends.
		</div>
			<?
	

} else {
	
	?>
	
	<div style="background:#151515;color:#fff">
		<?php echo functions::display_error($error); ?>
		<a class="cmt-to-login" href="/diemdanh.php">Retry</a>
		</div>
	<?php
}
		
	} else {
?>
<style>
 .social img {
         transition: -webkit-transform 0.25s ease;
         }
         .social img:active {
         -webkit-transform: scale(2);
         }
		 </style>
<div style="background:#151515;color:#fff">
		 <table style="margin:auto">
		 <tr style="width:100%">
		 <td style="width:33%">
		<b style="color:white">Earnt</b>  <img width="40" height="40" src="/sr/img/favicon.png"> 
		 </td>
		 <td style="width:33%"><h4 style="color:#ff00ff">12H:15H</h4><?php echo date("d/m",time()+$set['timeshift']*3600);?>
		 </td>
		 <td style="width:33%">
		 <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:<?php echo $usermain['color'];?>"> <?php echo $usermain['name'];?></b>
		 </td>
		 </tr>
		  <tr style="width:100%">
		 <td style="width:33%">
		 <span style="color:#ff00ff">-<?php echo number_format($cashbonus);?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 <td style="width:33%">
		 <form method="post" class="">
<button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
</form>
		 </td>
		 <td style="width:33%">
		  <span style="color:#58ACFA">+<?php echo number_format($cashbonus);?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 </tr>

</table>
</div>
<?php }} else {?>
<div style="background:#151515;color:#fff">
		 <table style="margin:auto">
		 <tr style="width:100%">
		 <td style="width:33%">
		<b style="color:white">Earnt</b>  <img width="40" height="40" src="/sr/img/favicon.png"> 
		 </td>
		 <td style="width:33%"><h4 style="color:#ff00ff">00H:24H</h4><?php echo date("d/m",time()+$set['timeshift']*3600);?>
		 </td>
		 <td style="width:33%">
		 <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:<?php echo $usermain['color'];?>"> <?php echo $usermain['name'];?></b>
		 </td>
		 </tr>
		  <tr style="width:100%">
		 <td style="width:33%">
		 <span style="color:#ff00ff">-<?php echo number_format($cashbonus);?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 <td style="width:33%">
		 <form method="post" class="">
<span style="border: 0px; background: transparent;opacity:0.5">
<img src="/sr/img/get.png"  height="40" />
</span>
</form>
		 </td>
		 <td style="width:33%">
		  <span style="color:#58ACFA">+<?php echo number_format($cashbonus);?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 </tr>

</table>
</div>
<p class="text-danger">Tổng số lần nhận tiền thưởng thêm hôm nay của bạn: <? echo $usermain['countdd'];?>/<? echo $usermain['f1onday'];?></p>
<?php } ?>

    
      
  <!-- <div><? echo $usermain['totaldd'];?> cumulative attendance</div>
   
   
   <div class="table-responsive">
   <table style="width:100%;border-collapse: collapse;">

      <tr style="background-color:#240B3B;font-weight:bold;color:#5F04B4;padding-bottom:5px;margin-bottom:5px;">
        <td >Log ID</td>
		<td >Time</td>
		<td>Status</td>
		<td>Cash</td>
		<td>Up%</td>
		<td>Bonus</td>
		
      </tr>
	  <? if($usermain['countdd']==0) { ?>
	  <div style="text-align:center;color:white">There has been no roll call today</div>
	  <? } else { ?>
   
      
      
   
  
  
     <?php
	 
	 $req=mysql_query("SELECT * FROM `log` WHERE act = 'add coin_bonus diem danh' and box = '".$user_id."' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		 <tr style="background-color:#F2f2f2;">

        <td><?php echo $res['id'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>Done</td>
		<td>+<?php echo number_format($res['coin_bonus_add']);?> <? echo $set['donvi'];?></td>
        
		
		
		
      </tr>
		
		 
		 <?php
	 $i++; }
	 
	 ?>  
	  <? } ?>
  </table></div>
  
  
  
  
    <?php
  if ($usermain['totaldd'] > $kmess) {
	  ?><div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $usermain['totaldd'], $kmess);?></div>
	   </div>
</div>
<? } ?>-->
</main>
 
  
  </div>
 
 
<?php require('botmenu.php');?></div>	
<?php require('incfiles/end.php');?>
<?php } ?>

