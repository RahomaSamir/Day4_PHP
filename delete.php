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

    // delete query
    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        
        header("Location: dataOfuser.php"); 
        exit;
    } else {
        echo "<p style='color: red;'>Error deleting record: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p style='color: red;'>Invalid ID.</p>";
}

// close connection
mysqli_close($conn);
?>

