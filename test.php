<?php
$act=$_GET['act'];
switch($act) {
	
	default:
	?>
	<form action="test.php?act=game" method="post">
<input name="text"/>
<input type="submit" name="submit"/>
</form>
	<?
	
	break;
	case 'game':
	session_start();
	$text=isset($_POST['text']) ? $_POST['text'] : '';
	echo $text;
	
	$_SESSION['game']=$text;
	if($_POST['submitok']) {
	$text=isset($_POST['text']) ? $_POST['text'] : '';
	echo $text;
	} else {
		?>
		<form method="post">
<input type="submit" name="submitok"/>
<input type="text" name="text" value="<?php echo $text;?>"/>
</form>
<?
		
	}
	
	break;
}


?>