<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Types</title>
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

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #3498db;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-warning {
            background-color: #f39c12;
        }

        .btn-warning:hover {
            background-color: #e67e22;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Room Types</h1>
    </header>

    <div class="container">
        <a href="/roomType/add" class="btn btn-primary">Add Room Type</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Beds</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roomType as $roomTypeItem): ?>
                <tr>
                    <td><?= $roomTypeItem['roomTypeID'] ?></td>
                    <td><?= $roomTypeItem['name'] ?></td>
                    <td><?= $roomTypeItem['price'] ?></td>
                    <td><?= $roomTypeItem['bedCount'] ?></td>
                    <td><?= $roomTypeItem['roomTypeDescription'] ?></td>
                    <td>
                        <a href="/roomType/edit/<?= $roomTypeItem['roomTypeID'] ?>" class="btn btn-warning">Edit</a>
                        <a href="/roomType/delete/<?= $roomTypeItem['roomTypeID'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
