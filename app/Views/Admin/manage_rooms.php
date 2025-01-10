<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #3498db;
            color: white;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .action-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .action-button:hover {
            background-color: #2980b9;
        }
        .delete-button {
            background-color: #e74c3c;
        }
        .delete-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Manage Rooms</h1>

    <!-- Tombol Edit Room Type -->
    <div style="margin-bottom: 20px;">
        <a href="/roomType" class="action-button">Edit Room Type</a>
    </div>

    <!-- Tombol Add Room -->
    <div style="margin-bottom: 20px;">
        <a href="/admin/addRoomPage" class="action-button">Add Room</a>
    </div>

    <!-- Tabel Manage Rooms -->
    <div class="search-container">
        <input type="text" id="searchBox" placeholder="Search rooms..." onkeyup="filterTable()">
    </div>
    <table id="roomTable">
        <thead>
            <tr>
                <th>Room ID</th>
                <th>Room Type</th>
                <th>Floor</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($room as $room): ?>
                <tr>
                    <td><?= esc($room['roomID']) ?></td>
                    <td><?= esc($room['roomTypeID']) ?></td>
                    <td><?= esc($room['floorNumber']) ?></td>
                    <td><?= esc($room['availability'] ? 'Available' : 'Unavailable') ?></td>
                    <td>
                        <form action="/admin/editRoom/<?= esc($room['roomID']) ?>" method="get" style="display:inline;">
                            <button type="submit" class="action-button">Edit</button>
                        </form>
                        <form action="/admin/deleteRoom/<?= esc($room['roomID']) ?>" method="post" style="display:inline;">
                            <button type="submit" class="action-button delete-button" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function filterTable() {
            const searchValue = document.getElementById('searchBox').value.toLowerCase();
            const rows = document.querySelectorAll('#roomTable tbody tr');
            rows.forEach(row => {
                row.style.display = [...row.cells].some(cell => cell.textContent.toLowerCase().includes(searchValue)) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
