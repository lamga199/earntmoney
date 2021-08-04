<?php
/*
date_default_timezone_set('asia/ho_chi_minh');
$token="ko get đc";
if($_REQUEST['token']){
	$token=$_REQUEST['token'];
}
$mess="test send mail ".date('h:s d-m-y')." token:".$token;

if(mail("vuongnguyen0712@gmail.com","My subject",$mess)){
	echo $mess; die;
}else{
	echo "don't ".$mess; die;
}
*/
date_default_timezone_set('asia/ho_chi_minh');
$d = new DateTime('31-12-2020 16:37:00');
$now=time();
$lan=0;
$time= $d->getTimestamp(); 
if($now>=$time){
	$lan=1;
}
if(isset($_REQUEST['thang']) && $_REQUEST['thang']=1){
	$lan=5;
}
echo $lan; die;
//echo  date('H:s d-m-y',time());