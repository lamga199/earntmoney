<?php
define('_IN_JOHNCMS', 1);

$headmod = 'paypal';
$textl='Paypal';
require('incfiles/core.php');
session_start();
require('incfiles/head.php');

if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#fff;color:#000">
<div style="background:#5882FA;color:#fff;width:120px;padding:5px;margin:auto">Paypal</div>
</div>	<div style="background:#fff;text-align:left;;padding:10px; color:#000;">


<?php 

switch($act) {
	default:
	?>
 <div style="height:85px;width:160px;background:#fff;color:black;text-align:center;margin:0 auto;">
	  <table>
	  <tr>
	  <td style="margin:5px;"><a style="color:#5882FA" href="/paypal.php?act=buy"><img onclick="paypal()" src="/sr/img/image051.png" height="60" />Mua PayPal</a>
	  </td><td style="margin:5px;"><a style="color:#5882FA" href="/paypal.php?act=sale"><img onclick="paypal()" src="/sr/img/image051.png" height="60" />Bán PayPal</a>
	  </td>
	  </tr>
	  </table>
	 
	  </div>
	  <?
	  
	  break;
	  case 'buyok':
	  if(isset($_POST['submit'])) {
		  $cash=isset($_POST['one']) ? abs(intval($_POST['one'])) : 0;
		  $pay = isset($_POST['pay']) ? functions::checkin(mb_substr(trim($_POST['pay']), 0, 200)) : 'cash';
		  $paypal = isset($_POST['paypal']) ? functions::checkin(mb_substr(trim($_POST['paypal']), 0, 200)) : '';
		  if($cash<1) {
			  $error[]='Chưa nhập số $ cần mua';
		  }
		  
		  $paycash=$cash*$set['vndus'];
		  if(empty($paypal)) {
			  $error[]='Email PayPal trống';
		  }
		   if(empty($pay)) {
			  $error[]='Empty method';
		  }
		  if($pay=='cash' && $paycash>$usermain['coin']) {
			  $error[]='You not enough cash';
		  }
		  if(empty($error)) {
			  if($pay=='cash') {
				  mysql_query("UPDATE `users` SET `coin` = `coin` - '".$paycash."' WHERE `id` = '".$usermain['id']."'");
				
		
			// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'buy paypal',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$cash."',
			`pay` = '".$paycash."',
			log = '".$report."',
			box = '".$user_id."',
			`note` = 'main cash',
			`status` = 'pending',
			boxid = ''");
			$newid=mysql_insert_id();
				 ?>

<center>
<img src="/sr/img/money2.png" height="50"/><br>
Bạn đã mua PayPal thành công tại EarntMoney! Vui lòng đợi chúng tôi xử lý thanh toán của bạn và chuyển PayPal của bạn đến địa chỉ Email tài khoản PayPal của bạn. Theo dõi lich sử giao dịch để biết thêm thông tin!
<br>
<a href="/paypal.php?act=buy">Mua tiếp</a>

</center>
<?				 
			  }
			  if($pay=='atm') {
				  
				
		
		// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'buy paypal',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$cash."',
			`date` = '".date("d/m/Y",time()+7*3600)."',
			`pay` = '".$paycash."',
			log = '".$report."',
			box = '".$user_id."',
			`note` = 'atm',
			`status` = 'pending',
			boxid = '".$newid."'");
			$newid=mysql_insert_id();
				 ?>

<center>
<img src="/sr/img/money2.png" height="50"/><br>
Bạn đã mua paypal thành công! Vui lòng chuyển khoản theo nội dung bên dưới. Sau khi chuyển khoản, vui lòng kiểm tra số dư tài khoản PayPal cần giao dịch.
<br>
<span style="color:#ff00ff;font-weight:bold;">Ngân hàng Tiên Phong TPBank - STK: 02312920601 NGUYEN DANG LAN</span>
<br>
<li>Tổng số tiền thanh toán: <? echo number_format($paycash);?> <? echo $set['donvi'];?> mua : <? echo number_format($cash);?>USD</li>
<li>Nội dung: ID: <? echo $user_id;?> MUAPAYPAL</li>
<a href="/paypal.php?act=buy">Mua tiếp</a>

</center>
<?				  
				  
			  }
			  
		  } else {
			  ?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		<a href="/paypal.php?act=buy">Mua lại PayPaL</a>
		</div>
	<?php
			  
			  
		  }
	  }
	  break;
	  case 'buy':

?>

	  
	  <form method="post" action="/paypal.php?act=buyok">
	  <table style="width:100%;">
	  <tr style="width:100%;">
	  <td style="width:50%;vertical-align:top">
	  Nguồn tiền thanh toán<br/>
	  <select name="pay" style="border-radius:5px;height:20px;width:90%;">
	  <option value="cash">Tiền chính</option>
	  <option value="atm">Internet Backing ATM</option>
	  </select><br>
	  Nhà cung cấp<br>
	  <img src="/sr/img/favicon.png" height="50"/>
	  <br>Email Nhận PayPal<br>
	  <input type="text" name="paypal" style="border-radius:5px;height:20px;width:90%;border:1px solid #9999;" value="<? echo $usermain['paypal'];?>"/>
	  </td>
	  <td style="width:50%;vertical-align:top">Tỉ giá paypal bán ra  <span style="color:#ff00ff">(1$ = <? echo number_format($set['vndus']);?><? echo $set['donvi'];?>)</span><br>
	  <input type="text" name="one" id="one" style="border-radius:5px;height:20px;width:90%;border:1px solid #9999;" value="0"/>
	  <input type="hidden" id="two" name="two" value="0" placeholder="" style="float:right;width:40%;height:30px;" >
	  <br>Tổng tiền bạn cần trả<br>
	  <input type="text" id="three" name="three" style="border-radius:5px;height:20px;width:90%;border:1px solid #9999;" value="0"/><br><br><br>
	  <button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
<form>
	  </td>
	  </tr>
	  </table>
	  <script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
	three.value = src.value*<? echo $set['vndus']; ?>;
    });
	
	
};

