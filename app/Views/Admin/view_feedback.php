<!-- Di admin/view_feedback.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
</head>
<body>
    <header>
        <h1>All Feedbacks</h1>
    </header>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Room ID</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td><?= esc($feedback['customerID']) ?></td>
                        <td><?= esc($feedback['roomID']) ?></td>
                        <td><?= esc($feedback['rating']) ?></td>
                        <td><?= esc($feedback['comment']) ?></td>
                        <td><?= esc($feedback['submittedAt']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
