<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Item</h1>
        <form action="process.php" method="POST" class="form">
            <label>Item Name</label>
            <input type="text" name="nama_barang" required>
            <label>Selling Price (Rp)</label>
            <input type="number" step="0.01" name="harga_jual" required>
            <label>Stock</label>
            <input type="number" name="stok" required>
            <input type="hidden" name="action" value="add_item">
            <button type="submit">Save Item</button>
            <a href="index.php" class="btn back-btn">Back</a>
        </form>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>