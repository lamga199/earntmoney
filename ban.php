<?php

define('_IN_JOHNCMS', 1);

$headmod = 'login';
require('incfiles/core.php');
$usermain=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$user_id."'"));
if($usermain['status']=='actived' && $login || !$login || !$user_id || $usermain['status']=='pending' && $login) {
	header('location:/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="MobileOptimized" content="width">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta name="Generator" content="">
<link rel="stylesheet" href="/sr/css/bootstrap.min.css">
<link rel="shortcut icon" href="/sr/img/favicon.png">
<title>Tài khoản bị chặn</title>
<style>
a{
	color:#FF8000;
}
a:hover {
	text-decoration:none;
	color:red;
}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
	  body{
	background-image: url("https://webkhoinghiep.net/wp-content/uploads/2019/10/login-background.jpg");

	/*background:#fff;*/
	color:#111;
	 min-height: 100%;
	 position:relative;
	}
	html { 
  height: 100%; 
} 
    </style>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="/sr/js/bootstrap.min.js"></script>
</head><body>


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
      <div class="sidebar-sticky pt-3">
	  <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Dành cho thành viên</span>
         
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="slash"></span>
              Chặn <span class="sr-only">(current)</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="/guide.php">
              <span data-feather="help-circle"></span>
              Hướng dẫn
            </a>
          </li>
        </ul>
        
		
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Account is locked!</h1>
        
      </div>

<div class="container-fluid" style="font-size:15px;">
Your account information: <strong><?php echo $login; ?></strong>       <i class="text-muted">(Tên đăng nhập)</i>
<div>Account name: <strong><?php echo $login; ?></strong> - Tình trạng tài khoản: <strong style="color:orange"><?php echo $usermain['status']; ?></strong></div>
<div>NRegistration Date: <strong><?php echo date("H:i:s - d/m/Y",$usermain['datereg']+$set['timeshift']*3600);?></strong></div>
<div>Time is locked: <strong><?php echo date("H:i:s - d/m/Y",$usermain['timeban']+$set['timeshift']*3600);?></strong></div>
<blockquote class="blockquote">
  <p class="mb-0">Your account has been locked during the operation due to EarntMoney breach.</p>
  <footer class="blockquote-footer"><cite title="Source Title">This message appears when your account is locked for the breach, and all account transactions and operations are not possible.</cite></footer>
  <a href="mailto:service@earntmoney.com?subject=Feedback&body=Message">
Send Feedback: service@earntmoney.com
</a><br>Fanpage Support: <a href="https://www.facebook.com/EarntMoney">Facebook.com/EarntMoney VN</a>
</blockquote>


  </div>
    
      
    </main>
  </div>
</div>	 
	<div style="padding-bottom:50px;" class="float-right"></div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
	  <script src="<?php echo $set['homeurl'];?>/sr/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="/sr/js/dashboard.js"></script>

</html>	