<?php
session_start();


$logged_in_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 


$host = 'localhost';
$db = 'your_database_name';  
$user = 'your_username';  
$pass = 'your_password';  

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Fail: ' . $e->getMessage();
    exit;
}


$query = 'SELECT * FROM events WHERE created_by = :user_id';
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $logged_in_user_id]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User's Created Events</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .event { border: 1px solid #ccc; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .event h3 { margin: 0; }
        .event p { font-size: 14px; }
    </style>
</head>
<body>

    <h1>Events Created by You</h1>

    <?php if (empty($events)): ?>
        <p>You haven't created any events.</p>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="event">
                <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                <p><strong>Date:</strong> <?php echo date('Y-m-d', strtotime($event['event_date'])); ?></p>
                <p><strong>Time:</strong> <?php echo date('H:i', strtotime($event['event_time'])); ?></p>
                <p><strong>Venue:</strong> <?php echo htmlspecialchars($event['venue']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
