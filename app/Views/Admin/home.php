<!-- home.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage <?= esc($name) ?>!</title>
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
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        .button-manage {
            background-color: #2ecc71;
        }

        .button-manage:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, Admin <?= esc($name) ?> !</h1>
    </header>

    <div class="container">
        <!-- <a href="/admin/dashboard" class="button">Admin Dashboard</a> -->
        <a href="/admin/customers" class="button">View Customers</a>
        <a href="/admin/logout" class="button button-logout">Logout</a>
        <a href="/admin/manageRooms" class="button">Manage Rooms</a>
        <a href="/admin/viewReservations" class="button">View Reservations</a>
        <a href="/admin/viewFeedback" class="button">View Feedback</a>

    </div>
</body>
</html>
