<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Your Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9fafb;
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
        input, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
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
        <h2>Join Us!</h2>
        <p>Create an account to get started</p>
        <form method="POST" action="<?= base_url('/customer/register') ?>">
            <input type="text" name="name" placeholder="Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Register</button>
        </form>
        <div class="footer">
            Already have an account? <a href="<?= base_url('/customer/login') ?>">Login here</a><br>
            <a href="/admin/register" class="button">Go to Admin Register</a>
        </div>
    </div>
</body>
</html>
