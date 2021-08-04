<?php
define('_IN_JOHNCMS', 1);
//Include Google Client Library for PHP autoload file
require_once 'incfiles/core.php';
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('344718532214-ufj56g8qbsd8sujcojee39pjnbb27v27.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('eIOOZcCdg77w9LxPpkcsnxxV');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://earntmoney.com/google.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
 
 
 // kiểm tra acc đã tồn tại hay chưa?
$check_acc=mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `google` = '".$data['email']."' LIMIT 1"), 0);
if ($check_acc==0) {
	echo 0;
} else if ($check_acc==1) {
	echo 1;
	
}
}
?>
<a href="<? echo $google_client->createAuthUrl();?>">button</a>
<title>google</title>