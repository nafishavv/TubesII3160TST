<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <style>
        .form-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add Room</h1>
        <form action="/admin/addRoom" method="post">
            <?= csrf_field() ?>
            <label for="roomTypeID">Room Type:</label>
            <input type="text" id="roomTypeID" name="roomTypeID" required>

            <label for="floorNumber">Floor Number:</label>
            <input type="number" id="floorNumber" name="floorNumber" required>

            <label for="availability">Availability:</label>
            <select id="availability" name="availability" required>
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>

            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
