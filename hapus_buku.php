<?php
include 'functions.php';

// Ambil data buku berdasarkan book_id
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $buku = bacaBukuById($book_id);

    // Jika buku tidak ditemukan, redirect ke halaman utama
    if (!$buku) {
        header("Location: index.php");
        exit();
    }
} else {
    // Jika tidak ada parameter 'id', redirect ke halaman utama
    header("Location: index.php");
    exit();
}

// Proses penghapusan buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["hapusBuku"])) {
        // Panggil fungsi hapusBuku
        if (hapusBuku($book_id)) {
            echo "<script>alert('Buku berhasil dihapus');</script>";
            header("Location: index.php"); // Redirect ke halaman utama setelah penghapusan
            exit();
        } else {
            echo "<script>alert('Gagal menghapus buku');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Hapus Buku</title>
</head>
<body>
    <div class="container">
        <h2>Hapus Buku</h2>

        <!-- Informasi Buku -->
        <div class="book-info">
            <p><strong>Judul:</strong> <?php echo $buku['book_title']; ?></p>
            <p><strong>Penulis:</strong> <?php echo $buku['author']; ?></p>
            <p><strong>Tahun Terbit:</strong> <?php echo $buku['publication_year']; ?></p>
            <p><strong>ISBN:</strong> <?php echo $buku['ISBN']; ?></p>
        </div>

        <!-- Formulir Hapus Buku -->
        <div class="form-container">
            <form action="hapus_buku.php?id=<?php echo $book_id; ?>" method="post">
                <p>Apakah Anda yakin ingin menghapus buku ini?</p>
                <button type="submit" name="hapusBuku">Hapus Buku</button>
            </form>
        </div>
    </div>
</body>
</html>
