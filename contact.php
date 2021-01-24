<?php
    session_start();
  
    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'abe');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM users WHERE username='$username'");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<span style="color:red;">Username password combination is wrong!</span>';

        } else {
            if ($password === $result['password']) {
                $_SESSION['user_id'] = $result['id'];
                header('Location: dashboard.php');
                echo '<span style="color:red;">Congratulations, you are logged in!</span>';

            } else {
                echo '<span style="color:red;">Username password combination is wrong!</span>';

                
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./contact.css">
    <title>Contact</title>
</head>
<body>
    
<div class="topnav" id="myTopnav">
  <a href="./index.php" >Home</a>
  <a href="./projects.php">projects and publications</a>
  <a href="#contact" class="active">Contact</a>
  <a onclick="document.getElementById('id01').style.display='block'" style="float:right;">Login</a>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<div>
<div class="container">
<div class="address">
      <p><i class="fa fa-mobile" aria-hidden="true"></i> Tel: +256754110454</p>
      <p><i class="fa fa-envelope-o" aria-hidden="true"></i> Email: isyagi13eb@gmail.com</p>
      <p><i class="fa fa-map-marker" aria-hidden="true"></i> Location: P.O.Box 3525 MUKONO </p>

    </div>
</div>

<div class="container">
<?php

$servername = "localhost";
$user = "root";
$pass = "";
$db = "abe";

$conn = new mysqli($servername, $user, $pass, $db);

// if($conn->error){
//     echo "DB error ".$conn->error."";
// }
// else{
//     echo "Connection successful";
// }

if (isset($_POST['send'])) {
  echo "<br>";

  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $sql = "insert into contact (name,email,message) values ('$name','$email','$message')";

  if ($conn->query($sql)) {
    // echo "message sent SUCCESSFULLY!!!";
    echo '<span style="color:green;">message sent SUCCESSFULLY!!!</span>';
  } else {
    echo "Error: " . $conn->error;
  }
}

?>

  <form action="./contact.php" method="POST">
    <div class="row">
      <div class="col-25">
        <label for="fname">First Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="name" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Last Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="email" placeholder="Your email..">
      </div>
    </div>
   
    <div class="row">
      <div class="col-25">
        <label for="subject">Subject</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="message" placeholder="Write something.." style="height:200px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" name="send" value="Send">
    </div>
  </form>
</div>
</div>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="./contact.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit" name="login">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
<script src="./func.js"></script>
</body>
</html>