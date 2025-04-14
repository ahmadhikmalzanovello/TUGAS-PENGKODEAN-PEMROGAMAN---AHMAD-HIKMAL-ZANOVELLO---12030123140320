<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'add_item') {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga_jual = floatval($_POST['harga_jual']);
    $stok = intval($_POST['stok']);

    if (empty($nama_barang) || $harga_jual <= 0 || $stok < 0) {
        die("Error: Invalid input. Please check all fields.");
    }

    $query = "INSERT INTO Barang (nama_barang, harga_jual, stok) VALUES ('$nama_barang', $harga_jual, $stok)";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        die("Error adding item: " . mysqli_error($conn));
    }
} elseif ($action == 'sell') {
    $nama_pelanggan = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
    $kontak = mysqli_real_escape_string($conn, $_POST['kontak']);
    $id_barang = intval($_POST['id_barang']);
    $jumlah = intval($_POST['jumlah']);

    $query_barang = "SELECT harga_jual, stok FROM Barang WHERE id_barang = $id_barang";
    $result_barang = mysqli_query($conn, $query_barang);
    if (!$result_barang || mysqli_num_rows($result_barang) == 0) {
        die("Error: Item not found.");
    }
    $barang = mysqli_fetch_assoc($result_barang);
    $harga_satuan = $barang['harga_jual'];
    $stok = $barang['stok'];

    if ($jumlah > $stok) {
        die("Error: Insufficient stock. Available: $stok");
    }

    $total_harga = $harga_satuan * $jumlah;

    $query_pelanggan = "INSERT INTO Pelanggan (nama_pelanggan, kontak) VALUES ('$nama_pelanggan', '$kontak')";
    if (!mysqli_query($conn, $query_pelanggan)) {
        die("Error adding customer: " . mysqli_error($conn));
    }
    $id_pelanggan = mysqli_insert_id($conn);

    $tanggal = date('Y-m-d');
    $query_penjualan = "INSERT INTO Penjualan (id_pelanggan, tanggal_penjualan, total_harga) VALUES ($id_pelanggan, '$tanggal', $total_harga)";
    if (!mysqli_query($conn, $query_penjualan)) {
        die("Error adding sale: " . mysqli_error($conn));
    }
    $id_penjualan = mysqli_insert_id($conn);

    $query_detail = "INSERT INTO Detail_Penjualan (id_penjualan, id_barang, jumlah, harga_satuan) VALUES ($id_penjualan, $id_barang, $jumlah, $harga_satuan)";
    if (mysqli_query($conn, $query_detail)) {
        header("Location: index.php");
        exit();
    } else {
        die("Error adding sale details: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>