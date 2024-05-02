<!DOCTYPE html>
<html>

<head>
    <title>Update Item</title>
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
    <h1>Update Item</h1>

    <?php
    // Include your database connection script (e.g., dbh.php)
    include '../dbh.php';

    if (isset($_GET['id'])) {
        $item_id = $_GET['id'];

        // Fetch item details from the database
        $query = "SELECT * FROM item WHERE itemId = $item_id";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            echo '<form action="update.php" method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="item_id" value="' . $item_id . '">';

            echo '<label for="item_name">Item Code:</label>';
            echo '<input type="text" id="item_name" name="item_code" value="' . $row['code'] . '" required>';

            echo '<label for="item_name">Item Name:</label>';
            echo '<input type="text" id="item_name" name="item_name" value="' . $row['name'] . '" required>';

            echo '<label for="item_price">Price (USD):</label>';
            echo '<input type="number" id="item_price" name="item_price" value="' . $row['price'] . '" step="0.01" required>';

            echo '<label for="item_description">Description:</label>';
            echo '<textarea id="item_description" name="item_description" rows="4" required>' . $row['discription'] . '</textarea>';

            echo '<label for="item_image">Item Image:</label>';
            echo '<input type="file" id="item_image" name="item_image" accept="image/*">';

            echo '<button type="submit">Update Item</button>';
            echo '</form>';
        } else {
            echo '<p>Item not found.</p>';
        }
    } else {
        echo '<p>Item ID not provided.</p>';
    }

    mysqli_close($conn);
    ?>

</body>

</html>

<?php
// Include your database connection script (e.g., dbh.php)
include '../dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item_id'], $_POST['item_name'], $_POST['item_price'], $_POST['item_description'])) {
        $item_id = $_POST['item_id'];
        $item_code = mysqli_real_escape_string($conn, $_POST['item_code']);
        $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
        $item_price = floatval($_POST['item_price']);
        $item_description = mysqli_real_escape_string($conn, $_POST['item_description']);

        // Check if a new image has been uploaded
        if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['item_image'];

            if (getimagesize($file['tmp_name'])) {
                // Generate a unique filename
                $image_filename = uniqid() . '_' . $file['name'];

                // Define the upload path
                $upload_path = 'uploads/' . $image_filename; // Change 'uploads/' to your desired directory

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                    // Update the item data with the new image path
                    $update_query = "UPDATE item SET code = '$item_code ', name = '$item_name', price = $item_price, discription = '$item_description', img = '$upload_path' WHERE itemId = $item_id";

                    if (mysqli_query($conn, $update_query)) {
                        // Item updated successfully
                        echo '<script type="text/javascript">
        window.onload = function () { alert("Item Updated !"); 
            window.location.href = "items.php";}
        </script>'; // Redirect to a success page
                        exit;
                    } else {
                        // Database update failed
                        header('Location: update_error.php'); // Redirect to an error page
                        exit;
                    }
                } else {
                    // File upload failed
                    header('Location: update_error.php'); // Redirect to an error page
                    exit;
                }
            } else {
                // The uploaded file is not an image
                header('Location: update_error.php'); // Redirect to an error page
                exit;
            }
        } else {
            // No new image uploaded, update other item data
            $update_query = "UPDATE item SET code = '$item_code ', name = '$item_name', price = $item_price, discription = '$item_description' WHERE itemId = $item_id";

            if (mysqli_query($conn, $update_query)) {
                // Item updated successfully
                echo '<script type="text/javascript">
        window.onload = function () { alert("Item Updated !"); 
            window.location.href = "items.php";}
        </script>'; // Redirect to a success page
                exit;
            } else {
                // Database update failed
                header('Location: update_error.php'); // Redirect to an error page
                exit;
            }
        }
    }
}
?>