<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php?error=not_logged_in");
    exit;
}

include "koneksi.php";

// Ambil nama panitia dari session
$nama_panitia = $_SESSION['nama_panitia'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevOps Final - Daftar Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: #fff;
        }
        .sidebar {
            background-color: #1b1e21;
            height: 100vh;
            padding: 20px 0;
            position: fixed;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }
        .sidebar .nav-link {
            color: #ccc;
            margin: 5px 0;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #343a40;
            color: #fff;
            border-radius: 5px;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .table-container {
            background-color: #495057;
            border-radius: 10px;
            padding: 20px;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-inline {
            display: flex;
            align-items: center;
        }
        .form-inline .form-control {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar col-md-3 col-lg-2 d-md-block">
            <div class="navbar-nav">
                <h4 class="mt-3">Selamat datang,
                <?php echo $nama_panitia; ?>!</h4>
                <a href="index.php" class="nav-link"><i class="material-icons">list</i> Daftar Peserta</a>
                <a href="data_panitia.php" class="nav-link"><i class="material-icons">group</i> Data Panitia</a>
                <a href="logout.php" class="nav-link text-danger"><i class="material-icons">logout</i> Logout</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content col">
            <div class="container-fluid">
                <h3 class="mb-4">Daftar Peserta Filkom Day 2024</h3>

                <div class="table-container">
                    <form method="GET" class="form-inline mb-3">
                        <input type="text" name="search" placeholder="Cari berdasarkan nama..." class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                    <a href="create.php" class="btn btn-primary mb-3">New Item</a>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>No Hp</th>
                                <th>No Regist</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menampilkan daftar peserta
                            include "koneksi.php";
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $sql = "SELECT * FROM mahasiswa WHERE nama LIKE '%$search%' ORDER BY id DESC";
                            $hasil = mysqli_query($kon, $sql);
                            $no = 0;
                            while ($data = mysqli_fetch_array($hasil)) {
                                $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data["nama"]; ?></td>
                                    <td><?php echo $data["jurusan"]; ?></td>
                                    <td><?php echo $data["no_hp"]; ?></td>
                                    <td><?php echo $data["no_regist"]; ?></td>
                                    <td>
                                        <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning btn-sm">Update</a>
                                        <a href="index.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
