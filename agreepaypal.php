<?php
session_start();
if(isset($_POST['ok'])) {

	
	header('location: /paypal.php?act=sale&ok=agree');

}
if(isset($_POST['no'])) {
	
	header('location: /paypal.php?act=sale&ok=refuse');

}

?>
<!DOCTYPE html>
<head>
<html lang="en">
	<title><?php echo $textl; ?></title>
	<link rel="icon" type="image/png" href="/sr/img/favicon.png"/>
	<meta name="theme-color" content="#23a86b">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="">
    <meta name="format-detection" content="telephone=no" /></head>
	<body style="background:#f2f2f2">
<div style="max-width:100%;width:960px;margin:0 auto;text-align:left;">




<div style="width:100%;background:#3104B4;">
<img src="/img/Picture1.png" height="50"/>

</div>
<div style="width:100%;background:#3104B4;border-top:1px solid #2E9AFE">
<table style="padding-left:50px;"><tr><td><img src="/img/Picture2.png" height="50"/></td>
<td>
<span style="max-width:60%;color:white">THỎA THUẬN NGƯỜI DÙNG PAYPAL<br>
Giới thiệu về tài khoản của bạn</span></td></tr></table>
</div>
<div style="max-width:100%;width:70%;;margin:0 auto;">
	      Thỏa thuận người dùng này sẽ có hiệu lực với tất cả người dùng kể từ ngày 31 tháng 10 năm 2020.												
													
<h4>CHÀO MỪNG BẠN ĐẾN VỚI EARNTMONEY		</h4>											
													
          Thỏa thuận người dùng này là hợp đồng giữa bạn và PayPal Pte. Ltd., một công ty Singapore chi phối việc sử dụng của bạn đối với tài													
             khoản PayPal của bạn và các dịch vụ PayPal. Nếu bạn là một cá nhân, bạn phải là cư dân của một trong những quốc gia/khu vực được													
          liệt  kê trên trang <b style="color:blue">PayPal trên toàn thế giới </b>và ít nhất 18 tuổi hoặc đủ tuổi trưởng thành tại quốc gia/khu vực cư trú của bạn để mở tài 													
         khoản PayPal và sử dụng dịch vụ PayPal. Nếu bạn là doanh nghiệp, doanh nghiệp phải được tổ chức, hoạt động hoặc cư dân tại một													
                            trong những quốc gia/khu vực được liệt kê trên trang <b style="color:blue">Paypal trên toàn thế giới</b> của PayPal để mở tài khoản PayPal và sử dụng dịch vụ PayPal.													
												<br>	
													
                                <b>  Giới thiệu về hoạt động kinh doanh chính của chúng tôi	</b></br>												
													
                          EarntMoney là bên cung cấp dịch vụ mua cho tặng bán PayPal và hoạt động như vậy bằng cách tạo, lưu trữ, duy trì và cung cấp dịch vụ PayPal của chúng													
                          tôi cho bạn thông qua internet. Các dịch vụ của chúng tôi cho phép bạn gửi thanh toán cho bất kỳ ai có tài khoản PayPal và nhận thanh toán													
													
          Dịch vụ PayPal do PayPal Pte. Ltd. cung cấp.													
													
	      <h4> Tư vấn tiêu dùng — PayPal Pte. Ltd., chủ sở hữu phương tiện giá trị lưu trữ của PayPal, không yêu cầu có sự phê duyệt của Cơ quan												
	       Quản lý Tiền tệ Singapore. Người tiêu dùng (người dùng) nên đọc kỹ các điều khoản và điều kiện.	</h4>											
													
	       Thỏa thuận người dùng này không nhằm mục đích chào bán dịch vụ PayPal và EarntMoney PayPal không nhắm mục tiêu vào bất kỳ quốc gia/khu												
	       vực hoặc thị trường nào thông qua thỏa thuận người dùng này.												

</div>

<div style="width:100%;background:#0489B1;">
<img src="/img/Picture1.png" height="50"/>

