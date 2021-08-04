<?php
define('_IN_JOHNCMS', 1);
require('incfiles/core.php');
// check lượt xemecho "<pre>";print_r($set);echo "</pre>";exit();


if($login) {
	// cộng lượt view
	
	// kiểm tra có lượt xem không cho nhận tiền trong 20 giây xem xong
	$video=mysql_fetch_assoc(mysql_query("SELECT * FROM `video` WHERE `id` = '".$id."' AND `show` = 'on'"));
	mysql_query("UPDATE `video` SET `view` = `view` + 1 WHERE `id` = '".$id."'");
	if($video['id']) {
	$lastvideo=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_view` WHERE `vidid` = '".$video['id']."' AND `userid` = '".$user_id."' AND `status` = 'pending' AND '".time()."' > `time` + '".$video['long']."'  ORDER BY `time` DESC LIMIT 1"));
	$count_viewvideo_for_user=mysql_fetch_assoc(mysql_query("SELECT count(*) FROM `video_view` WHERE `vidid` = ".$video['id']." AND `userid` = ".$user_id." and `status`='paid' ORDER BY `vidid` DESC "));
	


	if($lastvideo['id']) {
		
		$checkcount=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$video['id']."' AND `userid` = '".$user_id."'")); 
		
		$usermain=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$user_id."'"));
		if($usermain['status']=='pending') {
			$luotxem=$set['maxvideopending'];
			$toida=$set['video1daypending'];
			
		}
		if($usermain['status']=='actived') {
			$luotxem=$set['maxvideoact'];
			$toida=$set['video1dayact'];
			
		}
		if($count_viewvideo_for_user['count(*)']>=$luotxem || $usermain['videoviewday']>=$toida) {
		
			?>
		<script>alert("Over turns!");
		document.location="/video.php";
		</script>
		<?
			
		} else {
		mysql_query("UPDATE `video_view` SET
		`status` = 'paid',
		`earned` = '".$video['cash']."',
		`timepaid` = '".time()."'
		WHERE `id` = '".$lastvideo['id']."'");
		// cộng tiền cho `video`
		mysql_query("UPDATE `video` SET `payed` = `payed` + '".$video['cash']."' WHERE `id` = '".$id."'");
		mysql_query("UPDATE `users` SET `videocoin` = `videocoin` + '".$video['cash']."' WHERE `id` = '".$user_id."'");
		//
		$checklog=mysql_result(mysql_query("SELECT COUNT(*) FROM `video_log` WHERE `videoid` = '".$video['id']."' AND `userid` = '".$user_id."'"),0);
		if($checklog<1) {
			mysql_query("INSERT INTO `video_log` SET
			`userid` = '".$user_id."',
			`videoid` = '".$video['id']."',
			`count` = '1',
			`earned` = '".$video['cash']."'");
		} else {
			
			mysql_query("UPDATE `video_log` SET
		`count` = `count` + 1,
		`earned` = `earned` + '".$video['cash']."'
		WHERE `videoid` = '".$video['id']."' AND `userid` = '".$user_id."'");
		}
		/* Update lượt view ngày sau khi xem xong video và nhận tiền*/
		mysql_query("UPDATE `users` SET `videoviewday` = `videoviewday` + 1 WHERE `id` = '".$user_id."'");
			// ghi log
	$reportlog='user: '.$user_id.' view done and get money: '.number_format($video['cash']).' from video id:
	'.$video['id'].' name: '.$video['name'].'.';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'getmoneyvideo',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$video['cash']."',
			log = '".$reportlog."',
			box = '".$user_id."',
			`note` = '".$video['id']."'");
			
		?>
		<script>
		document.location="/video.php";
		</script>
		
		<?
		//header('location: '.$video['channel'].'');
		}
	} else {
		?>
		<script>alert("Video not true or longtime get cash over 20sec!"); document.location="/video.php";
		</script>
		<?
		//header('location: /');
		
	}
	} else {
		// ghi log
	$reportlog='user: '.$user_id.' have action bug video earn money';
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'bugvideo',
			idtacdong = '".$user_id."',
			coin_bonus_add = '0',
			log = '".$reportlog."',
			`note` = '".$id."',
			box = '".$user_id."'");
		?>
		<script>alert("Video not real!"); document.location="/video.php";
		</script>
		<?
		//header('location: /');
	}
	
}
