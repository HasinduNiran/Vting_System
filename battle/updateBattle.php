<!DOCTYPE html>
<html>
<head>
    <title>Update Battle</title>
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

    .contact {
        width: 90%;
        margin-top: 20%;
        max-width: 4px;
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

    h2 {
        text-align: center;
        text-decoration: underline;
   margin-top: 10%;
   
        
    }
</style>

</head>
<body>
<nav class="nav">
        <link rel="stylesheet" href="../Header/headcss.css" />
        <script src="../Header/headjs.js"></script>
        <div class="containerr">
            <h1 class="logo"><a href="index.php">One Shot Voting</a></h1>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="sign_up.php">Signup</a></li>
        
            </ul>
          </div>
        </nav>
    <h2>Update Battle</h2>

    <?php
    // Include your database connection script (e.g., dbh.php)
    include '../dbh.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the specific battle entry from the database
        $query = "SELECT * FROM battle WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Fetch player names for dropdown options
            $playersQuery = "SELECT name FROM candidate"; 
            $playersResult = mysqli_query($conn, $playersQuery);

            echo '<form action="updateBattle.php" method="post" class="contact">
                <input type="hidden" name="battle_id" value="' . $row['id'] . '">
                <div class="form-group">
                    <label for="name">Battle Name:</label>
                    <input type="text" id="name" name="name" value="' . $row['name'] . '" required>
                </div>

                <div class="form-group">
                    <label for="player1">Player 1:</label>
                    <select id="player1" name="player1" required>';
                        while ($player = mysqli_fetch_assoc($playersResult)) {
                            echo '<option value="' . $player['name'] . '"';
                            if ($row['player1'] == $player['name']) {
                                echo ' selected';
                            }
                            echo '>' . $player['name'] . '</option>';
                        }
            echo '</select>
                </div>

                <div class="form-group">
                    <label for="player2">Player 2:</label>
                    <select id="player2" name="player2" required>';
                        // Reset the pointer of $playersResult
                        mysqli_data_seek($playersResult, 0);
                        while ($player = mysqli_fetch_assoc($playersResult)) {
                            echo '<option value="' . $player['name'] . '"';
                            if ($row['player2'] == $player['name']) {
                                echo ' selected';
                            }
                            echo '>' . $player['name'] . '</option>';
                        }
            echo '</select>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required>' . $row['description'] . '</textarea>
                </div>

                <button type="submit" name="submit">Update</button>
            </form>';
        } else {
            echo 'Battle entry not found.';
        }
    }
    ?>

    <?php
    include '../dbh.php';
    if (isset($_POST['submit'])) {
        $id = $_POST['battle_id'];
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $player1 = mysqli_real_escape_string($conn, $_POST['player1']);
        $player2 = mysqli_real_escape_string($conn, $_POST['player2']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $sql = "UPDATE battle SET name='$name', player1='$player1', player2='$player2', description='$description' WHERE id=$id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<script type="text/javascript">
            alert("Data Updated!");
            window.location.href = "viewbattle.php";
            </script>';
        } else {
            echo "Failed";
        }
    }
    ?>
  
</body>

</html>
