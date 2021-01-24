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
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./index.css">

    <title>Home</title>
</head>
<body>
    
<div class="topnav" id="myTopnav">
  <a href="#home" class="active">Home</a>
  <a href="./projects.php">projects and publications</a>
  <a href="./contact.php">Contact</a>
  <a onclick="document.getElementById('id01').style.display='block'" style="float:right;">Login</a>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<div style="text-align: center; margin-top:30px;">
<img style="width: 350px;height:450px;" src="./abe.jpeg"/>
</div>
<div style="text-align: center;">
<h2>Abraham Isyagi</h2>
<p>Between hope and despair</p>
</div>
<div class="social-media">
      <ul class="social-link">
        <li class="social">
          <a class="list-link" href="mailto:isyagi13eb@gmail.com"><i class="fa fa-envelope fa-1x icon" aria-hidden="true"></i></a>
        </li>
        <li class="social">
          <a class="list-link" href="https://github.com/sabiti12"><i class="fa fa-github fa-1x icon" aria-hidden="true"></i></a>
        </li>
        <li class="social">
          <a class="list-link" href="https://twitter.com/isyagikelevra"><i class="fa fa-twitter fa-1x icon" aria-hidden="true"></i></a>
        </li>
        <li class="social">
          <a class="list-link" href="https://www.linkedin.com/in/abramisyagi/"><i class="fa fa-linkedin fa-1x icon" aria-hidden="true"></i></a>
        </li>
      </ul>
    </div>
    <div id="id01" class="modal">
  
  <form class="modal-content animate" action="./index.php" method="post">
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