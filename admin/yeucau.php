<?php
define('_IN_JOHNCMS', 1);
$headmod = 'yeucau';
$textl='Yêu cầu rút';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights>=9) {
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">YÊU CẦU RÚT TIỀN</div>
</div>
<div style="padding:10px;background:#fff">
<h5><i class="fa fa-clock-o" aria-hidden="true"></i> Đang chờ xử lý (<?php echo $totalwait=mysql_result(mysql_query("SELECT COUNT(*) FROM yeucaurut WHERE status = 'pending'"),0);?>)</h5></div>
 <?

 $list_wait=mysql_query("SELECT * FROM yeucaurut WHERE status = 'pending' ORDER BY time DESC LIMIT $start, $kmess");
 while($list=mysql_fetch_assoc($list_wait)) {
	 $useryc=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$list['user']."'"));
	 ?>
	 <div STYLE="background:#f2f2f2;padding:20px;border-bottom:1px solid white;font-size:12px;font-weight:normal;" >
  <div class="card-body">
  <div><i>Đã yêu cầu rút tiền lúc: <?php echo date("H:m:s - d/m/Y",$list['time']+$set['timeshift']*3600);?></i></div>
  <div>
    <div class="border-0 float-left" style="padding-right:10px;float:left;"> <?php if(!empty($useryc['avatar'])) { ?>
                <img width="40" class="avatarcs" height="40" src="/sr/avt/<?php echo $useryc['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" class="avatarcs" src="/sr/img/avt.png">
	  <?php } ?></div>
	<div class="border-0 float-left " style="padding-right:10px;float:left;">
	<strong class="text-black"><a href="/admin/search.php?id=<?php echo $list['user'];?>">ID: <?php echo $list['user'];?></a></strong><br>
	<strong class="text-success"><img src="/sr/img/money.png" height="20"/> <?php echo number_format($list['coin_old']);?></strong><br>
	<strong class="text-danger"><img src="/sr/img/money.png" height="20"/>-<?php echo number_format($list['coin']);?></strong><br>
	</div>
	<div>
	<div>Tên ngân hàng: <strong><?php echo $list['bank']; ?></strong></div>
