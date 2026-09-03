<?php
session_start();
$username = $_SESSION['username'];
$userData = json_decode(file_get_contents('database.json'), true);
if (isset($userData[$username])) {
  $userData[$username]['hasVote'] = true;
  file_put_contents('database.json', json_encode($userData));
}
unset($_SESSION['logged_in']);
unset($_SESSION['username']);
session_destroy();
header('Location: login.php');
exit;
?>