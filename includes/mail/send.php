<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json; charset=UTF-8');

$results = [];
$user_name = '';
$user_email = '';
$user_comment = '';

$results = $_POST;
require_once('../includes/recaptchalib.php');
$privatekey = "6Lfn5_IZAAAAAPSLzAD7sk8oWfU4uglXCSWjUOYq";
$resp = recaptcha_check_answer ($privatekey,
                              $_SERVER["REMOTE_ADDR"],
                              $_POST["recaptcha_challenge_field"],
                              $_POST["recaptcha_response_field"]);

if(isset($_POST['firstname'])) {
    $user_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
}


if(isset($_POST['lastname'])) {
    $user_name = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
}

if(isset($_POST['email'])) {
    $user_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
}

if(isset($_POST['comment'])) {
    $user_comment = filter_var(htmlspecialchars($_POST['comment']), FILTER_SANITIZE_STRING);
}
if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    sprint ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
      sprint ("Succesfully submitted");
  }

$results['name'] = $user_name;
$results['comment'] = $user_comment;

// Email preparation
$email_subj = 'Contact Form';
$email_recipient = 'ashwinakx12@gmail.com';
$email_msg = sprintf('Name: %s, Email: %s, Message: %s', $user_name, $user_email, $user_comment);

$email_headers = array(

'From' =>$user_email

);

$email_status = mail($email_recipient, $email_subj, $email_msg, $email_headers);
if($email_status){
    $results['comment'] = sprintf('Thank you for contacting ashwin. you will recieve an automated reply', $user_name);
}

else {
    $results['comment'] = sprintf('Something did not work right. Your email didnt work');
}
echo json_encode($results);