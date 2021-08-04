<?php
define('_IN_JOHNCMS', 1);
$headmod = 'ruthistory';
$textl='Lịch sử rút tiền';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
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
</style>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/index.php"><img src="/sr/img/logonew.png" height="35" /> </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Tìm kiếm" aria-label="Search">-->
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="/exit.php">Thoát</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
     
	  <div class="sidebar-sticky pt-3"><?php require('bar.php');?></div>
     
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lịch sử rút tiền</h1>
        
      </div>

<div class="container-fluid" style="font-size:15px;">
<?php require('uinfo.php');?>

<h5>Lịch sử rút tiền</h5>

<div class="table-responsive"><table style="width:100%">

      <tr style="background-color:rgb(230,230,230);font-weight:bold;">
        <td>ID log</td>
        <td>Thời gian yêu cầu</td>
        <td>Số tiền</td>
		<td>Tình trạng</td>
		<td>Thời gian xử lý</td>
      </tr>

    
	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `yeucaurut` WHERE user = '".$user_id."'"), 0);
	 $req=mysql_query("SELECT * FROM `yeucaurut` WHERE `user` = $user_id ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td><?php echo number_format($res['coin']);?> <? echo $set['donvi'];?></td>
		<td><?php 
		if($res['status']=='done') {
		echo '<span style="color:green">Đã thanh toán</span>';
		} else if($res['status']=='pending') {
		echo '<span style="color:orange">Đang chờ</span>';
		}elseif($res['status']=='fail') {
		echo '<span style="color:red">Bị từ chối</span>';
		}
		
		
		?></td>
		<td><?php 
		if($res['timedone']>0)
		echo date("H:i:s - d/m/Y",$res['timedone']+$set['timeshift']*3600);
		
		?></td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?>
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
<br>
<br>
<br>

<h5>Lịch sử rút tiền điểm danh</h5>

<div class="table-responsive"><table style="width:100%">
    <tr style="background-color:rgb(230,230,230);font-weight:bold;">
        <td>ID log</td>
        <td>Time</td>
        <td>Tiền điểm danh</td>
		<td>Tiền chính</td>
		<td>Tình trạng</td>
      </tr>

	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE idtacdong = '".$user_id."' and act = 'rut coin bonus'"), 0);
	 $req=mysql_query("SELECT * FROM `log` WHERE `idtacdong` = $user_id  and act = 'rut coin bonus' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>-<?php echo number_format($res['coin_bonus_minus']);?> <? echo $set['donvi'];?></td>
		<td>+<?php echo number_format($res['coin_add']);?> <? echo $set['donvi'];?></td>
		<td><span style="color:green">Hoàn thành</span></td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?>
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

<br>
<br>
<br>

<h5>Lịch sử rút tiền thưởng ngày</h5>

<div class="table-responsive"><table style="width:100%">
    <tr style="background-color:rgb(230,230,230);font-weight:bold;">
        <td>ID log</td>
        <td>Time</td>
        <td>Tiền thưởng ngày</td>
		<td>Tiền chính</td>
		<td>Tình trạng</td>
      </tr>

	 <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log` WHERE idtacdong = '".$user_id."' and act = 'rut coin diem danh'"), 0);
	 $req=mysql_query("SELECT * FROM `log` WHERE `idtacdong` = $user_id  and act = 'rut coin diem danh' ORDER BY `time` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 if($i%2) {?>
		 <tr style="background-color:#fff">
		 <? } else {
		 ?>
		 <tr style="background-color:#F2f2f2">
		 <? } ?>
        <td><?php echo $res['id'];?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['time']+$set['timeshift']*3600);?></td>
		<td>-<?php echo number_format($res['coin_bonus_minus']);?> <? echo $set['donvi'];?></td>
		<td>+<?php echo number_format($res['coin_add']);?> <? echo $set['donvi'];?></td>
		<td><span style="color:green">Hoàn thành</span></td>
      </tr>
		 
		 <?php
		 $i++; }
	 
	 ?>
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

<h5>Thông tin liên hệ</h5>
<div> Liên hệ với chúng tôi Email: <span style="color:orange">Support@earntmoney.com</span> </p><strong><? echo $set['support_phone'];?></strong></div>
<div>Fanpage: <a href="<? echo $set['fanpage'];?>"><? echo $set['fanpage'];?></a></div>

<div><i class="text-muted">Chỉ liên hệ các thông tin trên khi thực sự cần thiết, các nội dung khác có thể báo cáo với admin qua <a href="/report.php">report page</a></i></div>

  </div></div>
    
      
    </main>
  </div>
</div>	 
	<div style="padding-bottom:50px;" class="float-right"></div>
</body>
<? require('footer.php');?> 
</html>	
<?php } ?>
