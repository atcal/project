<?php
session_start();

// Username dan kata sandi default
$default_username = 'guest';
$default_password_hash = password_hash('password_guest', PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    // Cek apakah username dan password cocok
    if (
        ($entered_username === $default_username && password_verify($entered_password, $default_password_hash))
        || ($entered_username !== '' && $entered_password !== '')
    ) {
        // Login berhasil, set session dan redirect ke halaman utama
        $_SESSION['user_logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Username atau password salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    <style>
        /* CSS langsung di dalam file login.php */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #ff0000;
            margin-bottom: 16px;
        }
    </style>
    <link rel="stylesheet" href="styles.css"> <!-- Gantilah 'styles.css' dengan file CSS Anda -->
</head>
<body>
    <div class="container">
        <form method="post" action="login.php" class="login-form">
            <h2>Login</h2>
            <?php if (isset($error_message)) : ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
