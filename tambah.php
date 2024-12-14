<?php
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pesan = htmlspecialchars(trim($_POST['pesan']));

    $sql = "INSERT INTO pengaduan (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?message=success");
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Complaints</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">
                 E-Report
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="tambah.php">Add Complaints</a></li>
                <li><a href="logout.php">Exit</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Add Complaints</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="" method="POST">
            <label for="nama">Name:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="pesan">Message:</label>
            <textarea id="pesan" name="pesan" rows="5" required></textarea>
            <button type="submit" class="btn">Save</button>
            <a href="index.php" class="btn-back">Back</a>
        </form>
    </div>
</body>
</html>
