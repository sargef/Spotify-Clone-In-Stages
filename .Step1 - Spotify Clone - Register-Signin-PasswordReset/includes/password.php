<?php

include('config.php');

$errors  = array();

if(!isset($_GET["code"])) {
    exit("Can't find that page");
}

$code = $_GET["code"];

$getEmailQuery = mysqli_query($con, "SELECT email FROM resetPasswords WHERE code='$code'");

if (mysqli_num_rows($getEmailQuery) == 0) {
    exit("Can't find that page");
}

if(isset($_POST["password"])) {
    $pw = $_POST["password"];
    $pw = $pw;
    
    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row["email"];

    if(preg_match('/[^A-za-z0-9]/', $pw)) {
        $errors[] = "Your password can only contain numbers and letters";
    }

    if(strlen($pw) < 5 || strlen($pw > 30)) {
        $errors[] = "Your password must be between 5 and 30 characters";

        if (isset($_POST['resetButton'])) {
            echo '<script>
                    $(document).ready(function() {
                        $("#passwordReseted").hide();
                        $("#notReseted").show();
                        $("#resetForm").hide();
                    });
                </script>';
        }
    } else {
        if (!$errors) {
       $pw = md5($pw);
       
        $query = mysqli_query($con, "UPDATE users SET password='$pw' WHERE email='$email'");
        echo '<script>
        $(document).ready(function() {
            $("#passwordReseted").show();
            $("#notReseted").hide();
            $("#resetForm").hide();
        });
    </script>';

        if ($query) {
            $query = mysqli_query($con, "DELETE from resetPasswords WHERE code='$code'");

                if (isset($_POST['resetButton'])) {
                    echo '<script>
                            $(document).ready(function() {
                                $("#passwordReseted").show();
                                $("#notReseted").hide();
                                $("#resetForm").hide();
                            });
                        </script>';
                }
        
            }
        }

    }
}

?>

<html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/register.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="../assets/js/register.js"></script>
</head>
<body>

<?php

if (isset($_POST['resetButton'])) {
    if (!$errors) {
	echo '<script>
			$(document).ready(function() {
				$("#passwordReseted").show();
				$("#notReseted").hide();
				$("#resetForm").hide();
			});
		</script>';
    }
}

?>

<div id="background">
<div class="shadow-box"></div>
		<div id="loginContainer">
			<div id="inputContainer">
<!-- Reset shown -->
                <form id="resetForm" method="POST">

                    <?php
                        if ($errors) {
                            // display errors
                            foreach ($errors as $error) {
                                echo "<p class='error'>
                                $error</p>";
                            }
                        }
                    ?>
                    <label for="password">Password</label>
                        <input type="password" name="password">
                        <br>
                        <button type="submit" name="resetButton" value="Update Password">RESET</button>
                </form>

<!-- Updated Shown -->
                <form id="passwordReseted" method="POST">
                    <h3>Password Updated</h3>
                    <button class="returnLogin"><a href="../register.php">Return to Login</a></button>
                </form>

<!-- Not reset shown -->
                <form id="notReseted">
                <h3>Something went wrong</h3>
                <button class="returnLogin"><a href="../register.php">Return to Register</a></button>
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
