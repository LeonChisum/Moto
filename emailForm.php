<?php 
$messageSent = false;

if(isset($_POST['submit']) && $_POST['email'] != '') {

    if ( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
          // submitting form
    $email = $_POST['email'];

    $mailTo = "testwebsitemoto@gmail.com";
    $headers = "From: ".$email;
    $subject = "Moto Pre-Order";
    $txt = "You have recieved a new inquiry for a pre-order!";

    $mailSuccess = mail($mailTo, $subject, $txt, $headers);
    $messageSent = true;
    }

}
?>