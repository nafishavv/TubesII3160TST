<!DOCTYPE html>
<html>
<head>
    <title>Customer Homepage</title>
</head>
<body>
    <h1>Welcome, <?= esc($name) ?>!</h1>

    <button onclick="window.location.href='/customer/showProfile/<?= session()->get('customerID') ?>'">
        Show Profile
    </button>
    <button onclick="window.location.href='/customer/logout'">Logout</button>
</body>
</html>
