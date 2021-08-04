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
</div><br ><div  class="border-bottom">
<h5>Thông tin tài khoản</h5></div>
<div>Tổng số thành viên giới thiệu đã kích hoạt: <?php echo $alluser;?></div>
<div>Tổng số thành viên giới thiệu chưa kích hoạt: <?php echo $alluserpending;?></div>
<div>Tài khoản kích hoạt hôm nay <? echo date('d/m/Y',time()+$set['timeshift']*3600);?>: <?php echo $acttoday;?></div>
<div>Tài khoản kích hoạt trong 24h qua: <?php echo $act24h;?></div>
<div>Tổng doanh thu từ trước đến nay: <strong><?php echo number_format($usermain['totalearncoin']+$usermain['totalearndd']+$usermain['totalcoinday']);?> <?php echo $set['donvi'];?> (<? echo $usermain['f1_act'];?> kích hoạt)</strong></div>

   <br>
    <?php
   // ngày hôm nay
   $today=date('d/m/Y',time()+$set['timeshift']*3600);
   //hôm qua//date('d.m.Y',strtotime("-1 days"));
   $luingay1=date('d/m/Y',strtotime("-1 days")+$set['timeshift']*3600);
   $luingay2=date('d/m/Y',strtotime("-2 days")+$set['timeshift']*3600);
   $luingay3=date('d/m/Y',strtotime("-3 days")+$set['timeshift']*3600);
   $luingay4=date('d/m/Y',strtotime("-4 days")+$set['timeshift']*3600);
   $luingay5=date('d/m/Y',strtotime("-5 days")+$set['timeshift']*3600);
   $luingay6=date('d/m/Y',strtotime("-6 days")+$set['timeshift']*3600);
   $acttoday=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$today."'"),0);
   $actluingay1=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay1."'"),0);
   $actluingay2=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay2."'"),0);
   $actluingay3=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay3."'"),0);
   $actluingay4=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay4."'"),0);
   $actluingay5=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay5."'"),0);
   $actluingay6=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay6."'"),0);
   
   $regtoday=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and regdate = '".$today."'"),0);
   $regluingay1=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and regdate = '".$luingay1."'"),0);
   $regluingay2=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and regdate = '".$luingay2."'"),0);
   $regluingay3=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and regdate = '".$luingay3."'"),0);
   $regluingay4=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and regdate = '".$luingay4."'"),0);
   $regluingay5=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and regdate = '".$luingay5."'"),0);
   $regluingay6=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and regdate = '".$luingay6."'"),0);
   
   $kichhoat6ngay=$acttoday+$actluingay1+$actluingay2+$actluingay3+$actluingay4+$actluingay5+$actluingay6;
   $reg6ngay=$regtoday+$regluingay1+$regluingay2+$regluingay3+$regluingay4+$regluingay5+$regluingay6;
   $chuakich=$reg6ngay-$kichhoat6ngay;
   
   
   $acttodayban=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$today."' and status = 'banned'"),0);
   $actluingayban1=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay1."' and status = 'banned'"),0);
   $actluingayban2=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay2."' and status = 'banned'"),0);
   $actluingayban3=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay3."' and status = 'banned'"),0);
   $actluingayban4=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay4."' and status = 'banned'"),0);
   $actluingayban5=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay5."' and status = 'banned'"),0);
   $actluingayban6=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay6."' and status = 'banned'"),0);
   $bantuan=$acttodayban+$actluingayban1+$actluingayban2+$actluingayban3+$actluingayban4+$actluingayban5+$actluingayban6;
   
   $acttodaypremium=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$today."' and typeact = 'premium'"),0);
   $actluingaypremium1=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay1."' and typeact = 'premium'"),0);
   $actluingaypremium2=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay2."' and typeact = 'premium'"),0);
   $actluingaypremium3=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay3."' and typeact = 'premium'"),0);
   $actluingaypremium4=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay4."' and typeact = 'premium'"),0);
   $actluingaypremium5=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay5."' and typeact = 'premium'"),0);
   $actluingaypremium6=mysql_result(mysql_query("SELECT COUNT(*) FROM users where refid = '".$user_id."' and dateact = '".$luingay6."' and typeact = 'premium'"),0);
   $actpre=$acttodaypremium+$actluingaypremium1+$actluingaypremium2+$actluingaypremium3+$actluingaypremium4+$actluingaypremium5+$actluingaypremium6;
   $tongtiengioithieu=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."'"));
   
   
   $tongtiengioithieuttoday=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."' and dateact = '".$today."'"));
   $tongtiengioithieuttoday1=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."' and dateact = '".$luingay1."'"));
   $tongtiengioithieuttoday2=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."' and dateact = '".$luingay2."'"));
   $tongtiengioithieuttoday3=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."' and dateact = '".$luingay3."'"));
   $tongtiengioithieuttoday4=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."' and dateact = '".$luingay4."'"));
   $tongtiengioithieuttoday5=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."' and dateact = '".$luingay5."'"));
   $tongtiengioithieuttoday6=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_add_ref) AS value_sum FROM users WHERE refid = '".$user_id."' and dateact = '".$luingay6."'"));
   $tongtien=$tongtiengioithieuttoday['value_sum']
   +$tongtiengioithieuttoday1['value_sum']
   +$tongtiengioithieuttoday2['value_sum']
   +$tongtiengioithieuttoday3['value_sum']
   +$tongtiengioithieuttoday4['value_sum']
   +$tongtiengioithieuttoday5['value_sum']
   +$tongtiengioithieuttoday6['value_sum'];
   
   $tiendiemdanh=mysql_fetch_assoc(mysql_query("SELECT SUM(coin_bonus_add) AS value_sum FROM log WHERE idtacdong = '".$user_id."' and act = 'add coin_bonus diem danh'"));
   ?>
   <div>
   <div class="card float-left" style="width:300px;margin:10px;padding:10px;">
   <table><tr><td><img src="/sr/img/vi.png" height="50"/></td>
  <td>Tổng tiền kiếm được<br><strong style="color:rgb(12,186,229)"><?php echo number_format($usermain['totalearncoin']+$usermain['totalearndd']+$usermain['totalcoinday']);?> <?php echo $set['donvi'];?></strong></td></tr></table>
   </div>
   <div class="card float-left" style="width:300px;margin:10px;padding:10px;">
   <table><tr><td><img src="/sr/img/money.png" height="50"/></td>
  <td>Tổng tiền giới thiệu<br><strong style="color:rgb(12,186,229)"><?php echo number_format($tongtiengioithieu['value_sum']);?> <?php echo $set['donvi'];?></strong></td></tr></table>
   </div>
   
    <div class="card float-left" style="width:300px;margin:10px;padding:10px;">
   <table><tr><td><img src="/sr/img/avt.png" height="50"/></td>
  <td>Tổng thành viên đã kích hoạt<br><strong style="color:rgb(12,186,229)"><?php echo $alluser;?></strong></td></tr></table>
   </div>
    <div class="card float-left" style="width:300px;margin:10px;padding:10px;">
   <table><tr><td><img src="/sr/img/money2.png" height="50"/></td>
  <td>Tổng tiền kích hoạt tuần này<br><strong style="color:rgb(12,186,229)"><? echo number_format($tongtien);?> <?php echo $set['donvi'];?></strong></td></tr></table>
   </div>
    <div class="card float-left" style="width:300px;margin:10px;padding:10px;">
   <table><tr><td><img src="/sr/img/vi.png" height="50"/></td>
  <td>Tổng tiền điểm danh<br><strong style="color:rgb(12,186,229)"><?php echo number_format($tiendiemdanh['value_sum']);?> <?php echo $set['donvi'];?></strong></td></tr></table>
   </div>
    <div class="card float-left" style="width:300px;margin:10px;padding:10px;">
   <table><tr><td><img src="/sr/img/vi.png" height="50"/></td>
  <td>Thành viên mới kích hoạt tuần này<br><strong style="color:rgb(12,186,229)"><? echo $kichhoat6ngay;?></strong></td></tr></table>
   </div>
   
   </div>
   <div style="clear:both;"></div>
   <h5 style="color:orange">Tổng chi tiết tiền giới thiệu tuần này</h5>
   <div class="table-responsive"><table class="table table-bordere table-sm">
    <thead>
      <tr style="background-color:rgb(230,230,230);color:rgb(112,48,160)">
        <th>Ngày tham gia</th>
        <th>Tổng CTV</th>
		<th>Đã kích hoạt</th>
		<th>Chưa kích hoạt</th>
		<th>CTV bị khóa</th>
		<th>Tổng tiền</th>
		
      </tr>
    </thead>
    <tbody>
	<tr style="background-color:white;font-weight:normal;">
        <th>Tuần này</th>
        <th style="color:orange"><? echo $reg6ngay;?></th>
		<th style="color:rgb(12,186,229)"><? echo $kichhoat6ngay;?></th>
		<th style="color:red"><? echo $chuakich;?></th>
		<th style="color:red"><? echo $bantuan;?></th>
		<th style="color:green"><? echo number_format($tongtien);?> <?php echo $set['donvi'];?></th>
		
      </tr>
	</tbody>
	</table></div>
   
   <div class="row">
