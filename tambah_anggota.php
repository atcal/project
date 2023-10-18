<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];

    if (tambahAnggota($name, $email)) {
        echo "<script>alert('Anggota berhasil ditambahkan');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan anggota');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Anggota</title>
</head>
<body>
    <div class="container">
        <h2>Tambah Anggota</h2>
        <div class="form-container">
            <form action="tambah_anggota.php" method="post">
                <label for="name">Nama:</label>
                <input type="text" name="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <button type="submit">Tambah Anggota</button>
            </form>
        </div>
    </div>
</body>
</html>
