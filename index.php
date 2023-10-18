<?php
include_once 'functions.php';

// Proses form tambah buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tambahBuku"])) {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $year = $_POST["year"];
        $isbn = $_POST["isbn"];

        
        $gambarbuku = $_FILES["cover_image"]["name"];
        $imagetmpname = $_FILES["cover_image"]["tmp_name"];
        move_uploaded_file($imagetmpname, "assets/$gambarbuku");
        if (tambahBuku($title, $author, $year, $isbn, $gambarbuku)) {
            echo "<script>alert('Buku berhasil ditambahkan');</script>";
        } else {
            echo "<script>alert('Gagal menambahkan buku');</script>";
        }
    }
}

// Periksa apakah ada pesan sukses atau kesalahan dari operasi sebelumnya
if (isset($_SESSION['success_message'])) {
    echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan
} elseif (isset($_SESSION['error_message'])) {
    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
}



// Ambil daftar buku dari database
$daftarBuku = bacaSemuaBuku();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Perpustakaan</title>
    <style>
        .container{
            overflow: visible;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Buku</h2>

        <!-- Tambah Buku Form -->
        <div class="form-container">
            <h3>Tambah Buku Baru</h3>
            <form action="index.php" method="post" name="tambahBukuForm" enctype="multipart/form-data">

                <label for="title">Judul:</label>
                <input type="text" name="title" required>

                <label for="author">Penulis:</label>
                <input type="text" name="author" required>

                <label for="year">Tahun Terbit:</label>
                <input type="number" name="year" required>

                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" required>

                <label for="cover_image">Sampul Buku:</label>
                <input type="file" name="cover_image" accept="image/*">

                <button type="submit" name="tambahBuku">Tambah Buku</button>
            </form>
        </div>

        <!-- Daftar Buku -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>ISBN</th>
                    <th>Sampul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($daftarBuku as $buku) : ?>
                    <tr>
                        <td><?php echo $buku['book_id']; ?></td>
                        <td><?php echo $buku['book_title']; ?></td>
                        <td><?php echo $buku['author']; ?></td>
                        <td><?php echo $buku['publication_year']; ?></td>
                        <td><?php echo $buku['ISBN']; ?></td>
                        <td>
                            <?php
                            $gambar = $buku['cover_image'];
                            echo "<img src=\"assets/$gambar\" alt=\"Sampul Buku\" style=\"max-width: 100px; max-height: 150px;\">";
                            ?>
                        </td>
                        <td>
                            <a href="edit_buku.php?id=<?php echo $buku['book_id']; ?>">Edit</a>
                            <a href="hapus_buku.php?id=<?php echo $buku['book_id']; ?>" onclick="return confirm('Anda yakin ingin menghapus buku ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>