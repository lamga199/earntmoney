<?php
define('_IN_JOHNCMS', 1);
$headmod = 'video';
$textl='Video';
require('incfiles/core.php');
require('incfiles/head.php');
if(empty($login)) {
header('location: /index.php');
} else {
require('header.php');

	?>
	<style>
	.bang {border:1px solid #444;text-align:center;color:#7401DF;font-weight:bold}
	.bang2 {border:1px solid #444;text-align:center;;font-weight:bold}
	</style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Video view</div>
<?php
if($rights>=9) {
	
	?>
<div><a style="color:orange" href="/admin/addvideo.php">Add video</a></div>
	
<? } ?>
</div>
<?
function get_youtube_title($video_id){
    $html = 'https://www.googleapis.com/youtube/v3/videos?id=' . $video_id . '&key=AIzaSyD7ZL_zOtFCijEmzKTGw3lMvf3xIWPRLaI&part=snippet';
    $response = file_get_contents($html);
    $decoded = json_decode($response, true);
    foreach ($decoded['items'] as $items) {
         $title = $items['snippet']['title'];
         return $title;
    }
}
?>
<div style="background:#000;text-align:left;;padding:10px; color:#fff;">
<h4 style="padding:5px;font-weight:normal;text-transform:uppercase;color:yellow;text-align:center;">
TIỀN XEM VIDEO KIẾM ĐƯỢC:  <?php echo number_format($usermain['videocoin']);?><?php echo $set['donvi'];?>
</h4>
<?
if(empty($id)) {
	$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `video` WHERE `show` = 'on'"),0);
$video=mysql_query("SELECT * FROM `video` WHERE `show` = 'on' ORDER BY RAND() LIMIT 6");
while($vid=mysql_fetch_assoc($video)) {?>
<? if(!$is_mobile) { ?>
<div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $vid['id'];?>"><img src="https://img.youtube.com/vi/<? echo $vid['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $vid['id'];?>"><? echo $vid['name'];?></a></h4>
<? } ?>
Thời gian <? echo $vid['long'];?>s

<br>

Tiền thuưởng: <? echo number_format($vid['cash']);?><? echo $set['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$vid['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
</td>
</tr></table>

</div>
<? } else { ?>
<div style="width:100%;max-width:100%;background:#fff;color:#000; margin:5px;height:100px;max-height:100px;">

<table>
<tr style="height:100px;max-height:100px;">
<td style="height:100px;max-height:100px;">
<a href="/video.php?id=<? echo $vid['id'];?>"><img src="https://img.youtube.com/vi/<? echo $vid['vidid'];?>/0.jpg" height="96"/></a>
</td>
<td style="vertical-align: text-top;">
<? if($usermain['rights']>=9) { ?>
<h4><a href="/video.php?id=<? echo $vid['id'];?>"><? echo $vid['name'];?></a></h4>
<? } ?>
Thời gian xem: <? echo $vid['long'];?>đ

<br>

Tiền thưởng: <? echo number_format($vid['cash']);?><? echo $set['donvi'];?>

<?php
$earn=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$vid['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn['earned']>=0 && !empty($earn['earned'])) { ?>

<br>Earned: <? echo number_format($earn['earned']);?><? echo $set['donvi'];?>
<? } ?>
</td>
</tr></table>

</div>
<? } ?>
<? }
?>
<div style="text-align:center;"><br><a href="?" style="color:white" class="cmt-to-login">Đổi Video</a></div>
<?
} else {
	if($usermain['status']=='pending' && $usermain['luotxemvideongay']<=0) {
		?>
		<script>
		alert('You are out of free video views');
		document.location="/";
		</script>
		
		<?
	}
	
	$vid=mysql_fetch_assoc(mysql_query("SELECT * FROM `video` WHERE `id` = '".$id."'"));
	if($vid['id']) {
	mysql_query("UPDATE `users` SET `videoview` = '".$id."' WHERE `id` = '".$user_id."'");
	}
	//update location
	if($usermain['place']=='video' && $usermain['videoview']>0) {
		?>
		<!--<script>
		alert('Do not spam videos');
		document.location="/";
		</script>-->
		
		<?
	}
	?>
<div id="showname" style="text-align:center;display:none;"><?php echo get_youtube_title($vid['vidid']); ?></div>
	<div style="width:100%;max-width:100%;background:#000;color:#fff; margin:5px;" id="video-placeholder">
	<iframe width="99%" height="315" src="https://www.youtube.com/embed/<? echo $vid['vidid'];?>&autoplay=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	
	</div>
	<div style="padding-left:10px;font-size:20px;"><? echo $vid['name'];?> (<? echo number_format($vid['cash']);?><? echo $set['donvi'];?>)
	<? if($usermain['rights']>=9) {?>
	<div style="float:right"><? echo number_format($vid['view']);?> views</div>
	<?php }else{ 
	$count_viewvideo_for_user=mysql_fetch_assoc(mysql_query("SELECT count(*) FROM `video_view` WHERE `vidid` = ".$vid['id']." AND `userid` = ".$user_id." and `status`='paid' ORDER BY `vidid` DESC "));
	
	?>
	<div style="float:right"><? echo number_format($count_viewvideo_for_user['count(*)']);?> views</div>
	<?php } ?>
	</div>
	<div style="border:1px solid grey;padding:5px;margin:7px;">
	<? if($usermain['rights']>=9) {?>

	  <?
	  if(isset($_POST['video'])) {
		  $option=trim($_POST['option']);
		  $delete=trim($_POST['delete']);
		  $name=trim($_POST['name']);
		  $long=trim($_POST['long']);
		  $cash=trim($_POST['cash']);
		  mysql_query("UPDATE `video` SET `show` = '".$option."',`name` = '".mysql_real_escape_string($name)."', `cash` = '".$cash."',`long` = '".$long."' WHERE `id` = '".$id."'");
		  if($delete=='off') {
			  mysql_query("DELETE FROM `video` WHERE `id` = '".$id."'");
			  header('location: /admin/video.php');
		  }
		  echo '<div style="color:green">update success</div>'; 
	  }
	  ?>
	  <form method="post">
	  <select name="delete">
	  <option value="on">Giữ video</option>
	  <option value="off">Xóa video</option>
	  </select>
	  <select name="option">
	  <option value="on">Hiện video</option>
	  <option value="off">Ẩn video</option>
	  </select>
	  Name: <input type="text" name="name" value="<? echo $vid['name'];?>" style="width:120px"/>
	  Time view (Sec): <input type="text" name="long" value="<? echo $vid['long'];?>" style="width:25px"/>
	  Cash: <input type="text" name="cash" value="<? echo $vid['cash'];?>" style="width:120px"/>
	  <input name="video" type="submit" style="padding:2px;margin:2px;background:green;color:#fff;height:20px" value="SAVE"/>
	  </form>
	  <? }?>
	  </div>
	  
	  <center>
	   <!--<script>
	  function showdi() {
		  document.getElementById("playbtn").hidden = false;
		  window.open("https://www.w3schools.com");
	  }
	  </script>
	  <div id="channel" style="display:none;text-align:center;" onclick="showdi()">
	  <script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="default" data-count="default"></div>
</div>-->
	<div id="playbtn" style="visibility:visible;">
	<input type="button" class="cmt-to-login" value="START VIEWING" onClick="javascript:startvideo()"></div>
</center>
<script src="https://www.youtube.com/iframe_api"></script>
<script>
var money =<? echo $vid['cash'];?>;
 var dorun=0;
 var duration=<? echo $vid['long'];?>;
 var doend=0;
 var myinterval;
 function onYouTubeIframeAPIReady() {
    player = new YT.Player('video-placeholder', {
        height: 315,
        videoId: <?php echo "'".$vid['vidid']."'"; ?>,
        playerVars: {
         color: 'white',
         controls: '0',
         autoplay: '1',
         disablekb:'1',
         rel:      '0'
        },
        events: {
            'onReady': initialize,
            'onStateChange': onPlayerStateChange
        }
    });
 }

 function initialize(){
     // Обновляем элементы управления и загружаем
    updateTimerDisplay();
    updateProgressBar();

    // Сброс старого интервала
    clearInterval(time_update_interval);

    // Запускаем обновление таймера и дорожки проигрывания
    // каждую секунду.
    time_update_interval = setInterval(function () {
        updateTimerDisplay();
        updateProgressBar();
    }, 1000)

 }


 function startvideo(){
  player.playVideo();
  $('#showname').show();
 }

 function decduration(){
	 var cashvideo=<?php echo $vid['cash'];?>;
	 var donvicash='đ';
  duration=duration-1;
  document.getElementById("playbtn").innerHTML="<font style='color:yellow;font-weight:;'>Nhận thưởng sau "+duration+"s</font>";
  if (duration<=0){
   doend=1;
   clearInterval(myinterval);
   
   document.getElementById("playbtn").innerHTML="<div style='margin:10px;padding:10px;background:;border-radius:5px;'><input type='button' class='cmt-to-login' style='width:53%;;border-radius:5px;color:white;background:red;font-weight:bold;' value='NHẬN THƯỞNG "+cashvideo+" đ' onClick='javascript:showsub()'></div>";
   <!--document.getElementById('channel').style.display='block';
    <!--document.getElementById("playbtn").hidden = true;-->
   return false;
  }
 }

 function onPlayerStateChange(event) {
	 var videoid = <?php echo $vid['id'];?>;
  if ((event.data==YT.PlayerState.PLAYING)&&(dorun==0)){
   dorun=1;
   myinterval=setInterval(decduration,1000);
   $.get("startvideo.php?id="+videoid+"").done(function(json){
   });
  }
   
  if ((event.data==YT.PlayerState.PAUSED)&&(doend==0)){
   alert("Cannot pause video while watching!");
   document.location="/video.php";
   return false;
  }
	
 }

<?
if(empty($vid['channel'])) { ?>
function showsub(){
	 var videoid = <?php echo $vid['id'];?>;
  document.location="getcash.php?id="+videoid+"";
 }

<? } else { ?>
 function addmoney(){
	 var videoid = <?php echo $vid['id'];?>;
  document.location="getcash.php?id="+videoid+"";
 }
 function showsub(){
	 document.getElementById("playbtn").innerHTML="<div style='margin:10px;padding:10px;background:;border-radius:5px;'><div style='width:200px;color:white;font-weight:bold;text-align:center'>Subscribe to receive the bonus</div><div onClick='javascript:shownext()' class='cmt-to-login' style='width:200px;text-align:left;border-radius:5px; color:white;background:red;;font-weight:bold;'><img src='/sr/img/io.png' height='25'/><b>Subscribe to</b> <? echo $vid['channelname'];?></div><br><input type='button' class='cmt-to-login' style='width:220px;border-radius:5px; color:white;background:#f2f2f2;font-weight:bold;' id='next' value='NEXT' onClick='javascript:addmoney()' disabled='disabled'></div>";
 }
function shownext() {
	<? if($is_mobile) { ?>
	var win = window.open('<? echo $vid["channel"];?>?sub_confirmation=1', '_blank');
	<? } else { ?>
	var win = window.open('<? echo $vid["channel"];?>?sub_confirmation=1', '_blank');
	<? } ?>
	 
  win.focus();
    setTimeout(function () {
		//alert('Click next to receive cash');
    $('#next').removeAttr('disabled');
	$('#next').css('background', 'grey');
	//$('#next').setAttribute("style", "background:red;");
	
    }, 5000);
}
<? } ?>
</script>

<!--<h4 style="color:white">Others</h4>
<div>
<?
$video2=mysql_query("SELECT * FROM `video` WHERE `show` = 'on' AND `id` != '".$vid['id']."' ORDER BY RAND() LIMIT 10");
while($vid2=mysql_fetch_assoc($video2)) {?>
<div style="width:45%;max-width:45%;background:#fff;color:#000; margin:5px;float:left;">
<table><tr><td>
<a href="/video.php?id=<? echo $vid2['id'];?>"><img src="https://img.youtube.com/vi/<? echo $vid2['vidid'];?>/0.jpg" height="100"/></a>
</td>
<td style="vertical-align: text-top;"><h3><a href="/video.php?id=<? echo $vid2['id'];?>">#<? echo $vid2['id'];?> <? echo $vid2['name'];?></a></h3>
Sec require: <? echo $vid2['long'];?>

<br>

Cash: <? echo number_format($vid2['cash']);?><? echo $set['donvi'];?>

<?php
$earn2=mysql_fetch_assoc(mysql_query("SELECT * FROM `video_log` WHERE `videoid` = '".$vid2['id']."' AND `userid` = '".$usermain['id']."'"));
if($earn2['earned']>=0 && !empty($earn2['earned'])) { ?>

<br>Earned: <? echo number_format($earn2['earned']);?><? echo $set['donvi'];?>
<? } ?>
</td>
</tr></table>
</div>

<? } ?>
</div>
<div style="clear:both;"></div>-->
<?
	
}

?>
<div style="clear:both;"></div>

</div>
<script src = 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> 
        </script> 
<?php require('botmenu.php');?></div>

<?php require('incfiles/end.php');?>
<?php } ?>

