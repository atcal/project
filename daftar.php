<?php
include 'functions.php';

// Inisialisasi variabel
$username = $password = '';
$error = '';

// Proses formulir pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Panggil fungsi tambahAnggota
    if (tambahAnggota($username, $password)) {
        // Jika pendaftaran berhasil, login pengguna
        if (login($username, $password)) {
            // Redirect ke halaman utama setelah login
            header("Location: index.php");
            exit();
        }
    } else {
        // Jika pendaftaran gagal, tampilkan pesan kesalahan
        $error = "Gagal mendaftar. Username mungkin sudah digunakan.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Daftar</title>
</head>
<body>
    <div class="container">
        <h2>Daftar</h2>

        <!-- Formulir Daftar -->
        <div class="form-container">
            <form action="daftar.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Daftar</button>
            </form>

            <p style="color: red;"><?php echo $error; ?></p>
        </div>
    </div>
</body>
</html>
