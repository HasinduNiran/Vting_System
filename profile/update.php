<?php
session_start();
include '../dbh.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}


if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone'])) {
        // Sanitize and validate user inputs
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Update user details in the database
        $query = "UPDATE `user` SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', email = '$email', password = '$password' WHERE id = $userId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script type="text/javascript">
        window.onload = function () { alert("Account Updated !"); 
            window.location.href = "view.php";}
        </script>'; // Redirect back to the dashboard after successful update
            exit;
        }
    }
}
?>

<?php
        
        include '../dbh.php';

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Retrieve user details from the database
            $query = "SELECT * FROM `user` WHERE id = $userId";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
            }
        }
        ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <!-- <link rel="stylesheet" type="text/css" href="dashboard-style.css">  -->
    <style>



        body {
            font-family: 'Arial', sans-serif;
            
            margin: 0;
            padding: 0;
            background-image: url("./../image/sky.png");
            background-size: cover;
            background-repeat: no-repeat;
}

.container {
    position: relative;
    top: 100px;
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form {
    text-align: center;
}

label {
    display: block;
    font-size: 18px;
    margin-top: 20px;
    color: #333;
}

input {
    width: 90%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    margin-top: 20px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Styling for individual form fields */
#firstname {
    background-color: #f9f9f9;
}

#lastname {
    background-color: #f9f9f9;
}

#phone {
    background-color: #f9f9f9;
}

#email {
    background-color: #f9f9f9;
}

#firstname:focus, #lastname:focus, #phone:focus, #email:focus {
    background-color: #fff;
    border: 1px solid #007bff;
    outline: none;
}

/* Optional: Add a background image or texture */


    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Your Profile</h1>

        <!-- Add a form to edit user details -->
        <form method="post" action="update.php">
            <!-- Input fields for editing user details with values from the database -->
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="email">Password:</label>
            <input type="pass" id="email" name="password" value="<?php echo $user['password']; ?>" required>

            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>
</body>
</html>
