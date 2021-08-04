<?php
define('_IN_JOHNCMS', 1);
$headmod = 'log';
$textl='ADMIN: Logs';
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
        <h1 class="h2">Logs</h1>
        
      </div>

<div class="container-fluid" style="font-size:15px;">
<?php require('../uinfo.php'); ?>
<?

$totalwait=mysql_result(mysql_query("SELECT COUNT(*) FROM log"),0);
?>
</div><br ><div  class="border-bottom">
<h5>List of Logs (<?php echo $totalwait;?>)</h5></div>
 <?

 $list_wait=mysql_query("SELECT * FROM log ORDER BY time DESC LIMIT $start, $kmess");
 $i=0;
 while($list=mysql_fetch_assoc($list_wait)) {
	 $useryc=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$list['user']."'"));
	 ?>
	 <?
	 if($i%2) {?>
	 <div class="alert alert-primary" role="alert">
 <? }else { ?>
 <div class="alert alert-success" role="alert">
 <? } ?>
  <i class="fa fa-clock-o"></i> <?php echo date("H:i:s; d/m/Y",$list['time']+$set['timeshift']*3600);?>
  <strong>aciton:</strong> <?php echo $list['act'];?>; 
  <strong>log:</strong> <?php echo $list['log'];?>; 
  
  <strong>uid:</strong> <?php echo $list['idtacdong'];?>; 
  <strong>coin_add:</strong> <?php echo $list['coin_add'];?>; 
  <strong>coin_minus:</strong> <?php echo $list['coin_minus'];?>; 
  <strong>coin_bonus_add:</strong> <?php echo $list['coin_bonus_add'];?>; 
  <strong>coin_bonus_minus:</strong> <?php echo $list['coin_bonus_minus'];?>; 
  <strong>coin_lock_add:</strong> <?php echo $list['coin_lock_add'];?>; 
  <strong>coin_lock_minus:</strong> <?php echo $list['coin_lock_minus'];?>; 
</div>

<?php
$i++;
 }
 
 ?>
 	  <?php
  if ($totalwait > $kmess) {
	  ?><div class="">
	  <form method="get" class="form-inline text-left" style="max-width:90%;margin-top:20px;">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $totalwait, $kmess);?></div>
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

  
  </div> </main>
 
</div>	 
	<div style="padding-bottom:50px;" class="float-right"></div>
</body>
<?php require('../footer.php');?>

</html>	
<?php } ?>
