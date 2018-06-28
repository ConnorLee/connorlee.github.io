<?php

require('class.phpmailer.php');
$mail = new PHPMailer();
// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $form_subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // ================================================================================
    // =================== Update this to your desired email address. =================
    // ================================================================================
    $recipient = "2meetapp@gmail.com";
    // Set the email subject.
    $subject = "New contact from $name";

    $mail->FromName  = "From: $name <$email>";
    /*$mail->setFrom('mail@example.com', 'example.com');*/ // mailbox created on a server.
    $mail->Subject   = $subject;
    $mail->isHTML(true); 
    $mail->Body    = "<b>Contact info.</b><br>";
    if($name !=""){ $mail->Body .= "<p>Name: ".$name."</p>"; }
    if($email !=""){ $mail->Body .= "<p>Email: ".$email."</p>"; } 
    if($form_subject !=""){ $mail->Body .= "<p>Subject: ".$form_subject."</p>"; }
    if($message !=""){ $mail->Body .= "<p>Message: ".$message."</p>"; }
    $mail->AddAddress( $recipient ); 
    $mail->CharSet = "UTF-8";

    $mail->Send();
} 
?>