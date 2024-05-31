<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="styles/Portfolio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="Portfolio.php"><i class="fas fa-images"></i> Gallery</a>
            <a href="Service.php"><i class="fas fa-cogs"></i> Services</a>
            <a href="About.php"><i class="fas fa-user"></i> About Us</a>
            <a href="booknow.php"><i class="fas fa-calendar-plus"></i> Book Now</a>
        </nav>
    </header>

<h1 class="gallery-label">GALLERY</h1>
<h2 class="portfolio-label">SOLO PACKAGES</h2>

<div class="portfolio-container">
    <img class="portfolio-image" src="images/sp1.png" alt="Portfolio Image 1">
    <img class="portfolio-image" src="images/sp2.png" alt="Portfolio Image 2">
    <img class="portfolio-image" src="images/sp3.png" alt="Portfolio Image 3">
    <img class="portfolio-image" src="images/sp4.png" alt="Portfolio Image 4">
</div>

<h2 class="portfolio-label">DUO PACKAGES</h2>

<div class="portfolio-container">
    <img class="portfolio-image" src="images/dp1.png" alt="Portfolio Image 5">
    <img class="portfolio-image" src="images/dp2.png" alt="Portfolio Image 6">
    <img class="portfolio-image" src="images/dp3.png" alt="Portfolio Image 7">
    <img class="portfolio-image" src="images/dp4.png" alt="Portfolio Image 8">

</div>

<h2 class="portfolio-label">GROUP PACKAGES</h2>

<div class="portfolio-container">
    <img class="portfolio-image" src="images/gp1.png" alt="Portfolio Image 9">
    <img class="portfolio-image" src="images/gp2.png" alt="Portfolio Image 10">
    <img class="portfolio-image" src="images/gp3.png" alt="Portfolio Image 11">
    <img class="portfolio-image" src="images/gp4.png" alt="Portfolio Image 12">
</div>

<h2 class="portfolio-label">BIRTHDAY PACKAGES</h2>

<div class="portfolio-container">
    <img class="portfolio-image" src="images/bp1.png" alt="Portfolio Image 13">
    <img class="portfolio-image" src="images/bp2.png" alt="Portfolio Image 14">
    <img class="portfolio-image" src="images/bp3.png" alt="Portfolio Image 15">
    <img class="portfolio-image" src="images/bp4.png" alt="Portfolio Image 16">
</div>

    <h2 class="portfolio-label">SPECIAL BIRTHDAY PACKAGES</h2>

<div class="portfolio-container">
    <img class="portfolio-image" src="images/sbp1.png" alt="Portfolio Image 17">
    <img class="portfolio-image" src="images/sbp2.png" alt="Portfolio Image 18">
    <img class="portfolio-image" src="images/sbp3.png" alt="Portfolio Image 19">
    <img class="portfolio-image" src="images/sbp4.png" alt="Portfolio Image 20">
</div>
<script>
  window.onload = function() {
    const container = document.getElementById('solo-packages');
    const images = document.querySelectorAll('.portfolio-image');
    let index = 0;

    function moveLeft() {
        container.style.transform = 'translateX(-${index * 22}%)'; 
        index = (index + 1) % (images.length - 3); 
        setTimeout(moveLeft, 2000); 
    }

    setTimeout(moveLeft, 2000); 
};


</script>
</body>
</html>