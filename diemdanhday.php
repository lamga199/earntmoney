<?php
define('_IN_JOHNCMS', 1);
$headmod = 'diemdanhday';
$textl='Bonus daily';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login) || $set['diemdanhngay']=='off') {
header('location: /index.php');
} else {
	
	require('header.php');
	
	?>
	  <!-- đăng nhập-->
	 

 <div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Bonus daily</div>
<div style="background:#000;color:#fff;">
  <p class="mb-0">The bonus time is from 12:00 - 14:59 daily<br><p class="text-danger">Every time you receive a bonus you get <?
  
  if($usermain['f1_act']>0) {
    if($usermain['coin_diemdanhday_1ref']!=0) {
        $coinday=$usermain['coin_diemdanhday_1ref'];
        
    } else {
	 $coinday=$set['coin_diemdanhday_1ref'];
    }
  } else {
	   if($usermain['coin_diemdanhday_0ref']!=0) {
        $coinday=$usermain['coin_diemdanhday_0ref'];
        
    } else {
	 $coinday=$set['coin_diemdanhday_0ref'];
    }
  }
  echo number_format($coinday);
  ?> <? echo $set['donvi'];?> bonuses.</p><br>Your daily bonus status: <? echo ($usermain['turndd']=='on' ? 'Can get' : 'Locked');?>
</div>
<?php
//date("H",time()+$set['timeshift']*3600)>='12' && date("H",time()+$set['timeshift']*3600)<'14' && 
if(date("H",time()+$set['timeshift']*3600)>='12' && date("H",time()+$set['timeshift']*3600)<'15' && $usermain['daylastdd']!=date("d/m/Y",time()+$set['timeshift']*3600) && $usermain['turndd']=='on') {
if(isset($_POST['submit'])) {
if($usermain['daylastdd']==date("d/m/Y",time()+$set['timeshift']*3600)) {
	$error[]='You got the reward today';
}
if($set['admin_nhan_coin']==$user_id || $rights>=7) {
	$error[]='This account is prohibited from accepting bonuses';
}
if($usermain['xacthuc']==0) {
	$error[]='Unauthenticated account cannot take attendance';
}
if($usermain['f1_act']>0) {
    if($usermain['coin_diemdanhday_1ref']!=0) {
        $coinday=$usermain['coin_diemdanhday_1ref'];
        
    } else {
	 $coinday=$set['coin_diemdanhday_1ref'];
    }
  } else {
	   if($usermain['coin_diemdanhday_0ref']!=0) {
        $coinday=$usermain['coin_diemdanhday_0ref'];
        
    } else {
	 $coinday=$set['coin_diemdanhday_0ref'];
    }
  }
if(empty($error)) {

	// cộng cho tài khoản coin_bonus số tiền thưởng
		mysql_query("UPDATE users SET
		coinday = coinday + '".$coinday."',
		totalcoinday = totalcoinday + '".$coinday."',
		lastdd = '".time()."', totaldiemdanh = totaldiemdanh + 1,
		daylastdd  = '".date("d/m/Y",time()+$set['timeshift']*3600)."'
		 WHERE id = '".$user_id."'");
		 if($usermain['totaldiemdanh']==30) {
		 mysql_query("UPDATE users SET turndd = 'off' where id = '".$user_id."'");
		 }
		// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'add coinday diem danh',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$coinday."',
			log = '".$usermain['id']." receive bonus on received $coinday',
			box = '".$user_id."'");
			?>
			<div class="alert alert-success" role="alert">
		Congratulations on your reward and receipt <? echo number_format($coinday);?><? echo $set['donvi'];?> bonuses.
		</div>
			<?
	

} else {
	
	?>
	
	<div style="background:#151515;color:#fff">
		<?php echo functions::display_error($error); ?>
		<a class="cmt-to-login" href="/diemdanhday.php">Retry</a>
		</div>
	<?php
}
		
	} else {
?>
<style>
 .social img {
         transition: -webkit-transform 0.25s ease;
         }
         .social img:active {
         -webkit-transform: scale(2);
         }
		 </style>
		 <div style="background:#151515;color:#fff">
		 <table style="margin:auto">
		 <tr style="width:100%">
		 <td style="width:33%">
		<b style="color:white">Earnt</b>  <img width="40" height="40" src="/sr/img/favicon.png"> 
		 </td>
		 <td style="width:33%"><h4 style="color:#ff00ff">12H:15H</h4><?php echo date("d/m",time()+$set['timeshift']*3600);?>
		 </td>
		 <td style="width:33%">
		 <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:<?php echo $usermain['color'];?>"> <?php echo $usermain['name'];?></b>
		 </td>
		 </tr>
		  <tr style="width:100%">
		 <td style="width:33%">
		 <span style="color:#ff00ff">-<? echo number_format($coinday);
  ?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 <td style="width:33%">
		 <form method="post" class="">
<button type="image" name="submit" class="" style="border: 0px; background: transparent">
<img src="/sr/img/get.png"  height="40" />
</button>
</form>
		 </td>
		 <td style="width:33%">
		  <span style="color:#58ACFA">+<? echo number_format($coinday);
  ?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 </tr>

</table>
</div>
<?php }} else {?>
<style>
 .social img {
         transition: -webkit-transform 0.25s ease;
         }
         .social img:active {
         -webkit-transform: scale(2);
         }
		 </style>
		 <div style="background:#151515;color:#fff">
		 <table style="margin:auto">
		 <tr style="width:100%">
		 <td style="width:33%">
		<b style="color:white">Earnt</b>  <img width="40" height="40" src="/sr/img/favicon.png"> 
		 </td>
		 <td style="width:33%"><h4 style="color:#ff00ff">12H:15H</h4><?php echo date("d/m",time()+$set['timeshift']*3600);?>
		 </td>
		 <td style="width:33%">
		 <?php if(!empty($usermain['avatar'])) { ?>
                <img width="40" height="40" src="/sr/avt/<?php echo $usermain['avatar'];?>">
	  <?php } else { ?>
	  <img width="40" height="40" src="/sr/img/avt.png">
	  <?php } ?>
				<b style="color:<?php echo $usermain['color'];?>"> <?php echo $usermain['name'];?></b>
		 </td>
		 </tr>
		  <tr style="width:100%">
		 <td style="width:33%">
		 <span style="color:#ff00ff">-<? echo number_format($coinday);
  ?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 <td style="width:33%">
		 <form method="post" class="">
<span style="border: 0px; background: transparent;opacity: 0.5">
<img src="/sr/img/get.png"  height="40" />
</span>
</form>
		 </td>
		 <td style="width:33%">
		  <span style="color:#58ACFA">+<? echo number_format($coinday);
  ?></span> <span style="color:pink"><? echo $set['donvi'];?></span>
		 </td>
		 </tr>

</table>
</div>
<div style="background:#151515;color:#fff">You cannot claim the bonus for the following reasons: At the end of the reward period, you have received the bonus, you are not allowed to claim the bonus</div>
<?php } ?>

    
      
 <!--   <div><? echo $usermain['totaldiemdanh'];?> receive cumulative rewards</div>
   
   
   <div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;">
        <td >Log ID</td>
		<td >ID CTV</td>
		<td>Thời gian nhận thưởng</td>
		<td>nhận thưởng</td>
		
      </tr>
    <tbody>
      
      
   
  
  
     <?php
	 
	 $req=mysql_query("SELECT * FROM `log` WHERE act = 'add coinday diem danh' and box = '".$user_id."' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		 <tr style="background-color:#F2f2f2;">

        <td><?php echo $res['id'];?></td>
        <td><?php echo $res['box'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>+<?php echo number_format($res['coin_bonus_add']);?>  <? echo $set['donvi'];?></td>
		
      </tr>
		
		 
		 <?php
	 $i++; }
	 
	 ?>  </tbody>
  </table></div>
  
  
  
  
    <?php
  if ($usermain['totaldiemdanh'] > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $usermain['totaldiemdanh'], $kmess);?></div>
	   </div>
	<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Số trang</label>
    <input type="text" style="width:100px" class="form-control" name="page" id="page" placeholder="Số trang">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Đến trang</button>
</form>
</div>
<? } ?>-->
</main>
 
  
  </div>
  <?php require('botmenu.php');?>
</div>	 
	


<?php require('incfiles/end.php');?>
<?php } ?>

