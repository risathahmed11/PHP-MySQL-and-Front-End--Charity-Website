<?php
session_start();
include('config.php');

$error = null;
$send = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registration"])) {
    $stmt = $mysqli->prepare(
        "INSERT INTO volunteer (UserID, FirstName, LastName, Email, Phone, Address) VALUES (?, ?, ?, ?, ?, ?)"
    );
    
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $stmt->bind_param("ssssss", $_SESSION["id"], $FirstName, $LastName, $email, $phone, $address);

    if ($stmt->execute()) {
      $send = "Successfully added into the campaign!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

if (!isset($_SESSION["loggedin"])) {
    header("Location: Login.php");
}

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/Volunteer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

</head> 
<body style="background-color: #fbe5dc; font-family: 'Roboto', sans-serif; min-height: 100vh; display: flex; flex-direction: column;"> 

<?php include("components/header.php") ?>

<div class="signup-form">
<form action="Volunteer.php" method="post" > 
		<h2>Volunteer</h2>
		<p class="hint-text">Sign up here to became an Volunteer!</p>
        <div class="form-group">
			<div class="row">

			</div>
       </div>
        <div class="form-group">
           <input type="text" class="form-control" name="FirstName" placeholder="First Name" required="required">
        </div>
       <div class="form-group">
         <input type="text" class="form-control" name="LastName" placeholder="Last Name" required="required">
       </div>
       <div class="form-group">
         <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
       <div class="form-group">
        <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required="required">
        </div>
       <div class="form-group">
        <input type="text" class="form-control" name="address" placeholder="Address" required="required">
        </div>
       <div class="form-group">
        <input class="btn btn-success btn-lg btn-block" name="registration" type="submit" value="Submit" />
        </div>
				<?php
          if ($error) {
            echo "<p class='text-danger'>" . $error . "</p>";
          }
          if ($error) {
            echo "<p class='text-danger'>" . $error . "</p>";
          }
       ?>
    </form>
</div>
<?php include("components/footer.php") ?>
</body> 
</html> 