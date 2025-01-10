<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room Type</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #e3f2fd, #90caf9);
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
            background-color: #2196f3;
            color: white;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #1976d2;
        }
        .back-link {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
            font-size: 0.9rem;
            color: #2196f3;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Room Type</h1>
        <form method="post" action="/roomType/add">
            <input type="text" name="name" placeholder="Room Name" required>
            <input type="number" name="price" placeholder="Price" step="0.01" required>
            <input type="number" name="bedCount" placeholder="Bed Count" required>
            <textarea name="roomTypeDescription" placeholder="Description"></textarea>
            <button type="submit">Add Room Type</button>
        </form>
        <a href="/roomType" class="back-link">Back</a>
    </div>
</body>
</html>
