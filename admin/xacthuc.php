<?php
define('_IN_JOHNCMS', 1);
date_default_timezone_set('asia/ho_chi_minh');
$headmod = 'gift';
$textl='Gift';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) && $rights<9) {
header('location: /index.php');
} else { ?>
<?
require('../header.php');

	?>
	<div class="main" style="background:white;width:640px;max-width:100%;margin:auto">
	<?php require('../uinfo.php');?>

<?php require('../topmenu.php');

$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `yeucauxacthuc` = '1'"),0);

?>
	<div style="color:#000;font-weight:bold;font-size:20px;text-align:center;background:#8000FF;height:28px;">XÁC THỰC TÀI KHOẢN</div>
	<table style="border:1px solid #8000FF;width:100%;"><tr>
	<td style="border:1px solid #8000FF;width:50%;"><img src="/sr/img/Picture2.png"/> Danh sách yêu cầu xác thực(<? echo $total; ?>)</td>
	</tr></table>
	
<?php
if(isset($_POST['submithuy'])) {
	$gift = isset($_POST['check']) ? intval($_POST['check']) : 0;
	
	$cehg=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$gift."'"));
	if ($cehg['id']<=0 || empty($cehg['id'])) {
            $error[] = 'Error user not auth';
	}
	
	if (empty($error)) {
		if($cehg['tuchoixacthuc']>=2) {
		mysql_query("UPDATE users SET `status` = 'banned' WHERE `id` = '".$cehg['id']."'");	
		}
	mysql_query("UPDATE `users` SET
		`yeucauxacthuc` = '0',
		`xacthuc` = '0',
		`tuchoixacthuc` = `tuchoixacthuc` + 1
		WHERE `id` = '".$cehg['id']."'");	
		
		$textnote='User ID: '.$cehg['id'].' You have been denied verification due to unsatisfactory admin request';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = 'red',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$cehg['id']."'");	
	}
}
if(isset($_POST['submit'])) {
	$gift = isset($_POST['check']) ? intval($_POST['check']) : 0;
	
	$cehg=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$gift."'"));
	if ($cehg['id']<=0 || empty($cehg['id'])) {
            $error[] = 'Error user not auth';
	}/*
	if ($cehg['status']!== 'actived') {
            $error[] = 'Nick chưa kích hoạt';
	}*/
	$checkcmnd=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `cmnd` = '".$cehg['cmnd']."' AND `id` != '".$cehg['id']."' AND `xacthuc` = '1'"),0);
	if($checkcmnd>2) {
		$error[] = 'Số CMND vượt quá 3 tài khoản';
	}
	$checkpaypal=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `paypal` = '".$cehg['paypal']."' AND `id` != '".$cehg['id']."' AND `xacthuc` = '1'"),0);
	if($checkpaypal>0) {
		$error[] = 'Paypal đã dùng cho tài khoản khác';
	}
	$checkbank=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `stk` = '".$cehg['stk']."' AND `id` != '".$cehg['id']."' AND `xacthuc` = '1'"),0);
	if($checkbank>0) {
		$error[] = 'Số tài khoản đã dùng cho tài khoản khác';
	}
	if (empty($error)) {
		
		mysql_query("UPDATE `users` SET
		`yeucauxacthuc` = '0',
		`xacthuc` = '1',
		`timexacthuc` = '".time()."'		
		WHERE `id` = '".$cehg['id']."'");
		// mysql_query("UPDATE `log` SET `status` = 'done' WHERE `boxid` = '".$cehg['id']."'");
		$reportlog='user: '.$cehg['id'].' được xác thực nick';
	mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'authentication',
			idtacdong = '".$cehg['id']."',
			coin_bonus_add = '".$cehg['id']."',
			log = '".$reportlog."',
			box = '".$cehg['id']."'");				
	

		
	if ($cehg['status']== 'actived' && $cehg['bonus_referrals']==0) {		
	// chuyển point cho refid, cộng điểm f1 actived
	$refinfo=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$cehg['refid']."'"));
	$checkcmnd=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `cmnd` = '".$cehg['cmnd']."' AND `id` != '".$cehg['id']."' AND `xacthuc` = '1'"),0);
	
	if($checkcmnd>0) {
	$textnote='Congratulations. You have received a reward of <span style="color:red">0'.$set['donvi'].'</span> that belongs to you. When successfully introducing "'.$cehg['name'].'" friends';
	mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = 'red',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$cehg['refid']."'");
	} else {
		mysql_query("UPDATE users SET coin = coin + '".$set['f1coinreg']."',luotxemvideongay = luotxemvideongay + 2, totalearncoin = totalearncoin + '".$set['f1coinreg']."' WHERE id = '".$cehg['refid']."'");	
		mysql_query("UPDATE `users` SET
		`bonus_referrals`=1	
		WHERE `id` = '".$cehg['id']."'");
		$textnote='Congratulations. You have received a reward of <span style="color:green">'.number_format($set['f1coinreg']).''.$set['donvi'].'</span> that belongs to you. When successfully introducing "'.$cehg['name'].'" friends';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$cehg['refid']."'");
			}
			
			$textnote='User ID: '.$cehg['id'].' Has been successfully authenticated on the system';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$cehg['id']."'");	
			
				}
			
	
	
		?>
		<div class="alert alert-success" style="color:green;text-align:center;" role="alert">
		Duyệt nội dung thành công!
		</div>
		
		<?php
		
		
		
	} else { ?>
	
	<div class="alert alert-danger" style="color:red;text-align:center;" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}