<div>Số tài khoản: <strong><?php echo $list['stk']; ?></strong></div>
<div>Họ tên chủ tài khoản: <strong><?php echo $list['namebank']; ?></strong></div>
	</div>
	</div>
	
	<div style="clear:both;">
	<?php
	if(isset($_POST['tuchoi'.$list['id'].''])) {
	    $lido = isset($_POST['lido'.$list['id'].'']) ? trim($_POST['lido'.$list['id'].'']) : '';
	    if($list['status']!='pending') {
		 $error[]='Trạng thái không chính xác';
	 }
	 if($useryc['status']=='pending' || $useryc['status']=='banned') {
		 $error[]='Trạng thái tài khoản không hợp lệ';
	 }
	 if(empty($error)) {
		 
		 
		 // update status yeucaurut pending -> done
		 mysql_query("UPDATE yeucaurut SET 
		 status = 'fail',
		 timedone = '".time()."',
		 comment = '".mysql_real_escape_string($lido)."',
		 admin_duyet = '".$user_id."'
		 WHERE id = '".$list['id']."'");
		 //write log
		mysql_query("INSERT INTO log SET
		time = '".time()."',
		act = 'tu choi thanh toan',
		coin_minus = '".$list['coin']."',
		`status` = 'disagree',
		idtacdong = '".$list['user']."',
		box = '".$list['user']."',
		log = 'ID: $user_id từ chối thanh toán ".$list['coin']." cho ".$list['user']." với lí do ".$lido.".'
		");
		 $textnote='Error: Unsuccessful withdrawal request';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = 'red',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$list['user']."'");	
		 // send email admin
			$mail = $set['email'];
			$subject = "Earnmoney từ chối thanh toán cho ID: ".$list['user']."";
			$message = "Đã từ chối thanh toán cho ".$list['user']." thành công số tiền ".number_format($list['coin'])." với lí do ".$lido."";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
		 
		 // send email user
			$mail = $useryc['mail'];
			$subject = "Earnmoney từ chối thanh toán cho ID: ".$list['user']."";
			$message = "ID: ".$list['user']." không được duyệt thanh toán: ".number_format($list['coin'])." ".$set['donvi']." với lí do ".$lido.".";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
		  ?>
		<div class="alert alert-primary" role="alert">
		Đã từ chối thanh toán
		</div>
		<?
	 } else {
		 ?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
		 <div><span class="text-muted"><a href="/admin/yeucau.php" class="btn btn-primary"><i class="fa fa-retweet" aria-hidden="true"></i> Tải lại</a></span></div>
		<?
	 }
	}
	 if(isset($_POST['duyetrut'.$list['id'].''])) {
	 $phick=isset($_POST['phick'.$list['id'].'']) ? abs(intval($_POST['phick'.$list['id'].''])) : 0;
	 $code = isset($_POST['code'.$list['id'].'']) ? trim($_POST['code'.$list['id'].'']) : '';
	 if($list['status']!='pending') {
		 $error[]='Trạng thái không chính xác';
	 }
	 if($usermain['coin']<($list['coin']+$phick)) {
		 $error[]='Số dư tài khoản admin không đủ để thanh toán';
	 }
	 if($list['coin']<50000) {
		 $error[]='Số dư yêu cầu thanh toán không hợp lệ';
	 }
	 if($useryc['coin']<$list['coin']) {
		 $error[]='Số dư yêu cầu thanh toán không hợp lệ vì tài khoản user không đủ';
	 }
	 if($useryc['status']=='pending' || $useryc['status']=='banned') {
		 $error[]='Trạng thái tài khoản không hợp lệ';
	 }
	 if($phick<0) {
		 $error[]='Phí chuyển khoản không hợp lệ';
	 }
	 if($code!=$set['mamat']) {
		 $error[]='Mã bí mật của admin không trùng khớp';
	 }
	 if(empty($error)) {
		 //trừ tiền admin, trừ tiền cho user, rutcoindone + 1 user, set['paydone']+1
		 mysql_query("UPDATE users SET
		 coin = coin - '".($list['coin']+$phick)."'
		 WHERE id = '".$user_id."'");
		 mysql_query("UPDATE users SET
		 coin = coin - '".$list['coin']."',
		 rutcoindone = rutcoindone + 1
		 WHERE id = '".$list['user']."'");
		 mysql_query("UPDATE cms_settings SET val = val + 1 WHERE key = paydone");
		 // update status yeucaurut pending -> done
		 mysql_query("UPDATE yeucaurut SET 
		 status = 'done',
		 timedone = '".time()."',
		 phick = '".$phick."',
		 admin_duyet = '".$user_id."'
		 WHERE id = '".$list['id']."'");
		 //write log
		 
		 $textnote='Successful withdrawal.<br>Congratulations, you have successfully withdrawn '.number_format($list['coin']).''.$set['donvi'].' to your linked bank account<br>Please check your account balance';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$list['user']."'");	
			
		mysql_query("INSERT INTO log SET
		time = '".time()."',
		act = 'duyet thanh toan',
		`status` = 'done',
		idtacdong = '".$list['user']."',
		box = '".$user_id."',
		coin_minus = '".($list['coin']+$phick)."',
		log = 'ID: $user_id duyệt thanh toán ".$list['coin']." cho ".$list['user'].", phí chuyển khoản: $phick'
		");
		 
		 // send email admin
			$mail = $set['email'];
			$subject = "Earnmoney duyệt thanh toán thành công cho ID: ".$list['user']."";
			$message = "Đã xác nhận duyệt thanh toán cho ".$list['user']." thành công số tiền ".number_format($list['coin'])." và phí chuyển khoản $phick trừ vào tài khoản chính của admin";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
		 
		 // send email user
			$mail = $useryc['mail'];
			$subject = "Earnmoney đã thanh toán thành công cho ID: ".$list['user']."";
			$message = "ID: ".$list['user']." đã được duyệt thanh toán thành công số tiền: ".number_format($list['coin'])." ".$set['donvi'].". Hãy kiểm tra lại số dư tài khoản!";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
		  ?>
		<div class="alert alert-success" role="alert">
		Duyệt thanh toán thành công!
		</div>
		<?
	 } else {
		 ?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
		 <div><span class="text-muted"><a href="/admin/yeucau.php" class="btn btn-primary"><i class="fa fa-retweet" aria-hidden="true"></i> Tải lại</a></span></div>
		<?
	 }
	 
 } else {
 ?>
<br>
<form   method="post">
<div class="btn-group" style="float:right;max-width:48%;text-align:center;">
<input type="hidden" name="idyc<?php echo $list['id']; ?>" value="<?php echo $list['id']; ?>"/>
<input class="form-control" style="width:100%" name="code<?php echo $list['id']; ?>" type="text" value="" placeholder="Mã mật"/>
<span class="text-muted">Phí chuyển khoản nếu có</span>
<input class="form-control" name="phick<?php echo $list['id']; ?>" type="number" value="0" style="width:100%;" placeholder="Phí chuyển khoản nếu có"/>
<input class="cmt-to-login" type="submit" name="duyetrut<?php echo $list['id']; ?>" style="width:80%;background:green;color:white" value="Duyệt"/>
</div>

<div class="" style=";;max-width:48%;text-align:center;">
<textarea class="form-control" name="lido<?php echo $list['id']; ?>" type="text" value="" style="width:90%;height:100px;;" placeholder="Lí do từ chối"></textarea>

<input class=" cmt-to-login" type="submit" name="tuchoi<?php echo $list['id']; ?>" style="width:80%;background:red;color:white" value="Từ chối"/></div>
</form> 
 <? }?>
	</div>
  </div>
</div>
<?php
 }
 
 ?>
 	  <?php
  if ($totalwait > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Số trang</label>
    <input type="text" style="width:100px" class="form-control" name="page" id="page" placeholder="Số trang">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Đến trang</button>
</form>
</div>
<? } ?>
   <br>
   <br>
   <br>
 <div  class="border-bottom" style="background:white;padding:20px;">
<h5><i class="fa fa-clock-o" aria-hidden="true"></i> Đã xử lý (<?php echo $totaldone=mysql_result(mysql_query("SELECT COUNT(*) FROM yeucaurut WHERE status != 'pending'"),0);?>)</h5></div>
 <?

 $list_wait=mysql_query("SELECT * FROM yeucaurut  WHERE status != 'pending' ORDER BY time DESC LIMIT $start, $kmess");
 while($list=mysql_fetch_assoc($list_wait)) {
	 $useryc=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$list['user']."'"));
	 ?>
	 <div class="card shadow-sm p-3 mb-5 bg-white rounded" style="background:#f2f2f2;padding:20px;border-bottom:1px solid white;border-radius:0px;">
  <div class="card-body">
  <div><i>Đã yêu cầu rút tiền lúc: <?php echo date("H:m:s - d/m/Y",$list['time']+$set['timeshift']*3600);?></i></div>
  <div>
    <div class="border-0 float-left" style="padding-right:10px;float:left"><img src="/sr/img/avt.png" height="50"/></div>
	<div class="border-0 float-left " style="padding-right:10px;float:left">
	<strong class="text-black"><a href="/admin/search.php?id=<?php echo $list['user'];?>">ID: <?php echo $list['user'];?></a></strong><br>
	<strong class="text-success"><img src="/sr/img/money.png" height="20"/> <?php echo number_format($list['coin_old']);?></strong><br>
	<strong class="text-danger"><img src="/sr/img/money.png" height="20"/>-<?php echo number_format($list['coin']);?></strong><br>
	</div>
	<div>
	<div>Tên ngân hàng: <strong><?php echo $list['bank']; ?></strong></div>
<div>Số tài khoản: <strong><?php echo $list['stk']; ?></strong></div>
<div>Họ tên chủ tài khoản: <strong><?php echo $list['namebank']; ?></strong></div>
	</div>
	</div>
	
	<div style="clear:both;"><br>
	<? if($list['status']=='done') { ?>
	<strong class="text-success" style="color:green">Đã thanh toán thành công: <?php echo number_format($list['coin']);?>; phí chuyển khoản: <?php echo number_format($list['phick']);?></strong>
	<? } else if($list['status']=='fail') { ?>
	<strong class="text-danger" style="color:red">Đã từ chối thanh toán: <?php echo number_format($list['coin']);?></strong>
	<? } ?>
	</div>
	</div>
	</div>
 <? }?>
 <?php
  if ($totaldone > $kmess) {
	  ?><div class="">
	  
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	

</div>
<? } ?>
  </div>
</div>
  
  </div> </main>
 
</div>	 
	<div style="padding-bottom:50px;" class="float-right"></div>
</body>
<?php require('../footer.php');?>

</html>	
<?php } ?>
