<?php

include '../dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM vote WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        echo '<!DOCTYPE html>
<html>
<head>
    <title>Update Vote</title>
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
        background-image: url("../image/dg.png");
        background-size: cover;
        background-repeat: no-repeat;
    }
    

    h1 {
        text-align: center;
        margin: 20px 0;
        color: #333;
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
    input[type="date"],
    input[type="tel"],
    select,
    textarea {
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
    <h1>Update Vote</h1>

    <form action="update_vote.php" method="post" class="contact-form">
        <input type="hidden" name="vote_id" value="' . $row['id'] . '">
        <div class="form-group">
            <label for="voter">Voter:</label>
            <input type="text" id="voter" name="voter" value="' . $row['voter'] . '" required>
        </div>
        <div class="form-group">
            <label for="candidate">Vote Number:</label>
            <input type="hidden" name="candidate" value="' . $row['candidate'] . '">
            <span>' . $row['candidate'] . '</span>
        </div>
        <div class="form-group">
            <label for="voteDate">Vote Date:</label>
            <input type="date" id="voteDate" name="votedate" value="' . $row['votedate'] . '" required>
        </div>
        <div class="form-group">
            <label for="telephone">Telephone:</label>
            <input type="tel" id="telephone" name="telephone" value="' . $row['telephone'] . '" required>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment">' . $row['comment'] . '</textarea>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="' . $row['city'] . '" required>
        </div>
        <div class="form-group">
            <label for="vote">Vote:</label>
            <input type="checkbox" id="vote" name="vote" value="1" ' . ($row['vote'] == 1 ? 'checked' : '') . '>
        </div>
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>';
    } else {
        echo 'Vote entry not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote_id'])) {
    $id = $_POST['vote_id'];
    $voter = mysqli_real_escape_string($conn, $_POST['voter']);
    // You can remove the line below to prevent the user from updating the candidate field
    // $candidate = mysqli_real_escape_string($conn, $_POST['candidate']); 
    $voteDate = mysqli_real_escape_string($conn, $_POST['votedate']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $vote = isset($_POST['vote']) ? 1 : 0;

    $sql = "UPDATE vote SET voter='$voter', votedate='$voteDate', telephone='$telephone', comment='$comment', city='$city', vote=$vote WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: view_vote.php');
    } else {
        echo 'Failed to update vote.';
    }
}

mysqli_close($conn);

?>
