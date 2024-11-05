<?php 
require 'config.php';

// Retrieve all feedback from the database
$query = "SELECT * FROM `feedback` ORDER BY `timestamp` DESC";
$result = mysqli_query($con, $query);

// Check if the query executed successfully
if (!$result) {
    die("Error retrieving feedback: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Reviews</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2980b9;
            font-size: 2.5em;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
            margin-top: 40px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .review-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px auto;
            max-width: 1000px;
        }

        .review-item {
            display: flex;
            align-items: center;
            margin: 15px;
            border: 1px solid #ccc;
            padding: 25px;
            width: 100%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .review-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .review-item img {
            max-width: 120px;
            max-height: 120px;
            margin-right: 20px;
            border-radius: 50%;
            border: 2px solid #2980b9;
            transition: transform 0.3s, border-color 0.3s;
        }

        .review-item img:hover {
            transform: scale(1.1);
            border-color: #3498db;
        }

        .review-details {
            display: flex;
            flex-direction: column;
        }

        .review-details h3, .review-details h4 {
            margin: 0;
            color: #2c3e50;
            font-weight: bold;
        }

        .star-rating {
            color: gold;
            font-size: 1.5em;
        }

        @media (max-width: 600px) {
            .review-item {
                flex-direction: column;
                align-items: flex-start;
            }
            .review-item img {
                margin-bottom: 10px;
            }
        }
        /* menu code */
        header {
    position: sticky;
    top: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: black;
    color: white;
    padding: 15px 30px;
    width: 100%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    z-index: 1000;
}

.header-left {
    display: flex;
    align-items: center;
}

.nav-links {
    display: flex;
    align-items: center;
}

.nav-links a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    transition: color 0.3s ease;
}

.nav-links a:hover {
    color: #ffc107;
}

.menu-icon {
    display: none; /* Hidden by default */
    cursor: pointer;
}

/* Styles for mobile */
@media (max-width: 768px) {
    .nav-links {
        display: none; /* Hide links by default on mobile */
        flex-direction: column; /* Stack links vertically */
        position: absolute;
        top: 60px; /* Adjust based on header height */
        right: 0;
        background-color: black;
        width: 100%; /* Full width */
        z-index: 1000;
        padding: 10px 0; /* Padding for spacing */
    }

    .nav-links.show {
        display: flex; /* Show links when toggled */
    }

    .nav-links a {
        margin: 10px 0; /* Space between links */
        text-align: center; /* Center align text */
        font-size: 18px; /* Larger font size for better visibility */
    }

    .menu-icon {
        display: block; /* Show menu icon on mobile */
        color: white;
        font-size: 24px;
    }
}

    </style>
</head>
<body>

<header>
    <div class="header-left">
        <div>Mahadevprasad DL (Giri)</div>
    </div>
    <div class="nav-links" id="nav-links">
        <a href="Home.html">Home</a>
        <a href="service.html">Services</a>
        <a href="showcase.html">Showcase</a>
        <a href="index.html">Feedback</a>
        <a href="review.php">Review</a>
    </div>
    <div class="menu-icon" id="menu-icon">&#9776;</div>
</header>




<h1>The Clients Reviews</h1>
<div class="review-container">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="review-item">
            <?php if (!empty($row['client_image'])): ?>
                <img src="<?php echo htmlspecialchars($row['client_image']); ?>" alt="Client Image">
            <?php endif; ?>
            <div class="review-details">
                <h3>Name: <?php echo htmlspecialchars($row['client_name']); ?></h3>
                <h4>Project Name: <?php echo htmlspecialchars($row['project_name']); ?></h4>
                <p class="star-rating">
                    <?php 
                    // Display star rating
                    for ($i = 1; $i <= 5; $i++) {
                        echo ($i <= $row['rating']) ? '★' : '☆';
                    }
                    ?>
                </p>
                <p><strong>Feedback:</strong> <?php echo htmlspecialchars($row['comments']); ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<script>
    // JavaScript to toggle the navigation links
document.getElementById('menu-icon').onclick = function() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('show');
};

</script>

</body>
</html>
