<?php

/**
 * Cộng điểm cho user khi ngày 5 tài khoản kích hoạt thành công, chạy lúc 23:00 mỗi ngày. 1 lần duy nhất + reset tất cả đếm kích hoạt ngày về 0.
 */
 // set ngoài thời gian thì không truy cập được link này 23 giờ 59 phút.
$db_host = 'localhost';
$db_name = 'gamegato_demo';
$db_user = 'gamegato_pet';
$db_pass = 'SO[mP$)2Z?c+';
$conn=mysql_connect($db_host,$db_user,$db_pass) or die("Can not connect");
mysql_select_db($db_name,$conn);
mysql_query("SET NAMES 'utf8mb4'", $conn);


//log
	mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'cron run',
			idtacdong = '',
			user_add_coin = '',
			log = 'cronjob auto run on server at ".date("H:i:s - d/m/Y",time())."',
			box = ''");
			echo '<div>Add to log cronjob running</div>';



//1. SET thời gian tiền danh về 0, reset tiền danh trong ngày
mysql_query("UPDATE users SET diemdanh = '0', `luotquay` = 5");
echo '<div>Update diemdanh and luot quay in users = 0</div>';

// Cộng lượt xem video ngày cho user chưa kích hoạt

$video1dayact=mysql_fetch_assoc(mysql_query("SELECT `val` FROM `cms_settings` WHERE `key` = 'video1dayact'"));
$video1daypending=mysql_fetch_assoc(mysql_query("SELECT `val` FROM `cms_settings` WHERE `key` = 'video1daypending'"));
mysql_query("UPDATE `users` SET `luotxemvideongay` = '".$video1dayact['val']."' WHERE `status` = 'pending'");
mysql_query("UPDATE `users` SET `luotxemvideongay` = '".$video1daypending['val']."' WHERE `status` = 'actived'");


echo '<div>Cộng 5 lượt xem cho user đang chờ kích hoạt</div>';
// update quà hết hạn 
mysql_query("UPDATE gift SET `status` = 'expired' WHERE `time` < '".time()."' AND `timeuse` = 0");
echo '<div>Cập nhật quà hết hạn</div>';
		$set = array();
        $req = mysql_query("SELECT * FROM `cms_settings`");
        while (($res = mysql_fetch_row($req)) !== false) $set[$res[0]] = $res[1];
		
		
		
		
		
		//2.  CỘNG tiền THƯỞNG CHO CÁC NICK REFID
        $countf1onday=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE f1onday >= '".$set['peopleactivedindaytobonusdiemdanh']."'"),0);
        echo '<div><b>COUNT member have refid > '.$set['peopleactivedindaytobonusdiemdanh'].': '.$countf1onday.'</b></div>';
		if($countf1onday>0) {
$req1=mysql_query("SELECT * FROM users WHERE f1onday >= '".$set['peopleactivedindaytobonusdiemdanh']."' ORDER BY id ASC");
while($res1=mysql_fetch_assoc($req1)) {
	$sotienthuong = ($res1['f1onday']*$set['f1coinreg'])/$set['bonus_daily'];
	mysql_query("UPDATE users SET coin_lock = coin_lock + '".$sotienthuong."', totalbonusf1 = totalbonusf1 + '".$sotienthuong."' WHERE id = '".$res1['id']."'");
	//log
	mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'bonus_member_f1',
			idtacdong = '".$res1['id']."',
			user_add_coin = '".$sotienthuong."',
			coin_lock_add = '".$sotienthuong."',
			log = 'User ID: ".$res1['id']." được thưởng tiền tuyển member kích hoạt trong ngày, tổng số: $sotienthuong tiền hoa hồng.',
			box = '".$res1['id']."'");
	// thông báo mail đã đăng ký xong
			$mail = $res1['mail'];
			$subject = "Earnmoney thưởng tiền";
			$message = "Bạn được thưởng tiền tuyển member đăng ký và kích hoạt trong cùng ngày, tổng số: $sotienthuong tiền hoa hồng.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
	echo '<div>ID: '.$res1['id'].'; F1 ACT ON DAY: '.$res1['f1onday'].'; BONUS COIN: +'.$sotienthuong.'</div>';
}
		}
		
		

// check người dùng quá 10 ngày


