﻿<?php

// Replace this with your own email address
$siteOwnersEmail = 'mega.vvn@gmail.com';


if($_POST) {

   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = "New Subscriber for Smart Erasmus";

  // Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address.";
	}

   // Set Message
   $message .= "Email from: " . $email . "<br />";
	 $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

   // Set From: header
   $from =  "Smart E" . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


   if (!$error) {

      ini_set("sendmail_from", $siteOwnersEmail); // for windows server
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Something went wrong. Please try again."; }

	} # end if - no validation error

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;

		echo $response;

	} # end if - there was a validation error

}

?>
