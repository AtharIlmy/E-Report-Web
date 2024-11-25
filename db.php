<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'pengaduan_masyarakat2';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start(); // Memulai sesi untuk login
?>
