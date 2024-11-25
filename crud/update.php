<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Peserta</title>
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
                <h4 class="mt-3">Selamat datang, Crew!</h4>
                <a href="index.php" class="nav-link"><i class="material-icons">list</i> Daftar Peserta</a>
                <a href="data_panitia.php" class="nav-link"><i class="material-icons">group</i> Data Panitia</a>
                <a href="logout.php" class="nav-link text-danger"><i class="material-icons">logout</i> Logout</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content col">
            <div class="container-fluid">
                <h3 class="mb-4">Update Data Peserta</h3>
                <div class="form-container">
                    <?php
                    include "koneksi.php";

                    function input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    if (isset($_GET['id'])) {
                        $id = input($_GET["id"]);
                        $sql = "SELECT * FROM mahasiswa WHERE id = $id";
                        $hasil = mysqli_query($kon, $sql);
                        $data = mysqli_fetch_assoc($hasil);
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $id = htmlspecialchars($_POST["id"]);
                        $nama = input($_POST["nama"]);
                        $jurusan = input($_POST["jurusan"]);
                        $no_hp = input($_POST["no_hp"]);
                        $no_regist = input($_POST["no_regist"]);

                        $sql = "UPDATE mahasiswa SET
                            nama = '$nama',
                            jurusan = '$jurusan',
                            no_hp = '$no_hp',
                            no_regist = '$no_regist'
                            WHERE id = $id";

                        $hasil = mysqli_query($kon, $sql);

                        if ($hasil) {
                            header("Location:index.php");
                        } else {
                            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
                        }
                    }
                    ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jurusan:</label>
                            <input type="text" name="jurusan" class="form-control" value="<?php echo $data['jurusan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No HP:</label>
                            <input type="text" name="no_hp" class="form-control" value="<?php echo $data['no_hp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No Regist:</label>
                            <textarea name="no_regist" class="form-control" rows="5" required><?php echo $data['no_regist']; ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
