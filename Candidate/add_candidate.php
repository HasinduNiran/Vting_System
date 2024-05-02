<?php
//include db
include '../dbh.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $votenumber = $_POST['votenumber'];
    $performance = $_POST['perfomance']; // corrected variable name

    // Handle image upload
    $targetDir = "C:/xampp/htdocs/Vting_System/Candidate/uploads";
    
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Insert data into the database
            $sql = "INSERT INTO candidate (name, age, votenumber, perfomance, photo) 
                    VALUES ('$name', '$age', '$votenumber', '$performance', '$targetFile')";
            if (mysqli_query($conn, $sql)) {
                echo "Candidate added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Candidate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Candidate</h1>
        <form action="add_candidate.php" method="post" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" required>
            <label for="votenumber">Vote Number</label>
            <input type="number" name="votenumber" id="votenumber" required>
            <label for="perfomance">Performance</label>
            <input type="text" name="perfomance" id="perfomance" required>
            <label for="photo">Profile Image</label>
            <input type="file" name="photo" id="photo" accept="image/*" required>
            <button type="submit">Add Candidate</button>
        </form>
    </div>
</body>
</html>
