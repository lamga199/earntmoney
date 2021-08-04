<?php
define('_IN_JOHNCMS', 1);
$headmod = 'admin_uact';
$textl='ADMIN';
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
	</style><style>
table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}
</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Danh sách tài khoản đã bị ban</div>
</div>
<div style="background:white;padding:10px;">
<?
switch($act) {
	default:
	?>

<h2>List account</h2>    <div class="table-responsive"><table class="table table-striped table-sm">
   
      <tr style="background-color:rgb(230,230,230);">
        <td>Number</td>
        <td>Destination IP Adress</td>
        <td>Tên CTV</td>
		<td>Trạng thái</td>
		<td>Thời gian đăng ký</td>
		<td>ID</td>
		<td>RefID</td>
		<td>Action</td>
      </tr>
   

     <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `status` = 'banned' AND `code_register` = ''"), 0);
	 $req=mysql_query("SELECT * FROM `users` WHERE `status` = 'banned' AND `code_register` = '' ORDER BY `datereg` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		<tr style="background-color:#F2f2f2">
        <td><?echo $i;?></td>
        <td><?php echo $res['ip'];?></td>
        <td><?php echo $res['name'];?></td>
		<td <? echo ($res['status']=='pending' ? ' style="color:red"' : '');?><? echo ($res['status']=='actived' ? ' style="color:green"' : '');?><? echo ($res['status']=='banned' ? ' style="color:orange"' : '');?>><?php echo $res['status'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['datereg']+$set['timeshift']*3600);?></td>
		<td><?php echo $res['id'];?></td>
		<td><?php echo $res['refid'];?></td>
		<td><div class="btn-group" role="group" aria-label="Basic example">

	<a href="?act=unban&id=<?php echo $res['id'];?>" class="card-link btn btn-success">Open</a>

  </div></td>
      </tr>
	
		 
		 <?php
		 $i++; }
	 
	 ?> 
  </table></div><div style="clear:both;"></div>
	 
	  <?php
  if ($total > $kmess) {
	  ?><div class="">
	 
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	
</div>
<? } ?>

<?php 
break;
case 'unban':
$uid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
$refid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid['refid']."'"));
?>
<h2>Ban ID: <?php echo $uid['id'];?></h2>
<h5>Thông tin tài khoản mặc định</h5>
<div>Tên tài khoản: <strong><?php echo $uid['name'];?></strong> - Tình trạng tài khoản: <strong style="color:orange"><?php echo $uid['status']; ?></strong> - ID: <strong style="color:black"><?php echo $uid['id']; ?></strong></div>
<div>Ngày đăng ký: <strong><?php echo date("H:i:s - d/m/Y",$uid['datereg']+$set['timeshift']*3600);?></strong></div>
<div>Họ và tên: <strong><?php echo $uid['imname'];?></strong></div>
<div>Số điện thoại: <strong><?php echo $uid['mibile'];?></strong></div>
<div>Địa chỉ email: <strong><?php echo $uid['mail'];?></strong></div>
<div>ID tài khoản giới thiệu: <strong><?php echo $uid['refid']; ?></strong></div>
<h5>Xác nhận bỏ ban nick</h5>
<li><strong>ID <?php echo $uid['id'];?> - Tình trạng tài khoản: <strong style="color:orange">banned > actived</strong></strong></li>
<br>
<?php
if(isset($_POST['submit'])) {
		// check tồn tại tk kích hoạt
		if($uid['status']=='actived') {
			$error[] = 'Tài khoản đã đang trong tình trạng hủy ban rồi';
		}
		if(!$uid['id']) {
			$error[] = 'Tài khoản không tồn tại';
		}
		if($uid['rights']>=9) {
			$error[] = 'Không thể ban tài khoản Super admin';
		}
		if(empty($error)) {
			// kích hoạt tài khoản
			mysql_query("UPDATE users SET status = 'actived', timeban = '' WHERE id = '".$uid['id']."'");

			
			// ghi log cho user
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'unbanned nick',
			idtacdong = '".$user_id."'
			box = '".$uid['id']."'");

			// báo mail cho user được act
			$mail = $uid['mail'];
			$subject = "Earnmoney hủy banned tài khoản vi phạm";
			$message = "Tài khoản của bạn đã được hủy cấm trên Earnmoney!";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			
			// báo mail cho admin
			$mail = $set['email'];
			$subject = "Earnmoney admin vừa hủy ban nick";
			$message = "Tài khoản ID: ".$uid['id']." vừa được admin hủy banned trên Earnmoney.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			?>
			<div><span class="text-muted">Đã hủy cấm tài khoản truy cập. Quay lại <a href="/admin/user.php">Danh sách tài khoản chờ</a></span></div>
			
			<?php
		} else {
			
			echo functions::display_error($error);
		}
	
} else {?>
<form method="post">
<button type="submit" name="submit" class="cmt-to-login">Kích hoạt</button>
</form>
<?php
}

