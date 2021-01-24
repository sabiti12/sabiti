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
    <link rel="stylesheet" href="./project.css">

    <title>Projects and Publications</title>
</head>
<body>
    
<div class="topnav" id="myTopnav">
  <a href="./index.php" >Home</a>
  <a href="#projects" class="active">projects and publications</a>
  <a href="./contact.php">Contact</a>
  <a onclick="document.getElementById('id01').style.display='block'" style="float:right;">Login</a>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<div class="experience">
<h2 style="text-align: center;">Skills</h2>
<p>HTML</p>
<div class="container">
  <div class="skills html">90%</div>
</div>

<p>CSS</p>
<div class="container">
  <div class="skills css">80%</div>
</div>

<p>people skills</p>
<div class="container">
  <div class="skills js">99%</div>
</div>

<p>PHP</p>
<div class="container">
  <div class="skills php">60%</div>
</div>

</div>

<h2 style="text-align: center;">Projects</h2>
<div class="projects">

<div class="row">
  <div class="column">
    <div class="card">
      <h3>networking</h3>
      <p>infrastructure and mantainance</p>
    
    </div>
  </div>

  <div class="column">
    <div class="card">
      <h3>data collection</h3>
      <p>collecting data</p>
      
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>Server setup</h3>
      <p>Server management</p>
  
    </div>
  </div>
  
 
</div>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="./projects.php" method="post">
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