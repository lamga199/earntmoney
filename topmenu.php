<div id="menu" style="background:#333;font-weight:bold;">
	 <ul style="width:100%">
	 <?php if($usermain['status']=='pending') { ?>
	  <li style="width:25%">
	  
	  <a href="/transfer.php" >
	  <img src="/sr/img/image033.png" height="40"/><br>Chuyển tiền</a></li>
	   <li style="width:25%"><a href="/yeucau.php" >
	  <img src="/sr/img/image035.png" height="40"/><br>Rút Tiền</a></li>
 <li style="width:25%"><a href="/card.php" >
	  <img src="/sr/img/image036.png" height="40"/><br>Đổi thẻ cào</a></li>
	 <li style="width:25%"><a href="#" onclick="norun()" >
	  <img src="/sr/img/image037.png" height="40"/><br>Dịch Vụ</a></li>
	 <?php } else { ?>
	  <li style="width:25%">
	  
	  <a href="/transfer.php" >
	  <img src="/sr/img/image033.png" height="40"/><br>Chuyển tiền</a></li>
	   <li style="width:25%"><a href="/yeucau.php" >
	  <img src="/sr/img/image035.png" height="40"/><br>Rút tiền</a></li>
 <li style="width:25%"><a href="/card.php" >
	  <img src="/sr/img/image036.png" height="40"/><br>Đổi thẻ cào</a></li>
	 <li style="width:25%"><a href="#" onclick="norun()" >
	  <img src="/sr/img/image037.png" height="40"/><br>Dịch vụ</a></li>
	 <? } ?>
	  </ul>
	  
	
	  </div>
	  
	 <style>
	#menu ul {
  background: #333;
  list-style-type: none;
  text-align: center;
  width:100%;
}
#menu li {
  color: #f1f1f1;
  display: inline-block;
  width: 25%;

  margin-left: -5px;
}
#menu a {
  text-decoration: none;
  color: #fff;
  display: block;
}
#menu a:hover {
  background: #424242;
  color: orange;
}
	 </style>
	  <script>
	  function norun() {
		  alert("Only for commercial customers");
	  }</script>