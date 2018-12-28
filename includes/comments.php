<?php

if (isset($_SESSION['username'])) {

} else {
  header("Location: /register.php");
  exit;
}
?>

some
