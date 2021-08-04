<?php
define('_IN_JOHNCMS', 1);
$headmod = 'report';
$textl='User';
require('../incfiles/core.php');
$userkhach=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'"));
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
<h4 style="padding:5px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:5px;">TÌM TÀI KHOẢN</h4>
<form method="post" style="margin:0 auto;">
<input name="idnickinput" style="padding:5px;margin:15px;border:1px solid #999; border-radius:15px;" value="" placeholder="Nhập ID"/>
<button name="submitsearchidnick" class="cmt-to-login">Tìm</button>
</form>
<div style="margin:15px;">
<?
switch($act) {
	case 'xacthuc':
	mysql_query("UPDATE `users` SET `xacthuc` = '1' WHERE `id` = '".$id."'");
	header('location: /admin/search.php?id='.$id.'');
	break;
	case 'huyxacthuc':
	mysql_query("UPDATE `users` SET `xacthuc` = '0' WHERE `id` = '".$id."'");
	header('location: /admin/search.php?id='.$id.'');
	break;
	
}
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
		 
		 <div class="alert alert-danger">
		   <table><tr><td>
<?php if(!empty($list['avatar'])) { ?>
    <img width="50" class="avatarcs" height="50" src="/sr/avt/<?php echo $list['avatar'];?>">
	  <?php } else { ?>
	  <img width="50" class="avatarcs" height="50" src="/sr/img/avt.png">
	  <?php } ?>
	  </td>
	  <td><b><a href="uid.php?id=<? echo $list['id'];?>"><?php echo $list['name'];?></a>
	  </b><br>
	  <span style="color:grey;"><?php echo $list['mail'];?></span>
	  <br>
	  <? echo ($list['xacthuc']==1 ? '<b style="background:green;color:white;border-radius:5px;padding:1px 5px 1px 5px;">authenticated</b>' : '<b style="border-radius:5px;padding:1px 5px 1px 5px;background:red;color:white;">Not yet authentic</b>');?>
	 <!--<a href="?act=xacthuc&id=<? echo $list['id'];?>">Xác thực nhanh</a> | <a href="?act=huyxacthuc&id=<? echo $list['id'];?>">Hủy xác thực</a>-->
	 </td></tr>
	  </table>
		 </div>
		 <div style="margin:5px;border-bottom:1px solid #f2f2f2;padding:5px;">
		 <h4 style="color:black">Thông tin tài chính</h4>
		 <table style="width:100%;font-weight:bold;">
<tr style="width:100%;color:green">
<td style="width:50%;">Tiền chính:</td>
<td><?php echo number_format($list['coin']);?><?php echo $set['donvi']; ?></td>
</tr>
<tr style="width:100%;color:#FACC2E">
<td style="width:50%;">Tiền video:</td>
<td><?php echo number_format($list['videocoin']);?><?php echo $set['donvi']; ?></td>
</tr>
<tr style="width:100%;color:#DF7401">
<td style="width:50%;">Điểm danh:</td>
<td><?php echo number_format($list['coin_bonus']);?><?php echo $set['donvi']; ?></td>
</tr>
<tr style="width:100%;color:red">
<td style="width:50%;">Thưởng 10%:</td>
<td><?php echo number_format($list['coin_lock']);?><?php echo $set['donvi']; ?></td>
</tr>
<? if($set['diemdanhngay']=='on') {?>
<tr style="width:100%;color:#F78181">
<td style="width:50%;">Thưởng ngày:</td>
<td><?php echo number_format($list['coinday']);?><?php echo $set['donvi']; ?></td>
</tr>
<? } ?>
</table>
		 
		 </div> <div style="margin:5px;border-bottom:1px solid #f2f2f2;padding:5px;">
		 <h4 style="color:black">Thông tin tài khoản</h4>
		 <div style="padding-left:5px">Tài khoản: <strong><?php echo $list['name'];?></strong> - Tình trạng: <strong style="color:orange"><?php echo $list['status']; ?></strong> - ID: <strong style="color:black"><?php echo $list['id']; ?></strong></div>
<div style="padding-left:5px">Ngày đăng ký: <strong><?php echo date("H:i:s - d/m/Y",$list['datereg']+$set['timeshift']*3600);?></strong></div>
<div style="padding-left:5px">Ngày kích hoạt: <strong><?php echo date("H:i:s - d/m/Y",$list['timeactive']+$set['timeshift']*3600);?></strong></div>
<div style="padding-left:5px">ID kích hoạt: <strong><?php echo $list['refid']; ?></strong></div>
<div style="padding-left:5px">ID Tài khoản kích hoạt: <strong><?php echo $list['actid']; ?></strong></div>
		 <?
		 $alluser=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 and code_register = '' and status = 'actived' and refid = '".$userkhach['id']."'"),0);
$alluserpending=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 and code_register = '' and status = 'pending' and refid = '".$userkhach['id']."'"),0);
$alluseract=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'actived' and code_register = ''"),0);
$alluserban=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'banned' and code_register = ''"),0);
$alluserpd=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'pending' and code_register = ''"),0);
$mod24h=time()-86400;

