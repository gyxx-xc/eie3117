<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your events.";
    exit;
}

$user_id = $_SESSION['user_id'];

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

$query = '
    SELECT e.event_id, e.event_title, e.event_date, e.event_time, e.venue, e.description
    FROM events e
    JOIN user_events ue ON e.event_id = ue.event_id
    WHERE ue.user_id = :user_id
';
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events You Joined</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .event { border: 1px solid #ccc; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .event h3 { margin: 0; }
        .event p { font-size: 14px; }
        .event-buttons { margin-top: 10px; }
    </style>
</head>
<body>

    <h1>Events You Have Joined</h1>

    <?php if (empty($events)): ?>
        <p>You haven't joined any events yet.</p>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="event">
                <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                <p><strong>Date:</strong> <?php echo date('Y-m-d', strtotime($event['event_date'])); ?></p>
                <p><strong>Time:</strong> <?php echo date('H:i', strtotime($event['event_time'])); ?></p>
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
