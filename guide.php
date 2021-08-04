<?php
define('_IN_JOHNCMS', 1);
$headmod = 'huongdan';
$textl='Hướng dẫn';
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
	<div class="container-fluid" style="font-size:15px;">
	<div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">HƯỚNG DẪN NHẬN THƯỞNG</h1>
        
      </div>


<?php require('uinfo.php');?>
<h5>THỂ LỆ TRƯƠNG TRÌNH</h5>
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <strong> 1. Xem Video</strong>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <b>- Đối với tài khoản chưa kích hoạt<br>
  <b>+Mỗi ngày bạn sẽ xem được tối đa 5 Video. <br><br>
- Đối với tài khoản đã kích hoạt<br>
+ Đối với loại tài khoản này bạn sẽ không bị giới hạn xem video trong ngày. Số tiền nhận được sẽ không giới hạn.</b>
	  </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         <strong> 2. Nhận thưởng Khi Giới Thiệu bạn bè</strong>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
-	Các Thành Viên sau khi tài khoản được kích hoạt thành công. Thành Viên vô mục <a href="http://earntmoney.com/account.php"><b>Thông tin tài khoản<b></a> sẽ thấy Link giới thiệu có chứa ID của mình. Đường Link này sẽ được Thành Viên sử dụng để giới thiệu. <br>
+  Thành viên chia sẻ trực tiếp Mã giới Thiệu của mình để giới thiệu với người được giới thiệu. Với mỗi lần giới thiệu bạn bè thành công sẽ nhận được 60,000VNĐ và sẽ được nhận thưởng 20,000VNĐ Money Atfriends.<br>
* Không giới hạn số lân giới thiệu và số lần nhận thưởng Money Atfriendstrong ngày. Số lần nhận thưởng Money Atfriends trong ngày phụ thuộc vào số lượt giới thiệu bạn bè và kích hoạt trong ngày đó.<br>
-	Quy định Người Giới thiệu<br>
+ Chương trình không áp dụng khách hàng đang tham gia Cộng tác viên giới thiệu của Earntmoney. <br>
+ Người giới thiệu Cần hướng dẫn người được giới thiệu cập nhật thông tin tài khoản.</p>
* Tuyệt đối không hướng đẫn sai quy định nhận thưởng và cách trả thưởng của Earntmoney<br>
+ Các tài khoản vi phạm quy định giới thiệu sẽ bị khóa vĩnh viễn không cần báo trước.<br>
2.	Nhận 10%: Thành viên sẽ nhận được thêm 10% tiền thưởng từ tổng số tiền, nếu giới thiệu được từ 5 bạn bè/ngày . Số tiền này sẽ được cập nhật  sau 23h hàng ngày.

	  </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <strong> 3. Rút tiền </strong>
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        1.  Rút tiền Chung<br>
- Điều Kiện: Thành Viên sẽ rút tiền về tài khoản chính . Số tiền rút tối thiểu là 50,000VNĐ ( Chưa áp dụng cho Video)
- Tiền Chung sau khi rút về tài khoản chính sẽ có một Mail thông báo được gửi về.<br>
        2.	Rút tiền Giới Thiệu (Tiền chính).<br>
        B1:Thành viên cần cập nhật đầy đủ thông tin ngân hàng và Xác thực tài khoản.<br>
        B2:Xác thực 2 lớp (OTP)-Lấy mã xác thực yêu cầu rút tiền qua Email đã đăng ký tài khoản.<br>
        B3:Nhập mã xác thực và nhập số tiền cần rút về tài khoản Ngân Hàng liên kết.<br>
-	Yêu cầu rút tiền sẽ Tự Động duyệt vào 20h00p-23h59p VÀO các ngày trong tuần “ trừ Chủ Nhật” Số tiền rút tối thiểu là 50,000VNĐ.<br>


3.	Nhận 10%: Người giới thiệu nếu giới thiệu được 5 bạn bè/ngày sẽ nhận được thêm 10% tiền thưởng từ tổng số tiền mà thành viên nhận được. Số tiền này sẽ được cập nhật sau 23h hàng ngày<br>

LƯU Ý*: Để có thể rút tiền thành công về ngân hàng liên kết. Bạn cần hướng dẫn người được giới thiệu cập nhật đầy đủ và xác minh tài khoản.

	  </div>
    </div>
  </div><div class="card">
    <div class="card-header" id="heading4">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">

          <strong>4. Giao dịch PayPal.</strong>
        </button>
      </h5>
    </div>
    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
      <div class="card-body">
      
1.	Mua PalPal<br>
+ Số PayPal tối thiểu cần mua là 1$. Tỷ giá PayPal được cập nhật tự động theo tỷ giá của ngân hàng cùng ngày .

<br>2. Bán PayPal<br>
+ Số tiền bán tối thiểu là 1$ tối đa 100$ (áp dụng thành viên thường) trên một giao dịch. Bạn cần đọc và đồng ý với điều khoản & điều kiện của EarntMoney 
+ Nếu tài khoản làm sai các bước hướng dẫn sẽ không nhận được bất kỳ khoản bồi hoàn nào từ phía EarntMoney PalPal
+ Nếu bạn vi phạm 5 lần tài khoản sẽ bị khóa 72h , vi phạm ở lần tiếp theo tài khoản sẽ bị khóa vĩnh viễn.

<br>3.	Chúng tôi sẽ khóa tài khoản mà không cần thông báo trước ,nếu phát hiện các hành vi gian lận, Lừa đảo để trục lợi ,hoặc sử dụng các công cụ hỗ trợ phần mềm bẻ khóa, Tool... từ bên thứ ba.

<br>	
4.	Mọi thông tin phản ánh Liên quan đến tài khoản vui lòng vô mục @report (khuyến kích) hoặc Liên hệ Admin để được giải quyết Email:service@earntmoney.com

	  </div>
    </div>
  </div>
</div><br>
    <div><i class="text-muted">Các thông tin mặc định không thể thay đổi, mọi ý kiến vui lòng report đến admin qua <a href="/report.php">report page</a></i></div>
      </div>
	  
    </main>
  
</div>	 
</div>	 	 
	<div style="padding-bottom:50px;" class="float-right"></div>
</body>
<? require('footer.php');?>
</html>	
<?php } ?>
