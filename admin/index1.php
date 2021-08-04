<?php
define('_IN_JOHNCMS', 1);
$headmod = 'admin_index';
$textl='ADMIN: Tổng quan';
require('../incfiles/core.php');
require('../incfiles/head.php');
if($rights<7 || !$login) {
header('location: /index.php');
} else { ?>
	  <!-- đăng nhập-->
	 <style>
	 .wrapper {

  min-height: 100%; /* Fix cho firefox */
  height: auto !important;
  height: 100%;
 
}
body {
  font-size: .875rem;
}

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

/*
 * Sidebar
 */

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 48px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 5rem;
  }
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

@supports ((position: -webkit-sticky) or (position: sticky)) {
  .sidebar-sticky {
    position: -webkit-sticky;
    position: sticky;
  }
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

/*
 * Navbar
 */

.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .navbar-toggler {
  top: .25rem;
  right: 1rem;
}

.navbar .form-control {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, .1);
  border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}
td {
	border:1px solid #111;
}
</style>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/admin/"><img src="/sr/img/logonew.png" height="35" /> </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <? require('formsearch.php'); ?>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="/exit.php">Thoát</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
	  
<?php if($usermain['rights']>=7) {
		$activenav=1;
		require('../bar.php');
} ?>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashbard</h1>
        
      </div>







<div class="container-fluid" style="font-size:15px;">

<?php require('../uinfo.php');

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

 <?php //require('bieudo.php');?>


<h5>Lịch sử rút tiền</h5>
<div class="table-responsive"><table class="table table-striped table-sm">
    <thead>
      <tr style="background-color:rgb(230,230,230);">
        <th>ID log</th>
		<th>ID User</th>
        <th>Thời gian yêu cầu</th>
        <th>Số tiền</th>
		<th>Tình trạng</th>
		<th>Thời gian xử lý</th>
      </tr>
    </thead>
    <tbody>
	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `yeucaurut`"), 0);
	 $req=mysql_query("SELECT * FROM `yeucaurut` ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
        <td><?php echo $res['user'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td><?php echo number_format($res['coin']);?> <? echo $set['donvi'];?></td>
		<td><?php 
		if($res['status']=='done') {
		
		echo 'Thành công';
		
		}
		else if($res['status']=='pending') {
		
		echo 'Đang chờ';
		
		}
		else if($res['status']=='fail') {
		
		echo 'Từ chối;';
		echo $res['comment'];
		}
		?></td>
		<td><?php echo ($res['timedone']>0 ? date("H:i:s - d/m/Y",$res['timedone']+$set['timeshift']*3600) : '');?></td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?></tbody>
  </table></div>

  
 
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Số trang</label>
    <input type="text" style="width:100px" class="form-control" name="page" id="page" placeholder="Số trang">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Đến trang</button>
</form>
</div>
<? } ?>




<h5>Lịch sử rút tiền điểm danh</h5>

<div class="table-responsive"><table class="table table-striped table-sm">
    <thead>
      <tr style="background-color:rgb(230,230,230);">
        <th>ID log</th>
		<th>ID User</th>
        <th>Time</th>
        <th>Tiền điểm danh</th>
		<th>Tiền chính</th>
		<th>Tình trạng</th>
      </tr>
    </thead>
    <tbody>
	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE act = 'rut coin bonus'"), 0);
	 $req=mysql_query("SELECT * FROM `log` WHERE act = 'rut coin bonus' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
        <td><?php echo $res['idtacdong'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>-<?php echo number_format($res['coin_bonus_minus']);?></td>
		<td>+<?php echo number_format($res['coin_add']);?></td>
		<td>Hoàn thành</td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?></tbody>
  </table></div> 
  
  
   <?php
  if ($total > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
	<div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Số trang</label>
    <input type="text" style="width:100px" class="form-control" name="page" id="page" placeholder="Số trang">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Đến trang</button>
</form>
  </div>
  <? } ?>

 </main>
 
  
  </div>
 
</div>	 
	<div style="padding-bottom:50px;" class="float-right"></div>
</body>
<?php require('../footer.php');?>

</html>	
<?php } ?>
