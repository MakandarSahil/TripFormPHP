<?php 
$insert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost"; 
    $username = "root";
    $password = "";
    $database = "trip"; 

    $con = mysqli_connect($server, $username, $password, $database);

    if (!$con) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $name = mysqli_real_escape_string($con, $name);
    $age = (int) $age;
    $gender = mysqli_real_escape_string($con, $gender);
    $email = mysqli_real_escape_string($con, $email);
    $phone = mysqli_real_escape_string($con, $phone);
    $address = mysqli_real_escape_string($con, $address);

    $sql = "INSERT INTO `trip` (`name`, `age`, `gender`, `email`, `phone`, `address`, `dt`) 
            VALUES ('$name', '$age', '$gender', '$email', '$phone', '$address', current_timestamp())";

    if (mysqli_query($con, $sql)) {
        $insert = true;
    } else {
        echo "ERROR: $sql <br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DKTE Ichalkaranji Trip Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h3>Welcome to DKTE Ichalkaranji Trip Form</h3>
    <p>Enter your details and submit this form to confirm your participation in this exciting trip!</p>

    <?php
    if ($insert) {
        echo "<p style='color: green; font-weight: bold;'>Thank you! Your submission has been recorded.</p>";
    }
    ?>

    <form action="index.php" method="post">
      <input type="text" name="name" id="name" placeholder="Enter your name" required>
      <div class="input-group">
        <input type="number" name="age" id="age" placeholder="Enter your age" required>
        <input type="text" name="gender" id="gender" placeholder="Enter your gender" required>
      </div>
      <input type="email" name="email" id="email" placeholder="Enter your email" required>
      <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required>
      <input type="text" name="address" id="address" placeholder="Enter your address" required>
      <div class="btn-container">
        <button type="submit" class="btn">Submit</button>
        <button type="reset" class="btn">Reset</button>
      </div>
    </form>
  </div>
  <script src="script.js"></script>
</body>
</html>
