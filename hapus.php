<?php

require_once "Database.php";
require_once "Produk.php";

if (isset($_POST["id"])) {
    $id = (int) $_POST["id"];
} elseif (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
} else {
    $id = 0;
}

if ($id > 0) {
    $database = new Database();
    $produk = new Produk($database->getConnection());
    $produk->hapus($id);
}

header("Location: index.php");
exit;
