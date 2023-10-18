<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];
    $isbn = $_POST["isbn"];

    if (tambahBuku($title, $author, $year, $isbn)) {
        echo "<script>alert('Buku berhasil ditambahkan');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Buku</title>
</head>
<body>
    <div class="container">
        <h2>Tambah Buku</h2>
        <div class="form-container">
            <form action="tambah_buku.php" method="post" name="addBookForm" onsubmit="return validateForm()">
                <label for="title">Judul:</label>
                <input type="text" name="title" required>

                <label for="author">Penulis:</label>
                <input type="text" name="author" required>

                <label for="year">Tahun Terbit:</label>
                <input type="number" name="year" required>

                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" required>

                <button type="submit">Tambah Buku</button>
            </form>
        </div>
    </div>
</body>
</html>
