<?php
// connect to db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user-mangement";

// connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// check is ID in link
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    //get data
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // 
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<p style='color: red;'>User not found.</p>";
        exit;
    }
} else {
    echo "<p style='color: red;'>Invalid ID.</p>";
    exit;
}

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        button {
            background-color: #007bff; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            font-size: 16px; 
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <h2>View Record</h2>
    <hr>
    <p><strong>Name:<br><br></strong> <?php echo $row['name']; ?></p>
    <p><strong>Email:<br><br></strong> <?php echo $row['email']; ?></p>
    <p><strong>Gender:<br><br></strong> <?php echo $row['gender'] == 'M' ? 'Male' : 'Female'; ?></p><br><br>
    <p><?php echo $row['mail_status'] == 'yes' ? 'You will receive e-mails from us.' : 'You will not receive e-mails from us.'; ?></p>
    <button onclick="window.location.href='dataOfuser.php'">Back</button>
</body>
</html>
