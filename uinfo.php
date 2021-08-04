<style>
.ring {
  position: absolute;
  width: 256px;
  height: 256px;
  
}

.circle {
position: absolute;
}
.ring {
  background-color: rgba(0,0,0,0.5);
  border-radius: 50%;
  opacity: 0;

  -webkit-transform-origin: 50% 50%;
  -moz-transform-origin: 50% 50%;
  transform-origin: 50% 50%;

  -webkit-transform: scale(0.1) rotate(-270deg);
  -moz-transform: scale(0.1) rotate(-270deg);
  -transform: scale(0.1) rotate(-270deg);

  -webkit-transition: all 0.4s ease-out;
  -moz-transition: all 0.4s ease-out;
  transition: all 0.4s ease-out;
}






.open .ring {
  opacity: 1;
  
  -webkit-transform: scale(1) rotate(0);
  -moz-transform: scale(1) rotate(0);
  transform: scale(1) rotate(0);
}

.center {
  
  border-radius: 50%;
 
  bottom: 0;
  color: white;
  height: 80px;
  left: 0;
  line-height: 80px;
  margin: auto;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  width: 80px;
  
  -webkit-transition: all 0.4s ease-out;
  -moz-transition: all 0.4s ease-out;
  transition: all 0.4s ease-out;
}
.menuItem {
  border-radius: 50%;
  color: #eeeeee;
  display: block;
  height: 40px;
  line-height: 40px;
  margin-left: -20px;
  margin-top: -20px;
  position: absolute;
  text-align: center;
  width: 40px;
}
.menuItem:hover {
	background:#fff;
	
}
</style>

<div class="cmt-popup-pad cmt-popup-top" >
	  
	  <table style="margin:0 auto">
	  <tr style="width:100%">
	  <td style="width:400px;max-width:50%;position: relative;">
	  <a href="#" class="center"><img onclick="openround()" src="/sr/img/image005.png" height="60"/></a>
<div class="circle">
  <div class="ring" >
  <?php if($set['bonusdaily_on']=='on') { ?>
   <a href="/diemdanhday.php" class="menuItem"><img src="/sr/img/image043.png" height="30"/></a>
  <? } else {?>
  <img src="/sr/img/image043.png" height="30" style="filter: grayscale(100%);" />
  <? } ?>
  <?php if($set['diemdanh_on']=='on') { ?>
	  <a href="/diemdanh.php" class="menuItem"><img src="/sr/img/image045.png" height="30"/></a>
	  <? } else {?>
	  <img src="/sr/img/image045.png" height="30" style="filter: grayscale(100%);" />
	  <? } ?>
	  
	  <?php if($set['vongquay_on']=='on') { ?>
	  <a href="/roll.php" class="menuItem"><img src="/sr/img/image047.png" height="30"/></a>
	  
	  <? } else {?>
	  <img src="/sr/img/image047.png" height="30" style="filter: grayscale(100%);" />
	   <? } ?>
	  
	  
	  
	  
	   <?php if($set['paypaltrade_on']=='on') { ?>
	  <a href="/paypal.php" class="menuItem"><img src="/sr/img/image051.png" height="30"/></a>
	    <? } else {?>
	  <img src="/sr/img/image051.png" height="30" style="filter: grayscale(100%);" />
	   <? } ?>
	  

	 

<?php if($set['paygame_on']=='on') { ?>
	 <a href="/paygame.php" class="menuItem"><img src="/sr/img/image053.png" height="30"/></a>
	 <? } else {?>
	  <img src="/sr/img/image053.png" height="30" style="filter: grayscale(100%);" />
	   <? } ?>
	 
	 <?php if($set['payk_on']=='on') { ?>
	  <a href="/payk.php" class="menuItem"><img src="/sr/img/image055.png" height="30"/></a>
	  <? } else {?>
	  <img src="/sr/img/image055.png" height="30" style="filter: grayscale(100%);" />
	   <? } ?>
	  
	  <?php if($set['video_on']=='on') { ?>
	  <a href="/video.php" class="menuItem"><img src="/sr/img/image057.png" height="30"/></a>
	  <? } else {?>
	  <img src="/sr/img/image057.png" height="30" style="filter: grayscale(100%);" />
	   <? } ?>
	  
	  <?php if($set['phonecard_on']=='on') { ?>
	  <a href="/phonecard.php" class="menuItem"><img src="/sr/img/image059.png" height="30"/></a>
	  <? } else {?>
	  <img src="/sr/img/image059.png" height="30" style="filter: grayscale(100%);" />
	   <? } ?>
	  
	  
	  <?php if($set['payinternet_on']=='on') { ?>
	  <a href="/payinternet.php" class="menuItem"><img src="/sr/img/image061.png" height="30"/></a>
	  <? } else {?>
	  <img src="/sr/img/image061.png" height="30" style="filter: grayscale(100%);" />
	   <? } ?>
	  
	  
  </div>
  <span class="center"></span>
