<?php
include "connect.php";
session_start();

$errors = []; // Array untuk menyimpan pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_produk'])) {
        try {
            // Proses save untuk tabel produk
            $id = htmlspecialchars($_POST['id']);
            $produk = htmlspecialchars($_POST['produk']);
            $satuan = htmlspecialchars($_POST['satuan']);
            $harga = htmlspecialchars($_POST['harga']);
            $stok = htmlspecialchars($_POST['stok']);

            $id = mysqli_real_escape_string($conn, $id);
            $produk = mysqli_real_escape_string($conn, $produk);
            $satuan = mysqli_real_escape_string($conn, $satuan);
            $harga = mysqli_real_escape_string($conn, $harga);
            $stok = mysqli_real_escape_string($conn, $stok);

            $query = "INSERT INTO `tb_produk` (`id_produk`, `nm_produk`, `satuan`, `harga`, `stock`) VALUES ('$id', '$produk', '$satuan', '$harga', '$stok')";
            $result = $conn->query($query);

            if (!$result) {
                throw new Exception("Gagal menyimpan data produk: " . mysqli_error($conn));
            }

            header("Location: Tabel.php");
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    } elseif (isset($_POST['save_pelanggan'])) {
        try {
            // Proses save untuk tabel pelanggan
            $idPelanggan = htmlspecialchars($_POST['id_pelanggan']);
            $namaPelanggan = htmlspecialchars($_POST['nama_pelanggan']);
            $alamatPelanggan = htmlspecialchars($_POST['alamat_pelanggan']);
            $noHp = htmlspecialchars($_POST['no_hp']);
            $emailPelanggan = htmlspecialchars($_POST['email_pelanggan']);

            $idPelanggan = mysqli_real_escape_string($conn, $idPelanggan);
            $namaPelanggan = mysqli_real_escape_string($conn, $namaPelanggan);
            $alamatPelanggan = mysqli_real_escape_string($conn, $alamatPelanggan);
            $noHp = mysqli_real_escape_string($conn, $noHp);
            $emailPelanggan = mysqli_real_escape_string($conn, $emailPelanggan);

            $query = "INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nm_pelanggan`, `alamat`, `no_hp`, `email`) VALUES ('$idPelanggan', '$namaPelanggan', '$alamatPelanggan', '$noHp', '$emailPelanggan')";
            $result = $conn->query($query);

            if (!$result) {
                throw new Exception("Gagal menyimpan data pelanggan: " . mysqli_error($conn));
            }

            header("Location: Tabel.php");
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<span>
    <style>
        h1,span{
            color: white;
        }
    </style>
</span>
<body class="bg_2 bg">
<div class="card_bg">
    <div class="mb-4 bg_form">
        <div class="row">
            <form action="" method="post" class="col-md-6">
                <h1 class="text-center fw-bold">Input Pelanggan</h1>
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        <span class="mt-aot">ID </span>
                        <span class="mt-aot">Nama</span>
                        <span class="mt-aot">Alamat</span>
                        <span class="mt-aot">No Hp</span>
                        <span class="mt-aot">Email</span>
                    </div>
                    <div class="d-flex flex-column ms-3">
                        <input type="text" name="id_pelanggan" class="my-1">
                        <input type="text" name="nama_pelanggan" class="my-1">
                        <input type="text" name="alamat_pelanggan" class="my-1">
                        <input type="text" name="no_hp" class="my-1">
                        <input type="email" name="email_pelanggan" class="my-1">
                    </div>
                </div>
                <div class="d-flex justify-content-center my-3">
                    <button class="btn btn-dark" type="submit" name="save_pelanggan">Save</button>
                </div>
            </form>
            <form action="" method="post" class="col-md-6">
                <h1 class="text-center fw-bold">Input Produk</h1>
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        <span class="mt-aot">ID </span>
                        <span class="mt-aot">Produk</span>
                        <span class="mt-aot">satuan</span>
                        <span class="mt-aot">harga</span>
                        <span class="mt-aot">stok</span>
                    </div>
                    <div class="d-flex flex-column ms-3">
                        <input type="text" name="id" class="my-1">
                        <input type="text" name="produk" class="my-1">
                        <input type="text" name="satuan" class="my-1">
                        <input type="text" name="harga" class="my-1">
                        <input type="number" min="1" name="stok" class="my-1">
                    </div>
                </div>
                <div class="d-flex justify-content-center my-3">
                    <button class="btn btn-dark" name="save_produk" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row w-100 py-4">
        <div class="col-md-6 d-flex flex-column align-items-center">
            <h2>Tabel Produk</h2>
            <table class="table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Stock</th>
                </tr>
                <?php
                include "connect.php";
                $query = mysqli_query($conn, "Select * From tb_produk");
                $db_name = [
                    "id_produk",
                    "nm_produk",
                    "satuan",
                    "harga",
                    "stock"
                ];
                foreach ($query as $row) {
                    echo "<tr>
        <td>" . $row[$db_name[0]] . "</td>
        <td>" . $row[$db_name[1]] . "</td>
        <td>" . $row[$db_name[2]] . "</td>
        <td>" . $row[$db_name[3]] . "</td>
        <td>" . $row[$db_name[4]] . "</td>
        </tr>";
                }
                ?>
            </table>
        </div>
        <div class="col-md-6 d-flex flex-column align-items-center">
        <h2>Tabel Pelanggan</h2>
            <table class="table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Email</th>
                </tr>
                <?php
                include "connect.php";
                $query = mysqli_query($conn, "Select * From tb_pelanggan");
                $db_name = [
                    "id_pelanggan",
                    "nm_pelanggan",
                    "alamat",
                    "no_hp",
                    "email"
                ];
                foreach ($query as $row) {
                    echo "<tr>
        <td>" . $row[$db_name[0]] . "</td>
        <td>" . $row[$db_name[1]] . "</td>
        <td>" . $row[$db_name[2]] . "</td>
        <td>" . $row[$db_name[3]] . "</td>
        <td>" . $row[$db_name[4]] . "</td>
        </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>