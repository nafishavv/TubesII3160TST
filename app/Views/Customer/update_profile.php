<!-- app/Views/customer/update_profile.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
            font-size: 2rem;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 1.1rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        .form-group input:focus {
            border-color: #3498db;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            width: 48%;
            text-align: center;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .button-danger {
            background-color: #e74c3c;
        }

        .button-danger:hover {
            background-color: #c0392b;
        }

        .error {
            color: red;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            font-size: 1rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Update Profile</h1>
    </header>

    <div class="container">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="success"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <form action="/customer/updateProfile" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?= esc($customer['name']); ?>" placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= esc($customer['email']); ?>" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="********">
            </div>

            <div class="buttons">
                <button type="submit" class="button">Update Profile</button>
                <a href="/customer/showProfile" class="button">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