$acttoday=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".date('d/m/Y',time()+$set['timeshift']*3600)."' and refid = '".$userkhach['id']."'"),0);


$act24h=mysql_result(mysql_query("SELECT COUNT(*) FROM users where timeactive >= $mod24h and refid = '".$userkhach['id']."'"),0);
?>

<div style="padding-left:5px">Tổng số thành viên giới thiệu đã kích hoạt: <?php echo $alluser;?></div>
<div style="padding-left:5px">Tổng số thành viên giới thiệu chưa kích hoạt: <?php echo $alluserpending;?></div>
<div style="padding-left:5px">Tài khoản kích hoạt hôm nay <? echo date('d/m/Y',time()+$set['timeshift']*3600);?>: <?php echo $acttoday;?></div>
<div style="padding-left:5px">Tài khoản kích hoạt trong 24h qua: <?php echo $act24h;?></div>

		 </div>
		 
		 <? if($list['status']=='pending') { ?>
		 <div class="btn-group" role="group" aria-label="Basic example">Thao tác: 
    <a href="/admin/user.php?act=premium&id=<?php echo $list['id'];?>" class="card-link btn btn-primary">Premium</a> | 
    <a href="/admin/user.php?act=free&id=<?php echo $list['id'];?>" class="card-link btn btn-success">Free</a> | 
	<a href="/admin/user.php?act=ban&id=<?php echo $list['id'];?>" class="card-link btn btn-danger">Ban</a>
  </div>
		 
		 <? } ?>
		 <? if($list['status']=='actived') { ?>
		     <div class="btn-group" role="group" aria-label="Basic example">Thao tác: 

	<a href="/admin/uact.php?act=ban&id=<?php echo $list['id'];?>" class="card-link btn btn-danger">Ban</a>
  </div>
		 
		 <? } ?>
		 <? if($list['status']=='banned') { ?>
		 <div class="btn-group" role="group" aria-label="Basic example">Thao tác: 

	<a href="/admin/uban.php?act=unban&id=<?php echo $list['id'];?>" class="card-link btn btn-success">Active</a> | 
	<a href="/admin/uban.php?act=pending&id=<?php echo $list['id'];?>" class="card-link btn btn-warning">Pending</a>
  </div>
		 <? } ?>
		 <? if($list['yeucauxacthuc']==1 && $list['xacthuc']==0) { ?>
<h4 class="memnutab">Account Verification</h4>
<center style="color:red;">
<img src="/sr/img/khien.png" height="50"/> <i>Wait for validation</i>
</center>

<? }else if ($list['yeucauxacthuc']==0 && $list['xacthuc']==1){ ?>
<h4 class="memnutab">Account Verification</h4>
<center style="color:green;">
<img src="/sr/img/ok.png" height="50"/> <i>Verified successfully</i>
</center>

<? } ?>
<div style="margin:5px;border-bottom:1px solid #f2f2f2;padding:5px;">
		 <h4 style="color:black">Thông tin ngân hàng</h4>
		<div style="padding-left:10px">Bank name: <strong><?php echo $list['bank']; ?></strong></div>
<div style="padding-left:10px">Account number: <strong><?php echo $list['stk']; ?></strong></div>
<div style="padding-left:10px">Full name of account holder: <strong><?php echo $list['namebank']; ?></strong></div>
		 
		 </div>
		 
		 <div style="margin:5px;border-bottom:1px solid #f2f2f2;padding:5px;">
		 <h4 style="color:black">Thông tin paypal</h4>
		<div style="padding-left:10px">Paypal mail: <strong><?php echo $list['paypal']; ?></strong></div>
		 </div>
		  <div style="margin:5px;border-bottom:1px solid #f2f2f2;padding:5px;">
		 <h4 style="color:black">Thông tin cá nhân</h4>
		<div style="padding-left:10px">Họ và tên đầy đủ: <strong><?php echo $list['imname']; ?></strong></div>
		<div style="padding-left:10px">Ngày tháng năm sinh: <strong><?php echo $list['ngaysinh']; ?>/<?php echo $list['thangsinh']; ?>/<?php echo $list['yearofbirth']; ?></strong></div>
		<div style="padding-left:10px">Mail: <strong><?php echo $list['mail']; ?></strong></div>
		<div style="padding-left:10px">Số điện thoại: <strong><?php echo $list['mibile']; ?></strong></div>
		<div style="padding-left:10px">Địa chỉ: <strong><?php echo $list['live']; ?>, <?php echo $list['duong']; ?>, <?php echo $list['city']; ?></strong></div>
		 
		 </div>
		 <div style="margin:5px;border-bottom:1px solid #f2f2f2;padding:5px;">
		 <h4 style="color:black">Thông tin CMND</h4>
		<div style="padding-left:10px">Số: <strong><?php echo $list['cmnd']; ?></strong></div>
		<div style="padding-left:10px">Ngày cấp: <strong><?php echo $list['ngaycapcmnd']; ?></strong></div>
		<div style="padding-left:10px">Nơi cấp: <strong><?php echo $list['noicapcmnd']; ?></strong></div>
		 <div style="padding-left:10px">
		 <? if(!empty($list['cmnd1'])) { ?>
		 <img id="myImg" src="/sr/cmnd/<? echo $list['cmnd1'];?>" height="50"/>
		 <? } ?>
		 <? if(!empty($list['cmnd2'])) { ?>
		 <img id="myImg2" src="/sr/cmnd/<? echo $list['cmnd2'];?>" height="50"/>
		 <? } ?>
		 
		 </div>
		 <div id="myModal" class="modal">

  <!-- The Close Button -->
  <span style="margin-top:100px;" class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
	<div id="myModal2" class="modal2">

  <!-- The Close Button -->
  <span style="margin-top:100px;" class="close2">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content2" id="img02">

  <!-- Modal Caption (Image Text) -->
  <div id="caption2"></div>