<div class="col-sm"><h5>Biểu đồ</h5>
  
   
<style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
	</style>
		<canvas id="canvas"></canvas>

	<script>
		var config = {
			type: 'line',
			data: {
				labels: ['<? echo $luingay6;?>', '<? echo $luingay5;?>', '<? echo $luingay4;?>', '<? echo $luingay3;?>', '<? echo $luingay2;?>', '<? echo $luingay1;?>', '<? echo $today;?>'],
				datasets: [{
					label: 'Tài khoản kích hoạt',
					borderColor: window.chartColors.blue,
					backgroundColor: window.chartColors.blue,
					data: [
						<? echo $actluingay6;?>,
						<? echo $actluingay5;?>,
						<? echo $actluingay4;?>,
						<? echo $actluingay3;?>,
						<? echo $actluingay2;?>,
						<? echo $actluingay1;?>,
						<? echo $acttoday;?>
					],
					fill: false,
				}, {
					label: 'Tài khoản đăng ký',
					borderColor: window.chartColors.red,
					backgroundColor: window.chartColors.red,
					data: [
						<? echo $regluingay6;?>,
						<? echo $regluingay5;?>,
						<? echo $regluingay4;?>,
						<? echo $regluingay3;?>,
						<? echo $regluingay2;?>,
						<? echo $regluingay1;?>,
						<? echo $regtoday;?>
					],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Số lượng tài khoản đăng ký và kích hoạt theo ID: <? echo $user_id;?>'
				},
				tooltips: {
					mode: 'index',
					callbacks: {
						// Use the footer callback to display the sum of the items showing in the tooltip
						footer: function(tooltipItems, data) {
							var sum = 0;

							tooltipItems.forEach(function(tooltipItem) {
								sum += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
							});
							return 'Sum: ' + sum;
						},
					},
					footerFontStyle: 'normal'
				},
				hover: {
					mode: 'index',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							show: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							show: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
	</script>
	<div>
	<a class="btn btn-light btn-sm" href="">7 ngày qua</a>
	</div>
</div>
<div class="col-sm">
</div>
</div>

<h5>Danh sách tài khoản đã giới thiệu</h5>
<div class="table-responsive"><table class="table table-bordere table-sm">
    <thead>
      <tr style="background-color:rgb(230,230,230);">
        <th>ID Number</th>
        <th>Tên CTV</th>
		<th>Trạng thái</th>
		<th>Thời gian đăng ký</th>
		<th>Thời gian kích hoạt</th>
		<th>Kích hoạt</th>
		<th>Tiền</th>
		
      </tr>
    </thead>
    <tbody>
      
      
   
  
  
     <?php
	 $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `refid` = '".$user_id."'"), 0);
	 $req=mysql_query("SELECT * FROM `users` WHERE `refid` = '".$user_id."' ORDER BY `datereg` DESC LIMIT $start,$kmess");
	 $i=1;
	 while($res=mysql_fetch_assoc($req)) {
		 ?>
		 <tr style="background-color:#F2f2f2">
        <td><?php echo $res['id'];?></td>
        <td><?php echo $res['name'];?></td>
		<td <? echo ($res['status']=='pending' ? ' style="color:red">Chờ kích hoạt' : '');?>
		<? echo ($res['status']=='actived' ? ' style="color:green">Đã kích hoạt' : '');?>
		<? echo ($res['status']=='banned' ? ' style="color:black">Đã Ban' : '');?>
		<? echo ($res['status']=='notauth' ? ' style="color:blue">Chưa xác thực' : '');?>
		</td>
		<td><?php echo date("H:i:s - d/m/Y",$res['datereg']+$set['timeshift']*3600);?></td>
		<td><?php echo date("H:i:s - d/m/Y",$res['timeactive']+$set['timeshift']*3600);?></td>
		<td><?php echo $res['typeact'];?></td>
		<td>+<?php 
		if($res['coin_add_ref']==0) {
		echo '<span style="color:red">'.number_format($res['coin_add_ref']).' '.$set['donvi'].'</span>';
		} else {
		echo '<span style="color:green">'.number_format($res['coin_add_ref']).' '.$set['donvi'].'</span>';
		}
		
		
		?> <?php echo $set['donvi'];?></td>
		
      </tr>
		
		 
		 <?php
	 $i++; }
	 
	 ?>  </tbody>
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
  <div style="clear:both;"></div>