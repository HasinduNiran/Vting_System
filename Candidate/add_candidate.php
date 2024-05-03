<?php
// Include your database connection file (e.g., dbh.php)
include '../dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = intval($_POST['age']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $villege = mysqli_real_escape_string($conn, $_POST['villege']);
    $votenumber = intval($_POST['votenumber']);
    $perfomance = mysqli_real_escape_string($conn, $_POST['perfomance']); // corrected variable name

    // Check if a file was uploaded
    if (isset($_FILES['photo'])) {
        $file = $_FILES['photo'];

        // Check if the file is an image
        if (getimagesize($file['tmp_name'])) {
            // Generate a unique filename
            $image_filename = uniqid() . '_' . $file['name'];

            // Define the upload path
            $upload_path = 'uploads/' . $image_filename; // Change 'uploads/' to your desired directory

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                // Insert data into the database
                $insert_query = "INSERT INTO candidate (name, age, dob, villege, votenumber, perfomance, photo) 
                    VALUES ('$name', $age, '$dob', '$villege', $votenumber, '$perfomance', '$upload_path')";

                if (mysqli_query($conn, $insert_query)) {
                    // Candidate added successfully
                    echo '<script type="text/javascript">
                            window.onload = function () { 
                                alert("Candidate Added!"); 
                                window.location.href = "view_candidate.php";
                            }
                        </script>'; // Redirect to view_candidate.php
                    exit;
                } else {
                    // Database insertion failed
                    header('Location: error_page.php'); // Redirect to an error page
                    exit;
                }
            } else {
                // File upload failed
                header('Location: error_page.php'); // Redirect to an error page
                exit;
            }
        } else {
            // The uploaded file is not an image
            header('Location: error_page.php'); // Redirect to an error page
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <title>Add Candidate</title>
    <style>
       /* CSS for Update Candidate Form */
.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-image: url('../image/dg.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
    margin-bottom: 10px;
    display: block;
    color: #333;
}

input[type="text"],
input[type="number"],
input[type="date"],
textarea {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

img {
    display: block;
    margin-bottom: 10px;
    max-width: 100%;
    height: auto;
    border-radius: 5px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
<header class="header">

<a href="#" class="logo">
    <img src="../image/pngegg.png" alt="" width="150px" height="70px"> </a>

<nav class="navbar">
    <a href="#">home</a>
    <a href="#">Contact Us</a>
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</header>
    <h1>Add Candidate</h1>

    <div class="container">
        <form action="add_candidate.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>

            <label for="villege">Village:</label>
            <input type="text" id="villege" name="villege" required>

            <label for="votenumber">Vote Number:</label>
            <input type="number" id="votenumber" name="votenumber" required>

            <label for="perfomance">perfomance:</label>
            <input type="text" id="perfomance" name="perfomance" required>

            <label for="photo">Profile Image:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required><br><br>

            <button type="submit">Add Candidate</button>
        </form>
    </div>
</body>
</html>
