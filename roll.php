<?php
define('_IN_JOHNCMS', 1);
$headmod = 'roll';
$textl='Roll';
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
	
    <link rel="stylesheet" href="/lucky/css/hc-canvas-luckwheel.css" />
    <style>
      .hc-luckywheel{
       
        
        margin-left: 45px;
      }
    </style>
<div class="main" style="width:640px;max-width:100%;margin:auto">

<div style="background:#fff">
<?php require('uinfo.php');?>
</div>
<?php require('topmenu.php');?>
<?php
?>
<div class="cmt-popup-pad cmt-popup-top" style="background:#333;color:#fff">
<div style="background:#000;color:#fff;width:120px;padding:5px;margin:auto">Roll</div>
Your turns: <?php echo $usermain['luotquay'];?>
</div>
<? if($usermain['f1_act']>100) {
	?>
	<div style="background:#fff;text-align:center">
	not enough 100 Ref
<br>
<img src="/sr/img/lock.png" height="50"/><br>
<h4 style="color:red">This event was closed</h4>
</div>
	<?
	
} else {
?>
<div style=" background-image: url('../lucky/images/bg.png');;text-align:left;;padding:10px; color:#fff;">
<div class="wrapper typo" id="wrapper" >
      <section id="luckywheel" class="hc-luckywheel" >
        <div class="hc-luckywheel-container">
		<? if($is_mobile) { ?>
		 <canvas class="hc-luckywheel-canvas" width="500px" height="500px"
            >Lucky Roll</canvas
		<? } else { ?>
		 <canvas class="hc-luckywheel-canvas" width="500px" height="500px"
            >Lucky Roll</canvas
          >
		<? } ?>
         
        </div>
		
        <a class="hc-luckywheel-btn" href="javascript:;" >Rolls</a>
		
		
      </section>
    </div>
</style>
    <script src="/lucky/js/sweetalert2@9.js"></script>
    <script src="/lucky/js/hc-canvas-luckwheel.js"></script>
    <script>
	
	 var isPercentage = true;
      var prizes = [
              {
                text: "Up 5% Money Atfriends",
			
                number: 1, // 1%,
                percentpage: <?php echo $set['roll1'];?> // 10%
              },
              {
                text: "Up 10% Money Atfriends",
				
                number: 2,
                percentpage: <?php echo $set['roll2'];?> // 12%
              },
              {
                text: "Good luck",
               
                number : 3,
                percentpage: <?php echo $set['roll3'];?> // 30%
              },
              {
                text: "1K",
               
                number: 4,
                percentpage: <?php echo $set['roll4'];?> // 22%
              },
              {
                text: "Card mobile 10K",
              number: 5,
                percentpage: <?php echo $set['roll5'];?> // 15%
              },
			  {
                text: "Card mobile 50K",
              number: 6,
                percentpage: <?php echo $set['roll6'];?> // 10%
              },
			  {
                text: "Card mobile 100K",
              number: 7,
                percentpage: <?php echo $set['roll7'];?> // 6%
              },
            ];
      document.addEventListener(
        "DOMContentLoaded",
        function() {
          hcLuckywheel.init({
            id: "luckywheel",
            config: function(callback) {
              callback &&
                callback(prizes);
            },
            mode : "both",
            getPrize: function(callback) {
              var rand = randomIndex(prizes);
              var chances = rand;
              callback && callback([rand, chances]);
            },
            gotBack: function(data) {
				if(data == '1K'){
					$.get("getroll.php?id=1").done(function(json){});
				}
				if(data == 'Up 5% Money Atfriends'){
					$.get("getroll.php?id=2").done(function(json){});
				}
				if(data == 'Up 10% Money Atfriends'){
					$.get("getroll.php?id=3").done(function(json){});
				}
				if(data == 'Card mobile 10K'){
					$.get("getroll.php?id=4").done(function(json){});
				}
				if(data == 'Card mobile 50K'){
					$.get("getroll.php?id=5").done(function(json){});
				}
				if(data == 'Card mobile 100K'){
					$.get("getroll.php?id=6").done(function(json){});
				}
				if(data == 'Good luck'){
					$.get("getroll.php?id=7").done(function(json){});
				}
              if(data == null){
                Swal.fire(
                  'Event closed',
                  'Over gifts',
                  'error'
                )
              } else if (data == 'Good luck'){
                Swal.fire(
                  'Goodluck to you',
                  data,
                  'error'
                )
              } else{
                Swal.fire(
                  'WIN',
                  data,
                  'success'
                )
              }
			  setTimeout(function() {
  document.location="/roll.php";
}, 1000);
			  
            }
          });
        },
        false
      );
      function randomIndex(prizes){
		<? if($usermain['luotquay']<=0 && $usermain['coin']>=$set['tienquay']) { ?>
		var tienquaya = <? echo $set['tienquay'];?>;
		if (confirm('You have run out of turns, it will take you to continue recording '+tienquaya+'đ?')) {
  if(isPercentage){
          var counter = 1;
          for (let i = 0; i < prizes.length; i++) {
            if(prizes[i].number == 0){
              counter++
            }
          }
          if(counter == prizes.length){
            return null
          }
          let rand = Math.random();
          let prizeIndex = null;
          console.log(rand);
          switch (true) {
            case rand < prizes[4].percentpage:
              prizeIndex = 4 ;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage:
              prizeIndex = 3;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage:
              prizeIndex = 2;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage + prizes[1].percentpage:
              prizeIndex = 1;
              break;  
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage + prizes[1].percentpage  + prizes[0].percentpage:
              prizeIndex = 0;
              break;  
          }
          if(prizes[prizeIndex].number != 0){
            prizes[prizeIndex].number = prizes[prizeIndex].number - 1
            return prizeIndex
          }else{
            return randomIndex(prizes)
          }
        }else{
          var counter = 0;
          for (let i = 0; i < prizes.length; i++) {
            if(prizes[i].number == 0){
              counter++
            }
          }
          if(counter == prizes.length){
            return null
          }
          var rand = (Math.random() * (prizes.length)) >>> 0;
          if(prizes[rand].number != 0){
            prizes[rand].number = prizes[rand].number - 1
            return rand
          }else{
            return randomIndex(prizes)
          }
        }
} else {
  document.location = '/roll.php';
}
		
		
		
		
		
		<? } else if($usermain['luotquay']<=0 && $usermain['coin']<$set['tienquay']) { ?>
		alert('You no have turns and main cash');
		
		<? } else { ?> 
		
		if(isPercentage){
          var counter = 1;
          for (let i = 0; i < prizes.length; i++) {
            if(prizes[i].number == 0){
              counter++
            }
          }
          if(counter == prizes.length){
            return null
          }
          let rand = Math.random();
          let prizeIndex = null;
          console.log(rand);
          switch (true) {
            case rand < prizes[4].percentpage:
              prizeIndex = 4 ;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage:
              prizeIndex = 3;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage:
              prizeIndex = 2;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage + prizes[1].percentpage:
              prizeIndex = 1;
              break;  
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage + prizes[1].percentpage  + prizes[0].percentpage:
              prizeIndex = 0;
              break;  
          }
          if(prizes[prizeIndex].number != 0){
            prizes[prizeIndex].number = prizes[prizeIndex].number - 1
            return prizeIndex
          }else{
            return randomIndex(prizes)
          }
        }else{
          var counter = 0;
          for (let i = 0; i < prizes.length; i++) {
            if(prizes[i].number == 0){
              counter++
            }
          }
          if(counter == prizes.length){
            return null
          }
          var rand = (Math.random() * (prizes.length)) >>> 0;
          if(prizes[rand].number != 0){
            prizes[rand].number = prizes[rand].number - 1
            return rand
          }else{
            return randomIndex(prizes)
          }
        }
		<? } ?>
        
      }

  </script>


</div>

<?php 

}


require('botmenu.php');?>
</div>
<?php require('incfiles/end.php');?>
<?php } ?>

