<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fbe5dc;">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <img src="img/logo.jpg" height="28" weight="10" alt="CTA Foundation">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link <?php echo isCurrentPage('index.php'); ?>">Home</a>
                    <a href="/#about" class="nav-item nav-link <?php echo isCurrentPage('index.php/#about'); ?>">About Us</a>
                    <a href="Contact.php" class="nav-item nav-link <?php echo isCurrentPage('Contact.php'); ?>">Contact</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <?php
                        if (isset($_SESSION["loggedin"])) {
                    ?>
                            <p class="nav-item nav-link m-0"> 
                    <?php
                            $mysqli = new mysqli("localhost", "root", "", "22131051_20141188_22222895");

                            if ($mysqli->connect_error) {
                                die("Connection failed: " . $mysqli->connect_error);
                            }
                    
                            $stmt = $mysqli->prepare(
                                "
                                    SELECT sum(Amount) 
                                    FROM user 
                                    INNER JOIN donation ON user.UserID = donation.UserID 
                                    INNER JOIN payment ON donation.DonationID = payment.DonationID 
                                    WHERE username = ?
                                "
                            );
                        
                            $stmt->bind_param("s", $username);
                        
                            $username = $_SESSION["username"];
                        
                            $stmt->execute();
                            $stmt->store_result();
                        
                            if ($stmt->num_rows > 0) {
                                $stmt->bind_result($amount);
                                $stmt->fetch();

                                if ($amount) {
                                    echo "Donated: £" . $amount;
                                }
                            } 
                        
                            $stmt->close();
                            $mysqli->close();
                        } 
                    ?>
                    

                    </p>
                    <?php
                        if (isset($_SESSION["loggedin"])) {
                            echo "<span class='nav-item nav-link'>" . $_SESSION["username"] . "</span>";
                            echo "<a href='/signout.php' class='nav-item nav-link'>Sign Out</a>";
                        } else {
                            ?>
                                <a href="registration.php" class="nav-item nav-link <?php echo isCurrentPage('registration.php'); ?>">Register</a>
                                <a href="Login.php" class="nav-item nav-link <?php echo isCurrentPage('Login.php'); ?>">Login</a>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</div>

<?php
function isCurrentPage($page)
{
    return (strpos($_SERVER['REQUEST_URI'], $page) !== false) ? 'active' : '';
}
?>
