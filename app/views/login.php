<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem Tabungan Mahasiswa</title>
    <!-- Link ke file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav>
        <h1>Sistem Tabungan Mahasiswa</h1>
        <!-- Tautan navigasi ke halaman utama -->
        <a href="home">Home</a>
    </nav>

    <main>
        <!-- Judul untuk halaman login -->
        <h2>Login</h2>
        <!-- Form login dengan metode POST -->
        <form method="POST" action="login">
            <div>
                <!-- Input untuk email pengguna -->
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <!-- Input untuk password pengguna -->
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <!-- Tombol untuk submit form login -->
            <button type="submit">Login</button>
        </form>
        <!-- Tautan ke halaman registrasi jika pengguna belum memiliki akun -->
        <p>Don't have an account? <a href="register">Register</a></p>
    </main>
</body>
</html>