</div>
<div style="width:100%;background:#0489B1;border-top:1px solid #2E9AFE">
<table style="padding-left:50px;"><tr><td><img src="/img/Picture3.png" height="50"/></td>
<td>
<span style="max-width:60%;color:white">THỎA THUẬN NGƯỜI DÙNG PAYPAL<br>
Gửi thanh toán và mua hàng</span></td></tr></table>
</div>
<div style="margin:0 auto;background:#A9E2F3"><div style="margin:0 auto;max-width:100%;width:70%;;">
	                         <b style="color:#0489B1">CHƯƠNG TRÌNH BẢO VỆ GỬI THANH TOÁN CỦA PAYPAL EARNTMONEY		</b>									
											
											<br>
	Nếu bạn cung cấp cho chúng tôi số điện thoại di động của mình, bạn đồng ý rằng PayPal và các chi nhánh của nó có thể liên hệ với bạn										
	theo số đó bằng cách sử dụng các cuộc gọi hoặc tin nhắn văn bản được tự động quay số hoặc ghi âm trước để: (i) phục vụ các tài										
	khoản mang thương hiệu PayPal của bạn, (ii) điều tra hoặc ngăn chặn gian lận, hoặc (iii) đòi nợ. Chúng tôi sẽ không sử dụng các cuộc										
	gọi hoặc tin nhắn được tự động quay số hoặc ghi âm trước để liên hệ với bạn cho các mục đích tiếp thị trừ khi chúng tôi nhận được sự										
	đồng ý trước bằng văn bản của bạn. 	<br>									
											
	Bạn hiểu và đồng ý rằng, trong phạm vi được pháp luật cho phép, PayPal có thể, mà không cần thông báo hoặc cảnh báo thêm, theo										
	dõi hoặc ghi lại các cuộc trò chuyện qua điện thoại của bạn hoặc bất kỳ ai thay mặt bạn với PayPal hoặc các đại lý của nó cho mục đích										
	kiểm soát chất lượng và đào tạo hoặc cho chính chúng tôi sự bảo vệ. Bạn thừa nhận và hiểu rằng mặc dù thông tin liên lạc của bạn với										
	PayPal có thể bị nghe lén, theo dõi hoặc ghi âm nhưng không phải tất cả các đường dây điện thoại hoặc cuộc gọi đều có thể được										
	PayPal ghi lại và PayPal không đảm bảo rằng bản ghi âm của bất kỳ cuộc điện thoại cụ thể nào sẽ được lưu giữ hoặc truy xuất.										
											
	<br>	<b>Yêu cầu bán PayPal bằng chứng</b>	<br>									
											
	Đối với các giao dịch có tổng giá trị dưới 750 đô la Mỹ (hoặc ngưỡng đơn vị tiền tệ tương ứng), xác nhận có thể xem trực										
	tuyến và bao gồm địa chỉ giao hàng hiển thị ít nhất thành phố / tiểu bang hoặc mã zip, ngày giao hàng và danh tính của người giao										
	hàng công ty bạn đã sử dụng.		<br>									
											
	Đối với các giao dịch có tổng giá trị từ $ 750 đô la Mỹ (hoặc ngưỡng tiền tệ tương ứng giá trị 750$) trở lên, bạn phải cung cấp chữ ký										
	xác nhận giao hàng. Nếu giao dịch bằng đơn vị tiền tệ bằng howjc lớn hơn, thì cần phải có xác nhận chữ ký khi khoản thanh toán vượt 										
	quá $ 750 USD tương đương với tỷ giá hối đoái PayPal áp dụng tại thời điểm giao dịch được xử lý.	<br>										
											

</div>
</div>


