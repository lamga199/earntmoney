<?php
define('_IN_JOHNCMS', 1);
$headmod = 'report';
$textl='Search';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights<=9) {
header('location: /index.php');
} else { ?>
<?
require('../header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto;background:#fff">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php require('../topmenu.php');?>
<h4 style="padding:10px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:10px;">TÌM KIẾM TÀI KHOẢN</h4>

 <?
if(isset($_POST['submitsearchidnick']) || $id) {
	 $idnick=isset($_POST['idnickinput']) ? abs(intval($_POST['idnickinput'])) : $id;
	 $check=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE id = $idnick"),0);
	 if($check==0) {
		 ?>
		 <div class="alert alert-danger">
		 ID <? echo $idnick;?> không tồn tại trên hệ thống!
		 </div>
		 <?
	 } else {
	$list=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = $idnick AND code_register = ''"));
	 ?>
	 <div class="card shadow-sm p-3 mb-5 bg-white rounded">
  <div class="card-body">
  <div>
    <div class="border-0 float-left text-center" style="padding-right:10px;">
	<img src="/sr/img/avt.png" height="50"/><br>
	<?php echo $list['name'];?><br>
	<span <? echo ($list['status']=='pending' ? ' style="color:red"' : '');?><? echo ($list['status']=='actived' ? ' style="color:green"' : '');?><? echo ($list['status']=='banned' ? ' style="color:orange"' : '');?>><?php echo $list['status'];?></span>
	
	</div>
	<div class="border-0 float-left " style="padding-right:10px;">
	<strong class="text-black"><a href="/admin/uid.php?id=<?php echo $list['id'];?>">ID: <?php echo $list['id'];?></a></strong><br>
	<span class=" border-tien diemchinh"><img src="/sr/img/mmo.jpg"/><?php echo number_format($list['coin']);?></span><br>
<span class=" border-tien diemdanh"><img src="/sr/img/bonus.png"/><?php echo number_format($list['coin_bonus']);?></span><br>
<span class=" border-tien diemlock"><img src="/sr/img/coin.png"/><?php echo number_format($list['coin_lock']);?></span><br>
<span class=" border-tien diemday"><img src="/sr/img/coin.png"/><?php echo number_format($list['coinday']);?></span><br>
	</div>
	<div class="border-0 " style="padding-bottom:10px;">
	<div>Số điện thoại: <strong><?php echo $list['mibile']; ?></strong></div>
<div>Địa chỉ: <strong><?php echo $list['live']; ?></strong></div>
<div>Email: <strong><?php echo $list['mail']; ?></strong></div>
<div><a href="/admin/uid.php?id=<?php echo $list['id'];?>" class="">Chỉnh sửa thông tin</a></div>

	</div>
	<div>
	<? if($list['status']=='pending') {?>
	
	<div class="btn-group" role="group" aria-label="Basic example" style="max-height:30px;font-size:11px;">
    <a href="/admin/user.php?act=premium&id=<?php echo $list['id'];?>" style="max-height:30px;font-size:11px;display: flex;justify-content: center;margin:auto;" class="card-link btn btn-primary">Premium</a>
    <a href="/admin/user.php?act=free&id=<?php echo $list['id'];?>" style="max-height:30px;font-size:11px;display: flex;justify-content: center;margin:auto;" class="card-link btn btn-success">Free</a>
	<a href="/admin/user.php?act=ban&id=<?php echo $list['id'];?>" style="max-height:30px;font-size:11px;display: flex;justify-content: center;margin:auto;" class="card-link btn btn-danger">Ban</a>
  </div>
	<? } ?>
	<? if($list['status']=='banned') {?>
	
	<div class="btn-group" role="group" aria-label="Basic example" style="max-height:30px;font-size:11px;">
    <a href="/admin/uban.php?act=unban&id=<?php echo $list['id'];?>" style="max-height:30px;font-size:11px;display: flex;justify-content: center;margin:auto;"  class="card-link btn btn-success">Active</a>
	<a href="/admin/uban.php?act=pending&id=<?php echo $list['id'];?>"  style="max-height:30px;font-size:11px;display: flex;justify-content: center;margin:auto;"  class="card-link btn btn-warning">Pending</a>
  </div>
	<? } ?>
	<? if($list['status']=='actived') {?>
	<div class="btn-group" role="group" aria-label="Basic example" style="max-height:30px;font-size:11px;">
	<a href="/admin/user.php?act=ban&id=<?php echo $list['id'];?>" style="max-height:30px;font-size:11px;display: flex;justify-content: center;margin:auto;" class="card-link btn btn-danger">Ban</a>
  </div>
	<? } ?>
	</div>
	</div>
	

  </div>
</div>
 <div><h5>Lịch sử hoạt động của tài khoản này</h5></div>
  <h5>Thống kê ID: <? echo $list['id'];?>
  </h5>
  <div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;" class="text-center">
        <td style="">Tổng thời gian</td>
        <td>Tổng CTV</td>
        <td>Chưa kích hoạt</td>
		<td>Đã kích hoạt</td>
		<td>CTV bị khóa</td>
		<td>Tổng tiền nhận được</td>
		<td>Trạng thái</td>
		<td>Tổng tiền điểm danh</td>
		<td>Ngày tham gia</td>
		
      </tr>


		 <tr style="background-color:#F2f2f2">
		
        <td>Từ trước đến nay</td>
		<td><?php echo $total=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE refid = '".$list['id']."' and status != 'notauth'"),0);?></td>
		<td><?php echo $total=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE refid = '".$list['id']."' and status = 'pending'"),0); ?></td>
		<td><?php echo $total=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE refid = '".$list['id']."' and status = 'actived'"),0); ?></td>
		<td><?php echo $total=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE refid = '".$list['id']."' and status = 'banned'"),0); ?></td>
		<td><?php echo number_format($list['totalearncoin']+$list['totalearndd']+$list['totalcoinday']); ?></td>
		<td><?php echo $list['status']; ?></td>
		<td><?php echo number_format($list['totalearndd']); ?></td>
		<td><?php echo $list['regdate']; ?></td>
      </tr>

  </table></div> <br>
<br>
  <h5>Chi tiết ID: <? echo $list['id'];?>
  </h5>
 <div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;" class="text-center">
        <td>ID</td>
        <td>REFID</td>
        <td>HỌ TÊN</td>
		<td>NGÀY THAM GIA</td>
		<td>EMAIL</td>
		<td>SỐ ĐIỆN THOẠI</td>
		<td>NGƯỜI GIỚI THIỆU</td>
		<td>TRẠNG THÁI</td>
		<td>NGÀY KÍCH HOẠT</td>
		<td>+ TIỀN</td>

      </tr>

 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `refid` = '".$list['id']."'"), 0);
	 $req=mysql_query("SELECT * FROM `users` WHERE `refid` = '".$list['id']."' ORDER BY `datereg` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		 <tr style="background-color:#F2f2f2">
		
        <td><? echo $list['id'];?></td>
		<td><? echo $res['id'];?></td>
		<td><? echo $res['imname'];?></td>
		<td><? echo ($res['datereg']>0 ? date("H:i:s - d/m/Y",$res['datereg']+$set['timeshift']*3600) : '');?></td>
		<td><? echo $res['mail'];?></td>
		<td><? echo $res['mibile'];?></td>
		<td><? echo $res['refid'];?></td>
		
		<td <? echo ($res['status']=='pending' ? ' style="color:orange">Chờ kích hoạt' : '');?>
		<? echo ($res['status']=='actived' ? ' style="color:green">Đã kích hoạt' : '');?>
		<? echo ($res['status']=='banned' ? ' style="color:black">Bị Ban' : '');?>
		<? echo ($res['status']=='notauth' ? ' style="color:red">Chưa xác thực' : '');?>
		</td>
		<td><? echo ($res['timeactive']>0 ? date("H:i:s - d/m/Y",$res['timeactive']+$set['timeshift']*3600) : '');?></td>
		<td><? echo number_format($res['coin_add_ref']);?></td>
      </tr>

	 <? } ?>
	 
	 
	 
  </table></div>  
  
     <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnick.'&', $start, $total, $kmess);?></div>
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
 <h5><? echo $list['totaldd'];?> điểm danh tích lũy</h5>
   
   
   <div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;" class="text-center">
        <td >Log ID</td>
		<td >ID CTV</td>
		<td>Thời gian điểm danh</td>
		<td>Điểm danh</td>
		
      </tr>
    <tbody>
      
      
   
  
  
     <?php
	 
	 $req=mysql_query("SELECT * FROM `log` WHERE act = 'add coin_bonus diem danh' and box = '".$list['id']."' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		 <tr style="background-color:#F2f2f2;">

        <td><?php echo $res['id'];?></td>
        <td><?php echo $res['box'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>+<?php echo number_format($res['coin_bonus_add']);?></td>
		
      </tr>
		
		 
		 <?php
	 $i++; }
	 
	 ?>  </tbody>
  </table></div>
  
  
  
  
    <?php
  if ($list['totaldd'] > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnick.'&', $start, $list['totaldd'], $kmess);?></div>
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
  <h5>Chi tiết ID: <? echo $list['id'];?>
  </h5>
 <div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;" class="text-center">
        <td>ID</td>
        <td>REFID</td>
        <td>HỌ TÊN</td>
		<td>NGÀY THAM GIA</td>
		<td>EMAIL</td>
		<td>SỐ ĐIỆN THOẠI</td>
		<td>NGƯỜI GIỚI THIỆU</td>
		<td>TRẠNG THÁI</td>
		<td>NGÀY KÍCH HOẠT</td>
		<td>+ TIỀN</td>

      </tr>

 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `refid` = '".$list['id']."'"), 0);
	 $req=mysql_query("SELECT * FROM `users` WHERE `refid` = '".$list['id']."' ORDER BY `datereg` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		 <tr style="background-color:#F2f2f2">
		
        <td><? echo $list['id'];?></td>
		<td><? echo $res['id'];?></td>
		<td><? echo $res['imname'];?></td>
		<td><? echo ($res['datereg']>0 ? date("H:i:s - d/m/Y",$res['datereg']+$set['timeshift']*3600) : '');?></td>
		<td><? echo $res['mail'];?></td>
		<td><? echo $res['mibile'];?></td>
		<td><? echo $res['refid'];?></td>
		
		<td <? echo ($res['status']=='pending' ? ' style="color:orange">Chờ kích hoạt' : '');?>
		<? echo ($res['status']=='actived' ? ' style="color:green">Đã kích hoạt' : '');?>
		<? echo ($res['status']=='banned' ? ' style="color:black">Bị Ban' : '');?>
		<? echo ($res['status']=='notauth' ? ' style="color:red">Chưa xác thực' : '');?>
		</td>
		<td><? echo ($res['timeactive']>0 ? date("H:i:s - d/m/Y",$res['timeactive']+$set['timeshift']*3600) : '');?></td>
		<td><? echo number_format($res['coin_add_ref']);?></td>
      </tr>

	 <? } ?>
	 
	 
	 
  </table></div>  
  
     <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnick.'&', $start, $total, $kmess);?></div>
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





 <h5><? echo $list['totaldiemdanh'];?> nhận thưởng hàng ngày</h5>
   <div class="table-responsive"><table style="width:100%">
      <tr style="background-color:rgb(230,230,230);font-weight:bold;">
        <td >Log ID</td>
		<td >ID CTV</td>
		<td>Thời gian điểm danh</td>
		<td>Điểm danh</td>
      </tr>
    <tbody>
     <?php
	 
	 $req=mysql_query("SELECT * FROM `log` WHERE act = 'add coinday diem danh' and box = '".$list['id']."' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		 <tr style="background-color:#F2f2f2;">

        <td><?php echo $res['id'];?></td>
        <td><?php echo $res['box'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>+<?php echo number_format($res['coin_bonus_add']);?></td>
		
      </tr>
		 <?php
	 $i++; }
	 
	 ?>  </tbody>
  </table></div>
    <?php
  if ($list['totaldiemdanh'] > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $list['totaldiemdanh'], $kmess);?></div>
	   </div>
	<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Số trang</label>
    <input type="text" style="width:100px" class="form-control" name="page" id="page" placeholder="Số trang">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Đến trang</button>
</form>
</div>
<? } ?>




















<br><br>
 <h5>Lịch sử rút tiền</h5>

<div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;" class="text-center">
        <td>ID log</td>
        <td>Thời gian yêu cầu</td>
        <td>Số tiền</td>
		<td>Tình trạng</td>
		<td>Thời gian xử lý</td>
      </tr>

    
	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `yeucaurut` WHERE user = '".$list['id']."'"), 0);
	 $req=mysql_query("SELECT * FROM `yeucaurut` WHERE `user` = ".$list['id']." ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
		<td><?php echo ($res['time']>0 ? date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600) : '');?></td>
		<td><?php echo number_format($res['coin']);?> <? echo $set['donvi'];?></td>
		<td><?php 
		if($res['status']=='done') {
		
		echo '<span style="color:green">Thành công</span>';
		
		}
		else if($res['status']=='pending') {
		
		echo '<span style="color:orange">Chờ kích hoạt</span>';
		
		}
		else if($res['status']=='fail') {
		
		echo '<span style="color:red">Từ chối; '.$res['comment'].'</span>';
		}
		?></td>
		<td><?php echo ($res['timedone']>0 ? date("H:i:s - d/m/Y",$res['timedone']+$set['timeshift']*3600) : '');?></td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?>
  </table></div> 
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnick.'&', $start, $total, $kmess);?></div>
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

<h5>Lịch sử rút tiền điểm danh</h5>

<div class="table-responsive"><table style="width:100%">
    <tr style="background-color:rgb(230,230,230);font-weight:bold;" class="text-center">
        <td>ID log</td>
        <td>Time</td>
        <td>Tiền điểm danh</td>
		<td>Tiền chính</td>
		<td>Tình trạng</td>
      </tr>

	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE idtacdong = '".$list['id']."' and act = 'rut coin bonus'"), 0);
	 $req=mysql_query("SELECT * FROM `log` WHERE `idtacdong` = ".$list['id']."  and act = 'rut coin bonus' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>-<?php echo number_format($res['coin_bonus_minus']);?></td>
		<td>+<?php echo number_format($res['coin_add']);?></td>
		<td>Hoàn thành</td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?>
  </table></div> 
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnick.'&', $start, $total, $kmess);?></div>
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
 <h5>Danh sách report đã gửi</h5>

<div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;" class="text-center">
        <td>Number</td>
        <td>Report Name</td>
        <td>Time Send</td>
		<td>Last reply</td>
      </tr>


	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `report` WHERE uid_send = '".$list['id']."'"), 0);
	 $req=mysql_query("SELECT * FROM `report` WHERE `uid_send` = ".$list['id']." ORDER BY `time_update` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
        <td><?php echo ($res['nhan_read']==0 ? '(new)':'');?> <a href="/admin/report.php?id=<? echo $res['id'];?>"><?php echo $res['name'];?></a></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time_update']+$set['timeshift']*3600);?></td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?>
  </table></div> 
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnick.'&', $start, $total, $kmess);?></div>
	   </div>
	<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Số trang</label>
    <input type="text" style="width:100px" class="form-control" name="page" id="page" placeholder="Số trang">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Đến trang</button>
</form>
</div>
<? } ?>
 <br><br>
<?php
}}
 $totalwait=mysql_result(mysql_query("SELECT COUNT(*) FROM log WHERE idtacdong = '".$list['id']."'"),0);
 ?>
 <h5>Logs (<? echo $totalwait;?>)</h5>
 	<?

 $list_wait=mysql_query("SELECT * FROM log WHERE idtacdong = '".$list['id']."' ORDER BY time DESC LIMIT $start, $kmess");
 $i=0;
 while($list=mysql_fetch_assoc($list_wait)) {
	 ?>
	 <?
	 if($i%2) {?>
	 <div class="alert alert-primary" role="alert">
 <? }else { ?>
 <div class="alert alert-success" role="alert">
 <? } ?>
  <i class="fa fa-clock-o"></i> <?php echo date("H:m:s; d/m/Y",$list['time']+$set['timeshift']*3600);?>
  <strong>aciton:</strong> <?php echo $list['act'];?>; 
  <strong>log:</strong> <?php echo $list['log'];?>; 
  
  <strong>uid:</strong> <?php echo $list['idtacdong'];?>; 
  <strong>coin_add:</strong> <?php echo $list['coin_add'];?>; 
  <strong>coin_minus:</strong> <?php echo $list['coin_minus'];?>; 
  <strong>coin_bonus_add:</strong> <?php echo $list['coin_bonus_add'];?>; 
  <strong>coin_bonus_minus:</strong> <?php echo $list['coin_bonus_minus'];?>; 
  <strong>coin_lock_add:</strong> <?php echo $list['coin_lock_add'];?>; 
  <strong>coin_lock_minus:</strong> <?php echo $list['coin_lock_minus'];?>; 
</div>

<?php
$i++;
 }
 
 ?>
 	  <?php
  if ($totalwait > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$idnick.'&', $start, $totalwait, $kmess);?></div>
	   </div>
	<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Số trang</label>
    <input type="text" style="width:100px" class="form-control" name="page" id="page" placeholder="Số trang">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Đến trang</button>
</form>
</div>
<? } ?>
  </div>
</div>
  
 </main>
 
</div>	 
	<div style="padding-bottom:50px;" class="float-right"></div>
</body>
<?php require('../footer.php');?>

</html>	
<?php } ?>
