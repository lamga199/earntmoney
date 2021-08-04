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

<style>
table {
  width: 100%;
}
table, th, td {
  border: 1px solid #f2f2f2;
}
</style>
<div style="margin:15px;">
<table>
<tr style="background:#f2f2f2">
<td >ID
</td><td>Nick
</td><td>Full Name
</td><td>Ngày đăng ký
</td><td>Ngày kích hoạt
</td><td>Ngày xác thực
</td><td>Trạng thái
</td><td>Tiền cộng
</td>
</tr>
<?
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `refid` = '".$id."'"),0);
?>
<h4 style="padding:5px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:5px;">Giới thiệu F1 của <? echo $userkhach['name'];?> (<? echo $total; ?>)</h4>
<?
$f1=mysql_query("SELECT * FROM `users` WHERE `refid` = '".$id."' ORDER BY `id` DESC LIMIT $start, $kmess");
while($uf1=mysql_fetch_assoc($f1)) { ?>
<tr style="background:#f2f2f2">
<td ><? echo $uf1['id']; ?>
</td><td><? echo $uf1['name']; ?>
</td><td><? echo $uf1['imname']; ?>
</td><td><? echo $uf1['regdate']; ?>
</td><td><? echo $uf1['dateact']; ?>
</td><td><? echo date("d/m/Y",$uf1['timexacthuc']+7*3600); ?>
</td><td><? echo $uf1['status']; ?>
</td><td><? echo $uf1['coin_add_ref']; ?><? echo $set['donvi']; ?>
</td>
</tr>
<? } ?>
</table>
<? if($total>$kmess) { ?>
<div class="">
	  
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?id='.$id.'&', $start, $total, $kmess);?></div>
	   </div>

</div>
<? } ?>

</div>

<br><br>
</div><?

require('../incfiles/end.php');
}
?>
