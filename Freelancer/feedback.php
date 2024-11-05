<?php 
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = mysqli_real_escape_string($con, $_POST['client_name']);
    $project_name = mysqli_real_escape_string($con, $_POST['project_name']);
    $comments = mysqli_real_escape_string($con, $_POST['comments']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    
    // Handle file upload
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    
    // Check if uploads directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); // Creates the directory with permissions
    }
    
    $target_file = $target_dir . basename($_FILES["client_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["client_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 1MB for example)
    if ($_FILES["client_image"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["client_image"]["tmp_name"], $target_file)) {
            // Insert feedback into database
            $query = "INSERT INTO feedback (client_name, project_name, comments, rating, client_image) VALUES ('$client_name', '$project_name', '$comments', '$rating', '$target_file')";
            if (mysqli_query($con, $query)) {
                // Redirect to review.php after successful submission
                header("Location: review.php");
                exit(); // Exit to ensure no further code is executed
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
