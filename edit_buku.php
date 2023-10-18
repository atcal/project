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

// Proses form edit buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["perbaruiBuku"])) {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $year = $_POST["year"];
        $isbn = $_POST["isbn"];

        $gambarbuku = $_FILES["cover_image"]["name"];
        $imagetmpname = $_FILES["cover_image"]["tmp_name"];
        move_uploaded_file($imagetmpname, "assets/$gambarbuku");

        // Panggil fungsi perbaruiBuku
        if (perbaruiBuku($book_id, $title, $author, $year, $isbn, $gambarbuku)) {
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Gagal memperbarui buku');</script>";
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
    <title>Edit Buku</title>
</head>
<body>
    <div class="container">
        <h2>Edit Buku</h2>

        <!-- Formulir Edit Buku -->
        <div class="form-container">
            <form action="edit_buku.php?id=<?php echo $book_id; ?>" method="post" enctype="multipart/form-data">
                <label for="title">Judul:</label>
                <input type="text" name="title" value="<?php echo $buku['book_title']; ?>" required>

                <label for="author">Penulis:</label>
                <input type="text" name="author" value="<?php echo $buku['author']; ?>" required>

                <label for="year">Tahun Terbit:</label>
                <input type="number" name="year" value="<?php echo $buku['publication_year']; ?>" required>

                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" value="<?php echo $buku['ISBN']; ?>" required>

                <label for="cover_image">Sampul Buku:</label>
                <input type="file" name="cover_image" accept="image/*">

                <button type="submit" name="perbaruiBuku">Perbarui Buku</button>
            </form>
        </div>
    </div>
</body>
</html>
