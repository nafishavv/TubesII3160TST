<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"> <!-- Optional CSS -->
</head>
<body>
    <div class="container">
        <h1>Customer Details</h1>

        <?php if (!empty($customer)): ?>
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>Customer ID</th>
                    <td><?= esc($customer['customerID']) ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?= esc($customer['name']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= esc($customer['email']) ?></td>
                </tr>
                <tr>
                    <th>Total Point</th>
                    <td><?= esc($customer['totalPoint']) ?></td>
                </tr>
                <tr>
                    <th>Registration Date</th>
                    <td><?= esc($customer['registrationDate']) ?></td>
                </tr>
                <tr>
                    <th>Last Login</th>
                    <td><?= esc($customer['lastLogin']) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>No customer details found.</p>
        <?php endif; ?>

        <a href="<?= base_url('admin/customers') ?>">Back to Customers List</a>
    </div>
</body>
</html>
