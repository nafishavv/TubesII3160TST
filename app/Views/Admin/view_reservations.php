<!-- app/Views/admin/view_reservations.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <style>
        /* Styling untuk tabel dan elemen lain */
    </style>
</head>
<body>
    <header>
        <h1>All Reservations</h1>
    </header>

    <!-- Pencarian -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search reservations..." onkeyup="searchReservations()">
    </div>

    <!-- Tabel Reservasi -->
    <table id="reservationsTable">
        <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Customer Name</th>
                <th>Room Type</th>
                <th>Check-In Date</th>
                <th>Check-Out Date</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Customer Info</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= esc($reservation['reservationID']) ?></td>
                    <td><?= esc($reservation['customerName']) ?></td>
                    <td><?= esc($reservation['roomType']) ?></td>
                    <td><?= esc($reservation['checkInDate']) ?></td>
                    <td><?= esc($reservation['checkOutDate']) ?></td>
                    <td><?= esc($reservation['status']) ?></td>
                    <td><?= esc($reservation['totalPrice']) ?></td>
                    <td>
                        <a href="/admin/viewCustomer/<?= esc($reservation['customerID']) ?>" class="button">View Customer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function searchReservations() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toUpperCase();
            let table = document.getElementById('reservationsTable');
            let trs = table.getElementsByTagName('tr');

            for (let i = 1; i < trs.length; i++) {
                let tds = trs[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < tds.length; j++) {
                    if (tds[j]) {
                        if (tds[j].textContent.toUpperCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                trs[i].style.display = match ? '' : 'none';
            }
        }
    </script>
</body>
</html>