$countqua10=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE ".time()." > datereg + '864000' and f1 <1 and thongbaohoantien = '0' and status = 'actived' and rights = '0' and totaldd = '0' and totaldiemdanh = '0'"),0);
echo '<div><b>COUNT member 10 days no have f1: '.$countqua10.'</b></div>';
if($countqua10>0) {
$select10 = mysql_query("SELECT * FROM users WHERE ".time()." > datereg + '864000' and f1 <1 and thongbaohoantien = '0' and status = 'actived' and rights = '0' and totaldd = '0' and totaldiemdanh = '0' order by id asc");
while($skl=mysql_fetch_assoc($select10)) {
	// gửi mail thông báo
			$mail = $skl['mail'];
			$subject = "Earnmoney thông báo";
			$message = "Tài khoản của bạn đã 10 ngày không có thành viên được giới thiệu đăng ký và bất kỳ hoạt động nào, chúng tôi hoàn lại 150.000VND, phí mở tài khoản 30.000VND sẽ không được hoàn, hãy yêu cầu rút trong vòng 48 giờ kể từ thời điểm này. Tài khoản của sẽ bị thêm vào danh sách đen của công ty. Để được Hỗ trợ mở khóa tài khoản Vui lòng gửi mail đến hộp thư: Support@earntmoney.com ";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			// cộng tiền cho user
			mysql_query("UPDATE users SET coin = coin + 150000, thongbaohoantien = 1, timethongbaohoantien = '".time()."' where id = '".$skl['id']."'");
			// trừ tiền admin
			mysql_query("UPDATE users SET coin = coin - 150000 where id = '333333'");
			// thêm vào log
			mysql_query("INSERT INTO log SET
		time = '".time()."',
		act = 'hoantra200k',
		idtacdong = '".$skl['id']."',
		box = '".$skl['id']."',
		coin_add = '150000',
		log = 'ID: ".$skl['id']." được hoàn trả 150.000 cho 10 ngày chưa giới thiệu thành công thành viên. thời gian chấp nhận rút bắt đầu đếm trong vòng 48 giờ. Tài khoản admin: 333333 bị trừ 150.000 tiền'
		");
			// thêm vào banref
			mysql_query("INSERT INTO banrefid SET refid = '".$skl['id']."'");
			echo '<li>ID: '.$skl['id'].' back money 150.000</li>';
}
}

// check sau 48 giờ
$countqua48=mysql_result(mysql_query("SELECT COUNT(*) FROM users WHERE ".time()." - '172800' > timethongbaohoantien AND thongbaohoantien = '1' and status = 'actived' and rights = '0' and totaldd = '0' and totaldiemdanh = '0'"),0);
echo '<div><b>COUNT member 10 days no have f1 and after 48hours have notification: '.$countqua48.'</b></div>';
if($countqua48>0) {
$select48 = mysql_query("SELECT * FROM users WHERE ".time()." - '172800' > timethongbaohoantien AND thongbaohoantien = '1' and status = 'actived' and rights = '0' and totaldd = '0' and totaldiemdanh = '0' ORDER BY id ASC");
while($skl2=mysql_fetch_assoc($select48)) {
    if($skl2['f1_act']==0) {
	// gửi mail thông báo
			$mail = $skl2['mail'];
			$subject = "Earnmoney thông báo tài khoản bị khóa";
			$message = "Tài khoản của bạn đã bị khóa sau 48 giờ có thông báo hoàn tiền. Vui lòng liên hệ admin để mở khóa.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			$success = mail ($mail,$subject,$message,$header);
			
			// thành viên không rút tiền cộng lại tiền cho admin
			if($skl2['rutcoindone']==0) {
			mysql_query("UPDATE users SET coin = coin + 150000 where id = '333333'");
			}
			// khóa tài khoản member
			mysql_query("UPDATE users SET status = 'banned',
			coin = coin - '150000',
			thongbaohoantien = '0',
			timethongbaohoantien = '0'
			where id = '".$skl2['id']."' and rutcoindone = 0 and f1_act < 1");
			
			// thêm vào log
			mysql_query("INSERT INTO log SET
		time = '".time()."',
		act = 'memberkhongrut200',
		idtacdong = '".$skl2['id']."',
		box = '".$skl2['id']."',
		coin_add = '150000',
		log = 'ID: ".$skl2['id']." không rút 150.000 tiền, hoàn lại cho admin, tài khoản admin tăng lên 150.000'
		");
		echo '<div>ID: '.$skl2['id'].' dont get money back to admin 150.000</div>';
    }
     if($skl2['f1_act']>0) {
         
         // gửi mail thông báo
			$mail = $skl2['mail'];
			$subject = "Earnmoney thông báo tài khoản";
			$message = "Tài khoản của bạn đã dừng tiến trình khóa do có nick ref kích hoạt trong thời gian chờ 48 giờ.";
			$header  =  "From:support@earntmoney.com \r\n";
			$header .=  "Cc:support@earntmoney.com \r\n";
			//$success = mail ($mail,$subject,$message,$header);
			
			// thành viên không rút tiền cộng lại tiền cho admin
			if($skl2['rutcoindone']==0) {
			mysql_query("UPDATE users SET coin = coin + 150000 where id = '333333'");
			}
			// khóa tài khoản member
			mysql_query("UPDATE users SET 
			coin = coin - '150000',
			thongbaohoantien = '0',
			timethongbaohoantien = '0'
			where id = '".$skl2['id']."' and rutcoindone = 0 and f1_act > 0");
			
			// thêm vào log
			mysql_query("INSERT INTO log SET
		time = '".time()."',
		act = 'member stop banned 48h',
		idtacdong = '".$skl2['id']."',
		box = '".$skl2['id']."',
		coin_minus = '150000',
		log = 'ID: ".$skl2['id']." có ref kích hoạt trong thời gian chờ 48 giờ. tài khoản giảm 150000 tiền rút, tài khoản admin tăng lên 150.000'
		");
		echo '<div>ID: '.$skl2['id'].' dont get money back to admin 150.000</div>';
         
     }
    
			
}
}
//. ĐƯA F1 KÍCH HOẠT TRONG NGÀY VỀ 0 
mysql_query("UPDATE users SET f1onday = 0, countdd = 0");
echo '<div>Reset bo dem so tai khoan thanh vien gioi thieu duoc = 0; bo dem diem danh trong ngay = 0</div>';
// xóa thành viên không kích hoạt
//mysql_query("delete FROM users WHERE ".time()." - '86400' > datereg and status = 'notauth' and code_register != ''");

			
			

