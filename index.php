<?php
include('config.php');
        session_start();
        
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CTA Foundation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Myriad+Pro:wght@400;700&display=swap">
    <link rel="stylesheet" href="styles/index.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .volunteer-section {
            background: url("/img/Volunteer.jpg") center/cover no-repeat;
            color: #ffffff;
            padding: 100px 0;
            text-align: center;
         }
    </style>
</head>
<body>

        
    <?php include("components/header.php") ?>

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Nourish a Life, Feed a Soul</h1>
            <p class="lead"> Join us in making a meaningful impact! Your contribution to the Foodbank Charity helps ensure no one goes to bed hungry. Together, we can make a difference—one meal at a time. Donate now and nourish lives!</p>
            <p><a href="Donate.php" target="_self" class="btn btn-success btn-lg">Donate Now!</a></p>
        </div>
    </div>

    <div class="container-fluid section-container">
        <div class="row">
            <div class="col-md-4">
                <h2>Empower Through Nutrition</h2>
                <p>Unlock the power of compassion with the CTA Foundation. Millions face the harsh reality of food insecurity, but your £10 can transform despair into hope. Sponsor up to 40 meals and be a beacon of change in the lives of those battling hunger.</p>
                <p><a href="#about" target="_self" class="btn btn-success">Read More &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Fueling Hope, One Meal at a Time</h2>
                <p>At the CTA Foundation, your generosity sparks a ripple of change. With just £10, you provide more than sustenance; you provide a lifeline for those struggling. Join us in combating hunger and addressing its root causes, making every meal a step toward a hunger-free world.</p>
                <p><a href="#about" target="_self" class="btn btn-success">Read More &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Your Pound, Their Future</h2>
                <p>Be a catalyst for change with the CTA Foundation. Your support fuels our mission to eradicate hunger. Every pound counts and every meal sponsored is a tangible step toward a world without food poverty. Donate now, and together, let's create a life-changing impact.</p>
                <p><a href="#about" target="_self" class="btn btn-success">Read More &raquo;</a></p>
            </div>
        </div>
    </div>

  
    <div id="about" class="section-container" style="background-color: #e7c5ad; padding: 50px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
            <h2 class="font-weight-bold mb-4" style="font-family: 'Myriad', sans-serif;">Empowering Communities, Ending Hunger</h2>
                <p class="lead">
                    Welcome to the CTA Foundation, where compassion meets action, and a community unites to eradicate hunger.
                    We were founded in 2023 with a vision shared by a group of individuals determined to confront the challenges of food poverty head-on.
                </p>
                <p class="lead">
                    At the core of our mission is the unwavering commitment to eliminating hunger and addressing the root causes of food poverty within our communities.
                    We believe that every person, regardless of their circumstances, deserves access to nourishing meals and the opportunity to build a brighter future.
                </p>
            </div>
            <div class="col-md-6">
                <img src="img/children.jpg" alt="About Us Image" class="img-fluid rounded-md rounded-lg rounded-xl">
            </div>
        </div>
    </div>
</div>




    <div id="volunteer" class="volunteer-section">
        <div class="container">
            <h2>Become a Volunteer</h2>
            <p>Inspires employees and organizations to support causes they care about. We do this to bring more resources to the nonprofits that are changing our world.</p>
            <a href="Volunteer.php" class="btn btn-primary btn-lg">Join Now</a>
        </div>
    </div>

    <?php include("components/footer.php") ?>
</body>
</html>

