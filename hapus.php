<?php
include 'db.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah ID diberikan melalui URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID berupa angka

    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM pengaduan WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman utama dengan pesan sukses
        header("Location: index.php?message=deleted");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Redirect ke halaman utama jika tidak ada ID
    header("Location: index.php");
}
?>
