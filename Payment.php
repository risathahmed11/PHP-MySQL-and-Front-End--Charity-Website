
<?php
session_start();
include('config.php');

$error = null;

if (!isset($_SESSION["loggedin"])) {
  header("Location: Login.php");
}

if (isset($_POST["cardNumber"])) { 

    $charityID = 1;

    $donation = $mysqli->prepare(
        "INSERT INTO donation (UserID, CharityID, FirstName, LastName, Email) VALUES (?, ?, ?, ?, ?)"
    );
 
    $donation->bind_param("sssss", $charityID, $_SESSION["id"], $_POST["FirstName"], $_POST["LastName"], $_POST["email"]);

    if ($donation->execute()) {
      $donationID = $donation->insert_id;

      $PaymentMethod = $_POST["paymentMethod"];
      $Amount = $_POST["amount"];
      $CardNumber = $_POST["cardNumber"];
      $ExpiryDate = $_POST["expirationMonth"] . "/" . $_POST["expirationYear"];
      $CardHolderName = $_POST["cardHolderName"];
      $BillingAddress = $_POST["billingAddress"];
      $CVC = $_POST["cvc"];
  
      $payment = $mysqli->prepare(
          "INSERT INTO payment (DonationID, PaymentMethod, Amount, CardNumber, ExpiryDate, CardHolderName, BillingAddress, CVC) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
      );
  
      $payment->bind_param("ssssssss", $donationID, $PaymentMethod, $Amount, $CardNumber, $ExpiryDate, $CardHolderName, $BillingAddress, $CVC);
  
      if ($payment->execute()) {
        $transaction_history = $mysqli->prepare(
          "INSERT INTO transaction_history (DonationID, PaymentDate, Amount) VALUES (?, ?, ?)"
        );
        $transaction_history->bind_param("sss", $donationID, date("Y-m-d"), $Amount);

        if ($transaction_history->execute()) {
          header("Location: index.php");
        } else {
          $error = "Error: " . $transaction_history->error;
        }
      } else {
          $error = "Error: " . $payment->error;
      }
    } else {
      $error = "Error: " . $donation->error;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment</title>
    <link rel="stylesheet" href="styles/Payment.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

</head> 
<body> 

</head>
<body style="background-color: #fbe5dc; font-family: 'Roboto', sans-serif; min-height: 100vh; display: flex; flex-direction: column;">

<?php include("components/header.php") ?>

<div class="container py-5">
  <div class="row">
    <div class="col-lg-7 mx-auto">
     <div class="bg-light rounded-lg shadow-sm p-5" style="background-color: #2c2b2b;">
        <form action="Payment.php" method="post">

          <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <div class="input-group">
              <input type="number" name="cardNumber" placeholder="Your card number" class="form-control" required>
              <div class="input-group-append">
                <span class="input-group-text text-muted">
                  <i class="fa fa-cc-visa mx-1"></i>
                  <i class="fa fa-cc-amex mx-1"></i>
                  <i class="fa fa-cc-mastercard mx-1"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label><span class="hidden-xs">Expiration</span></label>
            <div class="input-group">
                <input type="number" placeholder="MM" name="expirationMonth" class="form-control" step="0.01" required>
                <input type="number" placeholder="YY" name="expirationYear" class="form-control" step="0.01" required>
            </div>
        </div>
    </div>
      <div class="col-sm-4">
          <div class="form-group mb-4">
              <label for="cvc" data-toggle="tooltip" title="Three-digits code on the back of your card">CVC
                <i class="fa fa-question-circle"></i>
                </label>
               <input type="text" id="cvc" name="cvc" placeholder="123" required class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="cardHolderName">Card Holder Name</label>
            <input type="text" name="cardHolderName" placeholder="Cardholder Name" required class="form-control">
          </div>
          <div class="form-group">
            <label for="billingAddress">Billing Address</label>
            <textarea name="billingAddress" placeholder="Enter Billing Address" class="form-control" required></textarea>
          </div>
          <input type="hidden" name="amount" value="<?php echo htmlspecialchars(isset($_POST['amount']) ? $_POST['amount'] : "");?>">
          <input type="hidden" name="FirstName" value="<?php echo htmlspecialchars(isset($_POST['FirstName']) ? $_POST['FirstName'] : "");?>">
          <input type="hidden" name="LastName" value="<?php echo htmlspecialchars(isset($_POST['LastName']) ? $_POST['LastName'] : "");?>">
          <input type="hidden" name="email" value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : "");?>">
          <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm">Confirm</button>

          
<ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
    <li class="nav-item">
        <label class="nav-link rounded-pill">
            <input type="radio" name="paymentMethod" value="creditCard" checked>
            <i class="fa fa-credit-card"></i> Credit Card
        </label>
    </li>
    <li class="nav-item">
        <label class="nav-link rounded-pill">
            <input type="radio" name="paymentMethod" value="paypal">
            <i class="fa fa-paypal"></i> Paypal
        </label>
    </li>
    <li class="nav-item">
        <label class="nav-link rounded-pill">
            <input type="radio" name="paymentMethod" value="bankTransfer">
            <i class="fa fa-university"></i> Bank Transfer
        </label>
    </li>
</ul>


<div class="tab-content">
    
    <div id="nav-tab-card" class="tab-pane fade show active">
        
    </div>
    
    <div id="nav-tab-paypal" class="tab-pane fade">
        
    </div>
    
    <div id="nav-tab-bank" class="tab-pane fade">
        
    </div>
</div>

<?php 
                if ($error) {
                    echo "<p class='text-danger'>" . $error . "</p>";
                }
			?>

        </form>
      </div>
    </div>
  </div>
</div>



<?php include("components/footer.php") ?>

</body>
</html>

