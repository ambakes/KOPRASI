<?php

require_once "Database.php";
require_once "Produk.php";

$database = new Database();
$produk = new Produk($database->getConnection());

$kata = isset($_GET["cari"]) ? trim($_GET["cari"]) : "";

if ($kata !== "") {
    $daftarProduk = $produk->cariNama($kata);
} else {
    $daftarProduk = $produk->semua();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk Koperasi</title>
</head>
<body>

<h2>Data Produk Koperasi</h2>
<p><a href="tambah.php">+ Tambah Produk</a></p>

<form method="get">
    Cari nama : <input type="text" name="cari" value="<?= htmlspecialchars($kata) ?>">
    <button type="submit">Cari</button>
    <?php if ($kata !== ""): ?>
        <a href="index.php">Reset</a>
    <?php endif; ?>
</form>

<h3>Daftar Produk</h3>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($daftarProduk)): ?>
            <tr>
                <td colspan="5">
                    <?php if ($kata !== ""): ?>
                        Produk dengan nama "<?= htmlspecialchars($kata) ?>" tidak ditemukan.
                    <?php else: ?>
                        Belum ada data produk.
                    <?php endif; ?>
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($daftarProduk as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row["id"]) ?></td>
                    <td><?= htmlspecialchars($row["nama"]) ?></td>
                    <td>Rp <?= number_format($row["harga"], 0, ",", ".") ?></td>
                    <td><?= htmlspecialchars($row["stok"]) ?></td>
                    <td>
                        <a href="edit.php?id=<?= htmlspecialchars($row["id"]) ?>">Edit</a>
                        <form method="post" action="hapus.php" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($row["id"]) ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
