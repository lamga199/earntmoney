 <?php
define('_IN_JOHNCMS', 1);

?>
	<?	
if($rights<7)  {
?>
<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Dành cho thành viên</span>
         
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='mainpage' ? 'active':'');?>" href="/index.php">
              <span data-feather="home"></span>
              Tổng quan <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='diemdanh' ? 'active':'');?>" href="/diemdanh.php">
              <span data-feather="file"></span>
              Điểm danh
            </a>
          </li>
		  <? if($set['diemdanhngay']=='on') {?>
		   <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='diemdanhday' ? 'active':'');?>" href="/diemdanhday.php">
              <span data-feather="file"></span>
             Nhận thưởng hàng ngày
            </a>
          </li>
		  <? } ?>
          <!--<li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link  <?php echo($headmod=='account' ? 'active':'');?>" href="/account.php">
              <span data-feather="users"></span>
              Thông tin tài khoản
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link  <?php echo($headmod=='ruthistory' ? 'active':'');?>" href="/ruthistory.php">
              <span data-feather="credit-card"></span>
              Lịch sử rút tiền
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='reportuser' ? 'active':'');?>" href="/report.php">
              <span data-feather="bar-chart-2"></span>
              Report page
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='ruttien' ? 'active':'');?>" href="/yeucau.php">
              <span data-feather="dollar-sign"></span>
              Yêu cầu rút tiền
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='huongdan' ? 'active':'');?>" href="/guide.php">
              <span data-feather="help-circle"></span>
              Hướng dẫn
            </a>
          </li>
		  <? if($rights<7) {?>
		  <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='exit' ? 'active':'');?>" href="/exit.php">
              <span data-feather="log-out"></span>
              Thoát
            </a>
          </li>
		  <? } ?>
        </ul>
        <? } ?>
	<?	
if($rights>=7)  {
?><h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Dành cho admin</span>
          
        </h6>
        <ul class="nav flex-column mb-2 font-weight-bold">
          <li class="nav-item">
            <a class="nav-link  <?php echo($headmod=='admin_index' ? 'active':'');?>" href="/admin/index.php">
              <span data-feather="bookmark"></span>
              Tổng quan
            </a>
          </li>
		   <li class="nav-item">
            <a class="nav-link  <?php echo($headmod=='log' ? 'active':'');?>" href="/admin/log.php">
              <span data-feather="bookmark"></span>
              Logs (<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `log`"), 0);?>)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($headmod=='admin_user' ? 'active':'');?>" href="/admin/user.php">
              <span data-feather="user-plus"></span>
              Danh sách tài khoản chờ (<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `status` = 'pending' and rights<7"), 0);?>)
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='admin_uact' ? 'active':'');?>" href="/admin/uact.php">
              <span data-feather="activity"></span>
              Danh sách tài khoản đã kích hoạt (<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `status` = 'actived' and rights<7"), 0);?>)
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='admin_uban' ? 'active':'');?>" href="/admin/uban.php">
              <span data-feather="slash"></span>
              Danh sách tài khoản bị chặn (<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `status` = 'banned' and rights<7"), 0);?>)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='yeucau' ? 'active':'');?>" href="/admin/yeucau.php">
              <span data-feather="dollar-sign"></span>
              Yêu cầu rút tiền (<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `yeucaurut` WHERE `status` = 'pending'"), 0);?>/<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `yeucaurut`"), 0);?>)
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='report' ? 'active':'');?>" href="/admin/report.php">
              <span data-feather="dollar-sign"></span>
              Reports list (<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `report` WHERE `ad_read` = '0' and type = 'report'"), 0);?>/<? echo $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `report` where type = 'report'"), 0);?>)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  <?php echo($headmod=='setting' ? 'active':'');?>" href="/admin/setting.php">
              <span data-feather="settings"></span>
              Cài đặt
            </a>
          </li>
		  <? if($rights>=7) {?>
		  <li class="nav-item">
            <a class="nav-link <?php echo($headmod=='exit' ? 'active':'');?>" href="/exit.php">
              <span data-feather="log-out"></span>
              Thoát
            </a>
          </li>
		  <? } ?>
        </ul>
<? } ?>