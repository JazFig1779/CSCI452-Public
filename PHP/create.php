<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $id = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT id FROM users WHERE username = '$id' and passcode = '$password'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 0) {
         $createUser = "INSERT INTO users VALUES($id, $f_name, $l_name, $email, $password)";
         mysqli($db, $createUser);
      } else {
         $error = "That username already exists";
      }
   }
?>
