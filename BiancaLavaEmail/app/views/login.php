<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }

        .login-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #28a745;
        }

        .btn-custom {
            background-color: #28a745;
            color: #fff;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #28a745;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-form">
        <h2>Login</h2>
        <?php flash_alert();  ?>
        <form action="<?=site_url('login');?>" method="POST">
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom">Login</button>


            <!-- Footer -->
            <div class="form-footer">
                <p>Don't have an account? <a href="<?=site_url('/');?>">Register</a></p>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
