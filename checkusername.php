<?php
function readJsonFile($filePath) {
    if (file_exists($filePath)) {
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $data;
        } else {
            error_log("JSON decode error for file $filePath: " . json_last_error_msg());
        }
    } else {
        error_log("File not found: $filePath");
    }
    return null;
}

$userDataPutra = readJsonFile('putra.json');
$userDataPutri = readJsonFile('putri.json');

function findUserByNIS($nis, $userDataPutra, $userDataPutri) {
    $results = [];
    
    if (is_array($userDataPutra)) {
        foreach ($userDataPutra as $username => $data) {
            if (isset($data['nis']) && $data['nis'] == $nis) {
                $results[] = ['username' => $username, 'data' => $data, 'gender' => 'Putra'];
            }
        }
    }
    if (is_array($userDataPutri)) {
        foreach ($userDataPutri as $username => $data) {
            if (isset($data['nis']) && $data['nis'] == $nis) {
                $results[] = ['username' => $username, 'data' => $data, 'gender' => 'Putri'];
            }
        }
    }
    
    return $results;
}

$message = '';
$userData = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchNIS = $_POST['search_nis'];
    $userData = findUserByNIS($searchNIS, $userDataPutra, $userDataPutri);
    
    if (empty($userData)) {
        $message = "User dengan NIS $searchNIS tidak ditemukan.";
    }
}

if ($userDataPutra === null || $userDataPutri === null) {
    $message = "Error: Gagal memuat data pengguna. Silakan coba lagi nanti atau hubungi administrator.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚀 Database - PEMILU RAYA ORSATRENS TEBUIRENG</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/jpg" href="logo.jpg">
</head>
<body>
    <div class="container">
        <h1 class="title">View User Information</h1>
        
        <?php if ($userDataPutra !== null && $userDataPutri !== null): ?>
            <form method="post">
                <input type="text" id="search_nis" name="search_nis" placeholder="Enter NIS" required>
                <button type="submit">Search</button>
            </form>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if ($userData !== null): ?>
            <h2 class="subtitle">User Information</h2>
            <?php foreach ($userData as $user): ?>
                <div class="user-info">
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>NIS:</strong> <?php echo htmlspecialchars($user['data']['nis']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['data']['namadepan'] . ' ' . $user['data']['namabelakang']); ?></p>
                    <p><strong>Password:</strong> <?php echo htmlspecialchars($user['data']['password']); ?></p>
                    <?php if ($user['data']['nis'] == '1'): ?>
                        <p><strong>ID:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <?php endif; ?>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>