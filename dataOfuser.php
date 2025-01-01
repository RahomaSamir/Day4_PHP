<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data_of_users</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
     button {
      background-color: #28a745; 
      color: white; 
      border: none; 
      padding: 10px 20px; 
      border-radius: 5px; 
      font-size: 16px; 
      margin-left: auto; 
      display: block; 
      width: 150px; 
      text-align: center;
    }
    button:hover {
      background-color: #218838; 
      box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2); 
    }
    table{
            width: 80%;
            margin: 20px auto;
        }
        th, td{
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th{
            background-color: rosybrown;
        }
  </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user-mangement";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>
  <h2>User details</h2>
  <button onclick="window.location.href='form.php'">Add New User</button>


  <hr>
<table border="1">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Gender</th>
      <th>Mail status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["email"] . "</td>";
      echo "<td>" . $row['gender'] . "</td>";
      echo "<td>" . $row['mail_status'] . "</td>";
      echo "<td>
      <a href='view.php?id=" . $row['id'] . "'>View</a> | 
      <a href='edit.php?id=" . $row['id'] . "'>Edit</a> | 
      <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
    </td>";
echo "</tr>";
}
} else {
echo "<tr><td colspan='6'>No users found</td></tr>";
}
  // Close connection
  mysqli_close($conn);
  ?>
  </tbody>
</table>
</body>
</html>


