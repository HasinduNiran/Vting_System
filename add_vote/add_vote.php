<!DOCTYPE html>
<html>
<head>
    <title>Voting</title>
    <style>
        /* CSS for Vote Box */
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
            margin-left: auto;
            margin-right: auto;
            padding-top: 15px;
        }

        .contact-form {
            width: 60%;
            max-width: 500px;
            margin: 20px auto;
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
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px; /* Add margin bottom */
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
            width: 100%; /* Make button full width */
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    

    <form action="add_vote.php" method="post" class="contact-form">
    <h1>Add New Vote</h1>
        <label for="candidate">Vote Number:</label>
        <select id="candidate" name="candidate" required>
            <option value="candidate1"> 01</option>
            <option value="candidate2"> 02</option>
            <option value="candidate3"> 03</option>
            <option value="candidate4"> 04</option>
            <option value="candidate5"> 05</option>
            <!-- Add more candidates as needed -->
        </select>

        <!-- <label for="vote">Vote:</label>
        <input type="checkbox" id="vote" name="vote" value="1"> -->

        <button type="submit" name="submit">Add Vote</button>
    </form>
</body>
</html>
<?php
include '../dbh.php'; // Make sure to include your database connection here

if (isset($_POST['submit'])) {
    // Sanitize and validate input
    $candidate = $_POST['candidate']; // Assuming you trust the values in the select box
    $vote = isset($_POST['vote']) ? 1 : 0; // Check if the checkbox is checked

    // Insert data into the database
    $sql = "INSERT INTO vote (candidate, vote) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $candidate, $vote);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Vote added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
?>