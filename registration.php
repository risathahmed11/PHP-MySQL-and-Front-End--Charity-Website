<?php
session_start();
include('config.php');

$error = null;

if (isset($_POST["registration"])) {
    $stmt = $mysqli->prepare(
        "INSERT INTO user (FirstName, LastName, username, email, password, confirmpassword) VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("ssssss",  $FirstName,  $LastName, $username, $email, $password,  $confirmpassword);

    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $userPassword = $_POST["password"];
    $userConfirmpassword = $_POST["confirmpassword"];

    $password = password_hash($userPassword, PASSWORD_DEFAULT);
		$confirmpassword = password_hash($userConfirmpassword, PASSWORD_DEFAULT);

		if ($userPassword != $userConfirmpassword) {
			$error = "Password does not match";
		} else if ($stmt->execute()) {
			header('Location: /login.php');
		} else {
			$error = "500 Error";
		}
//hash co
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/registration.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head> 
<body style="background-color: #fbe5dc; font-family: 'Roboto', sans-serif; min-height: 100vh; display: flex; flex-direction: column;"> 



<?php include("components/header.php") ?>

<div class="signup-form">
<form action="registration.php" method="post" > 
		<h2>Register</h2>
		<p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <div class="form-group">
			<div class="row">

			</div>        	
        </div>
        <div class="form-group">
        	<input type="username" class="form-control" name="FirstName" placeholder="First Name" required="required">
        </div>
        <div class="form-group">
        	<input type="username" class="form-control" name="LastName" placeholder="Last Name" required="required">
        </div>
        <div class="form-group">
        	<input type="username" class="form-control" name="username" placeholder="Username" required="required">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirmpassword" placeholder=" Confirm Password" required="required">
        </div>
		<div class="form-group">
            <input class="btn btn-success btn-lg btn-block" name="registration" type="submit" value="Register" /> 
        </div>
				<?php 
					if ($error) {
						echo "<p class='text-danger'>" . $error . "</p>";
					}
				?>
    </form>
	<div class="text-center">Already have an account? <a href="/charity_website/Login.php">Sign in</a></div>
</div>
<?php include("components/footer.php") ?>
</body> 
</html> 