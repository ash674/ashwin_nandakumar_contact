<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

$results = [];
$user_name = '';
$user_email = '';
$user_comment = '';

$results = $_POST;

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
    $user_comment = filter_var(htmlspecialcharacters($_POST['comment']), FILTER_SANITIZE_STRING);
}

$results['name'] = $user_name;
$results['comment'] = $user_comment;

// Email preparation
$email_subj = 'Contact Form';
$email_recipient = 'ashwinakx12@gmail.com';
$email_msg = sprintf('Name: %s, Email: %s, Message:');

$email_headers = array(

'From' =>$user_email

)

$email_status = mail($email_recipient, $email_subj, $email_msg, $email_headers);
if($email_status){
    $results['comment'] = sprint('Thank you for contacting ashwin. you will recieve an automated reply', $user_name);
}

else {
    $results['comment'] = sprint('Something did not work right. Your email didnt work');
}
echo json_encode($results);