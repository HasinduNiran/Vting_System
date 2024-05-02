<!DOCTYPE html>
<html>
<head>
    <title>Voting</title>
    <style>
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
    <h1>Add New Vote</h1>

    <form action="add_vote.php" method="post" class="contact-form">

        <label for="candidate">Candidates:</label>
        <select id="candidate" name="candidate" required>
            <option value="candidate1">Candidate 1</option>
            <option value="candidate2">Candidate 2</option>
            <option value="candidate3">Candidate 3</option>
            <!-- Add more candidates as needed -->
        </select>

        <label for="vote">Vote:</label>
        <input type="checkbox" id="vote" name="vote" value="1">

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

