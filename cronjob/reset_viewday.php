<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if(isset($_GET['token'])){
	if($_GET['token']=='18006595'){
		runNow();
	}
}

function runNow()
{
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');

//mysql_query("UPDATE `users` SET `videoviewday` = 0  WHERE `id` = 338646");
mysql_query("UPDATE `users` SET `videoviewday` = 0");
echo 123; die;
}