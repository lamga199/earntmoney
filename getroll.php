<?php
define('_IN_JOHNCMS', 1);
require('incfiles/core.php');
// check lượt xem
if($login) {
	$usermain=mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '".$user_id."'"));
	
	
	if($usermain['luotquay']>0) {
		mysql_query("UPDATE `users` SET `luotquay` = `luotquay` -1 WHERE `id` = '".$user_id."'");
	}
	if($usermain['luotquay']<=0 && $usermain['coin']>=$set['tienquay']) {
	mysql_query("UPDATE `users` SET `coin` = `coin` - ".$set['tienquay']." WHERE `id` = '".$user_id."'");
	}
	if($usermain['luotquay']<=0 && $usermain['coin']<$set['tienquay']) {
	header('location: /');
	}
if($id==1) {
	$timeexp=time()+25200;
	mysql_query("UPDATE `users` SET `coin` = `coin` + 1000 WHERE `id` = '".$user_id."'");
	 $textnote='Congratulations, You get <span style="color:green">1,000đ</span> on the main account. when you shoot lucky';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$user_id."'");
	// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'received gift 1K',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$coinday."',
			log = 'User: ".$usermain['id']." roll gift 1: main cash + 1K, luotquay - 1',
			box = '".$user_id."',
			boxid = '".$newid."',
			`status` = 'done'
			");
}if($id==2) {
	$timeexp=time()+25200;
	mysql_query("INSERT INTO `gift` SET
	`userid` = '".$user_id."',
	`gift` = '2',
	`name` = 'Up 5% attendance',
	`time` = '".time()."',
	`exp` = '".$timeexp."',
	`show` = 'on',
	`status` = 'new'");
	$newid=mysql_insert_id();
	// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'roll gift',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$coinday."',
			log = 'User: ".$usermain['id']." roll gift 2: up 5% diemdanh, luotquay - 1',
			box = '".$user_id."',
			boxid = '".$newid."',
			`status` = 'new'
			");
			
			
			
			
}if($id==3) {
	$timeexp=time()+25200;
	mysql_query("INSERT INTO `gift` SET
	`userid` = '".$user_id."',
	`gift` = '3',
	`name` = 'Up 10% attendance',
	`time` = '".time()."',
	`exp` = '".$timeexp."',
	`show` = 'on',
	`status` = 'new'");
	$newid=mysql_insert_id();
	// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'roll gift',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$coinday."',
			log = 'User: ".$usermain['id']." roll gift 3: up 10% diemdanh, luotquay - 1',
			box = '".$user_id."',
			boxid = '".$newid."',
			`status` = 'new'
			");
			
			
}if($id==4) {
	$timeexp=time()+25200;
	mysql_query("INSERT INTO `gift` SET
	`userid` = '".$user_id."',
	`gift` = '4',
	`name` = 'Card mobile 10K',
	`time` = '".time()."',
	`exp` = '".$timeexp."',
	`show` = 'on',
	`status` = 'new'");
	$newid=mysql_insert_id();
	// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'roll gift',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$coinday."',
			log = 'User: ".$usermain['id']." roll gift 4: card 10k, luotquay - 1',
			box = '".$user_id."',
			boxid = '".$newid."',
			`status` = 'new'
			");
			
			 $textnote='Congratulations, the <span style="color:green">10,00đ</span> recharge card has been sent to you. when you shoot lucky';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$user_id."'");
}if($id==5) {
	$timeexp=time()+25200;
	mysql_query("INSERT INTO `gift` SET
	`userid` = '".$user_id."',
	`gift` = '5',
	`name` = 'Card mobile 50K',
	`time` = '".time()."',
	`exp` = '".$timeexp."',
	`show` = 'on',
	`status` = 'new'");
	$newid=mysql_insert_id();
	// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'roll gift',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$coinday."',
			log = 'User: ".$usermain['id']." roll gift 5: card 50k, luotquay - 1',
			box = '".$user_id."',
			boxid = '".$newid."',
			`status` = 'new'
			");
			
			
			 $textnote='Congratulations, the <span style="color:green">50,00đ</span> recharge card has been sent to you. when you shoot lucky';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$user_id."'");
			
}if($id==6) {
	$timeexp=time()+25200;
	mysql_query("INSERT INTO `gift` SET
	`userid` = '".$user_id."',
	`gift` = '6',
	`name` = 'Card mobile 100K',
	`time` = '".time()."',
	`exp` = '".$timeexp."',
	`show` = 'on',
	`status` = 'new'");
	
	$newid=mysql_insert_id();
	// ghi log
			mysql_query("INSERT INTO log SET
			time = '".time()."',
			act = 'roll gift',
			idtacdong = '".$user_id."',
			coin_bonus_add = '".$coinday."',
			log = 'User: ".$usermain['id']." roll gift 6: card 100k, luotquay - 1',
			box = '".$user_id."',
			boxid = '".$newid."',
			`status` = 'new'
			");
			
			 $textnote='Congratulations, the <span style="color:green">100,00đ</span> recharge card has been sent to you. when you shoot lucky';
		mysql_query("INSERT INTO news SET
			time = '".time()."',
			color = '#A901DB',
			`type` = 'note',
			`text` = '".mysql_real_escape_string($textnote)."',
			`show` = 'on',
			`read` = '0',
			`user` = '".$user_id."'");
}
	
		
		//header('location: /');
	
	
}