</div>
		 </div>
		  <div style="margin:5px;border-bottom:1px solid #f2f2f2;padding:5px;">
		 <h4 style="color:black">Thông tin hoạt động</h4>
		 <div style="padding-left:10px"><a href="/history.php?id=<? echo $list['id'];?>">Lịch sử hoạt động</a></strong></div>
		<div style="padding-left:10px"><a href="/admin/f1.php?id=<? echo $list['id'];?>">Đã giới thiệu F1: <strong><?php echo $list['f1']; ?></a></strong></div>
		 <!--<div style="padding-left:10px"><a href="/f1act.php?id=<? echo $list['id'];?>">Số F1 được kích hoạt: <strong><?php echo $list['f1_act']; ?></a></strong></div>-->
		 <div style="padding-left:10px"><a href="/admin/totaldiemdanh.php?id=<? echo $list['id'];?>">Tổng số lần điểm danh: <strong><?php echo $list['totaldd']; ?></a></strong></div>
		 <div style="padding-left:10px"><a href="/admin/bonusngay.php?id=<? echo $list['id'];?>">Tổng số lần điểm danh thưởng ngày: <strong><?php echo $list['totaldiemdanh']; ?></a></strong></div>
		 <div style="padding-left:10px">Số lượt quay: <strong><?php echo $list['luotquay']; ?></strong></div>
		 <div style="padding-left:10px">Trạng thái điểm danh: <strong><?php echo $list['turndd']; ?></strong></div>
		 <div style="padding-left:10px">Điểm danh thưởng khi có ref trong ngày: <strong>
		 
		 <?php if(empty($list['coin_diemdanhday_1ref'])) { ?>
		 <? echo $set['coin_diemdanhday_1ref']; ?> - Hệ thống
		 <? } else { ?>
		  <? echo $list['coin_diemdanhday_1ref']; ?> - Tùy chỉnh cá nhân
		 <? } ?>
		 
		 </strong>
		 </div>
		 <div style="padding-left:10px">Điểm danh thưởng khi không có ref trong ngày: <strong>
		  <?php if(empty($list['coin_diemdanhday_0ref'])) { ?>
		 <? echo $set['coin_diemdanhday_0ref']; ?> - Hệ thống
		 <? } else { ?>
		  <? echo $list['coin_diemdanhday_0ref']; ?> - Tùy chỉnh cá nhân
		 <? } ?>
		 </strong></div>
		  <div style="padding-left:10px">Địa chỉ IP: <strong><?php echo $list['ip']; ?></strong></div>
		  <div style="padding-left:10px">Trình duyệt truy cập: <strong><?php echo $list['browser']; ?></strong></div>
		 </div>
		 <center>
		  <button name="videoadmin" class="cmt-to-login" style="color:white;background:orange;border:0px; width:150px;"><a style="color:white" href="/admin/uid.php?id=<? echo $list['id'];?>">Chỉnh sửa thông tin</a></button></center>
		 
		 
		 <?
		 
	 }
}
?></div><?
require('../botmenu.php');?></div><Script>
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
<Script>
var modal2 = document.getElementById("myModal2");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img2 = document.getElementById("myImg2");
var modalImg2 = document.getElementById("img02");
var captionText2 = document.getElementById("caption2");
img2.onclick = function(){
  modal2.style.display = "block";
  modalImg2.src = this.src;
  captionText2.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal2.style.display = "none";
}
</script>
<style>
#myImg,#myImg2 {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover,#myImg2:hover {opacity: 0.7;}

/* The Modal (background) */
.modal,.modal2 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content,.modal-content2 {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption,#caption2 {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content,.modal-content2, #caption,#caption2{
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close,.close2 {
  position: absolute;
top:-40px;
  right: 50%;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,.close2:hover,
.close:focusm,close2:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content,.modal-content2 {
    width: 100%;
  }
}
</style>
<?
require('../incfiles/end.php');
}
?>
