<?php
  session_start();
  if(strtoupper($_GET['secure_code']) == $_SESSION['captcha_id']) {
	  $validate = true;
  }
  else {
	  $validate = false;
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if ($validate) { ?>
<input type="hidden" name="validate_captchar" id="validate_captchar" value="true" />
<?php } else { ?>
<input type="hidden" name="validate_captchar" id="validate_captchar" value="false" />
<?php } ?>