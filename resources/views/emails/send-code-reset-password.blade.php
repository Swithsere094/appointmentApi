<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Agrega el enlace al CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Agrega tus propios estilos -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Reset Your Password</h2>
    <p>Dear user,</p>
    <p>We have received a request to reset your password. Please use the following code to proceed with the password reset process:</p>
    <div class="text-center mb-4">
        <h1 class="display-4">{{ $code }}</h1>
    </div>
    <p>If you did not request this reset, you can safely ignore this email.</p>
    <p>Thank you.</p>
</div>

</body>
</html>
