<?php
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil data pengaduan
$sql = "SELECT * FROM pengaduan ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
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
        <div class="header">
            <h1>Welcome To The Community Complaints Web</h1>
            <div class="Logout"><a href="logout.php" class="btn">Logout</a></div>
        </div>
        <center><a href="tambah.php" class="btn">Add Complaints</a></center>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['pesan']}</td>
                                <td>{$row['tanggal']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='btn-edit'>Edit</a>
                                    <a href='hapus.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\Sure you want to remove?\")'>Delete</a>
                                </td>
                              </tr>";
                        $no++;
                    }
                } else {
                     echo "<tr><td colspan='6'>No Complaint Yet</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
