<?php

include('config.php');



    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "22131051_20141188_22222895";
  
    session_start();

    $error = null;

    if (isset($_POST["login"])) {
        $mysqli = new mysqli($hostname, $username, $password, $db_name);
  
        // Check for errors
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        

        $stmt = $mysqli->prepare(
            "SELECT UserID, password FROM user WHERE username = ?"
        );
  
        $stmt->bind_param("s", $username);
  
        $username = $_POST["username"];
        $password = $_POST["password"];
  
        $stmt->execute();
        $stmt->store_result();
  
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
  
            $stmt->fetch();
  
            if (password_verify($password, $hashed_password)) {
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
  
                
                header("Location: index.php"); 
                exit();
            } else {
                $error = "ERROR: Incorrect password!";
            }
        } else {
            $error = "ERROR: User not found!";
        }
  
        $stmt->close();
        $mysqli->close();
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="styles/Login.css">
</head>
<body>


    <?php include("components/header.php") ?>

    <div class="login-form">
        <form action="login.php" method="post">
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="login" value="login">Log in</button>
            </div>
            <?php 
                if ($error) {
                    echo "<p class='text-danger'>" . $error . "</p>";
                }
			?>
            <div class="clearfix">
                <label class="float-left form-check-label"><input type="checkbox"> <a href="#" class="remember-link">Remember me</a></label>
                <a href="registration.php" class="float-right forgot-link">Forgot Password?</a>
            </div>
        </form>
        <p class="text-center create-account-link"><a href="registration.php">Create an Account</a></p>
    </div>

    <?php include("components/footer.php") ?>
</body>
</html>