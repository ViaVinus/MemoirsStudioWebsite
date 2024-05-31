<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memories Studio Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Service.css">
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
    <div class="wrapper">
        <h1>Memoirs Studio Services</h1>
        <div class="container" id="service-container">
        
        </div>
    </div>

    <script>
        // Fetch services from server-side PHP script
        fetch('get_services.php')
            .then(response => response.json())
            .then(data => {
                const serviceContainer = document.getElementById('service-container');
                // Clear existing content
                serviceContainer.innerHTML = '';
                // Loop through fetched data and create HTML elements
                data.forEach(service => {
                    const box = document.createElement('div');
                    box.classList.add('box');
                    box.innerHTML = `
                        <h3>${service.service_name}</h3>
                        <img src="uploads/${service.service_image}" alt="${service.service_name}">
                        <p>${service.service_description}<br> PHP ${parseFloat(service.service_price).toFixed(2)}</p>
                        <a  class="btn"> PHP ${parseFloat(service.service_price).toFixed(2)}</a>
                    `;
                    serviceContainer.appendChild(box);
                });
            })
            .catch(error => console.error('Error fetching services:', error));
    </script>
</body>
</html>
