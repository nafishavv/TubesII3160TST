<table border="1" style="width: 100%; text-align: center;">
    <thead>
        <tr>
            <th>Room ID</th>
            <th>Room Type</th>
            <th>Floor</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($room as $room): ?>
            <tr>
                <td><?= $room['roomID'] ?></td>
                <td><?= $room['name'] ?></td>
                <td><?= $room['floorNumber'] ?></td>
                <td><?= $room['price'] ?></td>
                <td><?= $room['availability'] ? 'Available' : 'Unavailable' ?></td>
                <td>
                    <?php if ($room['availability']): ?>
                        <form action="/customer/makeReservation" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="roomID" value="<?= $room['roomID'] ?>">
                            <label>Check-in: <input type="date" name="checkInDate" required></label>
                            <label>Check-out: <input type="date" name="checkOutDate" required></label>
                            <button type="submit">Reserve</button>
                        </form>
                    <?php else: ?>
                        <span>Not Available</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
