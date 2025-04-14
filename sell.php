<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Sale</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Make a Sale</h1>
        <form action="process.php" method="POST" class="form">
            <label>Customer Name</label>
            <input type="text" name="nama_pelanggan" required>
            <label>Contact</label>
            <input type="text" name="kontak">
            <label>Select Item</label>
            <select name="id_barang" required>
                <option value="">-- Choose Item --</option>
                <?php
                include 'db_connect.php';
                $query = "SELECT * FROM Barang WHERE stok > 0";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id_barang']}'>{$row['nama_barang']} (Stock: {$row['stok']})</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
            <label>Quantity</label>
            <input type="number" name="jumlah" min="1" required>
            <input type="hidden" name="action" value="sell">
            <button type="submit">Process Sale</button>
            <a href="index.php" class="btn back-btn">Back</a>
        </form>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>