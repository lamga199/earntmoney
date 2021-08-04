<?php
define('_IN_JOHNCMS', 1);
date_default_timezone_set('asia/ho_chi_minh');
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
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Danh sách tài khoản chưa kích hoạt</div>
</div>
<div style="background:white;padding:10px;">
<?php
switch($act) {
	default:
	?>

<h2>List account</h2>

    <div class="table-responsive"><table class="table table-striped table-sm">
    
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
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `status` = 'pending' AND `code_register` = ''"), 0);
	 $req=mysql_query("SELECT * FROM `users` WHERE `status` = 'pending' AND `code_register` = '' ORDER BY `datereg` DESC LIMIT $start,$kmess");
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
		<td><? if($res['rights']<7) { ?>
		
		<div class="btn-group" role="group" aria-label="Basic example">
    <a href="?act=premium&id=<?php echo $res['id'];?>" class="card-link btn btn-primary">Premium</a>
    <a href="?act=free&id=<?php echo $res['id'];?>" class="card-link btn btn-success">Free</a>
	<a href="?act=ban&id=<?php echo $res['id'];?>" class="card-link btn btn-danger">Ban</a>
  </div>
  
  <? } ?>
  </td>
      </tr>
		
		 
		 <?php
	 $i++; }
	 
	 ?>  
  </table></div>
  
  <div style="clear:both;"></div>
	 
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
case 'premium':
$uid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
$refid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid['refid']."'"));
?>
<h2>Kích hoạt Premium ID: <?php echo $uid['id'];?></h2>
<h5>Thông tin tài khoản mặc định</h5>
<div>Tên tài khoản: <strong><?php echo $uid['name'];?></strong> - Tình trạng tài khoản: <strong style="color:orange"><?php echo $uid['status']; ?></strong> - ID: <strong style="color:black"><?php echo $uid['id']; ?></strong></div>
<div>Ngày đăng ký: <strong><?php echo date("H:i:s - d/m/Y",$uid['datereg']+$set['timeshift']*3600);?></strong></div>
<div>Họ và tên: <strong><?php echo $uid['imname'];?></strong></div>
<div>Số điện thoại: <strong><?php echo $uid['mibile'];?></strong></div>
<div>Địa chỉ email: <strong><?php echo $uid['mail'];?></strong></div>
<div>ID tài khoản giới thiệu: <strong><?php echo $uid['refid']; ?></strong></div>
<h5>Xác nhận kích hoạt</h5>