</script>
	  <?
	  
	  break;
	  case 'saleok':
	  if(isset($_POST['submit'])) {
		  $cash=isset($_POST['one']) ? abs(intval($_POST['one'])) : 0;
		  $check=isset($_POST['check']) ? abs(intval($_POST['check'])) : 0;
		  if($check==1) {
			  $_SESSION['agreepaypal']='agree';
		  } else {
			  $_SESSION['agreepaypal']='refuse';
		  }
		  $pay = isset($_POST['pay']) ? functions::checkin(mb_substr(trim($_POST['pay']), 0, 200)) : 'cash';
		  $note = isset($_POST['note']) ? functions::checkin(mb_substr(trim($_POST['note']), 0, 500)) : '';
		  if($_SESSION['agreepaypal']!='agree') {
			  $error[]='Bạn cần đọc tất cả và đồng ý với các điều khoản của EarntMoney';
		  }
		 
		   if($cash<1) {
			  $error[]='Rỗng USD số tiền giao dịch Tối thiểu 1 USD';
		  }
		  
		  $paycash=$cash*$set['buyvndus'];
		  
		   if(empty($pay)) {
			  $error[]='Empty method';
		  }

		  if(empty($error)) {
			

				  
		
		
		// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'sale paypal',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$cash."',
			`date` = '".date("d/m/Y",time()+7*3600)."',
			pay = '".$paycash."',
			note = '".mysql_real_escape_string($note)."',
			log = '".$report."',
			`status` = 'pending',
			box = '".$user_id."',
			`boxid` = ''");
			$newid=mysql_insert_id();
			
			
				 ?>

<center>
<img src="/sr/img/money2.png" height="50"/><br>
Yêu cầu bán PayPal của bạn thành công. Hãy chọn loại giao dịch dưới 50$ hoặc trên 50$ và tiến hành bán PayPal của bạn ngay bây giờ
<!--<br>
<span style="color:#ff00ff;font-weight:bold;">earntmoneypaypal@gmail.com</span>-->
<br>
<?

			?>
<li style="color:#ff00ff;font-weight:bold;">Nhận: <? echo number_format($paycash);?> <? echo $set['donvi'];?> khi bán: <? echo number_format($cash);?>USD <a href="/upgd.php?id=<? echo ($_GET['id']>0 ? $_GET['id'] : $newid);?>&cash=<? echo $cash; ?>"><img src="/sr/img/i.png"/></a></li>
<br>
<i style="color:orange">Áp dụng cho các giao dịch bán Paypal dưới 50 $.Ấn vào biểu tượng để thanh toán</i>
<br>
<a href="http://paypal.me/earntmoney"><img alt="" border="0" src="/sr/img/pp1.png" height="40"></a>

<div style="color:#999">_______________________</div>
<i style="color:blue">Áp dụng cho các giao dịch bán Paypal từ 50 $. Bạn sẽ được chuyển đến cổng thanh toán của PayPal</i><br>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="earntmoneypaypal@gmail.com">
    <input type="hidden" name="item_name" value="Donation">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="<? echo $cash;?>">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="lc" value="AU">
    <input type="hidden" name="bn" value="PP-BuyNowBF">
    <input type="image" src="/sr/img/pp2.png" height="40" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." <? /*if ($_SESSION['upgd']=='no') { ?> disabled <? } */?>>
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
</center>
<?				  
				  
			  
			  
		  } else {
			  ?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		<a href="/paypal.php?act=sale">Bán lại PayPal</a>
		</div>
	<?php
			  
			  
		  }
	  } else {
		
	  $cash=$_GET['cash'];
	  $pay=$cash*$set['buyvndus'];
	  
	  ?>
	  <center>
<img src="/sr/img/money2.png" height="50"/><br>
You have successfully requested to sell paypal to us. Now visit paypal to sell us now.
<!--<br>
<span style="color:#ff00ff;font-weight:bold;">earntmoneypaypal@gmail.com</span>-->
<br>
<li style="color:#ff00ff;font-weight:bold;">Receive: <? echo number_format($pay);?> <? echo $set['donvi'];?> when sale: <? echo number_format($cash);?>USD <a href="/upgd.php?id=<? echo ($_GET['id']>0 ? $_GET['id'] : $newid);?>&cash=<? echo $cash; ?>"><img src="/sr/img/i.png"/></a></li>
<br>
<i style="color:orange">Apply for transactions selling Paypal under 50 $</i>
<br>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="earntmoneypaypal@gmail.com">
    <input type="hidden" name="item_name" value="Donation">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="<? echo $cash;?>">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="lc" value="AU">
    <input type="hidden" name="bn" value="PP-BuyNowBF">
    <input type="image" src="/sr/img/pp1.png" height="30" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." <? if ($_SESSION['upgd']=='no') { ?> disabled <? } ?>>
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
<div style="color:#999">_______________________</div>
<i style="color:blue">Apply for transactions selling Paypal from 50 $</i><br>
<a href="http://paypal.me/earntmoney"><img alt="" border="0" src="/sr/img/pp2.png" height="40"></a>
</center>
<?
		  
	  }
	  
	  break;
	  case 'sale':
	$countdate=mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `act` = 'sale paypal' AND `date` = '".date("d/m/Y",time()+7*3600)."' AND `idtacdong` = '".$user_id."'"),0);
	if($usermain['xacthuc']==0 && $countdate>$set['salepaypalchuaxacthuc']) {
		
		$errorw[]='Your account exceeds the number of paypal transactions according to our regulations';
	}
	if($usermain['xacthuc']==1 && $countdate>$set['salepaypalxacthuc']) {
		
		$errorw[]='Your account exceeds the number of paypal transactions according to our regulations';
	}
	if(empty($errorw)) {
	  $_SESSION['upgd']='no';
	  $ok=trim($_GET['ok']);
	  if($ok=='agree') {
		  $_SESSION['agreepaypal']='agree';
	  } else {
		   $_SESSION['agreepaypal']='refuse';
	  }
	 
	  
	   ?>
	  <form method="post" action="/paypal.php?act=saleok">
	  <table style="width:100%;">
	  <tr style="width:100%;">
	  <td style="width:50%;vertical-align:top">
	  Tài khoản nhận tiền<br/>
	  <select name="pay" style="border-radius:5px;height:20px;width:90%;">
	  <option value="cash">Tiền mặt chính</option>
	  </select><br>
	  Bán PayPal<br>
	  <img src="/sr/img/image005.png" height="50"/>
	  <br>Ghi chú của bạn (nếu có)<br>
	  <input type="text" name="note" style="border-radius:5px;height:20px;width:90%;border:1px solid #9999;" value=""/>
	  </td>
	  <td style="width:50%;vertical-align:top"><a href="/agreepaypal.php" class="cmt-to-login" style="background:red;color:white;border-radius:5px;border:0px;">
	  Điều khoản & Điều kiện</a><br>
	  <? if ($_SESSION['agreepaypal']=='agree') {?> <input type="radio" name="check" value="1" checked="checked"/><? } else { ?> <input name="check" value="1" type="radio" /><? } ?>
	  <i style="font-size:12px;color:#999">Tôi đồng ý với Điều khoản & Điều kiện của PayPal và EarntMoney</i> <br><br>Tỷ giá mua vào PayPal <span style="color:#ff00ff">(1$ = <? echo number_format($set['buyvndus']);?><? echo $set['donvi'];?>)</span><br>
	  <input type="text" name="one" id="one" style="border-radius:5px;height:20px;width:90%;border:1px solid #9999;" value="0"/>
	  <input type="hidden" id="two" name="two" value="0" placeholder="" style="float:right;width:40%;height:30px;" >
	  <br>Tổng tiền nhận được<br>
	  <input type="text" id="three" name="three" style="border-radius:5px;height:20px;width:90%;border:1px solid #9999;" value="0"/><br><br><br>
	  <button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
<form>
	  </td>
	  </tr>
	  </table>
	  <script>
window.onload = function() {
    var src = document.getElementById("one"),
        dst = document.getElementById("two"),
		three = document.getElementById("three");
    src.addEventListener('input', function() {
        dst.value = src.value;
	three.value = src.value*<? echo $set['buyvndus']; ?>;
    });
	
	
};

</script>
	  <?php
	} else {
			  ?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($errorw); ?>
		
		</div>
	<?php
	}
	  break;
} ?>
<h4 class="memnutab">Lưu ý</h4>

<div><i class="text-muted">Vui lòng kiểm tra giao dịch cẩn thận trước khi tiếp tục, chọn GET STARTED để hoàn tất giao dịch của bạn</i></div>

<h4 class="memnutab">Hỗ trợ</h4>

<div><i class="text-muted">Thông tin mặc định không thể thay đổi, mọi ý kiếnđóng góp vui lòng báo cho admin qua trang báo cáo <a style="color:orange" href="/report.php">report page</a></i></div>

  </div>
  

<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>
