<!DOCTYPE html>
<html>
<head>
    <title>Customer Profile</title>
</head>
<body>
    <h1>Customer Profile</h1>

    <p><strong>Name:</strong> <?= esc($customer['name']) ?></p>
    <p><strong>Email:</strong> <?= esc($customer['email']) ?></p>
    <p><strong>Password:</strong> <?= esc($customer['password']) ?></p>
    <p><strong>Total Points:</strong> <?= esc($customer['totalPoint']) ?></p>

    <button onclick="window.location.href='/customer/updateProfile/<?= $customer['customerID'] ?>'">
        Edit Profile
    </button>
    <button onclick="if(confirm('Are you sure to delete your account?')) { window.location.href='/customer/deleteAccount/<?= $customer['customerID'] ?>'; }">
        Delete Account
    </button>
    <button onclick="window.location.href='/customer/home'">Back to Home</button>
</body>
</html>
