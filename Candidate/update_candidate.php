<?php
// Include your database connection file (e.g., dbh.php)
include '../dbh.php';

// Initialize variables for existing candidate details
$existing_id = $existing_name = $existing_age = $existing_votenumber = $existing_dob = $existing_villege = $existing_perfomance = $existing_photo = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $existing_id = $_POST['existing_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = intval($_POST['age']);
    $votenumber = intval($_POST['votenumber']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $villege = mysqli_real_escape_string($conn, $_POST['villege']); // corrected variable name
    $perfomance = mysqli_real_escape_string($conn, $_POST['perfomance']); // corrected variable name

    // Check if a new file is uploaded
    if ($_FILES['photo']['size'] > 0) {
        // Handle image upload
        $file = $_FILES['photo'];

        // Check if the file is an image
        if (getimagesize($file['tmp_name'])) {
            // Generate a unique filename
            $image_filename = uniqid() . '_' . $file['name'];

            // Define the upload path
            $upload_path = 'uploads/' . $image_filename; // Change 'uploads/' to your desired directory

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                // Update the existing candidate with the new image path
                $sql_update = "UPDATE candidate SET name=?, age=?, votenumber=?, dob=?, villege=?, perfomance=?, photo=? WHERE id=?";
                $stmt_update = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt_update, "sisssssi", $name, $age, $votenumber, $dob, $villege, $perfomance, $upload_path, $existing_id);

                if (mysqli_stmt_execute($stmt_update)) {
                    // Redirect to view_candidate.php after successful update
                    header("Location: view_candidate.php");
                    exit(); // Ensure script execution stops after redirection
                } else {
                    echo "Error updating candidate: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt_update);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            // The uploaded file is not an image
            echo "File is not an image.";
        }
    } else {
        // Update the existing candidate without changing the image
        $sql_update = "UPDATE candidate SET name=?, age=?, votenumber=?, dob=?, villege=?, perfomance=? WHERE id=?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "sissssi", $name, $age, $votenumber, $dob, $villege, $perfomance, $existing_id);

        if (mysqli_stmt_execute($stmt_update)) {
            // Redirect to view_candidate.php after successful update
            header("Location: view_candidate.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            echo "Error updating candidate: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt_update);
    }
}

// Fetch existing candidate details
$sql_existing = "SELECT * FROM candidate WHERE id = ?";
$stmt_existing = mysqli_prepare($conn, $sql_existing);
mysqli_stmt_bind_param($stmt_existing, "i", $_GET['id']);
mysqli_stmt_execute($stmt_existing);
$result_existing = mysqli_stmt_get_result($stmt_existing);

// Check if there is an existing candidate
if (mysqli_num_rows($result_existing) > 0) {
    $row_existing = mysqli_fetch_assoc($result_existing);
    // Assign existing details to variables
    $existing_id = $row_existing['id'];
    $existing_name = $row_existing['name'];
    $existing_age = $row_existing['age'];
    $existing_votenumber = $row_existing['votenumber'];
    $existing_dob = $row_existing['dob'];
    $existing_villege = $row_existing['villege']; // corrected column name
    $existing_perfomance = $row_existing['perfomance']; // corrected column name
    $existing_photo = $row_existing['photo']; // existing photo path
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Candidate</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS for Update Candidate Form */
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 150px;
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
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

input[type="text"],
input[type="number"],
input[type="date"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

img {
    display: block;
    margin-bottom: 10px;
    max-width: 100%;
    height: auto;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

        </style>
</head>

<body>
<link rel="stylesheet" href="../css/style.css">
<header class="header">

<a href="#" class="logo">
    <img src="../image/pngegg.png" alt="" width="150px" height="70px"> </a>

<nav class="navbar">
    <a href="#">home</a>
    <a href="#">Contact Us</a>
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</header>
    <div class="container">
        <h1>Update Candidate</h1>

        <!-- Form to update an existing candidate -->
        <form action="update_candidate.php" method="post" enctype="multipart/form-data">
            <!-- Hidden input to store existing candidate ID -->
            <input type="hidden" name="existing_id" value="<?php echo $existing_id; ?>">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $existing_name; ?>" required>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" value="<?php echo $existing_age; ?>" required>
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="<?php echo $existing_dob; ?>" required>
            <label for="villege">Village</label>
            <input type="text" name="villege" id="villege" value="<?php echo $existing_villege; ?>" required>
            <label for="votenumber">Vote Number</label>
            <input type="number" name="votenumber" id="votenumber" value="<?php echo $existing_votenumber; ?>" required>
            <label for="perfomance">Performance</label>
            <input type="text" name="perfomance" id="perfomance" value="<?php echo $existing_perfomance; ?>" required>
            <label for="photo">Profile Image</label>
            <img src="<?php echo $existing_photo; ?>" alt="Current Profile Image" style="max-width: 200px;">
            <input type="file" name="photo" id="photo" accept="image/*">
            <button type="submit">Save Candidate</button>
        </form>
    </div>
</body>

</html>

<?php
// Close statement
mysqli_stmt_close($stmt_existing);

// Close connection
mysqli_close($conn);
?>
