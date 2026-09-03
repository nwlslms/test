<?php
session_start();

$username = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $userDataPutra = json_decode(file_get_contents('putra.json'), true);
  $userDataPutri = json_decode(file_get_contents('putri.json'), true);

  if (isset($userDataPutra[$username]) && $userDataPutra[$username]['password'] === $password && !$userDataPutra[$username]['hasVote']) {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    header('Location: votePA.php');
    exit;
  }
  elseif (isset($userDataPutri[$username]) && $userDataPutri[$username]['password'] === $password && !$userDataPutri[$username]['hasVote']) {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    header('Location: votePI.php');
    exit;
  }
  elseif ((isset($userDataPutra[$username]) && $userDataPutra[$username]['hasVote']) || 
          (isset($userDataPutri[$username]) && $userDataPutri[$username]['hasVote'])) {
    $errorMessage = 'Akun telah melakukan voting.';
  }
  else {
    $errorMessage = 'Username atau password salah.';
  }
}
?>

<html>
<head>
  <title>🚀 PEMILU RAYA ORSATRENS TEBUIRENG MASA KHIDMAT 2025/2026</title>
  <link rel="stylesheet" href="style\style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/jpg" href="logo.jpg">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="title">PEMILU RAYA</h2>  
    <h2 class ="subtitle">ORSATRENS TEBUIRENG MASA KHIDMAT 2025/2026</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="text" id="username" placeholder="Username" name="username" required value="<?php echo htmlspecialchars($username); ?>"><br>
        <input type="password" id="password" placeholder="Password" name="password" required value="<?php echo htmlspecialchars($password); ?>"><br>
      <?php if (isset($errorMessage)):?>
        <p class="error-message"><?php echo $errorMessage;?></p>
      <?php endif; ?>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>