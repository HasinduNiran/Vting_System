<!DOCTYPE html>
<html>
<head>
    <title>Update Battle</title>
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
        }

        form {
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
        select,
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

        /* Optional: Add a background image or texture */
        body {
            background-image: url('3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

    </style>
</head>
<body>
    <h1>Update Battle</h1>

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
            echo '<form action="updateBattle.php" method="post">
                <input type="hidden" name="battle_id" value="' . $row['id'] . '">
                <div class="form-group">
                    <label for="name">Battle Name:</label>
                    <input type="text" id="name" name="name" value="' . $row['name'] . '" required>
                </div>

                <div class="form-group">
                    <label for="player1">Player 1:</label>
                    <input type="text" id="player1" name="player1" value="' . $row['player1'] . '" required>
                </div>

                <div class="form-group">
                    <label for="player2">Player 2:</label>
                    <input type="text" id="player2" name="player2" value="' . $row['player2'] . '" required>
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
    <?php
include '../dbh.php';
if (isset($_POST['submit'])) {
    $id = $_POST['feedback_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];
    

    $sql = "UPDATE battle SET name='$name', email='$player1', message='$msg' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script type="text/javascript">
        window.onload = function () { alert("Data Updated !"); 
            window.location.href = "viewc.php";}
        </script>';
    } else {
        echo "Failed";
    }
}
?>
    ?>
</body>
</html>
