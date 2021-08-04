<?php
define('_IN_JOHNCMS', 1);
$headmod = 'history';
$textl='History';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');
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
	.done {color:green;}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `idtacdong` = '".$idnext."'"), 0);
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#999;color:#000;width:120px;padding:5px;margin:auto">History account</div>
</div>	<div style="background:#E6E0F8;text-align:left;;padding:10px;">


	
<div style="text-align:center"><h4>Hoạt động (<? echo $total;?>)</h4></div>
<table style="border-collapse: collapse;width:100%;max-width:100%;">
<tr>
<td class="bang">ID</td>
<td class="bang">Thời gian</td>
<td class="bang">Hoạt động</td>
<td class="bang">Tiền mặt</td>
<td class="bang">Trạng thái</td>
</tr>

  <?php
	
	 $req=mysql_query("SELECT * FROM `log` WHERE `idtacdong` = '".$idnext."' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 $userfe=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['user_id']."'"));
		 ?>
		 <tr>
        <td class="bang"><?php echo $idnext;?></td>
        <td class="bang"><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<?php 
		if($res['act']=='sale paypal') { ?>
		<td class="bang">Bán PayPal</td>
		<td class="bang">
		<span style="color: <? echo ($res['coin_bonus_add']>=50 ? '#23ACE5' : 'orange');?>"><? echo number_format($res['coin_bonus_add']);?>USD</span>
		</td>
		
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
						<?php 		$status="mặt định";		if(trim($res['status'])=='pending'){$status="chờ sử lý";}		if(trim($res['status'])=='disagree'){$status="bị từ chối";}		if(trim($res['status'])=='done'){$status="đã sử lý";}		if(trim($res['status'])=='success'){$status="Thành công";}		if(trim($res['status'])=='using'){$status="Sử dụng";}		if(trim($res['status'])=='paid'){$status="Đã thanh toán";}		echo $status;		?>
		</span>
		
		</td>
			<? } ?>
		<?php 
		if($res['act']=='buy paypal') { ?>
		<td class="bang">Mua paypal</td>
		<td class="bang">
		<span style="color: <? echo ($res['coin_bonus_add']>=50 ? '#23ACE5' : 'orange');?>"><? echo number_format($res['coin_bonus_add']);?>USD</span>
		</td>
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='Bị từ chối') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		</td>
			<? } ?>
			<?php 
		if($res['act']=='f1 premium actived') { ?>
		<td class="bang">Actived account</td>
		<td class="bang"></td>
		<td class="bang"><? echo $usermain['status'];?></td>
			<? } ?>
			<?php 
		if($res['act']=='authentication') { ?>
		<td class="bang">Authentication</td>
		<td class="bang"></td>
		<td class="bang"><span style="color:green">success</span></td>
			<? } ?>
			<?php 
		if($res['act']=='rutvideocoin') { ?>
		<td class="bang">Rút tiền video về Tiền chính</td>
		<td class="bang done"><? echo number_format($res['coin_add']);?><? echo $set['donvi'];?></td>
		<td class="bang"><span style="color:green">thành công</span></td>
			<? } ?>
			<?php 
		if($res['act']=='rutcoinlock') { ?>
		<td class="bang">Bonus 10% withdrawal</td>
		<td class="bang done"><? echo number_format($res['coin_add']);?><? echo $set['donvi'];?></td>
		<td class="bang"><span style="color:green">success</span></td>
			<? } ?>
				<?php 
		if($res['act']=='rutcoinbonus') { ?>
		<td class="bang">Money Atfriends withdrawal</td>
		<td class="bang done"><? echo number_format($res['coin_add']);?><? echo $set['donvi'];?></td>
		<td class="bang"><span style="color:green">success</span></td>
			<? } ?>
			<?php 
		if($res['act']=='rutcoinday') { ?>
		<td class="bang">Money Atfriends withdrawal</td>
		<td class="bang"><? echo number_format($res['coin_add']);?><? echo $set['donvi'];?></td>
		<td class="bang"><span style="color:green">success</span></td>
			<? } ?>
		<?php 
		if($res['act']=='buycard') { ?>
		<td class="bang">Exchange <? echo $res['amount'];?> card <? echo $res['namecard'];?> <? echo $res['typecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><? echo $res['status'];?></td>
			<? } ?>
			
			<?php 
		if($res['act']=='add coin_bonus diem danh') { ?>
		<td class="bang">Money Atfriends</td>
		<td class="bang done"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><span style="color:green">success</span></td>
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
		<td class="bang"><span style="color:green">success</span></td>
			<? } ?>
			<?php 
		if($res['act']=='change cmnd face 2') { ?>
		<td class="bang">Change cmnd face 2</td>
		<td class="bang"></td>
		<td class="bang"><span style="color:green">success</span></td>
			<? } ?>
			
<?php 
		if($res['act']=='register') { ?>
		<td class="bang">Register success</td>
		<td class="bang"></td>
		<td class="bang"><? echo $res['log'];?></td>
			<? } ?><?php 
		if($res['act']=='register on facebook') { ?>
		<td class="bang">Register by Facebook success</td>
		<td class="bang"></td>
		<td class="bang"><? echo $res['log'];?></td>
			<? } ?>
			<?php 
		if($res['act']=='add coinday diem danh') { ?>
		<td class="bang">Money Atfriends</td>
		<td class="bang done"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang"><span style="color:green">success</span></td>
			<? } ?>
			
			<?php 
		if($res['act']=='roll gift') { ?>
		<td class="bang">Receive gifts from the spin:
		<? echo $qua['name'];?>
		</td>
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<?
		$qua=mysql_fetch_assoc(mysql_query("SELECT * FROM `gift` WHERE `id` = '".$res['boxid']."'")); ?>
		<? echo $qua['loaithe'];?><? 
		if($res['status']!=='new' && $res['status']!=='pending') { ?>đ<?} ?>
		</span>
		</td>
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		
		</td>
			<? } ?>
			
			<?php 
		if($res['act']=='received gift 1K') { ?>
		<td class="bang">Receive gifts 1K from the spin
		</td>
		<td class="bang done">
		1.000đ
		</td>
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		
		</td>
			<? } ?>
		<?php 
		if($res['act']=='paygame') { ?>
		<td class="bang">Pay game <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		</td>
			<? } ?>	
		<?php 
		if($res['act']=='payk') { ?>
		<td class="bang">Pay K+: <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		</td>
			<? } ?>		
				<?php 
		if($res['act']=='payinternet') { ?>
		<td class="bang">Pay Internet: <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
	<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		</td>
			<? } ?>		
			
			<?php 
		if($res['act']=='duyet thanh toan') { ?>
		<td class="bang">Withdrawal</td>
		<td class="bang">-<? echo number_format($res['coin_minus']);?></td>
	<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		</td>
			<? } ?>	
			
			<?php 
		if($res['act']=='tu choi thanh toan') { ?>
		<td class="bang">Refuse payment</td>
		<td class="bang"><? echo number_format($res['coin_minus']);?></td>
	<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		</td>
			<? } ?>		
			<?php 
		if($res['act']=='payphonecard') { ?>
		<td class="bang">Pay card: <? echo $res['namecard'];?></td>
		<td class="bang"><? echo number_format($res['coin_bonus_add']);?></td>
		<td class="bang">
		<span style="color: 
		<? 
		if($res['status']=='done' || $res['status']=='success' || $res['status']=='paid') { echo 'green'; }
		if($res['status']=='pending' || $res['status']=='using') { echo 'orange'; }
		if($res['status']=='disagree') { echo 'red'; }
		?>">
		<? echo $res['status'];?>
		</span>
		</td>
			<? } ?>	<?php 
		if($res['act']=='getmoneyvideo') { ?>
		<td class="bang">Nhận tiền Video</td>
		<td class="bang done"><? echo number_format($res['coin_bonus_add']);?> <? echo $set['donvi'];?></td>
		<td class="bang done">Đã nhận</td>
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
	
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnext.'&', $start, $total, $kmess);?></div>
	   </div>
	

</div>
<? } ?>

</div>
<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

