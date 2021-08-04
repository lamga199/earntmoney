 <div class="container-fluid" style="font-size:15px;">

<h5>Biểu đồ</h5>
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
   $acttoday=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".$today."'"),0);
   $actluingay1=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".$luingay1."'"),0);
   $actluingay2=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".$luingay2."'"),0);
   $actluingay3=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".$luingay3."'"),0);
   $actluingay4=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".$luingay4."'"),0);
   $actluingay5=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".$luingay5."'"),0);
   $actluingay6=mysql_result(mysql_query("SELECT COUNT(*) FROM users where dateact = '".$luingay6."'"),0);
   
   $regtoday=mysql_result(mysql_query("SELECT COUNT(*) FROM users where regdate = '".$today."'"),0);
   $regluingay1=mysql_result(mysql_query("SELECT COUNT(*) FROM users where regdate = '".$luingay1."'"),0);
   $regluingay2=mysql_result(mysql_query("SELECT COUNT(*) FROM users where regdate = '".$luingay2."'"),0);
   $regluingay3=mysql_result(mysql_query("SELECT COUNT(*) FROM users where regdate = '".$luingay3."'"),0);
   $regluingay4=mysql_result(mysql_query("SELECT COUNT(*) FROM users where regdate = '".$luingay4."'"),0);
   $regluingay5=mysql_result(mysql_query("SELECT COUNT(*) FROM users where regdate = '".$luingay5."'"),0);
   $regluingay6=mysql_result(mysql_query("SELECT COUNT(*) FROM users where regdate = '".$luingay6."'"),0);
   ?>
   
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
					text: 'Biểu đồ số lượng tài khoản kích hoạt'
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
</div>