<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir login
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Lindungi dari serangan SQL injection
    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Query untuk memeriksa ke tabel tb_user
    $query = "SELECT * FROM tb_login WHERE user='$user' AND password='$pass'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "Login berhasil!";
        header("Location: Tabel.php");
    } else {
        echo "<script>alert('Login gagal Periksa username & password anda')</script>";
    }
}

// Menutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg bg_1">
    <div class="l1 d-flex justify-content-center align-items-center">
        <form action="" method="post" class="card card_bg p-4 px-5 rounded-4">
            <h1 class="text-capitalize fw-bold">login</h1>
            <div class="d-flex mb-3">
                <div class="d-flex flex-column">
                    <span class="text-capitalize my-2">User name </span>
                    <span class="text-capitalize my-3">password</span>
                </div>
                <div class="d-flex flex-column">
                    <input type="text" name="username" class="my-2 ms-1">
                    <input type="password" name="password" class="my-2 ms-1">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <a href="register.php" class="text-capitalize">sign up account</a>
                <button type="" class="btn btn-outline-dark w-25">Login</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>