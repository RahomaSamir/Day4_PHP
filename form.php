
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
.error {
  color: #FF0000;
      }
      
</style></body>
</head>
<body>

</html>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $agreeErr="";
$name = $email = $gender = "" ;


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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    } else {
      // check email use or not
      $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
      $result_check_email = mysqli_query($conn, $sql_check_email);

      if (mysqli_num_rows($result_check_email) > 0) {
        $emailErr = "Email already exists"; 
      }
    }
  }
  
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
 }
// Check agreement (optional)
   $mail_status = isset($_POST["agree"]) ? "yes" : "no";
///////
    // If no errors, insert into database
    if (empty($nameErr) && empty($emailErr) && empty($genderErr)) {
        $sql = "INSERT INTO users (name, email, gender, mail_status) VALUES ('$name', '$email', '$gender', '$mail_status')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>User added successfully!</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

// Close connection
$conn->close();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
    <h2>User Register Form</h2>
    <hr>
    <p> please fill this form and submit to add user record to the database</p>
    <span class="error">* required field</span>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      Name:<br>
      <input type="text" name="name"pattern="[A-Za-z\s]+" title="Only letters and spaces are allowedvalue"<?php echo $name;?>">
      <span class="error">* <?php echo $nameErr;?></span>
      <br><br>
      E-mail:<br>
       <input type="text" name="email" value="<?php echo $email; ?>">
       <span class="error">* <?php echo $emailErr;?></span>
     <br><br>
     Gender: <span class="error">* <?php echo $genderErr;?></span><br>
     <input type="radio" name="gender" value="F" <?php if ($gender == "F") echo "checked"; ?>>Female<br>
     <input type="radio" name="gender" value="M"<?php if ($gender == "M") echo "checked"; ?>>Male
     
      <br><br>
     <input type="checkbox" name="agree" >
     Receive Email from us.<span class="error">* <?php echo $agreeErr;?></span>
     <br><br>
     <input type="submit" name="submit" value="Submit" style="background-color:#28a745; border:none; color:white; padding: 5px 5px; border-radius: 3px;"> <button style="background-color:#white; border:none; padding: 5px 5px; border-radius: 4px">cancal</button>
     <br><br> 
    </form>
    <?php
//create db table

    ?> 
</body>