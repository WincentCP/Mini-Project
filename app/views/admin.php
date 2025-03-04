<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Sistem Tabungan Mahasiswa</title>
    <!-- Link ke file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav>
        <h1>Sistem Tabungan Mahasiswa - Admin Dashboard</h1>
        <div>
            <!-- Tautan navigasi untuk Home dan Logout -->
            <a href="home">Home</a>
            <a href="logout">Logout</a>
        </div>
    </nav>

    <main>
        <!-- Tabel untuk menampilkan daftar pengguna -->
        <h2>Users</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <!-- Header tabel pengguna -->
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <!-- Menampilkan data pengguna dengan sanitasi untuk keamanan -->
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tabel untuk menampilkan semua data tabungan -->
        <h2>All Savings</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <!-- Header tabel tabungan -->
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($savings as $saving): ?>
                    <tr>
                        <!-- Menampilkan data tabungan dengan format angka untuk jumlah -->
                        <td><?php echo $saving['id']; ?></td>
                        <td><?php echo htmlspecialchars($saving['name']); ?></td>
                        <td>Rp<?php echo number_format($saving['amount']); ?></td>
                        <td><?php echo htmlspecialchars($saving['message']); ?></td>
                        <td><?php echo $saving['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
