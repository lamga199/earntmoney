<?php

/**
 * @package     JohnCMS
 * @link        http://johncms.com
 * @copyright   Copyright (C) 2008-2011 JohnCMS Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      http://johncms.com/about
 */

define('_IN_JOHNCMS', 1);

require('incfiles/core.php');
$referer = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : core::$system_set['homeurl'];
$headmod='exit';
if (isset($_POST['submit'])) {
    setcookie('cuid', '');
    setcookie('cups', '');
    setcookie('cubr', '');
    session_destroy();

	unset($_SESSION["fb_id"]);
	unset($_SESSION["fb_name"]);
	unset($_SESSION["fb_first_name"]);
	unset($_SESSION["fb_last_name"]);
	unset($_SESSION["fb_email"]);
	unset($_SESSION["fb_gender"]);
	unset($_SESSION["fb_avatar"]);
	unset($_SESSION["fb_birthday"]);
    header('Location: index.php');
} else {
    require('incfiles/head.php');
	require('header.php');
	?>
<div class="main">
    <div class="cmt-popup" style="text-align:center">
	
        <p>Bạn có muốn đăng xuất?</p>
        <form action="/exit.php" method="post"><p><input type="submit" style="width:150px;" class="cmt-btn cmt-auth-submit" name="submit" value="Đăng xuất" /></p></form>
        <p><a  href="<?php echo $referer;?>">Cancel</a></p>
        </div>
		<?php
	require('incfiles/end.php');
}