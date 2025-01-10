<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Feedback</title>
</head>
<body>
    <header>
        <h1>Give Your Feedback</h1>
    </header>

    <div class="container">
        <form action="/customer/submitFeedback" method="POST">
            <!-- Room ID diambil dari session atau reservation data -->
            <input type="hidden" name="roomID" value="<?= esc($roomID) ?>">

            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>

            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
