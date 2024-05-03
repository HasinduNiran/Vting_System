<!DOCTYPE html>
<html>
<head>
    <title>Battle</title>
    <<style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-image: url('3.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    
    text-align: center;
    margin: 20px 0;
    background-color: white;
    width: 60%;
    height: 50px;
    border-radius: 8px;
    margin-left: 270px;
}

.contact-form {
    width: 70%;
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin: 10px 0;
}

label {
    display: block;
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <h1>Create Battle</h1>

    <div class="contact-form">
        <form action="addBattle.php" method="post">
            <div class="form-group">
                <label for="name">Battle Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="player1">Player 1:</label>
                <select id="player1" name="player1" required>
                    <option value="">Select Player 1</option>
                    <!-- Add options for Player 1 -->
                    <option value="Player 1 Option 1">Player 1 Option 1</option>
                    <option value="Player 1 Option 2">Player 1 Option 2</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="form-group">
                <label for="player2">Player 2:</label>
                <select id="player2" name="player2" required>
                    <option value="">Select Player 2</option>
                    <!-- Add options for Player 2 -->
                    <option value="Player 2 Option 1">Player 2 Option 1</option>
                    <option value="Player 2 Option 2">Player 2 Option 2</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="form-group">
                <label for="Description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
// Include the file that contains your database connection
include '../dbh.php';

if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $player1 = mysqli_real_escape_string($conn, $_POST['player1']);
    $player2 = mysqli_real_escape_string($conn, $_POST['player2']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // SQL query to insert battle details into the database
    $sql = "INSERT INTO `battle` (`name`, `player1`, `player2`, `description`) VALUES ('$name', '$player1', '$player2', '$description')";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // Redirect to another page after successful insertion
        header("Location: viewbattle.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
