<?php

/**
 * Cộng điểm cho user khi ngày 5 tài khoản kích hoạt thành công, chạy lúc 23:00 mỗi ngày. 1 lần duy nhất + reset tất cả đếm kích hoạt ngày về 0.
 */
 // set ngoài thời gian thì không truy cập được link này 23 giờ 59 phút.

$conn=mysql_connect("localhost","earntmoney","963852") or die("Can not connect");
mysql_select_db("earntmoney",$conn);
mysql_query("SET NAMES 'utf8mb4'", $conn);


$res=mysql_query("SELECT * FROM `users` where f1 > 0 ORDER BY `f1` DESC");
while($req=mysql_fetch_assoc($res)) {
   //mysql_query("UPDATE users SET f1 = '".$count."' WHERE id = '".$req['id']."'");
echo ''.$req['id'].': have '.$req['f1'].'<br>';
}




