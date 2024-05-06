<!DOCTYPE html>
<html>
<head>
    <title>Voting</title>
    <style>
        /* CSS for Vote Box */
        body {
            background-image: url('../image/sky.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 120px;
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
        input[type="tel"],
        input[type="date"],
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
<header class="header">
<link rel="stylesheet" href="../css/style.css">
    <a href="#" class="logo">
        <img src="../image/pngegg.png" alt="" width="150px" height="70px"> </a>

    <nav class="navbar">
        <a href="#">home</a>
        <a href="#">Contact Us</a>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>
</header>
    

    <form action="add_vote.php" method="post" class="contact-form">
    <h1>Add New Vote</h1>
        <label for="voter">Voter:</label>
        <input type="text" id="voter" name="voter" required>

        <label for="candidate">Vote Number:</label>
        <select id="candidate" name="candidate" required>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>
            <option value="5">05</option>
            <!-- Add more candidates as needed -->
        </select>

        <label for="voteDate">Vote Date:</label>
        <input type="date" id="voteDate" name="voteDate" required>

        <label for="telephone">Telephone:</label>
        <input type="tel" id="telephone" name="telephone" required>

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment"></textarea>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="vote">Vote:</label>
        <input type="checkbox" id="vote" name="vote" value="1">

        <button type="submit" name="submit">Add Vote</button>
    </form>
</body>
</html>
<?php
include '../dbh.php'; // Make sure to include your database connection here

if (isset($_POST['submit'])) {
    // Check if all required fields are set
    if (
        isset($_POST['voter']) && 
        isset($_POST['candidate']) && 
        isset($_POST['voteDate']) && 
        isset($_POST['telephone']) && 
        isset($_POST['city'])
    ) {
        // Sanitize and validate input
        $voter = $_POST['voter'];
        $candidate = $_POST['candidate'];
        $voteDate = $_POST['voteDate'];
        $telephone = $_POST['telephone'];
        $comment = isset($_POST['comment']) ? $_POST['comment'] : null; // Comment is optional
        $city = $_POST['city'];
        $vote = isset($_POST['vote']) ? 1 : 0;

        // Insert data into the database
        $sql = "INSERT INTO vote (voter, candidate, voteDate, telephone, comment, city, vote) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $voter, $candidate, $voteDate, $telephone, $comment, $city, $vote);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Vote added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // If required fields are not set, display an error message
        echo "Please fill in all required fields.";
    }

    // Close connection
    $conn->close();
}
?>
