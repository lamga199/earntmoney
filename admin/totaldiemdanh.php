<?php
define('_IN_JOHNCMS', 1);
$headmod = 'history';
$textl='History';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('../header.php');
if($login && $rights<9) {
	$idnext=$user_id;
}
if($login && $rights>=9) {
	$idnext=$id;
	if(empty($id)) {
		$idnext=$user_id;
	}
}
	?>
	<style>
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php require('../topmenu.php');?>
<?php
 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `idtacdong` = '".$idnext."' AND `act` = 'add coin_bonus diem danh'"), 0);
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#999;color:#000;width:120px;padding:5px;margin:auto">Điểm danh</div>
</div>	<div style="background:#E6E0F8;text-align:left;;padding:10px;">


	
<div style="text-align:center"><h4>Điểm danh các lần sau (<? echo $total;?>)</h4></div>
<table style="border-collapse: collapse;width:100%;max-width:100%;">
<tr>
<td class="bang">ID</td>
<td class="bang">Time</td>
<td class="bang">Action</td>
<td class="bang">Cash</td>
<td class="bang">Status</td>
</tr>

  <?php
	
	 $req=mysql_query("SELECT * FROM `log` WHERE `idtacdong` = '".$idnext."'  AND `act` = 'add coin_bonus diem danh' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 $userfe=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['user_id']."'"));
		 ?>
		 <tr>
        <td class="bang"><?php echo $idnext;?></td>
        <td class="bang"><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<?php 
		if($res['act']=='sale paypal') { ?>
		<td class="bang">Sale paypal for admin</td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?>USD</td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>
		<?php 
		if($res['act']=='buy paypal') { ?>
		<td class="bang">Buy paypal from admin</td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?>USD</td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>
			<?php 
		if($res['act']=='f1 premium actived') { ?>
		<td class="bang">Actived account by admin</td>
		<td class="bang"></td>
		<td class="bang"><? echo $usermain['status'];?></td>
			<? } ?>
			<?php 
		if($res['act']=='authentication') { ?>
		<td class="bang">Authentication</td>
		<td class="bang"></td>
		<td class="bang">success</td>
			<? } ?>
			
		<?php 
		if($res['act']=='buycard') { ?>
		<td class="bang">Buy <? echo $res['amount'];?> card <? echo $res['namecard'];?> <? echo $res['typecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>
			
			<?php 
		if($res['act']=='add coin_bonus diem danh') { ?>
		<td class="bang">Money Atfriends</td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang">success</td>
			<? } ?><?php 
		if($res['act']=='yeu cau rut coin') { ?>
		<td class="bang">Request get main cash</td>
		<td class="bang"><? echo number_format($res['coin_minus']);?></td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>
			<?php 
		if($res['act']=='change cmnd face 1') { ?>
		<td class="bang">Change cmnd face 1</td>
		<td class="bang"></td>
		<td class="bang">success</td>
			<? } ?>
			<?php 
		if($res['act']=='change cmnd face 2') { ?>
		<td class="bang">Change cmnd face 2</td>
		<td class="bang"></td>
		<td class="bang">success</td>
			<? } ?>
			
<?php 
		if($res['act']=='register') { ?>
		<td class="bang">Register success</td>
		<td class="bang"></td>
		<td class="bang"><? echo $res['log'];?></td>
			<? } ?>
			<?php 
		if($res['act']=='add coinday diem danh') { ?>
		<td class="bang">Money Atfriends</td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang">success</td>
			<? } ?>
			
			<?php 
		if($res['act']=='roll gift') { ?>
		<td class="bang">Receive gifts from the spin:
		<?
		$qua=mysql_fetch_assoc(mysql_query("SELECT * FROM `gift` WHERE `id` = '".$res['boxid']."'")); ?>
		<? echo $qua['name'];?>
		</td>
		<td class="bang">
		
		</td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>
		<?php 
		if($res['act']=='paygame') { ?>
		<td class="bang">Pay game <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>	
		<?php 
		if($res['act']=='payk') { ?>
		<td class="bang">Pay K+: <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>		
				<?php 
		if($res['act']=='payinternet') { ?>
		<td class="bang">Pay Internet: <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>		
			<?php 
		if($res['act']=='payphonecard') { ?>
		<td class="bang">Pay card: <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>	<?php 
		if($res['act']=='getmoneyvideo') { ?>
		<td class="bang">Get cash video: <? echo $res['note'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang">paid</td>
			<? } ?>	<?php 
		if($res['act']=='bugvideo') { ?>
		<td class="bang" style="color:red">Have bug video ID: <? echo $res['note'];?></td>
		<td class="bang">0</td>
		<td class="bang">BUG</td>
			<? } ?>	
      </tr>
		
		 
		 <?php
	 $i++; } ?>

</table>
    <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnext.'&', $start, $total, $kmess);?></div>
	   </div>
	
</form>
</div>
<? } ?>

</div>
<?php require('../botmenu.php');?></div>

<?php require('../incfiles/end.php');?>
<?php } ?>

