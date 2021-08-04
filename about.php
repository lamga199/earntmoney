<?php
define('_IN_JOHNCMS', 1);
$headmod = 'about';
$textl='Abouts';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');

	?>
	<style>
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
$alluser=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 and code_register = '' and status = 'actived' and refid = '".$user_id."'"),0);
$alluserpending=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 and code_register = '' and status = 'pending' and refid = '".$user_id."'"),0);
$alluseract=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'actived' and code_register = ''"),0);
$alluserban=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'banned' and code_register = ''"),0);
$alluserpd=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'pending' and code_register = ''"),0);
$mod24h=time()-86400;

$acttoday=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".date('d/m/Y',time()+$set['timeshift']*3600)."' and refid = '".$user_id."'"),0);


$act24h=mysql_result(mysql_query("SELECT COUNT(*) FROM users where timeactive >= $mod24h and refid = '".$user_id."'"),0);
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#999;color:#000;width:120px;padding:5px;margin:auto">Friends</div>
</div>	<div style="background:#E6E0F8;text-align:left;;padding:10px;">
<div style="text-align:center"><h4>Tất cả bạn bè</h4></div>
<table style="border-collapse: collapse;width:100%;max-width:100%;">
<tr>
<td class="bang">Ngày tham gia</td>
<td class="bang">Toàn bộ</td>
<td class="bang">Đã kích hoạt</td>
<td class="bang">Đang chờ sử lý</td>
<td class="bang">Bị khóa</td>
</tr>
<tr >
<td class="bang2">Toàn bộ</td>
<td class="bang2" style="color:orange"><? echo $alluser+$alluserpending+$alluserban; ?></td>
<td class="bang2" style="color:#00BFFF"><?php echo $alluser;?></td>
<td class="bang2" style="color:red"><?php echo $alluserpending;?></td>
<td class="bang2" style="color:red"><?php echo $alluserban;?></td>
</tr>
</table>


	<style>
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div style="text-align:center"><h4>Danh sách bạn bè</h4></div>
<table style="border-collapse: collapse;width:100%;max-width:100%;">
<tr>
<td class="bang">ID</td>
<td class="bang">Tên tài khoản</td>
<td class="bang">Họ tên</td>
<td class="bang">Ngày tham gia</td>
<td class="bang">Tiền giới thệu+</td>
<td class="bang">IDADM</td>
<td class="bang">Người giới thiệu</td>
<td class="bang">Trạng thái</td>
</tr>

  <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `refid` = '".$user_id."'"), 0);
	 $req=mysql_query("SELECT * FROM `users` WHERE `refid` = '".$user_id."' ORDER BY `datereg` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 $userfe=mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['refid']."'"));
		 ?>
		 <tr>
        <td class="bang"><?php echo $res['id'];?></td>
        <td class="bang"><?php echo $res['name'];?></td>
        <td class="bang"><?php echo $res['imname'];?></td>
		<td class="bang"><?php echo date("H:i:s - d/m/Y",$res['datereg']+$set['timeshift']*3600);?></td>
		<td class="bang">+<?php 
		if($res['coin_add_ref']==0) {
		echo '<span style="color:#e34f05">'.number_format($res['coin_add_ref']).' '.$set['donvi'].'</span>';
		} else {
		echo '<span style="'.($res['xacthuc']==1 ? 'color:green' : 'color:orange').'">'.number_format($res['coin_add_ref']).' '.$set['donvi'].'</span>';
		}
		
		
		?></td>
		<td class="bang"><? echo $set['admin_nhan_coin'];?></td>
		<td class="bang" style="color:orange;font-weight:bold"><? echo $userfe['name'];?></td>
		
		
		<td class="bang" 
		<? echo ($res['status']=='pending' ? ' style="color:#ed7e00">chờ kích hoạt' : '');?>
		<? echo ($res['status']=='actived' ? ' style="color:#029ad6">đã kích hoạt' : '');?>
		<? echo ($res['status']=='banned' ? ' style="color:red">bị khóa' : '');?>
		<? echo ($res['status']=='notauth' ? ' style="color:blue">' : '');?>
		</td>
      </tr>
		
		 
		 <?php
	 $i++; } ?>

</table>
    <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	
</form>
</div>
<? } ?>

</div>
<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

