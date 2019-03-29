<?php
  session_start();
  include 'db.php';
  if(isset($_POST['submitbtn'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $hash = password_hash($password,PASSWORD_BCRYPT);

    $data=array();
    $query = "SELECT username,password FROM login WHERE username=$username AND password=$hash;";

    if ($res=mysqli_query($conn, $query)) {
      foreach ($res as $row) {
        $data[]=$row;
      }
    }
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    if(empty($data)){
      header('Location: interstitial.html');
      exit;
    }
    else{
      if ($data[0]['username']==$regno && $data[0]['password']==$pass) {
        header('Location: home.php');
        exit;
      }
    }
    mysqli_close($conn);
  }
  if(isset($_POST['signupbtn'])){
    header('Location: signup.php');
  }
 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َAnimated Login Form</title>
    <link rel="stylesheet" href="css/login_page.css">
  </head>
  <body>

    <form class="box" action="login_page.php" method="post">
      <h1>Login</h1>
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" name="submitbtn" value="Login">
      <input type="submit" name="signupbtn" value="Sign Up">
    </form>

  </body>
</html>
