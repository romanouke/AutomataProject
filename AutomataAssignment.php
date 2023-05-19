<!DOCTYPE html>
<html>

<head>
    <title>TUGAS AUTOMATA</title>
</head>

<body>
    <style>
        body {
            display: grid;
            height: 100%;
            width: 100%;
            background: #234cad;
        }

        .judul {
            color: white;
            font-family: Helvetica;
        }
    </style>
    <div class="judul">
        <h1 style="text-align:center; margin-left: auto; margin-right: auto;">TUGAS AUTOMATA (NFA accepting language a (a + b) a*)</h1>
    </div>
    <div style="display:block; margin-left: auto; margin-right: auto;">
        <img style="width: 350px;" src="/AUTOMATA/Screenshot (333).png" alt="Gambar Penjelasan Tugas">
    </div>
    <br>
    <form method="POST" action="">
        <div style="text-align:center; margin-left: auto; margin-right: auto;">
            <label for="word" style="color: white; font-family: Helvetica;">Silahkan masukkan kata:</label>
            <input type="text" name="huruf" id="huruf" required>
            <button type="submit">Periksa</button>
        </div>
    </form>

<?php

// Definisikan fungsi untuk memeriksa apakah kata diterima oleh NFA
function nfa($huruf)
{
    $StateAwal = ['q0']; // State awal
    $StateAkhir = ['q2']; // State akhir

    // Tabel transisi NFA
    $Transisi = [
        'q0' => ['b' => ['q1']], //state q0 menerima inputan kata "b" dan dikirim ke q1
        'q1' => ['a' => ['q2'], 'b' => ['q2']], //state q1 mengirim kata "a" dan "b" ke q2
        'q2' => ['b' => ['q2']] //q2 mengirim kata "b" ke q2
    ];

    // Loop melalui setiap karakter dalam kata
    for ($i = 0; $i < strlen($huruf); $i++) {
        $input = $huruf[$i]; // Karakter saat ini
        $StateSelanjutnya = []; // State berikutnya

        // Loop melalui setiap state saat ini
        foreach ($StateAwal as $state) {
            // Periksa apakah ada transisi yang sesuai dengan input karakter
            if (isset($Transisi[$state][$input])) {
                // Tambahkan state berikutnya ke himpunan state berikutnya
                $StateSelanjutnya = array_merge($StateSelanjutnya, $Transisi[$state][$input]);
            }
        }

        // Perbarui state saat ini dengan state berikutnya
        $StateAwal = $StateSelanjutnya;
    }

    // Periksa apakah ada setidaknya satu state saat ini yang merupakan state akhir
    foreach ($StateAwal as $state) {
        if (in_array($state, $StateAkhir)) {
            return true; // Kata diterima
        }
    }

    return false; // Kata ditolak
}

?>
    <br>
    <div style="font-family:Helvetica; color:white; text-align:center; margin-left: auto; margin-right: auto;">
    <?php
    // Periksa apakah ada inputan kata yang dikirimkan dari form
    if (isset($_POST['huruf'])) {
    $inputHuruf = $_POST['huruf'];

    // Panggil fungsi nfa untuk memeriksa apakah kata diterima
    $isAccepted = nfa($inputHuruf);

    // Tampilkan pesan hasil pemeriksaan
    
    if ($isAccepted) {
        echo "Kata '$inputHuruf' yang anda masukkan diterima oleh mesin";
    } else {
        echo "Kata '$inputHuruf' yang anda masukkan ditolak oleh mesin";
    }
}
    ?>
    </div>
    <div>
        <a href="https://www.w3schools.com/">Visit W3Schools.com!</a> 
    </div>
    
</body>
</html>