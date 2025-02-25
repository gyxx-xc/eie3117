<?php

$host = 'localhost';
$db = 'your_database_name';  
$user = 'your_username';  
$pass = 'your_password';  

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Fail: ' . $e->getMessage());
}

$query = 'SELECT * FROM events';
$stmt = $pdo->query($query);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .event { border: 1px solid #ccc; padding: 10px; margin: 10px; border-radius: 5px; }
        .event-buttons { margin-top: 10px; }
        .event-buttons button { padding: 5px 10px; margin-right: 10px; cursor: pointer; }
    </style>
</head>
<body>

    <h1>Event List</h1>
    <a href="create_event.php"><button>Create Event</button></a>

    <?php if (empty($events)): ?>
        <p>No events available.</p>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="event">
                <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
                <p><strong>Time:</strong> <?php echo $event['event_time']; ?></p>
                <p><strong>Venue:</strong> <?php echo htmlspecialchars($event['venue']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                <div class="event-buttons">
                    <button onclick="window.location.href='event_detail.php?event_id=<?php echo $event['event_id']; ?>'">View Details</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