<?php if($refid['id']) {?>
<li><strong>ID <?php echo $set['admin_nhan_coin'];?>: +<?php echo number_format($set['thucoinreg']); ?><?php echo $set['donvi']; ?></strong></li>
<li><strong>ID <?php echo $uid['refid'];?>: +<?php echo number_format($set['f1coinreg']); ?><?php echo $set['donvi']; ?> </strong></li>
<? } else { ?>
<li><strong>ID <?php echo $set['admin_nhan_coin'];?>: +<?php echo number_format($set['coinact']); ?><?php echo $set['donvi']; ?></strong></li>
<? } ?>
<li><strong>ID <?php echo $uid['id'];?> - Tình trạng tài khoản: <strong style="color:orange">pending > actived</strong></strong></li>
<br>
<?php
if(isset($_POST['submit'])) {
		// check tồn tại tk kích hoạt
		$req2 = mysql_query("SELECT * FROM `users` WHERE `id`='" . $id . "'");

        if (mysql_num_rows($req2) == 0) {
            $error[] = 'Tài khoản kích hoạt không tồn tại';
        }
		
		if($uid['status']!='pending') {
			$error[] = 'Tài khoản đang không trong tình trạng chờ';
		}
		
		
		if($refid['id']) {
		// check tồn tại tk act
		$reqd = mysql_query("SELECT * FROM `users` WHERE `id`='" . $uid['refid'] . "'");
        if (mysql_num_rows($reqd) == 0) {
            $error[] = 'Tài khoản ref không tồn tại';
        }
		$req3 = mysql_query("SELECT * FROM `banrefid` WHERE `refid`='" . $uid['refid'] . "'");
        if (mysql_num_rows($req3) != 0) {
            $error[] = 'RefID bị cấm sử dụng';
        }
		$reqx = mysql_query("SELECT * FROM `users` WHERE `id`='" . $uid['refid'] . "' AND `status` = 'actived'");
        if (mysql_num_rows($reqx) == 0) {
            $error[] = 'RefID đang bị khóa không thể sử dụng';
        }
		}
		if(empty($error)) {




			if($refid['id'] && $uid['xacthuc'] ==1 && $uid['bonus_referrals']==0) {
			// chuyển point cho admin admin_nhan_coin
		
			mysql_query("UPDATE users SET coin = coin + '".$set['f1coinreg']."', actfor = actfor + 1, totalearncoin = totalearncoin + '".$set['f1coinreg']."' WHERE id = '".$refid['id']."'");
			// chuyển point cho refid, cộng điểm f1 actived
			// chuyển qua xác nhận mới nhận đc tiền mysql_query("UPDATE users SET coin = coin + '".$set['f1coinreg']."', f1_act = f1_act + 1, totalearncoin = totalearncoin + '".$set['f1coinreg']."' WHERE id = '".$uid['refid']."'");
			// kích hoạt tài khoản
			
			mysql_query("UPDATE users SET status = 'actived',
			typeact = 'premium',
			timeactive = '".time()."',
			dateact = '".date('d/m/Y',time()+$set['timeshift']*3600)."',
			coin_add_ad = '".$set['thucoinreg']."',
			coin_add_ref = '".$set['f1coinreg']."',
			`bonus_referrals`=1	
			WHERE id = '".$id."'");
			/// check +f1onday
			$resf1=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$id."'"));
			if($resf1['regdate']==$resf1['dateact']) {
				mysql_query("UPDATE users SET f1onday = f1onday + 1 WHERE id = '".$resf1['refid']."'");
			}
			// ghi log cho ref
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'f1 premium actived',
			idtacdong = '".$uid['id']."',
			coin_add = '".$set['f1coinreg']."',
			log = 'f1_act + 1',
			box = '".$uid['refid']."'");
			// ghi log cho user
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'premium actived',
			idtacdong = '".$user_id."'
			box = '".$uid['id']."'");
			
		
			
			$textnote='Congratulations. You have received a reward of <span style="color:green">'.number_format($set['f1coinreg']).''.$set['donvi'].'</span> that belongs to you. When successfully introducing "'.$req2['name'].'" friends';
			
			mysql_query("INSERT INTO news SET
				time = '".time()."',
				color = '#A901DB',
				`type` = 'note',
				`text` = '".mysql_real_escape_string($textnote)."',
				`show` = 'on',
				`read` = '0',
				`user` = '".$uid['refid']."'");
				
				
				$textnote='User ID: '.$uid['id'].' Has been successfully authenticated on the system';
			mysql_query("INSERT INTO news SET
				time = '".time()."',
				color = '#A901DB',
				`type` = 'note',
				`text` = '".mysql_real_escape_string($textnote)."',
				`show` = 'on',
				`read` = '0',
				`user` = '".$uid['id']."'");	
				
					
			
			
			
			
			
			
			} else {
				// kích hoạt tài khoản
			mysql_query("UPDATE users SET status = 'actived',
			typeact = 'premium',
			timeactive = '".time()."',
			dateact = '".date('d/m/Y',time()+$set['timeshift']*3600)."',
			coin_add_ad = '".$set['coinact']."',
			coin_add_ref = '0'
			WHERE id = '".$id."'");
			// chuyển point cho admin admin_nhan_coin
			mysql_query("UPDATE users SET coin = coin + '".$set['coinact']."', actfor = actfor + 1 WHERE id = '".$set['admin_nhan_coin']."'");
			// ghi log
			
			
			// ghi log cho user
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'premium actived',
			idtacdong = '".$user_id."'
			box = '".$uid['id']."'");
			}
			// báo mail cho user được act
			$mail = $uid['mail'];
			$subject = "Earnmoney kích hoạt tài khoản thành công";
			$message = "Tài khoản của bạn đã được kích hoạt Premium thành công trên Earnmoney, ID: ".$uid['id'].", tài khoản: ".$uid['name_lat'].". Bây giờ bạn có thể truy cập.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			if($refid['id']) {
			// báo mail cho refid
			$mail = $refid['mail'];
			$subject = "Earnmoney tài khoản nhánh kích hoạt thành công";
			$message = "Tài khoản nhánh ID: ".$uid['id']." đã kích hoạt thành công trên Earnmoney. Chúc mừng bạn!";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			}
			
			?>
			<div><span class="text-muted">Kích hoạt Premium tài khoản thành công. Quay lại <a href="/admin/user.php">Danh sách tài khoản chờ</a></span></div>
			
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
case 'free':
$uid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
$refid=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$uid['refid']."'"));
?>
<h2>Kích hoạt Free ID: <?php echo $uid['id'];?></h2>
<h5>Thông tin tài khoản mặc định</h5>
<div>Tên tài khoản: <strong><?php echo $uid['name'];?></strong> - Tình trạng tài khoản: <strong style="color:orange"><?php echo $uid['status']; ?></strong> - ID: <strong style="color:black"><?php echo $uid['id']; ?></strong></div>
<div>Ngày đăng ký: <strong><?php echo date("H:i:s - d/m/Y",$uid['datereg']+$set['timeshift']*3600);?></strong></div>
<div>Họ và tên: <strong><?php echo $uid['imname'];?></strong></div>
<div>Số điện thoại: <strong><?php echo $uid['mibile'];?></strong></div>
<div>Địa chỉ email: <strong><?php echo $uid['mail'];?></strong></div>
<div>ID tài khoản giới thiệu: <strong><?php echo $uid['refid']; ?></strong></div>
<h5>Xác nhận kích hoạt</h5>

<?php if($refid['id']) {?>
<li><strong>ID <?php echo $set['admin_nhan_coin'];?>: +0<?php echo $set['donvi']; ?></strong></li>
<li><strong>ID <?php echo $uid['refid'];?>: +0<?php echo $set['donvi']; ?></strong></li>
<? } else { ?>
<li><strong>ID <?php echo $set['admin_nhan_coin'];?>: +0<?php echo $set['donvi']; ?></strong></li>
<? } ?>
<li><strong>ID <?php echo $uid['id'];?> - Tình trạng tài khoản: <strong style="color:orange">pending > actived</strong></strong></li>
<br>
<?php
if(isset($_POST['submit'])) {
		// check tồn tại tk kích hoạt
		$req2 = mysql_query("SELECT * FROM `users` WHERE `id`='" . $id . "'");
        if (mysql_num_rows($req2) == 0) {
            $error[] = 'Tài khoản kích hoạt không tồn tại';
        }
		
		if($uid['status']!='pending') {
			$error[] = 'Tài khoản đang không trong tình trạng chờ';
		}
		
		
		if($refid['id']) {
		// check tồn tại tk act
		$reqd = mysql_query("SELECT * FROM `users` WHERE `id`='" . $uid['refid'] . "'");
        if (mysql_num_rows($reqd) == 0) {
            $error[] = 'Tài khoản ref không tồn tại';
        }
		$req3 = mysql_query("SELECT * FROM `banrefid` WHERE `refid`='" . $uid['refid'] . "'");
        if (mysql_num_rows($req3) != 0) {
            $error[] = 'RefID bị cấm sử dụng';
        }
		$reqx = mysql_query("SELECT * FROM `users` WHERE `id`='" . $uid['refid'] . "' AND `status` = 'actived'");
        if (mysql_num_rows($reqx) == 0) {
            $error[] = 'RefID đang bị khóa không thể sử dụng';
        }
		}
		if(empty($error)) {
			
			// kích hoạt tài khoản
			mysql_query("UPDATE users SET status = 'actived',
			typeact = 'free',
			timeactive = '".time()."',
			dateact = '".date('d/m/Y',time()+$set['timeshift']*3600)."',
			coin_add_ad = '0',
			coin_add_ref = '0'			
			WHERE id = '".$id."'");

			if($refid['id'] && $uid['xacthuc'] ==1 && $uid['bonus_referrals']==0) {
			// chuyển point cho admin admin_nhan_coin
			mysql_query("UPDATE users SET coin = coin + 0, actfor = actfor + 1, totalearncoin = totalearncoin + 0 WHERE id = '".$set['admin_nhan_coin']."'");
			// chuyển point cho refid, cộng điểm f1 actived
			mysql_query("UPDATE users SET coin = coin + 0, f1_act = f1_act + 1, totalearncoin = totalearncoin + 0 WHERE id = '".$uid['refid']."'");
			mysql_query("UPDATE users SET `bonus_referrals`=1			
			WHERE id = '".$id."'");
			
			/// check +f1onday
			$resf1=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$id."'"));
			if($resf1['regdate']==$resf1['dateact']) {
				mysql_query("UPDATE users SET f1onday = f1onday + 1 WHERE id = '".$resf1['refid']."'");
			}
			// ghi log cho ref
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'f1 free actived',
			idtacdong = '".$uid['id']."',
			log = 'f1_act + 1',
			box = '".$uid['refid']."'");
			// ghi log cho user
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'free actived',
			idtacdong = '".$user_id."'
			box = '".$uid['id']."'");
			
			} else {
			// chuyển point cho admin admin_nhan_coin
			mysql_query("UPDATE users SET coin = coin + 0, actfor = actfor + 1 WHERE id = '".$set['admin_nhan_coin']."'");
			
			// ghi log cho user
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'free actived',
			idtacdong = '".$user_id."'
			box = '".$uid['id']."'");
			}
			// báo mail cho user được actege xt43z@~!zx
			$mail = $uid['mail'];
			$subject = "Earnmoney kích hoạt tài khoản thành công";
			$message = "Tài khoản của bạn đã được kích hoạt Free thành công trên Earnmoney, ID: ".$uid['id'].", tài khoản: ".$uid['name_lat'].". Bây giờ bạn có thể truy cập.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			if($refid['id']) {
			// báo mail cho refid
			$mail = $refid['mail'];
			$subject = "Earnmoney tài khoản nhánh kích hoạt thành công";
			$message = "Tài khoản nhánh ID: ".$uid['id']." đã được kích hoạt Free thành công trên Earnmoney!";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			}
			// báo mail cho admin
			$mail = $set['email'];
			$subject = "Earnmoney admin vừa kích hoạt Premium";
			$message = "Tài khoản ID: ".$uid['id']." đã được admin kích hoạt Free trên Earnmoney.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			?>
			<div><span class="text-muted">Kích hoạt Free tài khoản thành công. Quay lại <a href="/admin/user.php">Danh sách tài khoản chờ</a></span></div>
			
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
case 'ban':
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
<h5>Xác nhận ban nick</h5>
<li><strong>ID <?php echo $uid['id'];?> - Tình trạng tài khoản: <strong style="color:orange">pending > banned</strong></strong></li>
<br>
<?php
if(isset($_POST['submit'])) {
		// check tồn tại tk kích hoạt
		if($uid['status']=='banned') {
			$error[] = 'Tài khoản đã đang trong tình trạng ban rồi';
		}
		if(!$uid['id']) {
			$error[] = 'Tài khoản không tồn tại';
		}
		if($uid['rights']>=9) {
			$error[] = 'Không thể ban tài khoản Super admin';
		}
		if(empty($error)) {
			// kích hoạt tài khoản
			mysql_query("UPDATE users SET status = 'banned', timeban = '".time()."' WHERE id = '".$uid['id']."'");

			
			// ghi log cho user
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'banned nick',
			idtacdong = '".$user_id."'
			box = '".$uid['id']."'");

			// báo mail cho user được act
			$mail = $uid['mail'];
			$subject = "Earnmoney banned tài khoản vi phạm";
			$message = "Tài khoản của bạn đã bị cấm trên Earnmoney!";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			
			// báo mail cho admin
			$mail = $set['email'];
			$subject = "Earnmoney admin vừa ban nick";
			$message = "Tài khoản ID: ".$uid['id']." vừa bị admin banned trên Earnmoney.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			?>
			<div><span class="text-muted">Đã cấm tài khoản truy cập. Quay lại <a href="/admin/user.php">Danh sách tài khoản chờ</a></span></div>
			
			<?php
		} else {
			
			echo functions::display_error($error);
		}
	
} else {?>
<form method="post">
<button type="submit" name="submit" class="cmt-to-login">Ban nick</button>
</form>
<?php
}

break;
}
?>
    </div>
<?php require('../incfiles/end.php');?>
<?php } ?>

