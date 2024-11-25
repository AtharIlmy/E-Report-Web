<?php
include 'db.php'; // Hubungkan dengan database

// Cek apakah ada ID yang diterima dari halaman sebelumnya
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitasi ID

    // Ambil data dari database berdasarkan ID
    $sql = "SELECT * FROM pengaduan WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Ambil data untuk ditampilkan
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Simpan perubahan setelah form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pesan = htmlspecialchars(trim($_POST['pesan']));

    // Query update data
    $sql = "UPDATE pengaduan SET nama = '$nama', email = '$email', pesan = '$pesan' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?status=success"); // Redirect ke halaman utama
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Data Pengaduan</h1>
        <form action="" method="POST">
            <label for="nama">Name:</label>
            <input type="text" id="nama" name="nama" required value="<?php echo $data['nama']; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo $data['email']; ?>">

            <label for="pesan">Message:</label>
            <textarea id="pesan" name="pesan" rows="5" required><?php echo $data['pesan']; ?></textarea>

            <button type="submit" class="btn-submit">Save</button>
            
            <a href="index.php" class="btn-back">Back</a>
        </form>
    </div>
</body>
</html>
