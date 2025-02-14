<?php

$host = 'localhost';  
$db = 'your_database_name';  
$user = 'your_username'; 
$pass = 'your_password';  

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '连接失败: ' . $e->getMessage();
}

$query = 'SELECT * FROM events';
$stmt = $pdo->query($query);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .event {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 15px;
            border-radius: 5px;
        }
        .event h3 {
            margin: 0;
        }
        .event p {
            font-size: 14px;
        }
        .event-buttons {
            margin-top: 10px;
        }
        .event-buttons button {
            padding: 5px 10px;
            margin-right: 10px;
            cursor: pointer;
        }
        .event-buttons button:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Event List</h1>

    <?php if (empty($events)): ?>
        <p>No events available.</p>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="event">
                <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                <p><strong>Date:</strong> <?php echo date('Y-m-d', strtotime($event['event_date'])); ?></p>
                <p><strong>Time:</strong> <?php echo date('H:i', strtotime($event['event_time'])); ?></p>
                <p><strong>Venue:</strong> <?php echo htmlspecialchars($event['venue']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                
                <div class="event-buttons">
                    <button onclick="window.location.href='join.php?event_id=<?php echo $event['event_id']; ?>'">Join</button>
                    <button onclick="window.location.href='view.php?event_id=<?php echo $event['event_id']; ?>'">View</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
