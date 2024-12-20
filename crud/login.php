<?php
session_start();

// Daftar username dan password
$valid_users = [
    "Juanri" => "12345",
    "Falen" => "12345",
    "Alex" => "12345",
    "Grace" => "12345"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($valid_users[$username]) && $valid_users[$username] === $password) {
        $_SESSION['login'] = true;
        $_SESSION['nama_panitia'] = ucfirst($username);
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
        }
        .container {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .image-section {
            background: #f7f8fc;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50%;
        }
        .image-section h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4a4a4a;
            margin-bottom: 20px;
        }
        .image-section p {
            font-size: 1rem;
            color: #6c757d;
            text-align: center;
        }
        .image-section img {
            max-width: 200px;
            margin-top: 20px;
        }
        .form-section {
            padding: 40px;
            width: 50%;
        }
        .form-section h3 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .form-control {
            border-radius: 30px;
            margin-bottom: 20px;
            padding: 15px 20px;
        }
        .btn-custom {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: linear-gradient(90deg, #2575fc, #6a11cb);
        }
        .social-login {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .social-login a {
            color: #6c757d;
            font-size: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Image Section -->
        <div class="image-section">
            <h3>Welcome Back Crew!</h3>
            <p>Panitia Filkom Day</p>
            <img src="data:image/png;base64,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" alt="Illustration">
        </div>
        
        <!-- Form Section -->
        <div class="form-section">
            <h3>Login</h3>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn btn-custom">Login</button>
            </form>
            <div class="social-login">
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
