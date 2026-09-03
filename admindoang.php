<?php
header('Content-Type: text/html; charset=utf-8');
$userDataPutra = json_decode(file_get_contents('putra.json'), true);
$userDataPutri = json_decode(file_get_contents('putri.json'), true);

function countVotingStatus($userData) {
    $voted = 0;
    $notVoted = 0;
    foreach ($userData as $user) {
        if ($user['hasVote']) {
            $voted++;
        } else {
            $notVoted++;
        }
    }
    return [$voted, $notVoted];
}

list($votedPutra, $notVotedPutra) = countVotingStatus($userDataPutra);
$totalPutra = count($userDataPutra);

list($votedPutri, $notVotedPutri) = countVotingStatus($userDataPutri);
$totalPutri = count($userDataPutri);

if(isset($_GET['get_vote_data'])) {
    $voteDataPA = json_decode(file_get_contents('suaraPA.json'), true);
    $voteDataPI = json_decode(file_get_contents('suaraPI.json'), true);
    $userDataPutra = json_decode(file_get_contents('putra.json'), true);
    $userDataPutri = json_decode(file_get_contents('putri.json'), true);
    list($votedPutra, $notVotedPutra) = countVotingStatus($userDataPutra);
    list($votedPutri, $notVotedPutri) = countVotingStatus($userDataPutri);
    
    echo json_encode([
        'PA' => $voteDataPA,
        'PI' => $voteDataPI,
        'voterData' => [
            'putra' => [
                'total' => count($userDataPutra),
                'voted' => $votedPutra,
                'notVoted' => $notVotedPutra
            ],
            'putri' => [
                'total' => count($userDataPutri),
                'voted' => $votedPutri,
                'notVoted' => $notVotedPutri
            ]
        ]
    ]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>Data Pemilih</h2>
        <table border="1" id="voterDataTable">
            <tr>
                <th>Database</th>
                <th>Total Users</th>
                <th>Voted</th>
                <th>Not Voted</th>
            </tr>
            <tr>
                <td>Putra</td>
                <td id="totalPutra"><?php echo $totalPutra; ?></td>
                <td id="votedPutra"><?php echo $votedPutra; ?></td>
                <td id="notVotedPutra"><?php echo $notVotedPutra; ?></td>
            </tr>
            <tr>
                <td>Putri</td>
                <td id="totalPutri"><?php echo $totalPutri; ?></td>
                <td id="votedPutri"><?php echo $votedPutri; ?></td>
                <td id="notVotedPutri"><?php echo $notVotedPutri; ?></td>
            </tr>
        </table>

        <h2>Real Count</h2>
        <canvas id="realCountChart" width="400" height="200"></canvas>
        <script>
            let realCountChart;

            function createChart(data) {
                const ctx = document.getElementById('realCountChart').getContext('2d');
                realCountChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Paslon Nomor 1', 'Paslon Nomor 2', 'Paslon Nomor 3'],
                        datasets: [
                            {
                                label: 'Putra',
                                data: [data.PA.paslon_1, data.PA.paslon_2, data.PA.paslon_3],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Putri',
                                data: [data.PI.paslon_1, data.PI.paslon_2, 0],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            function updateVoterData(data) {
                document.getElementById('totalPutra').textContent = data.voterData.putra.total;
                document.getElementById('votedPutra').textContent = data.voterData.putra.voted;
                document.getElementById('notVotedPutra').textContent = data.voterData.putra.notVoted;
                document.getElementById('totalPutri').textContent = data.voterData.putri.total;
                document.getElementById('votedPutri').textContent = data.voterData.putri.voted;
                document.getElementById('notVotedPutri').textContent = data.voterData.putri.notVoted;
            }

            function updateData() {
                fetch('admindoang.php?get_vote_data=1')
                    .then(response => response.json())
                    .then(data => {
                        realCountChart.data.datasets[0].data = [data.PA.paslon_1, data.PA.paslon_2, data.PA.paslon_3];
                        realCountChart.data.datasets[1].data = [data.PI.paslon_1, data.PI.paslon_2, 0];
                        realCountChart.update();
                        updateVoterData(data);
                    })
                    .catch(error => console.error('Error:', error));
            }

            fetch('admindoang.php?get_vote_data=1')
                .then(response => response.json())
                .then(data => {
                    createChart(data);
                    updateVoterData(data);
                    setInterval(updateData, 5000);
                })
                .catch(error => console.error('Error:', error));
        </script>
    </div>
</body>
</html>