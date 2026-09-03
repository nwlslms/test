<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
function logVoteChoice($username, $nis, $chosenCheckbox, $logFilePath) {
    $logEntry = date('Y-m-d H:i:s') . " | Username: " . $username . " dengan nomer: " . $nis . " telah melakukan vote. Vote: " . $chosenCheckbox . "\n";
    file_put_contents($logFilePath, $logEntry, FILE_APPEND);
}
$username = $_SESSION['username'];
$userDataPutra = json_decode(file_get_contents('putra.json'), true);
$userDataPutri = json_decode(file_get_contents('putri.json'), true);
if (isset($userDataPutra[$username])) {
    $userData = $userDataPutra;
    $filePath = 'putra.json';
    $voteFilePath = 'suaraPA.json';
    $logFilePath = 'logsPA.txt';
    $displayUsername = $userDataPutra[$username]['namadepan'];
} elseif (isset($userDataPutri[$username])) {
    $userData = $userDataPutri;
    $filePath = 'putri.json';
    $voteFilePath = 'suaraPI.json';
    $logFilePath = 'logsPI.txt';
    $displayUsername = $userDataPutri[$username]['namadepan'];
} else {
    header('Location: login.php');
    exit;
}
$nis = $userData[$username]['nis'];
$chosenCheckbox = $_POST['question'];
$voteData = json_decode(file_get_contents($voteFilePath), true);
if ($chosenCheckbox === 'Paslon Nomor 1') {
    $voteData['paslon_1']++;
} else if ($chosenCheckbox === 'Paslon Nomor 2'){
    $voteData['paslon_2']++;
} else if ($chosenCheckbox === 'Paslon Nomor 3') {
    $voteData['paslon_3']++;
} else {
    $voteData['SuaraRusak']++;
}
$voteData['total_suara']++;
file_put_contents($voteFilePath, json_encode($voteData));
logVoteChoice($username, $nis, $chosenCheckbox, $logFilePath);
$userData[$username]['hasVote'] = true;
file_put_contents($filePath, json_encode($userData, JSON_PRETTY_PRINT));

unset($_SESSION['logged_in']);
unset($_SESSION['username']);

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/jpg" href="logo.jpg">
    <title>🚀 PEMILU RAYA ORSATRENS TEBUIRENG MASA KHIDMAT 2025/2026</title>
</head>
<body>
<div class="container4">
    <h1>Terima Kasih, <?php echo htmlspecialchars($displayUsername); ?></h1>
    <p>atas partisipasinya dalam Pemilu Raya ORSATRENS TEBUIRENG 2026/2027!</p>
    <a href="logout.php"><button type="submit">KELUAR</button></a>
</div>
</body>
</html>