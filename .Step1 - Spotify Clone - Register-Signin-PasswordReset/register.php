<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");
	include_once("includes/reset-password.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="sweetalert2.all.min.js" charset="UTF-8"></script>	
	<script src="assets/js/register.js"></script>
</head>
<body>

<?php
//Display form on page according to selection of login/signup options
if (isset($_POST['registerButton'])) {
	echo '<script>
			$(document).ready(function() {
				$("#loginForm").hide();
				$("#resetForm").hide();
				$("#registerForm").show();
			});
		</script>';
}
else if (isset($_POST['loginButton'])) {
	echo '<script>
			$(document).ready(function() {
				$("#loginForm").show();
				$("#registerForm").hide();
				$("#resetForm").hide();
			});
		</script>';
}
else if (isset($_POST['resetButton'])) {
	echo '<script>
		$(document).ready(function() {
			$("#loginForm").hide();
			$("#registerForm").hide();
			$("#resetForm").show();
		});
	</script>';
} else if (isset($_POST['back'])){
	echo '<script>
		$(document).ready(function() {
			$("#loginForm").show();
			$("#registerForm").hide();
			$("#resetForm").hide();
		});
	</script>';
} else {
	echo '<script>
			$(document).ready(function() {
				$("#loginForm").show();
				$("#resetForm").hide();
				$("#registerForm").hide();
			});
		</script>';
}

?>

	<div id="background">
	<div class="shadow-box"></div>
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
					<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" value="<?php getInputValue('loginUsername');?>" type="text" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" value="<?php getInputValue('loginPassword');?>"type="password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here</span>
					</div>

					<div class="hasAccountText">
						<span id="hideReset">Forgot Password? click here</span>
					</div>
					
				</form>


				<form id="resetForm" method="POST">
					<h2>Enter Your email address</h2>
					<p>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<label for="emailReset">Email</label>
						<input id="emailReset" name="emailReset" autocomplete="off" type="email" value="<?php getInputValue('email'); ?>"  required>
					</p>

					<button type="submit" id="resetButton" name="resetButton">RESET PASSWORD</button>
					<span id="back"><a href="register.php">Home</a></span>
				</form>

				
            <!-- Email not sent Shown -->
			<form id="passwordSuccess" method="POST">
                                <h1>Reset password link has been sent to your email</h1>
                                <button class="returnLogin"><a href="../register.php?id=loginForm">Return Home</a></button>
                            </form>

            <!-- Back shown -->
                            <form id="passwordNoSuccess">
                            <h1>Message could not be sent.</h1>
                            <button class="returnLogin"><a href="../register.php?id=registerForm">Return Home</a></button>
                            </form>


				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="username">Username</label>
						<input id="username" name="username" type="text" value="<?php getInputValue('username'); ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<label for="firstName">First name</label>
						<input id="firstName" name="firstName" type="text" value="<?php getInputValue('firstName'); ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="lastName">Last name</label>
						<input id="lastName" name="lastName" type="text" value="<?php getInputValue('lastName'); ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" value="<?php getInputValue('email'); ?>"  required>
					</p>

					<p>
						<label for="email2">Confirm email</label>
						<input id="email2" name="email2" type="email" value="<?php getInputValue('email2'); ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphaNumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" required>
					</p>

					<p>
						<label for="password2">Confirm password</label>
						<input id="password2" name="password2" type="password" required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Login here</span>
					</div>
					
				</form>

			</div>

			<div id="loginText">
				<h1>Get great Music, right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create you own playlists</li>
					<li>Follow artists and keep up to date</li>
				</ul>
			</div>

		</div>
	</div>

	<footer>
	<a href="https://icons8.com/icon/4JmJwTZOPITk/checked">Checked icon by Icons8</a>
	</footer>

</body>
</html>