break;
case 'pending':
$uid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
$refid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid['refid']."'"));
?>
<h2>Ban ID: <?php echo $uid['id'];?></h2>
<h5>Thông tin tài khoản mặc định</h5>
<div>Tên tài khoản: <strong><?php echo $uid['name'];?></strong> - Tình trạng tài khoản: <strong style="color:orange"><?php echo $uid['status']; ?></strong> - ID: <strong style="color:black"><?php echo $uid['id']; ?></strong></div>
<div>Ngày đăng ký: <strong><?php echo date("H:i:s - d/m/Y",$uid['datereg']+$set['timeshift']*3600);?></strong></div>
<div>Họ và tên: <strong><?php echo $uid['imname'];?></strong></div>
<div>Số điện thoại: <strong><?php echo $uid['mibile'];?></strong></div>
<div>Địa chỉ email: <strong><?php echo $uid['mail'];?></strong></div>
<div>ID tài khoản giới thiệu: <strong><?php echo $uid['refid']; ?></strong></div>
<h5>Xác nhận đẩy nick về trạng thái pending</h5>
<li><strong>ID <?php echo $uid['id'];?> - Tình trạng tài khoản: <strong style="color:orange">banned > pending</strong></strong></li>
<br>
<?php
if(isset($_POST['submit'])) {
		// check tồn tại tk kích hoạt
		if($uid['status']=='pending') {
			$error[] = 'Tài khoản đã đang trong tình trạng hủy ban rồi';
		}
		if(!$uid['id']) {
			$error[] = 'Tài khoản không tồn tại';
		}
		if($uid['rights']>=9) {
			$error[] = 'Không thể ban tài khoản Super admin';
		}
		if(empty($error)) {
			// kích hoạt tài khoản
			mysql_query("UPDATE users SET status = 'pending', timeban = '' WHERE id = '".$uid['id']."'");

			
			// ghi log cho user
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'pending nick',
			idtacdong = '".$user_id."'
			box = '".$uid['id']."'");

			// báo mail cho user được act
			$mail = $uid['mail'];
			$subject = "Earnmoney hủy banned chuyển về pending cho tài khoản";
			$message = "Tài khoản của bạn đã được hủy cấm về pending trên Earnmoney!";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			
			// báo mail cho admin
			$mail = $set['email'];
			$subject = "Earnmoney admin vừa hủy ban nick chuyển về pending cho tài khoản";
			$message = "Tài khoản ID: ".$uid['id']." vừa được admin hủy banned chuyển về pending cho tài khoản trên Earnmoney.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			?>
			<div><span class="text-muted">Đã hủy cấm tài khoản truy cập chuyển về pending. Quay lại <a href="/admin/user.php">Danh sách tài khoản chờ</a></span></div>
			
			<?php
		} else {
			
			echo functions::display_error($error);
		}
	
} else {?>
<form method="post">
<button type="submit" name="submit" class="btn btn-warning">Pending</button>
</form>
<?php
}

break;
}
?>
    
 
  
  </div>
<?php require('../incfiles/end.php');?>
<?php } ?>

