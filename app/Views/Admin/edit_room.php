<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            padding: 20px;
        }

        h1 {
            color: #3498db;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Edit Room</h1>
    <form action="/admin/updateRoom/<?= esc($room['roomID']) ?>" method="post">
        <label for="roomTypeID">Room Type ID:</label>
        <input type="text" name="roomTypeID" id="roomTypeID" value="<?= esc($room['roomTypeID']) ?>"><br>

        <label for="floorNumber">Floor Number:</label>
        <input type="number" name="floorNumber" id="floorNumber" value="<?= esc($room['floorNumber']) ?>"><br>

        <label for="availability">Availability:</label>
        <select name="availability" id="availability">
            <option value="1" <?= $room['availability'] ? 'selected' : '' ?>>Available</option>
            <option value="0" <?= !$room['availability'] ? 'selected' : '' ?>>Unavailable</option>
        </select><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
