<!DOCTYPE html>
<html>
<head>
    <title>Home - Sistem Tabungan Mahasiswa</title>
    <!-- Link ke file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav>
        <h1>Sistem Tabungan Mahasiswa</h1>
        <?php if(isset($_SESSION['user_id'])): ?>
            <div>
                <!-- Menampilkan nama pengguna yang sedang login -->
                Welcome, <?php echo $_SESSION['user_name']; ?>
                <?php if($_SESSION['user_role'] === 'admin'): ?>
                    <!-- Tautan ke dashboard admin jika pengguna adalah admin -->
                    <a href="admin">Admin Dashboard</a>
                <?php endif; ?>
                <!-- Tautan untuk fitur menabung dan logout -->
                <a href="save">Save</a>
                <a href="logout">Logout</a>
            </div>
        <?php else: ?>
            <div>
                <!-- Tautan untuk login atau register jika pengguna belum login -->
                <a href="login">Login</a>
                <a href="register">Register</a>
            </div>
        <?php endif; ?>
    </nav>

    <main>
        <!-- Ringkasan total tabungan pengguna -->
        <h2>Your Savings Summary</h2>
        <div class="summary-card">
            <h3>Total Savings</h3>
            <!-- Menampilkan total tabungan dengan format angka -->
            <p>Rp<?php echo number_format($totalSavings); ?></p>
        </div>

        <!-- Riwayat tabungan pengguna -->
        <h2>Your Savings History</h2>
        <?php if(count($userSavings) > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <!-- Header tabel riwayat tabungan -->
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($userSavings as $saving): ?>
                        <tr>
                            <!-- Menampilkan data riwayat tabungan -->
                            <td><?php echo $saving['created_at']; ?></td>
                            <td>Rp<?php echo number_format($saving['amount']); ?></td>
                            <td><?php echo htmlspecialchars($saving['message']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Pesan jika pengguna belum memiliki tabungan -->
            <p>You don't have any savings yet. <a href="save">Start saving now!</a></p>
        <?php endif; ?>
    </main>
</body>
</html>
