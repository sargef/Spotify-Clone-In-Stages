<?php

    include('configs.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    ?>
    
    <html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/register.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="sweetalert2.all.min.js" charset="UTF-8"></script>  
    <script src="../assets/js/register.js"></script>
</head>
<body>

<?php
    
	if(isset($_POST["emailReset"])) {

        $emailTo = $_POST["emailReset"];
    
        $result = "SELECT * FROM `users` WHERE `email` = '$emailTo'";
        $query = mysqli_query($con, $result);
        if(mysqli_num_rows($query) == 0) {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
            swal({
                position: "center",
                width: 600,
                padding: "3em",
                icon: "error",
                className: "swal-styling",
                customClass: "swal-styling",
                title: "Error! Email does not exist",
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
                timer: 4000
                })
            });
            </script>
            ';
        }
        else {

        $code = uniqid(true);
        $query = mysqli_query($con, "INSERT INTO resetPasswords(code, email) VALUES('$code', '$emailTo')");

        if (!$query) {
            exit("Could not generate reset code");
        }
		
		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings                    
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = SMTP_HOST;                              // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = SMTP_USER;                              // SMTP username
			$mail->Password   = SMTP_PASS;                              // SMTP password
            // $mail->SMTPSecure = 'ssl';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = SMTP_PORT;                              // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			//Recipients
			$mail->setFrom(SMTP_SET_FROM);
			$mail->addAddress("$emailTo");                              // Add a recipient
			$mail->addReplyTo(SMTP_NO_REPLY);

            // Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/includes/password.php?code=$code";
			$mail->isHTML(true);                                        // Set email format to HTML
			$mail->Subject = 'Your password reset link';
            $mail->Body    = "<h1>You requested a password reset</h1>
                                Click <a href='$url'>this link</a> to change your password";
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
              
            
            echo '
                <script type="text/javascript">
                    $(document).ready(function(){
                    swal({
                        position: "center",
                        width: 600,
                        padding: "3em",
                        icon: "success",
                        className: "swal-styling",
                        customClass: "swal-styling",
                        type: "success",
                        title: "Check your emails for reset link",
                        showConfirmButton: false,
                        showCancelButton: false,
                        buttons: false,
                        timer: 4000
                        })
                    });
                </script>
                ';

                header("Refresh:4; url=register.php");  

		} catch (Exception $e) {
            echo '
                <script type="text/javascript">
                $(document).ready(function(){
                swal({
                    position: "center",
                    width: 600,
                    padding: "3em",
                    icon: "error",
                    className: "swal-styling",
                    customClass: "swal-styling",
                    type: "success",
                    title: "Error! Reset email could not be sent",
                    showConfirmButton: false,
                    showCancelButton: false,
                    buttons: false,
                    timer: 4000
                    })
                });
                </script>
                ';

            header("Refresh:4; url=register.php");  
     }
    }
}
?>