<!-- customers.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
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

        .button-back {
            background-color: #95a5a6;
        }

        .button-back:hover {
            background-color: #7f8c8d;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .search-box {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .search-button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .search-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Customer List</h1>
    </header>

    <div class="container">

        <a href="/admin/home" class="button">Back to Home</a>
        <form method="get" action="/admin/customers">
            <input type="text" name="search" class="search-box" placeholder="Search by name, email, or ID" value="<?= esc($search) ?>" />
            <button type="submit" class="search-button">Search</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= esc($customer['customerID']) ?></td>
                        <td><?= esc($customer['name']) ?></td>
                        <td><?= esc($customer['email']) ?></td>
                        <td><a href="/admin/customer/<?= esc($customer['customerID']) ?>" class="button">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
