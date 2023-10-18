<?php
include 'koneksi.php';

function tambahBuku($title, $author, $year, $isbn, $cover_image_data) {
    global $conn;

    // ...

    // Contoh pemanggilan dengan data gambar
    // $cover_image_data = file_get_contents('C:\xampp\htdocs\perpus\assets\cover_1.jpeg'); // Ganti dengan path yang sesuai
    // tambahBuku($title, $author, $year, $isbn, $cover_image_data);


    // ...

    $sql = "INSERT INTO Books (book_title, author, publication_year, ISBN, cover_image) VALUES ('$title', '$author', $year, '$isbn', '$cover_image_data')";
    
    // ...

    $result = $conn->query($sql);
    
    if ($result) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}



function tambahAnggota($username, $password) {
    global $conn;

    // Escape string to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash password before storing in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use backticks for table and column names
    $sql = "INSERT INTO `members` (`username`, `password`) VALUES ('$username', '$hashed_password')";

    // Attempt to execute the query
    if ($conn->query($sql) === TRUE) {
        return true; // Insert successful
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Print detailed error message
        return false; // Insert failed
    }
    
}

function bacaSemuaBuku() {
    global $conn;
    $sql = "SELECT * FROM Books";
    $result = $conn->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}


function bacaBukuById($book_id) {
    global $conn;
    $sql = "SELECT * FROM Books WHERE book_id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function perbaruiBuku($book_id, $title, $author, $year, $isbn, $cover_image_data) {
    global $conn;
    $sql = "UPDATE Books SET book_title='$title', author='$author', publication_year=$year, ISBN='$isbn' , cover_image ='$cover_image_data' WHERE book_id=$book_id";
    $result = $conn->query($sql);
    return $result;
}

function hapusBuku($book_id) {
    global $conn;
    $sql = "DELETE FROM Books WHERE book_id=$book_id";
    $result = $conn->query($sql);
    return $result;
}



function signup($nama, $kelas) {
    global $conn;

    $query = "INSERT INTO members (nama, kelas) VALUES ('$nama', '$kelas')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Pendaftaran berhasil
        return true;
    } else {
        // Pendaftaran gagal
        return false;
    }
}
?>