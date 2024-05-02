<?php
// Include your database connection file (e.g., dbh.php)
include '../dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user inputs
    $item_code = mysqli_real_escape_string($conn, $_POST['item_code']);
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $item_price = floatval($_POST['item_price']);
    $item_description = mysqli_real_escape_string($conn, $_POST['item_description']);

    // Check if a file was uploaded
    if (isset($_FILES['item_image'])) {
        $file = $_FILES['item_image'];

        // Check if the file is an image
        if (getimagesize($file['tmp_name'])) {
            // Generate a unique filename
            $image_filename = uniqid() . '_' . $file['name'];

            // Define the upload path
            $upload_path = 'uploads/' . $image_filename; // Change 'uploads/' to your desired directory

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                // Insert the item data into the database
                $insert_query = "INSERT INTO item (code, name, price, discription, img) VALUES ('$item_code', '$item_name', $item_price, '$item_description', '$upload_path')";

                if (mysqli_query($conn, $insert_query)) {
                    // Item added successfully
                    echo '<script type="text/javascript">
        window.onload = function () { alert("Item Aded !"); 
            window.location.href = "items.php";}
        </script>'; // Redirect to a success page
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
<html>

<head>
    <title>Add Item</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
            background-color: yellow;
            width: 60%;
            height: 50px;
            border-radius: 8px;
            margin-left: 20px;
        }

        .container {

            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 15px 20px #ABB2B9;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);

        }

        label {
            margin-left: 50px;
            display: block;
            font-weight: bold;
            margin-top: 10px;
            font-size: 30px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            margin-left: 100px;
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 5px;
        }

        textarea {
            resize: vertical;
        }

        label[for="item_image"] {

            display: block;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        input[type="file"] {
            margin-left: 100px;
            margin-top: 5px;
            color: #333;
        }

        button[type="submit"] {
            background-color: #007bff;
            margin-left: 50px;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Optional: Add a background image or texture */
        body {
            background-image: url('bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <h1>Add New Fashion Item</h1>

    <form action="add_items.php" method="post" enctype="multipart/form-data">

        <label for="item_name">Candidates:</label>
        <input type="text" id="item_code" name="item_code" required>

        <label for="item_name">Add votes:</label>
        <input type="text" id="item_name" name="item_name" required>

        <label for="item_price">Price (USD):</label>
        <input type="number" id="item_price" name="item_price" step="0.01" required>

        <label for="item_description">Description:</label>
        <textarea id="item_description" name="item_description" rows="4" required></textarea>

        <label for="item_image">Item Image:</label>
        <input type="file" id="item_image" name="item_image" accept="image/*" required><br><br>

        <button type="submit">Add Item</button>
    </form>
</body>

</html>