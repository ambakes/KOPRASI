<?php

require_once "Database.php";
require_once "Produk.php";

$database = new Database();
$produk = new Produk($database->getConnection());

if (isset($_POST["id"])) {
    $id = (int) $_POST["id"];
} elseif (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
} else {
    $id = 0;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produk->ubah($id, $_POST["nama"], $_POST["harga"], $_POST["stok"]);
    header("Location: index.php");
    exit;
}

$data = $produk->cari($id);

if (!$data) {
    die('Produk tidak ditemukan. <a href="index.php">Kembali ke daftar produk</a>');
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<body>

<h2>Edit Produk</h2>
<form method="post" action="edit.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data["id"]) ?>">
    Nama : <input type="text" name="nama" value="<?= htmlspecialchars($data["nama"]) ?>" required><br>
    Harga : <input type="number" name="harga" min="0" value="<?= htmlspecialchars($data["harga"]) ?>" required><br>
    Stok : <input type="number" name="stok" min="0" value="<?= htmlspecialchars($data["stok"]) ?>" required><br>
    <button type="submit">Simpan Perubahan</button>
    <a href="index.php">Batal</a>
</form>

</body>
</html>
