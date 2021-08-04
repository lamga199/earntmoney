<?php
define('_IN_JOHNCMS', 1);
$headmod = 'video';
$textl='Video';
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
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto"><a href="/admin/">ADMIN PANEL</a></div>
</div>
<div style="padding:10px;background:#fff">
<?php
$alluser=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 and code_register = ''"),0);
$alluseract=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'actived' and code_register = ''"),0);
$alluserban=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'banned' and code_register = ''"),0);
$alluserpd=mysql_result(mysql_query("SELECT COUNT(*) FROM users where rights<7 AND status = 'pending' and code_register = ''"),0);
$mod24h=time()-86400;

$acttoday=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".date('d/m/Y',time()+$set['timeshift']*3600)."'"),0);


$act24h=mysql_result(mysql_query("SELECT COUNT(*) FROM users where timeactive >= $mod24h"),0);
?>
<div  class="border-bottom">
<h5>Thông tin tài khoản</h5></div>
<div>Tổng số thành viên: <?php echo $alluser;?> (đăng ký)</div>
<li><a href="/admin/uact.php">Tổng số đã kích hoạt: <?php echo $alluseract;?> (actived)</a></li>
<li><a href="/admin/uban.php">Tổng số bị ban: <?php echo $alluserban;?> (banned)</a></li>
<li><a href="/admin/user.php">Thành viên chưa kích hoạt: <?php echo $alluserpd;?> (pending)</a></li>
<div>Tài khoản kích hoạt hôm nay <? echo date('d/m/Y',time()+$set['timeshift']*3600);?>: <?php echo $acttoday;?></div>
<div>Tài khoản kích hoạt trong 24h qua: <?php echo $act24h;?></div>

<h4 style="padding:5px;height:28px;font-size:20px;color:#333;background:#999;text-align:center;margin-top:5px;">TÌM TÀI KHOẢN</h4>
<form method="post" action="/admin/search.php" style="margin:0 auto;">
<input name="idnickinput" style="padding:5px;margin:15px;border:1px solid #999; border-radius:15px;" value="" placeholder="Nhập ID"/>
<button name="submitsearchidnick" class="cmt-to-login">Tìm</button>
</form>
<div style="margin:5px;">> <a href="addvideo.php">Đăng video</a></div>
<div style="margin:5px;">> <a href="video.php">Quản lý video</a></div>
<div style="margin:5px;">> <a href="addnews.php">Đăng tin tức</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `yeucaurut` WHERE `status` = 'pending'"), 0);?>
<div style="margin:5px;">> <a href="yeucau.php">Duyệt rút tiền (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `muacard` WHERE `status` = 'pending'"), 0);?>
<div style="margin:5px;">> <a href="card.php">Duyệt mua thẻ cào (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `gift` WHERE `status` = 'pending' AND ".time()." < `exp`"), 0);?>
<div style="margin:5px;">> <a href="gift.php">Duyệt quà vòng quay (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `paygame` WHERE `status` = 'pending'"), 0);?>
<div style="margin:5px;">> <a href="game.php">Duyệt thanh toán game (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `payk` WHERE `status` = 'pending'"), 0);?>
<div style="margin:5px;">> <a href="kplus.php">Duyệt thanh toán k+ (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `payinternet` WHERE `status` = 'pending'"), 0);?>
<div style="margin:5px;">> <a href="internet.php">Duyệt thanh toán internet (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `paycard` WHERE `status` = 'pending'"), 0);?>
<div style="margin:5px;">> <a href="paycard.php">Duyệt thanh toán di động (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `act` = 'sale paypal' AND `status` = 'pending'"), 0); ?>
<div style="margin:5px;">> <a href="paypal.php">Duyệt bán paypal (<? echo $total;?>)</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE `act` = 'buy paypal' AND `status` = 'pending'"), 0); ?>
<div style="margin:5px;">> <a href="buypaypal.php">Duyệt mua paypal (<? echo $total;?>)</a></div>
<div style="margin:5px;">> <a href="tyle.php">Chỉnh tỷ lệ trúng thưởng vòng quay</a></div>
<div style="margin:5px;">> <a href="report.php">Report</a></div>
<? $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `yeucauxacthuc` = '1'"), 0);?>
<div style="margin:5px;">> <a href="xacthuc.php">Xác thực chứng minh nhân dân (<? echo $total;?>)</a></div>
<div style="margin:5px;">> <a href="setting.php">Cài đặt hệ thống</a></div>
<div style="margin:5px;">> <a href="mail.php">Gửi mail toàn bộ user có mail</a></div>
<!--
<script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="default" data-count="default"></div>
<div style="margin:5px;">> <a href="actived.php">Lịch sử đăng ký và kích hoạt tài khoản</a></div>
<div style="margin:5px;">> <a href="transfer.php">Lịch sử chuyển khoản</a></div>
<div style="margin:5px;">> <a href="diemdanh.php">Lịch sử điểm danh</a></div>
<div style="margin:5px;">> <a href="bonus.php">Lịch sử thưởng ngày</a></div>
<div style="margin:5px;">> <a href="roll.php">Lịch sử vòng quay may mắn</a></div>
<div style="margin:5px;">> <a href="video.php">Lịch sử cộng thưởng xem video</a></div>-->
</div>
</div>

<?php require('../incfiles/end.php');?>
<?php } ?>
























