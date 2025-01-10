<!-- manage_availability.php -->
<form action="/admin/updateAvailability/<?= esc($room['roomID']) ?>" method="POST">
    <label for="availability">Availability:</label>
    <select name="availability" id="availability">
        <option value="1" <?= $room['availability'] == 1 ? 'selected' : '' ?>>Available</option>
        <option value="0" <?= $room['availability'] == 0 ? 'selected' : '' ?>>Not Available</option>
    </select>

    <a href="/admin/viewReservations" class="button">Update Availabity</a>
</form>

