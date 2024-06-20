<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

  $id = $_GET['delete'];
  $adn = "DELETE FROM  rpos_products  WHERE  prod_id = ?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $stmt->close();
  if ($stmt) {
    $success = "Deleted" && header("refresh:1; url=products.php");
  } else {
    $err = "Try Again Later";
  }
require_once('partials/_head.php');
?>