?>
	<form method="post">
<?
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `yeucauxacthuc` = '1'"),0);
$gif=mysql_query("SELECT * FROM `users` WHERE `yeucauxacthuc` = '1' ORDER BY `id` ASC LIMIT $start, $kmess");
$i=1;
$a=9000;
while($gift=mysql_fetch_assoc($gif)) {
	?>
	<div style="margin:5px;padding:5px;border:dotted 1px #333;">
	<input type="radio" value="<? echo $gift['id'];?>" name="check"/>
	Tên tài khoản: <b><? echo $gift['name'];?> </b>- 
	ID: <b><?php echo $gift['id'];?></b>
	<br>Thời gian yêu cầu xác thực: <? echo date("H:i:s - d/m/Y",$gift['timeyeucauxacthuc']+7*3600);?>
	<br>
	Số CMND: <b><? echo $gift['cmnd'];?></b> Ngày cấp:  <b><? echo $gift['ngaycapcmnd'];?></b> Nơi cấp:  <b><? echo $gift['noicapcmnd'];?></b>
	<br>
	Ảnh mặt trước: <img id="myImg<? echo $i;?>" src="/sr/cmnd/<? echo $gift['cmnd1'];?>" height="50"/>
	<br>
	Ảnh mặt sau: <img id="myImg<? echo $a;?>" src="/sr/cmnd/<? echo $gift['cmnd2'];?>" height="50"/>
	</div><div id="myModal<? echo $i;?>" class="modal<? echo $i;?>">

  <!-- The Close Button -->
  <span style="margin-top:100px;" class="close<? echo $i;?>">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content<? echo $i;?>" id="img0<? echo $i;?>">

  <!-- Modal Caption (Image Text) -->
  <div id="caption<? echo $i;?>"></div>
</div>
	<div id="myModal<? echo $a;?>" class="modal<? echo $a;?>">

  <!-- The Close Button -->
  <span style="margin-top:100px;" class="close<? echo $a;?>">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content<? echo $a;?>" id="img0<? echo $a;?>">

  <!-- Modal Caption (Image Text) -->
  <div id="caption<? echo $a;?>"></div>
</div>
<style>
#myImg<? echo $i;?>,#myImg<? echo $a;?> {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg<? echo $i;?>:hover,#myImg<? echo $a;?>:hover {opacity: 0.7;}

/* The Modal (background) */
.modal<? echo $i;?>,.modal<? echo $a;?> {
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
.modal-content<? echo $i;?>,.modal-content<? echo $a;?> {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption<? echo $i;?>,#caption<? echo $a;?> {
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
.modal-content<? echo $i;?>,.modal-content<? echo $a;?>, #caption<? echo $i;?>,#caption<? echo $a;?>{
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close<? echo $i;?>,.close<? echo $a;?> {
  position: absolute;
top:-40px;
  right: 50%;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close<? echo $i;?>:hover,.close<? echo $a;?>:hover,
.close<? echo $i;?>:focusm,close<? echo $a;?>:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content<? echo $i;?>,.modal-content<? echo $a;?> {
    width: 100%;
  }
}
</style>
<Script>
var modal<? echo $i;?> = document.getElementById("myModal<? echo $i;?>");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img<? echo $i;?> = document.getElementById("myImg<? echo $i;?>");
var modalImg<? echo $i;?> = document.getElementById("img0<? echo $i;?>");
var captionText<? echo $i;?> = document.getElementById("caption<? echo $i;?>");
img<? echo $i;?>.onclick = function(){
  modal<? echo $i;?>.style.display = "block";
  modalImg<? echo $i;?>.src = this.src;
  captionText<? echo $i;?>.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span<? echo $i;?> = document.getElementsByClassName("close<? echo $i;?>")[0];

// When the user clicks on <span> (x), close the modal
span<? echo $i;?>.onclick = function() {
  modal<? echo $i;?>.style.display = "none";
}
</script>
<Script>
var modal<? echo $a;?> = document.getElementById("myModal<? echo $a;?>");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img<? echo $a;?> = document.getElementById("myImg<? echo $a;?>");
var modalImg<? echo $a;?> = document.getElementById("img0<? echo $a;?>");
var captionText<? echo $a;?> = document.getElementById("caption<? echo $a;?>");
img<? echo $a;?>.onclick = function(){
  modal<? echo $a;?>.style.display = "block";
  modalImg<? echo $a;?>.src = this.src;
  captionText<? echo $a;?>.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span<? echo $a;?> = document.getElementsByClassName("close<? echo $a;?>")[0];

// When the user clicks on <span> (x), close the modal
span<? echo $a;?>.onclick = function() {
  modal<? echo $a;?>.style.display = "none";
}
</script>
	<?
	++$i;
	++$a;
	
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
<input style="margin:7px;background:#04B431;border-radius:10px;" type="submit" name="submit" class="cmt-to-login" value="Duyệt xác nhận CMND"/>
<input style="margin:7px;background:#ff00ff;border-radius:10px;" type="submit" name="submithuy" class="cmt-to-login" value="Từ chối"/>

</form>
	</div>

<div style="max-width:640px;margin:0 auto">
<?
require('../botmenu.php');?></div>


<?php require('../incfiles/end.php');?>
<?php } ?>
