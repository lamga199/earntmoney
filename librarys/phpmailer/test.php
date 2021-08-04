<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - SMTP test</title>
</head>
<body>
<?php
//echo !extension_loaded('openssl')?"Not Available":"Available";

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 1;
//$mail->Timeout = 3600;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "email-smtp.us-east-1.amazonaws.com";//mail.angela.com.vn
$mail->SMTPSecure = 'ssl';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "AKIAICD2BJ2TF7EGI2JA";
//Password to use for SMTP authentication
$mail->Password = "ArqYP9j0F1+AwAw/JpdqZVAuuiK3T6hhXkfAIorius+l";
//Set who the message is to be sent from
$mail->setFrom('vnnjustin@gmail.com', 'toanho');
//Set an alternative reply-to address
 $to='hosongtoan@gmail.com';
 if(isset($_GET['to'])) $to=$_GET['to'];
//Set who the message is to be sent to
$mail->addAddress($to, 'Ho Song Toan');
//Set the subject line
$mail->Subject = 'PHPMailer SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->MsgHTML('Noi dung mail');
//Replace the plain text body with one created manually
 
//Attach an image file
 

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>
</body>
</html>
