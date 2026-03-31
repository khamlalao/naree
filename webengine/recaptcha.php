<?php
session_start();
// Create a random string, leaving out 'o' to avoid confusion with '0'
$char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));

// Concatenate the random string onto the random numbers
// The font 'Anorexia' doesn't have a character for '8', so the numbers will only go up to 7
// '0' is left out to avoid confusion with 'O'
$str = rand(1, 7) . rand(1, 7) . $char;

// Set the session contents
$_SESSION['captcha_id'] = $str;
// Echo the image - timestamp appended to prevent caching
echo '<a href="javascript:void(0);" onclick="refreshus(); return false;" title="Click to refresh image"><img src="ajax_captcha/images/image.php?' . time() . '" width="130" height="35" alt="Captcha image" border="0" /></a>';

?>