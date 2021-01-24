<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dashboard.css">
    <title>Document</title>
</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="./index.php">LogOut</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
    <h2>Admin Dashboard</h2>

    <div class="main" style="text-align: center;">
      <h2>Messages</h2>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "abe";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $tbl = "contact"; // Table name 
      $sql = "SELECT * FROM $tbl";
      $result = $conn->query($sql);
      while ($rows = $result->fetch_assoc()) {
      ?>
        <?php

        echo "<pre>"."Name: " . $rows['name'];
        echo "<pre>" . "Email: " . $rows['email'];
        echo "<pre>" . "Message: " . $rows['message'];
        echo "<pre>"
        ?>
        <a href="dashboard.php?name=<? echo $rows['name']; ?>">delete</a>
        <hr>
      <?php
      }
      ?>
      <?php
      $conn->close();
      ?>

      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "abe";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $tbl = "contact";
      $name = $_GET['name'];
      $sqlD = "DELETE FROM $tbl WHERE name = '$name'";
      $result = $conn->query($sqlD);
      if ($result) {
        
      } else {
        echo '<span style="color:green;">ERORR</span>';
      }
      ?>
      <?php
      $conn->close();
      ?>

    </div>

</body>
</html>