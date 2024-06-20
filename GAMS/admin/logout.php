<?php
session_start();
unset($_SESSION['aadmin_id']);
session_destroy();
header("Location: ../../index.php");
exit;
