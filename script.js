function validateForm() {
    var title = document.forms["addBookForm"]["title"].value;
    var author = document.forms["addBookForm"]["author"].value;
    var year = document.forms["addBookForm"]["year"].value;
    var isbn = document.forms["addBookForm"]["isbn"].value;

    if (title === "" || author === "" || year === "" || isbn === "") {
        alert("Semua kolom harus diisi!");
        return false;
    }
    return true;
}

// Tambahkan fungsi-fungsi lainnya sesuai kebutuhan aplikasi Anda
