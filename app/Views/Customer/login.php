<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Your Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f3f4f6;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .footer {
            margin-top: 15px;
            font-size: 14px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Notification Section -->
        <?php if (session()->getFlashdata('success_message')): ?>
            <div class="alert">
                <?= session()->getFlashdata('success_message') ?>
            </div>
        <?php endif; ?>

        <h2>Welcome Back!</h2>
        <p>Please login to access your account</p>
        <form method="POST" action="/customer/login">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
        <div class="footer">
            Don't have an account? <a href="/customer/register">Register here</a>
        </div>
    </div>
</body>
</html>