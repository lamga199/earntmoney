<?php
define('_IN_JOHNCMS', 1);
$headmod = 'news';
$textl='News';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else { ?>
<?
require('header.php');
mysql_query("UPDATE `news` SET `read` = '1' WHERE `id` = '".$id."' AND `user` = '".$user_id."'");
	?>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#fff;color:#000">
<div style="background:#5882FA;color:#fff;width:120px;padding:5px;margin:auto">News</div>
</div>	<div style="background:#fff;text-align:left;;padding:10px; color:#000;">
<?php
if(isset($_POST['submit'])) {
	$name = isset($_POST['hoten']) ? functions::checkin(mb_substr(trim($_POST['hoten']), 0, 100)) : '';
	$mibile = isset($_POST['sdt']) ? functions::checkin(mb_substr(trim($_POST['sdt']), 0, 20)) : '';
	$namsinh = isset($_POST['namsinh']) ? intval($_POST['namsinh']) : 0;
	$paypal = isset($_POST['paypal']) ? functions::checkin(mb_substr(trim($_POST['paypal']), 0, 100)) : '';
	$live = isset($_POST['live']) ? functions::checkin(mb_substr(trim($_POST['live']), 0, 100)) : '';
	$bank = isset($_POST['bank']) ? functions::checkin(mb_substr(trim($_POST['bank']), 0, 100)) : '';
	$stk = isset($_POST['stk']) ? functions::checkin(mb_substr(trim($_POST['stk']), 0, 20)) : '';
	$namebank = isset($_POST['namebank']) ? functions::checkin(mb_substr(trim($_POST['namebank']), 0, 100)) : '';
	if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $error[] = 'Full names exceed 100 characters';
	}
	if (mb_strlen($mibile) < 9 || mb_strlen($mibile) > 15) {
            $error[] = 'Phone number is incorrect';
	}
	if ($namsinh < 1960 || $namsinh>=2020) {
            $error[] = 'Year of birth is incorrect';
	}
	if (mb_strlen($live) < 0 || mb_strlen($live) > 100) {
            $error[] = 'Address up to 100 characters';
	}
	if (mb_strlen($bank) < 0 || mb_strlen($bank) > 100) {
            $error[] = 'Your bank account is required, up to 100 characters';
	}
	if (mb_strlen($stk) < 0 || mb_strlen($stk) > 100) {
            $error[] = 'Your bank account is required, up to 100 characters';
	}
	if (mb_strlen($namebank) < 0 || mb_strlen($namebank) > 100) {
            $error[] = 'Your bank account is required, up to 100 characters';
	}
	if (mb_strlen($paypal) < 0 || mb_strlen($paypal) > 100) {
            $error[] = 'Paypal is only from 0 to 100 characters';
	}
	if (!$error) {
		mysql_query("UPDATE users SET
		imname = '".mysql_real_escape_string($name)."',
		mibile = '".mysql_real_escape_string($mibile)."',
		paypal = '".mysql_real_escape_string($paypal)."',
		yearofbirth = '".mysql_real_escape_string($namsinh)."',
		live = '".mysql_real_escape_string($live)."',
		bank = '".mysql_real_escape_string($bank)."',
		stk = '".mysql_real_escape_string($stk)."',
		namebank = '".mysql_real_escape_string($namebank)."',
		changebank = 1
		WHERE id = '".$user_id."'");
		?>
		<div class="alert alert-success" role="alert">
		Successful account information update! <a href="/account.php">Reload to see new information</a>
		</div>
		
		<?php
	} else { ?>
	
	<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php
}
}
?>






<div >
<style>
.form-control {
height:30px;border:1px solid #999; border-radius:5px;	width:98%;padding:5px;
}
.memnutab {background:#F2F2F2;padding:5px;margin:4px}
</style>
<?
if($id) {
$news=mysql_fetch_assoc(mysql_query("SELECT * FROM `news` WHERE `id` = '".$id."'"));

?>
<h3 style="color:blue; text-align:center"><? echo $news['name'];?></h3>
      
	  <div style="padding:5px;">
	  Poster: admin - Date: <? echo date("H:i - d/m/Y",$news['time']);?><br>Content: 
	  
   <? echo functions::checkout($news['text'],1); ?>
</div>
<div style="border:1px solid grey;padding:5px;margin:7px;">
	<? if($usermain['rights']>=9) {?>

	  <?
	  if(isset($_POST['save'])) {
		  $option=trim($_POST['option']);
		  $type=trim($_POST['type']);
		  $name = isset($_POST['name']) ? functions::checkin(mb_substr(trim($_POST['name']), 0, 200)) : '';
	$text = isset($_POST['text']) ? functions::checkin(mb_substr(trim($_POST['text']), 0, 1000)) : '';
	if(empty($name) || empty($text)) {
		  $error[]='Empty content or name';
	  }
	  if(empty($error)) {
		  mysql_query("UPDATE `news` SET `show` = '".$option."',
`type` = '".$type."',
`name` = '".mysql_real_escape_string($name)."',
`text` = '".mysql_real_escape_string($text)."',
`time` = '".time()."' WHERE `id` = '".$id."'");
	  }
		  echo '<div style="color:green">update success</div>'; 
		  header('location: /news.php?id='.$id.'');
	  }
	  if(isset($_POST['delete'])) {
		  mysql_query("DELETE FROM `news` WHERE `id` = '".$news['id']."'");
		  header('location: /news.php');
	  }
	  ?>
	  <form method="post">
	  <select name="option">
	  <option value="on">Show news</option>
	  <option value="off">Hide news</option>
	  </select><select name="type">
	  <option <? echo ($news['type']=='promotion' ? 'selected="selected"' : '');?> value="promotion">promotion</option>
	  <option <? echo ($news['type']=='news' ? 'selected="selected"' : '');?> value="news">news</option>
	  </select><br>
	  <input type="text" name="name" value="<? echo $news['name'];?>" style="width:99%;border:1px solid #999;height:25px;"/><br>
	  Content: <br><textarea name="text" style="width:99%;border:1px solid #999;height:55px;"><? echo $news['text'];?></textarea>
	  
	  <input name="save" type="submit" style="padding:2px;margin:2px;background:green;color:#fff;height:20px" value="SAVE"/>
	  <input name="delete" type="submit" style="padding:2px;margin:2px;background:red;color:#fff;height:20px" value="DELETE"/>
	  </form>
	  <? }?>
	  </div>
	  
<h4 class="memnutab">Other news</h4>
<?
$newo=mysql_query("SELECT * FROM `news` WHERE `id` != '".$news['id']."' AND `type` != 'note' AND `show` = 'on' ORDER BY RAND() LIMIT 5");
while($new=mysql_fetch_assoc($newo)) {
	?>
	<div style="padding:3px;margin-bottom:3px;border-bottom:1px dotted #999;"><a style="" href="/news.php?id=<?echo $new['id'];?>"><?echo $new['name'];?></a></div>
	
	<?
	
}
} else {
	?>
<h4 class="memnutab">All news</h4>
<?
$total=mysql_result(mysql_query("SELECT * FROM `news` WHERE `show` = 'on' AND `type` != 'note'"),0);
$newo=mysql_query("SELECT * FROM `news` WHERE `id` != '".$news['id']."' AND `type` != 'note' AND `show` = 'on' ORDER BY `id` DESC LIMIT $start, $kmess");
while($new=mysql_fetch_assoc($newo)) {
	?>
	<div style="padding:3px;margin-bottom:3px;border-bottom:1px dotted #999;"><a style="" href="/news.php?id=<?echo $new['id'];?>"><?echo $new['name'];?></a> <i>(<? echo date("H:i d/m/Y",$new['time']);?>)</i> </div>
	
	<?
	
}	
?>

   <?php
  if ($total > $kmess) {
	  ?><div class="">
	   <div class="form-group mb-2">
	   <div class="text-left" style="font-size:20px;padding:10px;"><?php echo functions::display_pagination('?', $start, $total, $kmess);?></div>
	   </div>
</div>
<? } ?>
<?	
}

?>
<h4 class="memnutab">Support</h4>

<div><i class="text-muted">The default information can not be changed, any comments please report to the admin via <a style="color:orange" href="/report.php">report page</a></i></div>

  </div>
  
</div>
<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>
