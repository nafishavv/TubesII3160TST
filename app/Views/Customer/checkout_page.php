<h2>Checkout</h2>
<table border="1" style="width: 100%; text-align: center;">
    <tr>
        <th>Reservation ID</th>
        <td><?= $reservation['reservationID'] ?></td>
    </tr>
    <tr>
        <th>Room Type</th>
        <td><?= $room['roomTypeName'] ?></td>
    </tr>
    <tr>
        <th>Room ID</th>
        <td><?= $reservation['roomID'] ?></td>
    </tr>
    <tr>
        <th>Check-in</th>
        <td><?= $reservation['checkInDate'] ?></td>
    </tr>
    <tr>
        <th>Check-out</th>
        <td><?= $reservation['checkOutDate'] ?></td>
    </tr>
    <tr>
        <th>Total Price</th>
        <td><?= $room['price'] * ((strtotime($reservation['checkOutDate']) - strtotime($reservation['checkInDate'])) / (60 * 60 * 24)) ?></td>
    </tr>
</table>

<form action="/customer/confirmCheckout" method="post">
    <?= csrf_field() ?>
    <button type="submit">Confirm</button>
</form>
<form action="/customer/cancelCheckout" method="post">
    <?= csrf_field() ?>
    <button type="submit">Cancel</button>
</form>
