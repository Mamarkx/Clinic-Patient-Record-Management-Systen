<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error</title>   
    <link href="Admin/Assets/css/bootstrap.min.css" rel="stylesheet">
        <style>
        body {
            background-color: #1c1c24;
        }
        .error-container {
            background-color: #d8d8d8;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        .error-container h1 {
            font-size: 8rem;
            font-weight: bold;
        }
        .error-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .error-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="error-container border-2 border text-center">
        <h1 class="display-1 text-danger">403</h1>
        <p class="lead fs-3 text-black">Forbidden</p>
        <p class="text-muted">It looks like you don't have permission to access this page.</p>
        <a href="index.php" class="btn btn-primary mt-3">Go to Login</a>
    </div>
        <script src="Admin/Assets/javascript/bundle.min.js"></script>
</body>
</html>