<div style="width:100%;background:#AC58FA;color:white">
<img src="/img/Picture1.png" height="50"/>
Sự thỏa thuận của người dùng
</div>
<div style="width:100%;background:#AC58FA;border-top:1px solid #2E9AFE">
<table style="padding-left:50px;color:white;"><tr><td><img src="/img/Picture4.png" height="50"/> </td>
<td>
<span style="max-width:60%;color:white"><br>
Bán và chấp nhận thanh toán</span></td></tr></table>
</div>
<div style="margin:0 auto;background:#D0A9F5"><div style="margin:0 auto;max-width:100%;width:70%;;">
	                                          <center><font style="color:white">CHƯƠNG TRÌNH BẢO VỆ GỬI THANH TOÁN CỦA PAYPAL EARNTMONEY	</font></center><br>													
														
														
	Nếu bạn bán thứ gì đó cho người mua và giao dịch sau đó bị tranh chấp hoặc bị đảo ngược trong mục.<b style="color:blue"> Đảo ngược, Khiếu nại hoặc khoản 													
	 bồi hoàn</b> ,bạn có thể đủ điều kiện để được hoàn tiền theo chương trình Bảo vệ người bán của PayPal. Khi áp dụng, chương trình Bảo vệ người bán													
	 của PayPal cho phép bạn giữ lại toàn bộ số tiền mua hàng và chúng tôi sẽ miễn mọi khoản phí bồi hoàn liên quan đã trả (đối với các giao dịch 													
	được tài trợ bằng thẻ ghi nợ và thẻ tín dụng). Không có giới hạn về số lần thanh toán mà bạn có thể nhận được bảo hiểm. Bằng cách truy cập 													
	trang chi tiết giao dịch trong tài khoản PayPal, bạn có thể xác định xem giao dịch của mình có đủ điều kiện để được bảo vệ theo chương trình													
	này hay không.													
							<br>							
	Chương trình Bảo vệ người bán của PayPal có thể áp dụng khi người mua tuyên bố rằng:<br>													
														
	Họ đã không ủy quyền hoặc hưởng lợi từ các khoản tiền được gửi từ tài khoản PayPal của họ  và Giao dịch trái phép xảy ra trong môi trường do Paypal lưu trữ; 													
	hoặc là Họ không nhận được hàng từ bạn (được gọi là khiếu nại “ Không nhận được hàng ”).													
	Chương trình Bảo vệ người bán của PayPal cũng có thể áp dụng khi giao dịch bị đảo ngược do người mua hoàn lại tiền thành công hoặc													
	khi khoản thanh toán được ngân hàng tài trợ bị ngân hàng của người mua hoàn lại.													
														
										
											

</div>
</div>


<div style="width:100%;background:#FA5858;color:white">
<img src="/img/Picture1.png" height="50"/>
Sự thỏa thuận của người dùng
</div>
<div style="width:100%;background:#FA5858;border-top:1px solid #999">
<table style="padding-left:50px;color:white;"><tr><td><img src="/img/Picture5.png" height="50"/> </td>
<td>
<span style="max-width:60%;color:white">THỎA THUẬN NGƯỜI DÙNG PAYPAL<br>
Bán và chấp nhận thanh toán</span></td></tr></table>
</div>
<div style="margin:0 auto;background:#F8E0E0"><div style="margin:0 auto;max-width:100%;width:70%;;">
	                                          <center><font style="color:#FA5858">CÁC HÀNH ĐỘNG MÀ CHÚNG TÔI CÓ THỂ THỰC HIỆN NẾU BẠN THAM GIA VÀO BẤT KỲ HOẠT ĐỘNG BỊ HẠN CHẾ NÀO													
</font></center><br>													
														
														
	<B STYLE="COLOR:#A901DB">I. NGUỒN PAYPAL	</B></BR>												
													
Chúng tôi  không chấp nhận các giao dịch PayPal kiếm được từ Website vi phạm bản quyền, <i style="color:red">Lấy từ người khác ,đánh cắp tài khoản, Lừa đảo, Tiền PayPal thu được từ nội dung 18+,													
các giao dịch trái phép, tài khoản đã bị PayPal đánh giới hạn hoặc đưa vào danh sách đen</i> để theo dõi <i>"tài khoản có thể bị khóa bất kỳ lúc nào"</i>.													
Nguồn PayPal mà bạn có được cần phải minh bạch rõ ràng, như từ các công ty trả thưởng, từ việc kinh doanh bán hàng hóa của bạn kiếm được trên <i>Amazon, Alibaba, DHGate...	</i>												
hoặc nguồn tiền PayPal của bạn kiếm được từ các nhà<i> quảng cáo, dịch vụ, tài trợ... </i>													
													
	<br><B STYLE="COLOR:#A901DB">II. HOW TO TRANSACTION		</B></BR>															
