<?php
define('_IN_JOHNCMS', 1);
$headmod = 'news';
$textl='News';
require('../incfiles/core.php');
require('../incfiles/head.php');
if(empty($login) || $usermain['rights']<9) {
header('location: /index.php');
} else { ?>
<?
require('../header.php');

	?>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('../uinfo.php');?>
</div>
<?php require('../topmenu.php');?>
<?php

?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#fff;color:#000">
<div style="background:#5882FA;color:#fff;width:120px;padding:5px;margin:auto">Tạo tin tức</div>
</div>	<div style="background:#fff;text-align:left;;padding:10px; color:#000;">
<?php

?>






<style>
.form-control {
height:30px;border:1px solid #999; border-radius:5px;	width:98%;padding:5px;
}
.memnutab {background:#F2F2F2;padding:5px;margin:4px}
</style>
<?
$news=mysql_fetch_assoc(mysql_query("SELECT * FROM `news` WHERE `id` = '".$id."'"));

?>
<h3 style="color:blue; text-align:center"><? echo $news['name'];?></h3>
      <div >
	
<div style="border:1px solid grey;padding:5px;margin:7px;">
	<? if($usermain['rights']>=9) {?>

	  <?
	  if(isset($_POST['save'])) {
		  $option=trim($_POST['option']);
		  $type=trim($_POST['type']);
			$text=trim($_POST['text']);
			$name=trim($_POST['name']);
			$link=trim($_POST['link']);
			$namelink=trim($_POST['namelink']);
				$check1 = getimagesize($_FILES["image1"]["tmp_name"]);
		if($check1==true) {
	  $file_name1 = $_FILES['image1']['name'];
      $file_size1 =$_FILES['image1']['size'];
      $file_tmp1 =$_FILES['image1']['tmp_name'];
      $file_type1=$_FILES['image1']['type'];
      $file_ext1=strtolower(end(explode('.',$_FILES['image1']['name'])));
	  $expensions1= array("png","jpg");
		if(in_array($file_ext1,$expensions1)=== false){
         $error[]="Only accept file image.";
      }
      if ($file_size1 > 500000) {
         $error[]='The image is larger than 500Kb';
      }
	}
	  if($check1 == false) {
		  $error[]='No picture';
	  }
			
	  if(empty($text) || empty($text)) {
		  $error[]='Empty content or name';
	  }
	  if(empty($error)) {
		  		   $tenfile1=substr(str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0 , 10);
		move_uploaded_file($file_tmp1,"../sr/news/".$tenfile1.".".$file_ext1."");
		  $thang=date("m",time());
		  mysql_query("INSERT INTO `news` SET `show` = '".$option."',
`type` = '".$type."',
`text` = '".mysql_real_escape_string($text)."',
`name` = '".mysql_real_escape_string($name)."',
`link` = '".mysql_real_escape_string($link)."',
`namelink` = '".mysql_real_escape_string($namelink)."',
`image` = '".$tenfile1.".".$file_ext1."',
`time` = '".time()."',
`read` = '0',
`thang` = '".$thang."',
`user` = '".$user_id."'");
$idnew=mysql_insert_id();
		  echo '<div style="color:green">Đăng tin thành công!</div>'; 
	  }
	  } else {
		 ?>
		<div class="alert alert-danger" role="alert">
		<?php echo functions::display_error($error); ?>
		</div>
	<?php 
		  
	  }
	  ?>
	  <form method="post" enctype="multipart/form-data">
	  <select name="option" class="cmt-to-login">
	  <option value="on">Hiện tin</option>
	  <option value="off">Ẩn tin</option>
	  </select><select name="type"  class="cmt-to-login">
	  <option <? echo ($news['type']=='promotion' ? 'selected="selected"' : '');?> value="promotion">Ưu đãi/Sự kiện</option>
	  <option <? echo ($news['type']=='news' ? 'selected="selected"' : '');?> value="news">Tin mới</option>
	  </select><br>
	  Tiêu đề:<br><input type="text" value="" name="name" style="width:99%;border:1px solid #999;height:20px"/><br>
	  Nội dung tin: <br><textarea name="text" id="editor1" style="width:99%;border:1px solid #999;height:55px;"><? echo $news['text'];?></textarea>
	  <br>
	  <div style="padding-left:10px">

	Chọn ảnh:
	<input type="file" name="image1" id="image1">

	</div>
	  Tên nút:<br><input type="text" value="" name="namelink" style="width:99%;border:1px solid #999;height:20px"/><br>
	  
	  
	  Link cho nút:<br><input type="text" value="" name="link" style="width:99%;border:1px solid #999;height:20px"/><br>
	  <input name="save" type="submit" class="cmt-to-login" style="" value="Đăng tin"/>
	  </form>
	  <? }?>
	  </div>

  </div>
  
</div> <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
<?php require('../botmenu.php');?></div>

<?php require('../incfiles/end.php');?>
<?php } ?>
