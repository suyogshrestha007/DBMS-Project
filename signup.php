<html>
  <head>
    <meta charset="utf-8">
    <title>َSign Up</title>
    <link rel="stylesheet" href="css/signup.css">
  </head>
  <body>

    <form action="signup.php" method="post">
      <div class="signupinfo">
        <div class="first-last">
          <label for="occupation">Occupation</label>
          <select class="ipbox" name="occupation" style="margin-left:76px" required>
            <option value="prof">Professor</option>
            <option value="student">Student</option>
          </select>
          <br>
          <label for="fname">First Name</label>
          <input type="text" placeholder="First Name" name="fname" class="ipbox" required>
          <br>
          <label for="lname">Last Name</label>
          <input type="text" placeholder="Last Name" name="lname" class="ipbox" style="margin-left: 80px;" required>
        </div>
          <br>
        <div class="email-pass">
          <label for="email">E-mail</label>
          <input type="text" placeholder="E-mail" name="email" class="email-box" required>
        </div>
          <br>
        <div class="reg-no">
          <label for="regno">Registration Number</label>
          <input type="text" placeholder="Reg. No." name="regno" class="reg-box" required>
        </div>
          <br>
        <div class="email-pass">
          <label for="pword">Password</label>
          <input type="password" placeholder="Password" name="pword" class="pass-box" required>
        </div>
          <br>
          <button type="submit" name="submitbtn" class="signupbtn"><span>SUBMIT</span></button>
      </div>
    </form>
  </body>
</html>

<?php
  include 'db.php';
  if(isset($_POST['submitbtn'])){
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $reg_no = $_POST['regno'];
    $password = $_POST['pword'];
    $dept = $_POST['branch'];
    $sem = $_POST['sem'];
    $grp = $_POST['grp'];
    $subgrp = $_POST['subgrp'];
    $hash = password_hash($password,PASSWORD_BCRYPT);

    $query1 = "INSERT INTO login VALUES($reg_no,'$hash',1,'$email');";
    $query2 = "INSERT INTO student VALUES($reg_no,'$first_name','$last_name','$dept','$grp','$subgrp','$sem');";

    if(mysqli_query($conn,$query1)) {
      if(mysqli_query($conn,$query2)) {
        header('Location: login_page.php');
        exit;
      }
      else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        echo "Error connecting to database";
      }
    }
    else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
      echo "Error connecting to database";
    }
    mysqli_close($conn);
  }
?>
