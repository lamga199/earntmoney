<?php

define('_IN_JOHNCMS', 1);
$headmod = 'paypal';
$textl='UPGD';
require('incfiles/core.php');

session_start();
$giaodich=mysql_fetch_assoc(mysql_query("SELECT * FROM `log` WHERE `id` = '".$id."' AND `idtacdong` = '".$user_id."' AND `act` = 'sale paypal'"));
if(!$giaodich['id'] || !$login) {
	header('location: /');
}
$_SESSION['gdok']='no';
?>
<!DOCTYPE html>
<head>
<html lang="en">
	<title><?php echo $textl; ?></title>
	<link rel="icon" type="image/png" href="/sr/img/favicon.png"/>
	<meta name="theme-color" content="#23a86b">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="">
    <meta name="format-detection" content="telephone=no" /></head>
	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
	<style>
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
				$('#blah').hide();
				 $('#loading').show();
				 setTimeout(function() {
  $('#loading').hide();
  $('#blah').show();
}, 2000);
				 
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	</script>
<div style="width:500px;max-width:100%;margin:0 auto;text-align:center;background:#424242;color:white;"><br><br>
<form method="post" enctype="multipart/form-data">
<div style="margin:20px;text-align:left;"><h4>I. HOW TO SELL PAYPAL IF YOU ARE BELOW <i style="color:orange">50 $</i></h4>
<div><i>Step 1: Capture the 10 most transaction history of your PayPal account here</i></div>
<center id="upload">
<?php
$cash=$_GET['cash'];
$id=$_GET['id'];
if(isset($_POST['submit'])) {
	$test=isset($_POST['check']);
	$check1 = getimagesize($_FILES["image1"]["tmp_name"]);
		if($check1==true) {
	  $file_name1 = $_FILES['image1']['name'];
      $file_size1 =$_FILES['image1']['size'];
      $file_tmp1 =$_FILES['image1']['tmp_name'];
      $file_type1=$_FILES['image1']['type'];
      $file_ext1=strtolower(end(explode('.',$_FILES['image1']['name'])));
	  $expensions1= array("png","jpg");
		if(in_array($file_ext1,$expensions1)=== false){
         $error[]="Only accept file image.";
      }
      if ($file_size1 > 500000) {
         $error[]='The image is larger than 500Kb';
      }
	}
	  if($check1 == false) {
		  $error[]='No picture';
	  }
	  if($test=='value1') {
		  
		 
	  } else {
		   $error[]='You need agree with terms us';
	  }

if(!$error) {
	$tenfile1='salepaypal_'.$id.'';
	move_uploaded_file($file_tmp1,"sr/paypal/".$tenfile1.".".$file_ext1."");
	mysql_query("UPDATE `log` SET `image` = '".$tenfile1.".".$file_ext1."' WHERE `id` = '".$id."'");
	$_SESSION['upgd']='yes';
	header('location: /paypal.php?act=saleok&cash='.$cash.'&id='.$id.'');
} else {
	$_SESSION['upgd']='no';
	?>
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		<a href="/paypal.php?act=sale">Re sale Paypal</a>
		</div>
		<?
}
}
?>
<label for="file-upload" class="custom-file-upload" style="font-size:20px;text-align:center;">
 <img id="blah" src="#" style="display:none;height:50px;max-height:50px;" lt="your image" />
 <img id="loading" src="/sr/img/loading.gif" style="display:none;height:50px;max-height:50px;" lt="loading" />
 
 <br><img src="/sr/img/camera.png"/>
</label>
 
<input id="file-upload" onchange="readURL(this);" name="image1" type="file"/>

<br>
	
</center>
<div><i>Step 2: Click on <img src="/sr/img/pp1.png" height="20"/> And choose to transfer the $ you need to sell</i></div>


<div><i>Step 3: Choose to sell $ as instructed below</i> <img src="/sr/img/pp1.png" height="20"/></div>
<center>1.Select the amount of <font style="color:orange">$</font> PayPal you need to sell as shown in the image <b style="color:orange">"Guide 1"</b>				
<br>
<img src="/img/gif.gif" style="width:70%"/>
<br>
<i style="color:orange">Figure 1.</i>
<br><font style="text-align:left">
2. Uncheck <img src="https://i.imgur.com/gN2Z1Gq.png"/> Paying for goods or a service? After giving up Paying for goods or a service, please
             select Send Payment Now for sale. See <b style="color:orange">"Tutorial 2"</b> picture.</font><br>
			 
<img src="/img/gif2.gif" style="width:70%"/>
<br><i style="color:orange">Figure 2.</i>

<br>
<i><b>Note</b>: This <b style="color:orange">Guide</b> is only applicable for PayPal accounts with balances below <b style="color:orange">$ 50</b>
Sell <b>​​PayPal</b> you do not write the <b>Content </b>in this "Add message" <img src="https://i.imgur.com/SQlhOBc.png"/>section.</i>

</center>
<i>

<li>For transactions from <b style="color:blue">$ 50</b> or more, simply upload a Transaction History image and then select the system button
   <img src="/img/Picture7.png" height="25"/>will direct you to the PayPal payment page</li>


<li>If you install <b style="color:blue">PayPal</b> app on your device, the system will automatically transfer to your <b style="color:blue">APP</b> with the following transactions
  <b style="color:orange"> $ 50</b>, please choose the method Send to someone you trust Family and Friends to us.
</li>

<b style="color:gray">The payout you receive is between 8 hours and 24 hours from the start of the transaction!</b>


<li style="color:red"><img src="https://i.imgur.com/uvqHLUs.png/">Waring: Pay close attention to the instructions above. If you make the wrong way to transfer money
                            <span style="color:white">EarntMoney</span>. We will decline the transaction at the same time you will not receive any liquidity
Which math comes from your transaction</li>


<li>If your transactions are rejected 5 times, the system will automatically lock the account within 72 hours at the next time.
       If the violation continues, the account will be <span style="color:red">locked permanently</span>.
	   </li>
	   <?
	   
	   $checktuchoi=mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `act` = 'sale paypal' AND `status` = 'disagree' OR `act` = 'buy paypal' AND `status` = 'disagree'"),0);
	   
	   ?><br>
	   <div style="width:250px;background:#000;color:red;text-align:center;margin:0 auto">
	   <span style="position:relative"><? echo $checktuchoi;?>/5</span>
	   <div style="background:#FE2E2E;width:<? echo ($checktuchoi*50);?>px;color:white;position:absolute">
	   
	   
	   </div>
	   <script>
	   function check() {
 var check = document.getElementById("check").checked;
 if(check==true) {
	<?
	
	$_SESSION['gdok']='yes';
	?>
}
}
	   
	   </script>
	   </div>
	   <br><center><span style="color:#088A68">To continue you need to agree to these terms</span>
	   <br><span style="color:white"><input type="checkbox" value="value1" name="check" id="check"/>I agree with Teams & Condition of PayPal anh EarntMoney						
</span> </i></form>
	   <br>
	   <span style="color:yellow">Upload photos should and continue		</span>
<br>


<button type="image" name="submit" value="upload" class="" style="border: 0px; background: transparent">
<img src="https://i.imgur.com/yEvTxfP.png"  />
</button>
<br>
<a href="/paypal.php?act=saleok&cash=<? echo $cash; ?>&id=<? echo $id; ?>"><img src="https://i.imgur.com/9K1VAj1.png"/></a>

</center>
	  
<br><br>
</div>
</div>
</html>