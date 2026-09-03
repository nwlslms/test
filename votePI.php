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
    <title>🚀 PEMILU RAYA ORSATRENS TEBUIRENG MASA BAKTI 2026/2027</title>
    <link rel="stylesheet" href="style/style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo.jpg">
</head>
<body>

<div class="wrapper">
    <div class="title">
        Pilih presiden-wakil presiden ORSATRENS TEBUIRENG Masa bakti 2026/2027
    </div>
    <form method="post" action="submit_response.php" onsubmit="return validateForm()">
        <div class="container">
            <label class="option_item">
            <input type="checkbox" class="checkbox" name="question" value="Paslon Nomor 1" id="question1" onclick="uncheckOtherCheckbox('question2')">
                <div class="option_inner kandidat_1">
                    <div class="image">
                        <img src="style/cwe1.png" alt="Paslon 1">
                    </div>
                    <div class="name">Izza Kholydia Rohman & Rosandhita Widyani Pramesti</div>
                    <button type="button" onclick="showCandidateInfo(1)">Tentang Paslon 01</button>
                </div>
            </label>
            <label class="option_item">
                <input type="checkbox" class="checkbox" name="question" value="Paslon Nomor 2" id="question2" onclick="uncheckOtherCheckbox('question1')">
                <div class="option_inner kandidat_2">
                    <div class="image">
                        <img src="style/cwe2.png" alt="Paslon 2">
                    </div>
                    <div class="name">Tsabitha Afaf Al Fatinah & Kayla Aura Syifa Azzahra</div>
                    <button type="button" onclick="showCandidateInfo(2)">Tentang Paslon 02</button>
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
    function uncheckOtherCheckbox(checkboxId) {
        var checkbox = document.getElementById(checkboxId);
        if (checkbox.checked) {
            checkbox.checked = false;
        }
    }

    function validateForm() {
        var checkbox1 = document.getElementById('question1');
        var checkbox2 = document.getElementById('question2');

        if (!checkbox1.checked && !checkbox2.checked) {
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
        <p style='text-align: center;'><em>Mewujudkan ORSATRENS TEBUIRENG sebagai wadah pengembangan siswa yang berakhlak mulia, berprestasi, aktif bertanya, serta berjiwa nasionalis, melalui terciptanya lingkungan yang komunikatif, inklusi dan responsif dengan menguatkan komunikasi dua arah.</em></p>
        <br>
        <p style='text-align: center;'><strong>MISI</strong></p>
        <ul style='text-align: justify; padding: 0;'>
            <li>Membangun budaya yang dapat menjunjung tinggi akhlak, kepedulian, dan saling menghargai berlandaskan 5 Prinsip Dasar Tebuireng.</li>
            <li>Mendorong peningkatan kemampuan berprestasi melalui pemberdayaan akademik maupun non akademik yang merata dan berkelanjutan.</li>
            <li>Menciptakan hubungan yang dekat dan terbuka dengan seluruh siswa melalui komunikasi yang jelas, penerimaan aspirasi, dan tindak lanjut.</li>
        </ul>
        <br>
        <p style='text-align: center;'><strong>Program Unggulan</strong></p>
        <ul style='text-align: justify; padding: 0;'>
            <li><strong>Laman Suara</strong>: Wadah diskusi interaktif bagi siswa untuk membahas berbagai isu aktual dan relevan dengan kehidupan siswa, pendidikan, lingkungan sekolah, maupun masyarakat. Dilaksanakan secara santai saat jam istirahat dengan melibatkan siswa dan guru, hasil diskusi dikemas dalam bentuk <em>podcast</em> yang diperdengarkan melalui sistem audio sekolah. Topik diskusi juga dapat berasal dari kotak aspirasi siswa, sehingga program ini menjadi sarana untuk menyampaikan aspirasi, bertukar perspektif, serta membangun budaya berpikir kritis dan terbuka di lingkungan sekolah.</li>
        </ul>
    </div>
        `,
        2: `
<div style='padding: 20px;'>
    <p style='text-align: center; margin-top=0px;'><strong>VISI</strong></p>
    <p style='text-align: center;'><em>Mewujudkan ORSATRENS TEBUIRENG sebagai ruang kolaborasi yang nyaman dan berjiwa kepemimpinan, serta mendorong siswa untuk memiliki pola pikir yang terbuka, sehingga dapat merealisasikan tujuan bersama yang menjadi wadah kolaboratif bagi sekolah.</em></p>
    <br>
    <p style='text-align: center;'><strong>MISI</strong></p>
    <ul style='text-align: justify; padding: 0;'>
        <li>Membangun kepemimpinan yang bertanggung jawab melalui pembagian tugas yang jelas, komunikasi yang efektif, dan pelaksanaan tugas yang konsisten sesuai dengan 5 Prinsip Dasar Tebuireng.</li>
        <li>Menyediakan ruang aspirasi yang terbuka, transparan, dan saling menghargai bagi seluruh warga sekolah.</li>
        <li>Menjadi penghubung komunikasi antara siswa, ORSATRENS TEBUIRENG, dan pihak sekolah dengan menampung, menyampaikan, serta menindaklanjuti aspirasi secara terbuka dan solutif.</li>
        <li>Membangun kerja sama antar organisasi sekolah, khususnya badan semi otonom, untuk saling mendukung dan mewujudkan program yang bermanfaat bagi kemajuan sekolah.</li>
    </ul>
    <br>
        <p style='text-align: center;'><strong>Program Unggulan</strong></p>
        <ul style='text-align: justify; padding: 0;'>
            <li><strong>Bonding ORSATRENS TEBUIRENG</strong>: Kegiatan santai yang terstruktur khusus untuk pengurus ORSATRENS TEBUIRENG dan seluruh BSO untuk menyelaraskan program kerja, menganalisis progres tiap organisasi, serta mencari solusi bersama atas kendala yang dialami BSO.</li>
            <li><strong>Sinkronisasi BSO</strong>: Mengadakan pertemuan berkala antara ORSATRENS TEBUIRENG dan seluruh BSO untuk menyelaraskan program kerja, menganalisis progres tiap organisasi, serta mencari solusi bersama atas kendala yang dialami BSO.</li>
            <li><strong>Scientific Podcasting</strong>: Wadah media kreatif tempat para santri/siswa membagikan konten sains, eksperimen seru, dan kegiatan islami (banjari, kultum, dll) di media sosial.</li>
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