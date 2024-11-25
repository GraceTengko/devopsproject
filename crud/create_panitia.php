<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Panitia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
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
        .form-container {
            background-color: #495057;
            border-radius: 10px;
            padding: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
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
                <h3 class="mb-4">Tambah Data Panitia</h3>
                <div class="form-container">
                    <?php
                    include "koneksi.php";

                    function input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nama_panitia = input($_POST["nama_panitia"]);
                        $divisi = input($_POST["divisi"]);
                        $no_hp = input($_POST["no_hp"]);
                        $email_panitia = input($_POST["email_panitia"]);

                        $sql = "INSERT INTO tbl_panitia (nama_panitia, divisi, no_hp, email_panitia) 
                                VALUES ('$nama_panitia', '$divisi', '$no_hp', '$email_panitia')";

                        $hasil = mysqli_query($kon, $sql);

                        if ($hasil) {
                            header("Location:data_panitia.php");
                        } else {
                            echo "<div class='alert alert-danger'> Data Gagal Disimpan.</div>";
                        }
                    }
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                        <div class="form-group">
                            <label>Nama Panitia:</label>
                            <input type="text" name="nama_panitia" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Divisi:</label>
                            <input type="text" name="divisi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No HP:</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email_panitia" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="data_panitia.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
