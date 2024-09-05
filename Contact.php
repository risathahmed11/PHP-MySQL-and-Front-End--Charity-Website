 <?php
include('config.php');

session_start();

$send = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Submit"])) {
    $stmt = $mysqli->prepare(
        "INSERT INTO contact (FirstName, LastName, Email, Mobile, Message) 
        VALUES (?, ?, ?, ?, ?)" 
    );

    $stmt->bind_param("sssss", $FirstName, $LastName, $Email, $Mobile, $Message);

    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $Email = $_POST["Email"];
    $Mobile = $_POST["Mobile"];
    $Message = $_POST["Message"];

    if ($stmt->execute()) {
        $send = "Submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles/Contact.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</head>
<?php include("components/header.php") ?>
<body>
<div class="signup-form">
<form action="Contact.php" method="POST">
    <h2>Contact</h2>
    <p class="hint-text">Contact our team through here!</p>
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
        <input type="email" class="form-control" name="Email" id="Email" placeholder="Email" required="required" autocomplete="email">
    </div>
    <div class="form-group">
        <input type="tel" class="form-control" name="Mobile" id="Mobile" placeholder="Phone Number" required="required" autocomplete="tel">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="Message" id="Message" placeholder="Message" required="required"></textarea>
    </div>
    <?php 
        if ($send) {
            echo "<p>" . $send . "</p>";
        }
    ?>
    <div class="form-group">
        <input class="btn btn-success btn-lg btn-block" name="Submit" type="submit" value="Submit" />
    </div>
</form>
</div>

<?php include("components/footer.php") ?>
</body>
</html>