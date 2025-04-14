<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Inventory Dashboard</h1>
        <div class="button-group">
            <a href="add_item.php" class="btn">Add Item</a>
            <a href="sell.php" class="btn">Make Sale</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connect.php';
                $query = "SELECT * FROM Barang";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Error: " . mysqli_error($conn));
                }
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['id_barang']}</td>";
                        echo "<td>{$row['nama_barang']}</td>";
                        echo "<td>Rp " . number_format($row['harga_jual'], 2) . "</td>";
                        echo "<td>{$row['stok']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No items available</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>