<li>1. <i>Khi giao dịch bán PayPal bạn sẽ cần phải chụp lại 10 giao dịch ngần nhất gửi ảnh<img src="https://i.imgur.com/k8EhLEp.png/"> ở đây trong tùy chọn hướng dẫn này 										bạn có thể nhìn thấy ở bước chọn giao dịch dưới 50$ hoặc từ				
50$ trở lên.</i></li>														
<li>2.  <i>Đối với các giao dịch dưới <font style="color:orange">50$</font> chọn nút <b>Pay</b><b style="color:blue">Pal</b> màu <b style="color:orange">Vàng</b> để bán cho chúng tôi 		<img src="/img/Picture6.png" height="20"/>							      Các lựa chọn khác <b> EarntMoney</b> sẽ không chấp nhận				
thanh toán và bạn sẽ không nhận được bất kỳ khoản bồi hoàn nào.													
</i></li>
													
	<li>3. Đối với các giao dịch từ <font style="color:blue">50$</font> trở lên hãy chọn nút<b> PayPal </b>màu <b style="color:blue">Xanh</b> để bán cho chúng tôi 		<img src="/img/Picture7.png" height="20"/>                    Số dư PayPal của bạn sẽ được EarntMoney hoàn trả  				
nếu có phát sinh lỗi từ phía chúng tôi. Điều này là trách nghiệm bắt buộc để đảm bảo oan toàn số dư tài khoản PayPal của bạn. 													
											
</i></li>													
										
		<li>Bạn cần đọc và đồng ý với tất cả các Điều khoản & Điều kiện mà chúng tôi đưa ra nếu tài khoản của bạn vi phạm chúng tôi sẽ từ chấm dứt thỏa thuận này, từ chối cung cấp các 														
dịch vụ của EarntMoney kể các các tài khoản phụ của bạn , giới hạn quyền truy cập của bạn vào các trang web, do chúng tôi hoặc tổ chức doanh nhân điều hành. Tài khoản EarntMoney hoặc														
bất kỳ dịch vụ nào của EarntMoney bao gồm cả việc giới hạn khả năng thanh toán của bạn hoặc gửi tiền bằng bất kỳ phương thức thanh toán nào được liên kết với tài khoản Earntmoney của 														
bạn,hạn chế khả năng gửi tiền hoặc rút tiền của bạn;	</li>													
														
<li>Tạm ngưng tư cách hợp lệ của bạn đối với chương trình Bảo vệ mua hàng của PayPal và / hoặc chương trình Bảo vệ người bán của PayPal;	</li>													
														
<li>Thực hiện hành động pháp lý chống lại bạn;	</li>													
														
<li>Cập nhật thông tin không chính xác mà bạn đã cung cấp cho chúng tôi;														
														
<li>Nếu bạn là người bán và bạn vi phạm Chính sách sử dụng được chấp nhận, thì ngoài việc phải tuân theo các hành động nêu trên, chúng tôi buộc đóng tài khoản EarntMoney của bạn														
hoặc chấm dứt việc sử dụng các dịch vụ EarntMoney của bạn vì bất kỳ lý do gì,chúng tôi sẽ cung cấp cho bạn thông báo về các hành động của chúng tôi và thực hiện bất kỳ khoản tiền														
trong số dư tài khoản sẽ không thể rút về tài khoản liên kết của bạn			</li>											
														
<li>®Bạn chịu trách nhiệm cho tất cả các khoản hoàn trả, khoản bồi hoàn, khiếu nại, phí, tiền phạt, tiền phạt và các trách nhiệm pháp lý khác mà PayPal, bất kỳ khách hàng PayPal nào hoặc 														
 bên thứ ba gây ra do hoặc phát sinh từ việc bạn vi phạm thỏa thuận này và / hoặc việc bạn sử dụng Dịch vụ EarntMoney.	</li>													
									
<div style="color:#333;text-align:center"><i>Chúng tôi bảo vệ tài khoản khỏi các giao dịch trái phép là tiêu chí hàng đầu trong dịch vụ EarntMoney cung cấp © EarntMoney.com All rights reserved	</i>										
<div style="padding:15px;">
<a style="color:white;padding:10px;margin:5px;border-radius:15px;background:#000" href="/">Trang chủ</a>
<input type="checkbox" onClick="check()" name="check" id="check"/>
<i>I agree with Teams & Condition of PayPal anh EarntMoney			
</i>
</div>
</div>
<script>
function check() {
 var check = document.getElementById("check").checked;
 if(check==true) {
	document.location="/paypal.php?act=sale";
}
}
</script>

</div>
</div>


<!--<form method="post">
<input type="submit" name="no" style="color:white;background:red;padding: 2 5 2 5px;text-decoration: none;border-radius:7px;" value="refuse"/>
 <input type="submit" name="ok" style="color:white;background:green;padding: 2 5 2 5px;text-decoration: none;border-radius:7px;" value="agree"/></form>
-->
</div>
</html>