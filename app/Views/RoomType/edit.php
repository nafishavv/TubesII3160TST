<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room Type</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #e8f5e9, #a5d6a7);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 10px;
        }
        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: #43a047;
            color: white;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #388e3c;
        }
        .back-link {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
            font-size: 0.9rem;
            color: #43a047;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Room Type</h1>
        <p>Current Room Type: <strong><?= $roomType['name'] ?></strong></p>
        <form method="post" action="/roomType/update/<?= $roomType['roomTypeID'] ?>">
            <input type="text" name="name" value="<?= $roomType['name'] ?>" required>
            <input type="number" name="price" value="<?= $roomType['price'] ?>" step="0.01" required>
            <input type="number" name="bedCount" value="<?= $roomType['bedCount'] ?>" required>
            <textarea name="roomTypeDescription"><?= $roomType['roomTypeDescription'] ?></textarea>
            <button type="submit">Update Room Type</button>
        </form>
        <a href="/roomType" class="back-link">Back</a>
    </div>
</body>
</html>
