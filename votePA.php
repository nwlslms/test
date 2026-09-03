<?php
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🚀 PEMILU RAYA ORSATRENS TEBUIRENG MASA KHIDMAT 2025/2026</title>
    <link rel="stylesheet" href="style/style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo.jpg">
</head>
<body>

<div class="wrapper">
    <div class="title">
        Pilih presiden-wakil presiden ORSATRENS TEBUIRENG Masa Khidmat 2026/2027
    </div>
    <form method="post" action="submit_response.php" onsubmit="return validateForm()">
        <div class="container">
            <label class="option_item">
            <input type="checkbox" class="checkbox" name="question" value="Paslon Nomor 1" id="question1" onclick="uncheckOthers('question1')">
                <div class="option_inner kandidat_1">
                    <div class="image">
                        <img src="style/cwo1.jpg" alt="Paslon 1">
                    </div>
                    <div class="name">Achmad Haidhar Qolfatirius & M. Rizki Al Albar Januarfa</div>
                    <button type="button" onclick="showCandidateInfo(1)">Tentang Paslon 01</button>
                </div>
            </label>
            <label class="option_item">
                <input type="checkbox" class="checkbox" name="question" value="Paslon Nomor 2" id="question2" onclick="uncheckOthers('question2')">
                <div class="option_inner kandidat_2">
                    <div class="image">
                        <img src="style/cwo2.jpg" alt="Paslon 2">
                    </div>
                    <div class="name">M. Ray Ibnu Tsalis Pamungkas & M. Rafiif Hadiansyah</div>
                    <button type="button" onclick="showCandidateInfo(2)">Tentang Paslon 02</button>
                </div>
            </label>
            <label class="option_item">
                <input type="checkbox" class="checkbox" name="question" value="Paslon Nomor 3" id="question3" onclick="uncheckOthers('question3')">
                <div class="option_inner kandidat_3">
                    <div class="image">
                        <img src="style/cwo3.jpg" alt="Paslon 3">
                    </div>
                    <div class="name">Ikhtiar Audra Hafyazka & Ibrahim Ibadurrahman Ad Dafi</div>
                    <button type="button" onclick="showCandidateInfo(3)">Tentang Paslon 03</button>
                </div>
            </label>
        </div>
        <div class="submit_button">
            <button class="collect_btn">VOTE!</button>
        </div>
    </form>
</div>
<div id="candidateModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="candidateTitle"></h2>
      <p id="candidateInfo"></p>
    </div>
</div>

<script>
    function uncheckOthers(currentId) {
        var checkboxes = document.querySelectorAll('.checkbox');
        checkboxes.forEach(cb => {
            if (cb.id !== currentId) cb.checked = false;
        });
    }
    function validateForm() {
        var checkbox1 = document.getElementById('question1');
        var checkbox2 = document.getElementById('question2');
        var checkbox3 = document.getElementById('question3');

        if (!checkbox1.checked && !checkbox2.checked && !checkbox3.checked) {
            alert('Silakan pilih salah satu kandidat untuk melanjutkan.');
            return false;
        }
        return true;
    }

    function showCandidateInfo(candidateNumber) {
    var candidateInfo = {
        1: `
    <div style='padding: 20px;'>
        <p style='text-align: center;'><strong>VISI</strong></p>
        <p style='text-align: center;'><em>Menjadikan ORSATRENS TEBUIRENG sebagai wadah kolaborasi antar organisasi serta ruang bagi setiap siswa untuk berkembang, berkarya, dan turut berkontribusi dalam menciptakan perubahan yang nyata</em></p>
        <br>
        <p style='text-align: center;'><strong>MISI</strong></p>
        <ul style='text-align: justify; padding: 0;'>
            <li>Membangun kordinasi serta komunikasi yang terbuka, terstruktur, dan berkelanjutan antar organisasi.</li>
            <li>Menjadikan aspirasi siswa sebagai tujuan utama dalam penyusunan program kerja</li>
            <li>Menyediakan ruang kepada siswa untuk berkarya serta mengembangkan bakat dan minatnya.</li>
            <li>Membangun lingkungan suportif untuk terus mendukung bakat dan minat siswa.</li>
        </ul>
    <br>

        <p style='text-align: center;'><strong>Program Unggulan</strong></p>
    
        <ul style='text-align: justify; padding: 0;'>
            <li>Mading aspirasi</li>
        </ul>
    </div>
        `,
        2: `
<div style='padding: 20px;'>
    <p style='text-align: center; margin-top=0px;'><strong>VISI</strong></p>
    <p style='text-align: center;'><em>Menjadikan ORSATRENS TEBUIRENG bukan sekadar ruang untuk memimpin, tetapi rumah bagi setiap suara, tempat berkembangnya gagasan dan moral, serta wadah bagi setiap langkah untuk menciptakan perubahan.</em></p>
    <br>
    <p style='text-align: center;'><strong>MISI</strong></p>
    <ul style='text-align: justify; padding: 0;'>
        <li>Membangun budaya kolaborasi, kepedulian, dan keberanian untuk berkontribusi demi menciptakan lingkungan yang lebih inklusif.</li>
        <li>Menumbuhkan semangat kebersamaan, kekeluargaan, dan tanggung jawab dalam setiap langkah ORSATRENS TEBUIRENG.</li>
        <li>Membangun komunikasi yang terbuka dan dekat dengan seluruh siswa sebagai ruang untuk menyampaikan aspirasi, kritik, dan saran.</li>
    </ul>
    <br>
    <p style='text-align: center;'><strong>Program Unggulan</strong></p>
        <ul style='text-align: justify; padding: 0;'>
            <li>Hari Aspirasi</li>
        </ul>
</div>
`,
3: `
<div style='padding: 20px;'>
    <p style='text-align: center; margin-top=0px;'><strong>VISI</strong></p>
    <p style='text-align: center;'><em>Mewujudkan ORSATRENS TEBUIRENG yang inklusif dan merangkul seluruh siswa tanpa terkecuali agar setiap individu punya kesempatan yang sama untuk berkontribusi dan berkembang di sekolah.</em></p>
    <br>
    <p style='text-align: center;'><strong>MISI</strong></p>
    <ul style='text-align: justify; padding: 0;'>
        <li>Membuka kesempatan yang sama bagi civitas.</li>
        <li>Merancang kegiatan terbuka dari siswa untuk siswa.</li>
        <li>Membangun lingkungan sekolah yang saling menghargai perbedaan dan mendorong interaksi lintas kelompok pertemanan.</li>
    </ul>
    <br>
    <p style='text-align: center;'><strong>Program Unggulan</strong></p>
        <ul style='text-align: justify; padding: 0;'>
            <li>ORSA LAB</li>
        </ul>
</div>
`
    };

    var modal = document.getElementById("candidateModal");
    var title = document.getElementById("candidateTitle");
    var info = document.getElementById("candidateInfo");
    var span = document.getElementsByClassName("close")[0];

    title.textContent = "Informasi Paslon " + candidateNumber;
    info.innerHTML = candidateInfo[candidateNumber];
    modal.style.display = "block";

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
</script>
</body>
</html>