<?php
define('_IN_JOHNCMS', 1);
$headmod = 'gift';
$textl='Gift';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');
?>
<style>
.dau {
	border-top:1px solid orange;
	color: #FF8000;
	font-size:16px;;
	margin:10px;
	text-align:center;
	padding:10px;
	background:#FBF8EF;
	margin-bottom:0px;
}
.success {
	color:#01DF3A;
	font-weight:bold;
}
.khung {
	color:#000;
	border: 1px solid #fff;
	padding:10px;
	height:170px;
	margin-top:10px;
	
}
.bo {
	max-width:80%;
	margin:0 auto;
}
.hr {
	border:1px solid #f2f2f2;
	width:80%;
	margin:0 auto;
	
}
.right {
	font-weight:bold;color:#000;	
}
</style>
<?
switch($act) {
	default:
	
	case 'bonus':
	$totallucky = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'new' AND `show` = 'on'"),0);
	$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on'"),0);
	?>
	<div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
	<?php require('uinfo.php');?>

<?php require('topmenu.php');?>
	
	<table style="border:1px solid #8000FF;width:100%;"><tr>
	<td style="border:1px solid #8000FF;width:50%;"><img src="/sr/img/Picture1.png"/> <a style="color:#2E64FE;font-weight:bold;" href="?act=bonus">Đổi thưởng vòng quay  (<? echo $total; ?>)</a></td>
	<td style="border:1px solid #8000FF;width:50%;"><img src="/sr/img/Picture2.png"/> <a style="color:red;font-weight:bold;" href="?act=lucky">Vòng quay may mắn (<? echo $totallucky; ?>)</a></td>
	</tr></table>
	<?php if($total==0) {?>
	<div style="color:#999;text-align:center">
	<img src="/sr/img/Picture3.png" height="50"/><br>You do not have a  EarntMoney Pay
	</div>
	<? } ?>
	<div class="wrap_cart_list">
	<?php 
	if(!$act){
	$totalviettel10k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '10.000' AND `mang` = 'viettel'"),0);
	//
	if($totalviettel10k>0) {
		?>
		<a href="?act=viettel10k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/viettel.png" height="30"/></td>
		<td style="width:40%;">VIETTEL CARD (<? echo $totalviettel10k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">10.000đ</td></tr></table></a>
		<?
		}
		$totalviettel50k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '50.000' AND `mang` = 'viettel'"),0);
	//
	if($totalviettel50k>0) {
		?>
		<a href="?act=viettel1k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/viettel.png" height="30"/></td>
		<td style="width:40%;">VIETTEL CARD (<? echo $totalviettel50k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">50.000đ</td></tr></table></a>
		<?
	}
	
	$totalviettel100k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '100.000' AND `mang` = 'viettel'"),0);
	//
	if($totalviettel100k>0) {
		?>
		<a href="?act=viettel1k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/viettel.png" height="30"/></td>
		<td style="width:40%;">VIETTEL CARD (<? echo $totalviettel100k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">100.000đ</td></tr></table></a>
		<?
	}
	
	$totalmobifone1k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '1.000' AND `mang` = 'mobifone'"),0);
	//
	if($totalmobifone1k>0) {
		?>
		<a href="?act=mobifone1k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/mobifone.png" height="30"/></td>
		<td style="width:40%;">MOBIFONE CARD (<? echo $totalmobifone1k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">1.000đ</td></tr></table></a>
		<?
	}
	
	
	$totalmobifone10k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '10.000' AND `mang` = 'mobifone'"),0);
	//
	if($totalmobifone10k>0) {
		?>
		<a href="?act=mobifone10k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/mobifone.png" height="30"/></td>
		<td style="width:40%;">MOBIFONE CARD (<? echo $totalmobifone10k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">10.000đ</td></tr></table></a>
		<?
		}
	$totalmobifone50k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '50.000' AND `mang` = 'mobifone'"),0);
	
	if($totalmobifone50k>0) {
		?>
		<a href="?act=mobifone50k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/mobifone.png" height="30"/></td>
		<td style="width:40%;">MOBIFONE CARD (<? echo $totalmobifone50k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">50.000đ</td></tr></table></a>
		<?
	}
		$totalmobifone100k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '100.000' AND `mang` = 'mobifone'"),0);
	//
	if($totalmobifone100k>0) {
		?>
		<a href="?act=mobifone100k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/mobifone.png" height="30"/></td>
		<td style="width:40%;">MOBIFONE CARD (<? echo $totalmobifone100k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">100.000đ</td></tr></table></a>
		<?
	}
	
	
	$totalvinaphone1k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '1.000' AND `mang` = 'vinaphone'"),0);
	//
	if($totalvinaphone1k>0) {
		?>
		<a href="?act=vinaphone1k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/vinaphone.png" height="30"/></td>
		<td style="width:40%;">VINAPHONE CARD (<? echo $totalvinaphone1k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">1.000đ</td></tr></table></a>
		<?
	}
		$totalvinaphone10k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '10.000' AND `mang` = 'vinaphone'"),0);
	//
	if($totalvinaphone10k>0) {
		?>
		<a href="?act=vinaphone10k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/vinaphone.png" height="30"/></td>
		<td style="width:40%;">VINAPHONE CARD (<? echo $totalvinaphone10k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">10.000đ</td></tr></table></a>
		<?
		}
		$totalvinaphone50k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '50.000' AND `mang` = 'vinaphone'"),0);
	//
	if($totalvinaphone50k>0) {
		?>
		<a href="?act=vinaphone50k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/vinaphone.png" height="30"/></td>
		<td style="width:40%;">VINAPHONE CARD (<? echo $totalvinaphone50k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">50.000đ</td></tr></table></a>
		<?
	}
		$totalvinaphone100k = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' AND `loaithe` = '100.000' AND `mang` = 'vinaphone'"),0);
	//
	if($totalvinaphone100k>0) {
		?>
		<a href="?act=vinaphone100k" style="color:black"><table style="width:100%;padding:5px;">
		<tr style="width:100%;"><td style="width:30%;">
		<img src="/sr/img/vinaphone.png" height="30"/></td>
		<td style="width:40%;">VINAPHONE CARD (<? echo $totalvinaphone100k; ?>)</td><td style="width:30%;font-weight:bold;color:#999">100.000đ</td></tr></table></a>
		<?
	}
	}
	switch($act) {
			case 'vinaphone1k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE VINAPHONE CARD<br>1000đ<br>
				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">1000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card1k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '1.000' AND `mang` = 'vinaphone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card1k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/vinaphone.png" height="30"/> vinaphone</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalvinaphone1k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'vinaphone10k':
			?>
				
				<div class="dau">
					CHANGE MOBILE PHONE THE VINA CARD					
				</div>
				<div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<img src="sr/img/logo_notslogan.png" width="50">
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						VALUE CARD
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<strong>10000đ</strong>
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<span class="success">success</span>
					 </div>
				</div>
				<div class="bo">
				<div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">10000đ</div></div>
				<div>
					<div class="hr"></div>
					<div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  VINAPHONE EARNTMONEY</div></div>
					<div style="color:#000;padding:10px; "><div class="right">TRANSACTION DETAILS</div></div>
					
					<div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
					<div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				</div>
				<div  style="clear:both;"></div>
				<div class="hr"></div>
			<?
			$card10k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '10.000' AND `mang` = 'vinaphone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card10k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/vinaphone.png" height="30"/> vinaphone</div></div>
				<!--<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalvinaphone10k;?></div></div>--->
				<div style="clear:both;"></div>
				<div>Card Code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div>
				<div style="clear:both;"></div>
				</div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div>
				<div style="clear:both;"></div>
				</div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br>
				</div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'vinaphone50k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE VINAPHONE CARD<br>50000đ<br>
				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">50000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card50k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '50.000' AND `mang` = 'vinaphone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card50k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/vinaphone.png" height="30"/> vinaphone</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalvinaphone50k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'vinaphone100k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE VINAPHONE CARD<br>100000đ<br>
				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">100000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card100k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '100.000' AND `mang` = 'vinaphone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card100k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/vinaphone.png" height="30"/> vinaphone</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalvinaphone100k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}

			break;
			
			
			
		}
	?>
	<?php
	switch($act) {
			
			case 'viettel10k':
			?>
				
				<div class="dau">
					ĐỔI THẺ NẠP ĐIỆN THOẠI TỪ VÒNG QUAY MAY MẮN					
				</div>
				<div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<img src="sr/img/logo_notslogan.png" width="50">
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						MỆNH GIÁ THẺ
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<strong>10000đ</strong>
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<span class="success">Thành công</span>
					 </div>
				</div>
				<div class="bo">
				<div style="color:#000;padding:10px;">THÔNG TIN THẺ</div>
				
				<div style="color:#000;padding:10px;">Nguồn<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Phí giao dịch<div style="float:right;color:#000">Miễn phí</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">10000đ</div></div>
				<div>
					<div class="hr"></div>
					<div style="color:#000;padding:10px;">Dịch vụ cung cấp<div style="float:right;color:#000">  VIETTEL EARNTMONEY</div></div>
					<div style="color:#000;padding:10px; "><div class="right">CHI TIẾT GIAO DỊCH</div></div>					
					<div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Mã giao dịch</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
					<div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Thời gian</div><div style="color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				</div>
				<div  style="clear:both;"></div>
				<div class="hr"></div>
			<?
			$card10k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '10.000' AND `mang` = 'viettel' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card10k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">THÔNG TIN THẺ<div style="float:right;"><img src="/sr/img/viettel.png" height="30"/> Viettel</div></div>
				<!--<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalviettel10k;?></div></div>--->
				
				<div style="clear:both;"></div>
				<div>Mã thẻ<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div>
				<div style="clear:both;"></div>
				</div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div>
				<div style="clear:both;"></div>
				</div>
				<div  style="padding-top:20px;">Hết hạn<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br>
				</div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'viettel50k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE VIETTEL CARD<br>50000đ<br>
				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">50000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card50k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '1.000' AND `mang` = 'viettel' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card50k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/viettel.png" height="30"/> Viettel</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalviettel50k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'viettel100k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE VIETTEL CARD<br>100000đ<br>
				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">100000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card100k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '1.000' AND `mang` = 'viettel' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card100k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/viettel.png" height="30"/> Viettel</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalviettel100k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}

			break;
			
			
			
		}
		switch($act) {
			case 'mobifone1k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE MOBIFONE CARD

				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">1000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card1k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '1.000' AND `mang` = 'mobifone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card1k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/mobifone.png" height="30"/> mobifone</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalmobifone1k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'mobifone10k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE MOBIFONE CARD
				</div>
				<div style="text-align:center;background:#fafafa;margin-left:10px;margin-right:10px;padding-bottom:5px;">
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<img src="sr/img/logo_notslogan.png" width="50">
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						VALUE CARD
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<strong>10000đ</strong>
					 </div>
					 <div style="text-align:center;padding-top:5px;padding-bottom5px;">
						<span class="success">success</span>
					 </div>
				</div>
				<div class="bo">
				<div style="color:#000;padding:10px;">INVIOCE INFOMATION</div>
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">10000đ</div></div>
				<div class="hr"></div>
				<div class="hr"></div>
				<div style="color:#000;padding:10px;">Service provided<div style="float:right;color:#000">  MOBIFONE EARNTMONEY</div></div>
				<div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div>
				<div>
					<div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Trading code</div><div style="color:#000"><? echo rand(11111111,99999999);?></div></div>
					<div style="color:#000;padding:10px;width:calc( 50% - 20px);float:left;text-align:left;"><div>Time</div><div style="color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				</div>
				<div  style="clear:both;"></div>
				<div class="hr"></div>
			<?
			$card10k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '10.000' AND `mang` = 'mobifone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card10k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">INFORMATION CARD<div style="float:right;"><img src="/sr/img/mobifone.png" height="30"/> mobifone</div></div>
				<!--<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalmobifone10k;?></div></div>--->
				<div style="clear:both;"></div>
				<div style="clear:both;">Card Code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div>
				<div style="clear:both;"></div>
				</div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div>
				<div style="clear:both;"></div>
				</div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'mobifone50k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE MOBIFONE CARD<br>50000đ<br>
				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">50000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card50k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '50.000' AND `mang` = 'mobifone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card50k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/mobifone.png" height="30"/> mobifone</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalmobifone50k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}
			break;
			case 'mobifone100k':
			?>
				
				<div class="dau">
				CHANGE MOBILE PHONE THE MOBIFONE CARD<br>100000đ<br>
				<span class="success">success</span></div><div class="bo">
				<div style="color:#000;padding:10px;">Source<div style="float:right;color:#000">EarntMoney E-Commerce Service</div></div>
				<div style="color:#000;padding:10px;">Transaction costs<div style="float:right;color:#000">No Fees</div></div>
				
				<div style="color:#000;padding:10px;"> EarntMoney Pay<div style="float:right;color:#000">100000đ</div></div>
				<div class="hr"></div><div style="color:#000;padding:10px;"><div class="right">TRANSACTION DETAILS</div></div><div style="color:#000;padding:10px;">Trading code<div style="float:right;color:#000"><? echo rand(11111111,99999999);?></div></div>
				<div style="color:#000;padding:10px;">Time<div style="float:right;color:#000"><?php echo date("H:i -d/m/Y",time()+7*3600);?></div></div>
				
			<?
			$card100k=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on' 
			 AND `loaithe` = '100.000' AND `mang` = 'mobifone' ORDER BY `timeduyet` DESC");
			while($card=mysql_fetch_assoc($card100k)) {
				?>
				<div class="khung">
				<div style="padding-bottom:10px;">Supplier<div style="float:right;"><img src="/sr/img/mobifone.png" height="30"/> mobifone</div></div>
				<div>Amount<div style="float:right;color:black;font-weight:bold;"><? echo $totalmobifone100k;?></div></div>
				<div>Pin code<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="code_<? echo $card['id'];?>" value="<? echo $card['code'];?>"/>
				<span onclick="code_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div style="padding-top:20px;">Seri<div style="float:right;background:#EFFBFB">
				<input type="text" style=";padding:7px;background:#EFFBFB" id="seri_<? echo $card['id'];?>" value="<? echo $card['seri'];?>"/>
				<span onclick="seri_<? echo $card['id'];?>()" href="#">copy <img src="/sr/img/copy.png" height="20"/></span></div></div>
				<div  style="padding-top:20px;">Exp<div style="float:right;color:black;font-weight:bold;"><?php echo $card['hethanthe'];?><br><a class="cmt-to-login" style="background:red;border-radius:10px;margin-bottom:10px;border:0px;" href="/report.php">Error report</a></div></div>
				</div>
				
				<script>
				function code_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("code_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
function seri_<? echo $card['id'];?>() {
 var cardid = <? echo $card['id'];?>;
  var copyText = document.getElementById("seri_"+cardid+"");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");


}
				</script>
				<?
				
			}

			break;
			
			
			
		}
		?>
	</div>
	</div>
	
	<?
	
	break;
	case 'lucky':
	?>
	<div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
	<?php require('uinfo.php');?>

<?php require('topmenu.php');
$totallucky = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'new' AND `show` = 'on'"),0);
	$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'done' AND `hienthe` = 'on'"),0);

?>
	
	<table style="border:1px solid #8000FF;width:100%;"><tr>
	<td style="border:1px solid #8000FF;width:50%;"><img src="/sr/img/Picture1.png"/> <a style="color:#2E64FE;font-weight:bold;" href="?act=bonus">Đổi thưởng vòng quay (<? echo $total; ?>)</a></td>
	<td style="border:1px solid #8000FF;width:50%;"><img src="/sr/img/Picture2.png"/> <a style="color:red;font-weight:bold;" href="?act=lucky"> Vòng quay may mắn(<? echo $totallucky; ?>)</a></td>
	</tr></table>
	
<?php
if(isset($_POST['submit'])) {
	$gift = isset($_POST['check']) ? intval($_POST['check']) : 0;
	$cehg=mysql_fetch_assoc(mysql_query("SELECT * FROM `gift` WHERE `id` = '".$gift."'"));
	if ($cehg['gift']<=0 || empty($cehg['gift'])) {
            $error[] = 'Error gift 1';
	}
	if ($cehg['gift']<=0 || $cehg['gift'] >=7) {
            $error[] = 'Error gift 2';
	}
	if ($cehg['userid']!=$user_id) {
            $error[] = 'Error user';
	}
	if ($cehg['status']!='new' || $cehg['exp']<=time() || $cehg['show']!='on') {
            $error[] = 'Qùa của bạn đã hết hạn hoặc được sử dụng';
	}
	$checkgiftbonusdd=mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `gift` = '2' AND `status` = 'using' OR `gift` = '3' AND `status` = 'using'"),0);
	if($checkgiftbonusdd>=1 && $cehg['gift']==2 || $checkgiftbonusdd>=1 && $cehg['gift']==3) {
		$error[] = 'Only 1 spawn item can be used at the same time';
	}
	if (!$error) {
		if($cehg['gift']!=2 && $cehg['gift']!=3) {
		mysql_query("UPDATE `gift` SET
		`status` = 'pending',
		`timeuse` = '".time()."',
		`show` = 'off'
		WHERE `id` = '".$cehg['id']."'");
		mysql_query("UPDATE `log` SET `status` = 'pending' WHERE `act` = 'roll gift' AND `boxid` = '".$cehg['id']."'");
		?>
		<div class="alert alert-success" style="color:green;text-align:center;" role="alert">
		Yêu cầu đổi thẻ thành công, hãy kiểm tra lại trong mục Đổi Thưởng Sau ít phút!
		</div>
		
		<?php
		} else if ($cehg['gift']==2 || $cehg['gift']==3) {
			mysql_query("UPDATE `gift` SET
		`status` = 'using',
		`timeuse` = '".time()."',
		`show` = 'off'
		WHERE `id` = '".$cehg['id']."'");
		mysql_query("UPDATE `log` SET `status` = 'using' WHERE  `act` = 'roll gift' AND `boxid` = '".$cehg['id']."'");
		?>
		<div class="alert alert-success" style="color:green;text-align:center;" role="alert">
		Use the item successfully! 
		</div>
		
		<?php
		}
		
		
	} else { ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
?>
	<form method="post">
<?
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'new' AND `show` = 'on'"),0);
$gif=mysql_query("SELECT * FROM `gift` WHERE `userid` = '".$user_id."' AND `status` = 'new' AND `show` = 'on' ORDER BY `status` DESC LIMIT $start, $kmess");
$i=1;
while($gift=mysql_fetch_assoc($gif)) {
	?>
	<div style="margin:5px;padding:5px;border:dotted 1px #333;"><input type="radio" value="<? echo $gift['id'];?>" name="check"/> <? echo $i;?>. <? echo $gift['name'];?>; Received date: <? echo date("H:i:s - d/m/y",$gift['time']+$set['timeshift']*3600);?>; Status: <? echo $gift['status'];?></div>
	
	<?
	++$i;
	
}

?>
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>
<input style="margin:7px;background:#04B431;border-radius:10px;" type="submit" name="submit" class="cmt-to-login" value="Đổi thưởng"/></form>
	</div>
	<?
	
	break;

	
}
?>
<div style="max-width:640px;margin:0 auto">
<?
require('botmenu.php');?></div>
<style>
.wrap_cart_list >a:nth-child(2n+1) table{
	background:#dcdcdc;
}
</style>
<?php require('incfiles/end.php');?>
<?php } ?>
