<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif; 
    }

    
    .contact-info p {
        font-weight: 200;
        font-size: 18px;
    }

    .contact-info h1 {
        font-family: 'Roboto', sans-serif; 
        font-size: 30px;
        margin-bottom: 20px;
        color: #333;
    }

    .contact-info h1 {
        font-family: 'Roboto', sans-serif; 
    }

    header {
        background-color: #4F6F52;
        color: #fff;
        padding: 15px;
        text-align: right;
        font-weight: bold;
    }

    nav a {
        color: #fff;
        text-decoration: none;
        margin: 0 50px;
        font-weight: bold;
    }

    nav a:not(.active):hover {
        background-color: #A4CE95;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .contact-wrapper {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 80%;
        max-width: 800px;
    }

    .image-container {
        flex: 1;
    }

    .image-container img {
        max-width: 1000px;
        height: 850px;
        margin-left: -450px;
        margin-right: auto;
    }

    .contact-info {
        background-color: #A4CE95; 
        padding: 20px;
        margin-left: 100px;
        margin-top: -200px;
        border-radius: 8px;
        font-size: larger;
    }

    .contact-info p {
        margin-top: 10px;
        color: #555;
        font-size: 35px;
        font-weight: bold;
        display: flex;
        align-items: center; 
    }

    .contact-info i {
        color: rgb(17, 16, 15);
        margin-right: 10px;
    }

    .contact-info .address {
        display: flex;
        align-items: center; 
    }

    .contact-info .address i {
        margin-right: 5px; 
        font-size:30px;
    }

    body {
        background-color: #A4CE95; 
    }
    /* Media query for smaller screens */
@media screen and (max-width: 768px) {
    nav {
        flex-direction: column;
        text-align: center;
    }

    nav a {
        margin: 3px;
    }

    .contact-wrapper {
        flex-direction: column;
        width: 100%;
        max-width: 100%;
    }
     .image-container {
        flex: 1;
        margin-left: 0px; 
        margin-right: -850px; 
    }

    .image-container img {
        max-width: 150%; 
        height: auto;
    }

    .contact-info {
        margin-top: 20px;
        margin-left: 0;
        padding-left: 20px; /
        border-radius: 0; 
        width: 100%;
        max-width: 100%;
        margin-bottom:20px;
    }

    .contact-info h1 {
        font-size: 26px; 
        margin-bottom: 10px; 
    }

    .contact-info p {
        font-size: 18px; 
    }

    .contact-info .address i {
        font-size: 26px; 
    }
    
    .contact-info a {
        font-size: 16px; 
    }
}
</style>

</head>
<body>
    <header>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="Portfolio.php"><i class="fas fa-images"></i> Gallery</a>
            <a href="Service.php"><i class="fas fa-cogs"></i> Services</a>
            <a href="About.php" class="active"><i class="fas fa-user"></i> About Us</a>
            <a href="booknow.php"><i class="fas fa-calendar-plus"></i> Book Now</a>
        </nav>
    </header>
    <div class="container">
        <div class="contact-wrapper">
            <div class="image-container">
                <img src="pic.jpg" alt="pic">
            </div>
            <div class="contact-info"> 
                <h1>Contact Information</h1> 
                <p>
                    <i class="fab fa-facebook"></i><a href="https://www.facebook.com/memoirsstudios23?mibextid=LQQJ4d"> Memoirs Studios</a>
                </p>
                <p>
                    <i class="fas fa-envelope"></i><a href="mailto:MemoirsStudio@gmail.com"> MemoirsStudio@gmail.com</a>
                </p>
                <p class="address">
                    <span><i class="fas fa-map-marker-alt"></i> 2nd Floor Gen-Bru Bldg (7-Eleven Bldg) Unit C, Brgy. Silanganan, Dolores, Philippines</span>
                </p>
            </div>
        </div>
    </div>
</body>
</html>