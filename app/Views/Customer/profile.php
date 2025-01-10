<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
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

        .profile-info p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .profile-info strong {
            color: #3498db;
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
            width: 30%;
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
    </style>
</head>
<body>
    <header>
        <h1>Customer Profile</h1>
    </header>

    <div class="container">
        <div class="profile-info">
            <p><strong>Name:</strong> <?= esc($customer['name']) ?></p>
            <p><strong>Email:</strong> <?= esc($customer['email']) ?></p>
            <p><strong>Password:</strong> <?= esc($customer['password']) ?></p>
            <p><strong>Total Points:</strong> <?= esc($customer['totalPoint']) ?></p>
        </div>

        <div class="buttons">
            <a href="/customer/updateProfile" class="button">Edit Profile</a>
            <a href="javascript:void(0);" class="button button-danger" onclick="if(confirm('Are you sure to delete your account?')) { window.location.href='/customer/deleteAccount'; }">Delete Account</a>
            <a href="/customer/home" class="button">Back to Home</a>
        </div>
    </div>
</body>
</html>
