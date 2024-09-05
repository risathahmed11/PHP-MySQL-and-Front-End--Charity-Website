<?php
include('config.php');
session_start();

if (!isset($_SESSION["loggedin"])) {
    header("Location: Login.php");
}

$error = null;

if (isset($_POST["donate"])) { 

}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Donation Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/Donate.css">
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    


</head> 
<body> 

<?php include("components/header.php") ?>

<div class="signup-form">
<form action="Payment.php" method="POST">
    <h2>Donation</h2>
    <p class="hint-text">Support a Cause with Your Donation</p>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="First Name" required="required" autocomplete="given-name">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="LastName" id="LastName" placeholder="Last Name" required="required" autocomplete="family-name">
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="required" autocomplete="email">
    </div>
    <div class="form-group">
        <input type="number" class="form-control" name="amount" id="amount" placeholder="Donation Amount" required="required" autocomplete="off">
    </div>
    <div class="form-group">
        <input class="btn btn-success btn-lg btn-block" name="Donation" type="submit" value="Donate" />
    </div>
    <?php
    if ($error) {
        echo "<p class='text-danger'>" . $error . "</p>";
    }
    ?>
</form>
</div>
<?php include("components/footer.php") ?>
      
</body> 
</html> 



    
