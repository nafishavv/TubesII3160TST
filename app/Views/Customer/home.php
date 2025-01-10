<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Homepage</title>
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
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .button-logout {
            background-color: #e74c3c;
        }

        .button-logout:hover {
            background-color: #c0392b;
        }

        .welcome-message {
            margin-bottom: 20px;
        }

        .welcome-message h2 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .welcome-message p {
            font-size: 1rem;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?= esc($name) ?>!</h1>
    </header>

    <div class="container">
        <div class="welcome-message">
            <h2>Welcome to Our Hotel!</h2>
            <p>Plan your perfect stay with us by making a reservation today.</p>
        </div>

        <a href="/customer/reservationPage" class="button">
            Make a Reservation
        </a>
        <a href="/customer/showProfile" class="button">
            Show Profile
        </a>
        <a href="/customer/feedbackForm" class="button">
            Feedback
        </a>
        <a href="/customer/logout" class="button button-logout">
            Logout
        </a>
    </div>
</body>
</html>
