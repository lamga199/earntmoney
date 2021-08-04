<?php
define('_IN_JOHNCMS', 1);
$headmod = 'game';
$textl='MANAGER';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights<9) {
header('location: /index.php');
} else {
require('../header.php');

	?>
	<style>
.form-control {
height:30px;border:1px solid #999; border-radius:5px;	width:95%;padding:5px;margin:5px;
}
.memnutab {background:#F2F2F2;padding:5px;margin:4px}
</style>
	<style>
	label {font-weight:bold;margin:5px;}
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Duyệt Mua Paypal</div>
</div>
<div style="background:white;padding:10px;">
<?php
 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `act` = 'buy paypal' AND `status` = 'pending' ORDER BY `time` ASC"), 0);
 
 if(isset($_POST['submit'])) {
	 $check=isset($_POST['check']) ? abs(intval($_POST['check'])) : 0;
	 $duyet = isset($_POST['duyet']) ? functions::checkin(mb_substr(trim($_POST['duyet']), 0, 100)) : 'ok';
	 $checkon=mysql_fetch_assoc(mysql_query("SELECT * FROM `log` WHERE `id` = '".$check."'"));
	 if($check==0 || !$checkon['id']) {
		$error[]='Empty ID'; 
	 }
	 if(empty($duyet)) {
		 $error[]='Trống duyệt'; 
	 }
	 if(empty($error)) {

	
		
	 
	 if($duyet=='ok') {
			 mysql_query("UPDATE `log` SET `status` = 'done' WHERE `id` = '".$checkon['id']."'");
			 						

			$textnote='Congratulations on your successful <span style="color:orange">$'.number_format($checkon['coin_bonus_add']).'</span> purchase, check your PayPal account now.';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$checkon['idtacdong']."'");
	 ?>
	 
	 <div>Đã duyệt thành công!</div>
	 <?
	 } else {
		 if($checkon['note']=='main cash') {
			  mysql_query("UPDATE `users` SET `coin` = `coin` + '".$checkon['pay']."' WHERE `id` = '".$checkon['idtacdong']."'");
		 }
			 mysql_query("UPDATE `log` SET `status` = 'disagree' WHERE `id` = '".$checkon['id']."'");
	$textnote='Your $'.number_format($checkon['coin_bonus_add']).' PayPal purchase request has been declined. Please check your transaction again';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = 'red',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$checkon['idtacdong']."'");
	  $checktuchoi=mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `act` = 'sale paypal' AND `status` = 'disagree' OR `act` = 'buy paypal' AND `status` = 'disagree'"),0);
	 if($checktuchoi>=5) {
		 mysql_query("UPDATE `users` SET `status` = 'banned' WHERE `id` = '".$checkon['idtacdong']."'");
		  $textnote='Account is locked due to declined transactions 5 times';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = 'red',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$checkon['idtacdong']."'");
		  ?><div>Tài khoản này bị khóa do đã đạt giới hạn 5 lần bị từ chối giao dịch!</div><?
	 }
	 ?><div>Đã từ chối duyệt yêu cầu mua này!</div><?
	 }
 } else {
	 ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
	 
 }
 }
?>
<div style="text-align:center"><h4>Danh sách chờ (<? echo $total;?>)</h4></div>
<table style="border-collapse: collapse;width:100%;max-width:100%;">
<form method="post">
<tr>
<td class="bang">UID</td>
<td class="bang">Time</td>
<td class="bang">Giao dịch</td>
<td class="bang">Mua số lượng</td>
<td class="bang">Trả</td>
<td class="bang">Thanh toán</td>

<td class="bang">Status</td>
<td class="bang">Duyệt</td>
</tr>

  <?php
	
	 $req=mysql_query("SELECT * FROM `log` WHERE `act` = 'buy paypal' AND `status` = 'pending' ORDER BY `time` ASC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 $userfe=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['idtacdong']."'"));
		 ?>
		 <tr>
        <td class="bang"><a href="/admin/search.php?id=<?php echo $res['idtacdong'];?>"><?php echo $res['idtacdong'];?></a></td>
        <td class="bang"><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td class="bang"><?php echo $res['act'];?></td>
		<td class="bang"><?php echo number_format($res['coin_bonus_add']);?>$</td>
		<td class="bang"><?php echo number_format($res['pay']);?>đ</td>
		<td class="bang"><?php echo $res['note'];?></td>

		<td class="bang"><?php echo $res['status'];?></td>
		<td class="bang"><? if($res['status']!=='done' && $res['status']!=='dissagree') { ?><input type="radio" name="check" value="<?echo $res['id'];?>"/> <? } ?></td>
      </tr>
		
		 
		 <?php
	 $i++; } ?>

</table>

<div style="padding:10px;">
<select name="duyet" class="cmt-to-login">
<option value="ok">Duyệt</option>
<option value="no">Từ chối</option>
</select>

<input type="submit" name="submit" value="Thực hiện" style="" class="cmt-to-login"/>
</form>
</div>
    <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	
</form>
</div>
<? } ?>

<?
$totaldone = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `act` = 'buy paypal' AND `status` != 'pending'"), 0);
?>
<div style="text-align:center"><h4>Danh sách đã duyệt (<? echo $totaldone;?>)</h4></div>
<table style="border-collapse: collapse;width:100%;max-width:100%;">
<form method="post">
<tr>
<td class="bang">UID</td>
<td class="bang">Time</td>
<td class="bang">Giao dịch</td>
<td class="bang">Mua số lượng</td>
<td class="bang">Trả</td>
<td class="bang">Thanh toán</td>

<td class="bang">Status</td>

</tr>

  <?php
	
	 $req=mysql_query("SELECT * FROM `log` WHERE  `act` = 'buy paypal' AND `status` != 'pending' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 $userfe=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['idtacdong']."'"));
		 ?>
		 <tr>
        <td class="bang"><a href="/admin/search.php?id=<?php echo $res['idtacdong'];?>"><?php echo $res['idtacdong'];?></a></td>
        <td class="bang"><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td class="bang"><?php echo $res['act'];?></td>
		<td class="bang"><?php echo number_format($res['coin_bonus_add']);?>$</td>
		<td class="bang"><?php echo number_format($res['pay']);?>đ</td>
		<td class="bang"><?php echo $res['note'];?></td>
		

		<td class="bang"  <? echo ($res['status']=='done' ? 'style="color:green"' : 'style="color:red"');?>><?php echo $res['status'];?></td>
		
      </tr>
		
		 
		 <?php
	 $i++; } ?>

</table>

    <?php
  if ($totaldone > $kmess) {
	  ?><div class="">

	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $totaldone, $kmess);?></div>
	   </div>

</div>
<? } ?>

<h4 class="memnutab">Note</h4>

<div><i class="text-muted">Ngay khi yêu cầu mua tiền sẽ bị trừ, nếu không duyệt yêu cầu tiền sẽ hoàn lại tài khoản.</div>

</div>



</div>
<?php require('../incfiles/end.php');?>
<?php } ?>





























