<?php 
  include_once('../settings/db.php');
  session_start();

  if (isset($_POST['username'])){
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($db,$username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($db,$password);
    //Checking is user existing in the database or not
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
    $result = mysqli_query($db,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
      $_SESSION['username'] = $username;
      // Redirect user to index.php
      header("Location: index.php");
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Login</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="css/floating-labels.css" rel="stylesheet">
</head>
<body>
  <form action="" method="post" name="login" class="form-signin">
    <div class="text-center mb-4">
      <img class="mb-4" src="../image/dj-raveon-txt-full.png" alt="" width="72" height="72">
    </div>
    <div class="form-label-group">
      <input type="text" id="inputUser" class="form-control" name="username" placeholder="Username" required autofocus>
      <label for="inputUser">Username</label>
    </div>
    <div class="form-label-group">
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <label for="inputPassword">Password</label>
    </div>
    <button class="btn btn-lg btn-light btn-block" type="submit">Sign in</button>
    <small>
      <p class="mt-5 mb-3 text-muted text-center">&copy; DJ Raveon <?php echo date('Y'); ?></p>
    </small>
  </form>
</body>
</html>
