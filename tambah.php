<?php

require_once "Database.php";
require_once "Produk.php";

$database = new Database();
$produk = new Produk($database->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produk->tambah($_POST["nama"], $_POST["harga"], $_POST["stok"]);
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>

<h2>Tambah Produk</h2>
<form method="post" action="tambah.php">
    Nama : <input type="text" name="nama" required><br>
    Harga : <input type="number" name="harga" min="0" required><br>
    Stok : <input type="number" name="stok" min="0" required><br>
    <button type="submit">Simpan</button>
    <a href="index.php">Batal</a>
</form>

</body>
</html>
