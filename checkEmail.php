<?php

session_start();

/*echo "HELLO";*/

$_SESSION["uniqid"] = uniqid("EID");
	
	require 'PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	$mail->isSMTP();
	$mail->IsHTML(true);
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	
	$mail->Username = 'noreply.teameid@gmail.com';
	$mail->Password = 'teameid1';
	
	$mail->setFrom('noreply.teameid@gmail.com', 'Team EID');
	$mail->addAddress($_POST['email']);
	
	$mail->Subject = 'Validate your email address @ EID';
	$mail->Body = 'Greetings!<br><br>Please validate this email address at EID to continue by entering the following unique ID<br><br>Unique ID: <b>' . $_SESSION["uniqid"] . '</b><br><br><br><br><br><br>Regards,<br><br>Team EID';
	
	//send the message, check for errors
	if (!$mail->send()) {
		//$dom = new DOMDocument();
		//$dom->validateOnParse = true;
		$message = "ERROR: " . $mail->ErrorInfo;
		//echo "showUniqueID();";
		//echo "<script> showUniqueID(); </script>";
		//echo "<script>".$dom->getElementById("val-div").".style.display:\"block\";</script>";
		//echo "<script>document.getElementById(\"val-div\").show();</script>";
		//echo "<script>alert(\"Helo\");</script>";
	} else {
		$message = "A unique ID has been sent to your email address. Please enter the ID and click Validate";
		$valdiv = "block";
        $checkEmailBtn = "none";
		//echo "<script>".$dom->getElementById("val-div").".show();</script>";
	}

echo json_encode(array($message, $valdiv, $checkEmailBtn));

?>