<?php
define('_IN_JOHNCMS', 1);
require('incfiles/core.php');
// tính giờ video bắt đầu
if($login) {
	// thêm giờ xem video
	mysql_query("INSERT INTO `video_view` SET
	`vidid` = '".$id."',
	`userid` = '".$user_id."',
	`time` = '".time()."'");
	//mysql_query("UPDATE `users` SET `videoviewday` = `videoviewday` + 1 WHERE `id` = '".$user_id."'");
}