</div>
    <!-- End of Nav Structure -->
	  <script>
	  var items = document.querySelectorAll('.menuItem');

for(var i = 0, l = items.length; i < l; i++) {
  items[i].style.left = (50 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
  
  items[i].style.top = (50 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
}

document.querySelector('.center').onclick = function(e) {
   e.preventDefault(); document.querySelector('.circle').classList.toggle('open');
}
     
	  </script>
	  <td style="width:400px;max-width:50%">
	  <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" class="avatarcs" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" class="avatarcs" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:<?php echo $usermain['color'];?>"> <?php echo $usermain['name'];?></b> - <b style="color:green">ID: <?php echo $usermain['id'];?></b>
               <?php if($rights>=9) {?>
			   <br><a href="/admin/">Management system</a>
			   
			   <? } ?>
			   
			  <span class="glowings"  style="padding:7px;padding-right:10px;color:#FDD969;font-weight:bold;font-size:11px;border-radius:15px;">
          <a href="/notice.php"><img  id="bell"		  src="/sr/img/bell.png "  style="animation: shake 0.0s;animation-iteration-count: infinite;" height="25"/>
          <img  id="hidebell"		  src="/sr/img/bell.png "  style="display:none;animation: shake 0.0s;animation-iteration-count: infinite;" height="25"/></a>
	<?

function notcong() {
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'promotion'"),0);
$allpro=mysql_query("SELECT * FROM `news` WHERE `type` = 'promotion'");
$cong=0;
while($allp=mysql_fetch_assoc($allpro)) {
	$tach=explode(",",$allp['view']);
	if (in_array($user_id, $tach))
  {
	  $cong=$cong+1;
  }
}
$pro = $tong-$cong;	
	$tong2=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'news'"),0);
$allpro2=mysql_query("SELECT * FROM `news` WHERE `type` = 'news'");
$cong2=0;
while($allp2=mysql_fetch_assoc($allpro2)) {
	$tach2=explode(",",$allp2['view']);
	if (in_array($user_id, $tach2))
  {
	  $cong2=$cong2+1;
  }
}
$pro2 = $tong2-$cong2;
$not=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'note' AND `user` = '".$user_id."' AND `read` = '0'"),0);
echo $pro;
}
?>
		   
		   
		   (<? echo $not=mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `type` = 'note' AND `user` = '".$user_id."' AND `read` = '0'"),0); ?>)
		   
		   
		   <div id="notice" style="background:white;position:absolute;width:320px;height:400px;z-index:1000px;display:none;">
<div style="text-align:center;color:#E0F2F7;background:#5882FA;padding:5px;">Notice</div>
<? if($usermain['rights']>=9) {?>
<a href="/admin/addnews.php">+ add news or promotion</a>

<? } ?>
<table style="margin:auto;width:100%;">
<tr style="margin:auto;width:100%;">
<td style="width:32%;vertical-align: top;">
<div style="margin:auto;color:white;background:#5882FA;padding:5px;border-radius:5px;">Your notice</div>
<?php
$ev=mysql_query("SELECT * FROM `news` WHERE `show` = 'on' AND `type` = 'note' ORDER BY `id` DESC LIMIT 10");
while($event=mysql_fetch_assoc($ev)) {
	?>
	<div style="padding:5px;border-bottom:1px dotted #999;color:#222;text-align:left;font-weight:normal;height:21px;text-overflow: ellipsis;overflow :hidden;
      ">
	<a style="color:blue" href="/news.php?id=<? echo $event['id'];?>"><? echo $event['name'];?></a>
	<i>(<? echo date("d/m/Y",$event['time']);?>)</i>
	</div>
	
	<?
	
}

?>
</td>

<td style="width:32%;vertical-align: top;">
<div style="margin:auto;color:white;background:#5882FA;padding:5px;border-radius:5px;">News</div>
<?php
$ev=mysql_query("SELECT * FROM `news` WHERE `show` = 'on' AND `type` = 'news' ORDER BY `id` DESC LIMIT 10");
while($event=mysql_fetch_assoc($ev)) {
	?>
	<div style="padding:5px;border-bottom:1px dotted #999;color:#222;text-align:left;font-weight:normal;height:21px;text-overflow: ellipsis;overflow :hidden;
      ">
	<a style="color:blue" href="/news.php?id=<? echo $event['id'];?>"><? echo $event['name'];?></a>
	<i>(<? echo date("d/m/Y",$event['time']);?>)</i>
	</div>
	
	
	<?
	
}

?>

</td>

<td style="width:32%;vertical-align: top;">
<div style="margin:auto;color:white;background:#5882FA;padding:5px;border-radius:5px;">Promotion</div>
<?php
$ev=mysql_query("SELECT * FROM `news` WHERE `show` = 'on' AND `type` = 'promotion' ORDER BY `id` DESC LIMIT 10");
while($event=mysql_fetch_assoc($ev)) {
	?>
	<div style="padding:5px;border-bottom:1px dotted #999;color:#222;text-align:left;font-weight:normal;height:21px;text-overflow: ellipsis;overflow :hidden;
      ">
	<a style="color:blue" href="/news.php?id=<? echo $event['id'];?>"><? echo $event['name'];?></a>
	<i>(<? echo date("d/m/Y",$event['time']);?>)</i>
	</div>
	
	<?
	
}

?>
</td>

</tr>

</table>

</div>
<script>
function notice() {
	$("#notice").show();
	$("#bell").hide();
	$("#hidebell").show();
	
}
function hidenotice() {
	$("#notice").hide();
	$("#bell").show();
	$("#hidebell").hide();
	
}
</script>
		  </span>
		  <a href="/exit.php"><ion-icon name="power-outline"></ion-icon> </a>
		  <br><? echo ($usermain['xacthuc']==1 ? '<b style="color:#41de12">[đã xác thực]</b>' : '<b style="color:red">[Chưa xác thực]</b>');?>
		  </td>
		  
		  </tr>
		  <tr>
		  <td>
		  Tiền mặt PayPal <span id="showcash" onclick="showcash()"><ion-icon name="eye-outline"></ion-icon></span>
		  <span onclick="hidecash()" id="hidecash"  style="display:none;"><ion-icon name="eye-off-outline"></ion-icon></span>
		  <script>
		  function showcash() {
								$("#showcash").hide();
	                             $("#hidecash").show();
								 $("#cash").show();
	                            $("#cashoff").hide();
                              
		  }
		  function hidecash() {
								$("#showcash").show();
	                             $("#hidecash").hide();
								 $("#cash").hide();
								 $("#cashoff").show();
	                            
                              
		  }
		  </script>
		  </td>
		  
		  <td>
		  <b id="cash" style="display:none;color:blue"  name="cash"><?php echo number_format($usermain['paypalcash']);?>$</b>
		  <span id="cashoff" name="cashoff">$</span>
		  </td>
		  </tr>
		  </table>
           
			
			
			

  <style>
  
  .border-tien {
	  background:#EBEDF0;padding:2px 7px 2px 7px;border:0px; border-radius:20px;font-size:13px;font-weight:bold;color:#858C8D;width:100px;
  }
  .border-tien img {
	 height:18px;
	 padding-left:0px;
	 padding-right:5px;
	 padding-bottom:3px;
    margin: auto;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }
  .diemlock {
	  background:#E70505;
	  color:white;
  }
  .diemday {
	  background:#FE7C44;
	  color:white;
  }
  .diemchinh {
	  background:green;
	  color:white;
  }
  .diemdanh {
	  background:orange;
	  color:white;
  }
  </style>

<span class=" border-tien diemchinh"><img src="/sr/img/mmo.jpg"/>Tiền chính: <?php echo number_format($usermain['coin']);?> <?php echo $set['donvi']; ?> </span>
<span class=" border-tien diemdanh"><img src="/sr/img/mmo.jpg"/>Tiền Video: <?php echo number_format($usermain['videocoin']);?> <?php echo $set['donvi']; ?> </span>
<span class=" border-tien diemdanh"><img src="/sr/img/bonus.png"/>Tiền bạn bè: <?php echo number_format($usermain['coin_bonus']);?> <? echo $set['donvi']; ?> </span>
<!--<span class=" border-tien diemlock"><img src="/sr/img/coin.png"/>Bonus 10%: <?php echo number_format($usermain['coin_lock']);?> <? echo $set['donvi']; ?> </span>-->
<? if($set['diemdanhngay']=='on') {?>
<span class=" border-tien diemday"><img src="/sr/img/coin.png"/>Bonus daily: <?php echo number_format($usermain['coinday']);?> <? echo $set['donvi']; ?> </span>
<? } ?>
 </div>
 
 
 <?php
if($usermain['status']=='pending') {
	?>
	<div style="height:13px;padding:5px;background:red;color:white;text-align:center;"><a style="color:white" href="/activeacc.php?act=main">"Click" để kích hoạt tài khoản bây giờ!</a></div>
	<?
}
?>