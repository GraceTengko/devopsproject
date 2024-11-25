<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Panitia</title>
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
                <h4 class="text-center mb-4">Admin Dashboard</h4>
                <a href="index.php" class="nav-link"><i class="material-icons">list</i> Daftar Peserta</a>
                <a href="data_panitia.php" class="nav-link"><i class="material-icons">group</i> Data Panitia</a>
                <a href="logout.php" class="nav-link text-danger"><i class="material-icons">logout</i> Logout</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content col">
            <div class="container-fluid">
                <h3 class="mb-4">Data Panitia Filkom Day</h3>

                <div class="table-container">
                    <form method="GET" class="form-inline mb-3">
                        <input type="text" name="search" placeholder="Cari berdasarkan nama..." class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                    <a href="create_panitia.php" class="btn btn-primary mb-3">New Item</a>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Panitia</th>
                                <th>Divisi</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "koneksi.php";
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $sql = "SELECT * FROM tbl_panitia WHERE nama LIKE '%$search%' ORDER BY id DESC";
                            $sql = "SELECT * FROM tbl_panitia ORDER BY id_panitia DESC";
                            $hasil = mysqli_query($kon, $sql);
                            $no = 0;
                            while ($data = mysqli_fetch_array($hasil)) {
                                $no++;
                                echo "
                                <tr>
                                    <td>{$no}</td>
                                    <td>{$data['nama_panitia']}</td>
                                    <td>{$data['divisi']}</td>
                                    <td>{$data['no_hp']}</td>
                                    <td>{$data['email_panitia']}</td>
                                    <td>
                                        <a href='update_panitia.php?id_panitia={$data['id_panitia']}' class='btn btn-warning btn-sm'>Update</a>
                                        <a href='data_panitia.php?id_panitia={$data['id_panitia']}' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
