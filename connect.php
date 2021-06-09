<?php

$mail = $_POST['mail'];

if (!empty($mail)) {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jazz_newsletter_emails";

  //create a connection

  $conn = new mysqli($servername, $username, $password, $dbname);

  if (mysqli_connect_error()) {
    die('Connect Error ('.mysqli_connect_errno().')'. mysqli_connect_error());
  } else {
    $SELECT = "SELECT mail From jazz_emails Where mail = ? Limit 1";
    $INSERT = "INSERT Into jazz_emails (mail) values (?)";

    $stmt = $conn -> prepare($SELECT);
    $stmt -> bind_param("s", $mail);
    $stmt -> execute();
    $stmt -> bind_result($mail);
    $stmt -> store_result();
    $rnum = $stmt -> num_rows;

    if ($rnum==0) {
        $stmt -> close();

        $stmt = $conn->prepare($INSERT);
        $stmt -> bind_param("s", $mail);
        $stmt -> execute();
        echo "You have been successfully registered!";
    } else {
        echo "Please, try another e-mail!";
    }
    $stmt -> close();
    $conn -> close();
  }
} else {
  echo "Please, insert your e-mail again!";
  die();
}

?>
