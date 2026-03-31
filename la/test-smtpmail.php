<?php
require_once "common.inc.php";
require_once DIR."library/class/class.phpmailer.php";    

?>
<?php
ini_set("display_errors", "1");

$mail = new PHPMailer();
// used only when SMTP requires authentication  

			$mail->IsSMTP();        
			$mail->CharSet = "utf-8";  
			$mail->Host     = "mail.naree.co"; 
			$mail->SMTPAuth = true;                            
			$mail->Username = "info@naree.co";                     
			$mail->Password = "Naree1001";                         
			$mail->From     ="info@naree.co";
			$mail->FromName ='naree';		
		//	$mail->AddAddress(trim($_POST['text_email']));    
			$mail->IsHTML(true);               



/////////////////////////////////////////////////	
		  	
$mail->AddAddress("boy@1001click.com");
$mail->AddAddress("chy_boy@hotmail.com");
$mail->From = "info@naree.co";
$mail->Subject = "Test Mail";
$mail->Body = "Hello";


if ($mail->Send()) {
  echo "<br>Send Complete.";
} else {
  echo "<br>Can't Sent!!! : ".$mail->ErrorInfo;;
}
?>