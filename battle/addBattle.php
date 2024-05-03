<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Battle</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        body {
            background-image: url("battleBack.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        .contact-form {
            width: 90%;
            max-width: 450px;
            position: absolute;
            top: 50%; /* Adjust the vertical position of the form */
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9); /* Set background color with opacity */
            border-radius: 10px;
            padding: 50px 60px 70px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2); /* Add shadow to the border */
        }

        .form-group {
            margin-bottom: 20px; /* Adjust spacing between input fields */
        }

        label {
            font-weight: bold;
            display: block;
        }

        input, select, textarea {
            padding: 15px 10px;
            width: calc(100% - 20px); /* Adjust width to fit the container */
            font-family: 'Poppins', sans-serif;
            border-radius: 10px;
            border-style: none;
            background-color: rgb(145, 205, 207);
        }

        button {
            margin: 10px 0;
            padding: 15px;
            width: calc(100% - 20px); /* Adjust width to fit the container */
            background-color: rgb(61, 150, 202);
            border-style: none;
            border-radius: 20px;
            font-size: 15px;
            color: aliceblue;
            font-family: 'Poppins', sans-serif;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        button:hover {
            color: rgb(20, 129, 192);
            background-color: rgb(237, 237, 237);
        }

        h1 {
            text-align: center;
            text-decoration: underline;
            margin-bottom: 20px;
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
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

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
            echo '<script type="text/javascript">
            window.onload = function () { alert("Battle details saved successfully!"); 
                window.location.href = "viewbattle.php";}
            </script>'; // Redirect to viewbattle.php after successful insertion
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
