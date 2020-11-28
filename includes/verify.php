<?php
  require_once('recaptchalib.php');
  $privatekey = "AIzaSyDL80iQWGb5MwbWUjh6IZ99rtn9NLLo0ns";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    sprint ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
      sprint ("Succesfully submitted");
  }
  ?>