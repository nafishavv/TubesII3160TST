<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
</head>
<body>
    <header>
        <h1>Provide Your Feedback</h1>
    </header>

    <div class="container">
        <h2>Rooms You've Reserved</h2>
        <table>
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Reservation Date</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= esc($reservation['roomID']) ?></td>
                        <td><?= esc($reservation['createdAt']) ?></td>
                        <td>
                            <!-- Link to feedback form without including roomID in the URL -->
                            <a href="/customer/feedbackForm" class="button">Give Feedback</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
