<?php
$dsn = 'mysql:host=database;dbname=database';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO events (event_title, event_date, event_time, venue, description) VALUES (:event_title, :event_date, :event_time, :venue, :description)");

    $stmt->bindParam(':event_title', $event_title);
    $stmt->bindParam(':event_date', $event_date);
    $stmt->bindParam(':event_time', $event_time);
    $stmt->bindParam(':venue', $venue);
    $stmt->bindParam(':description', $description);

    $event_title = 'Sample Event';
    $event_date = '2025-02-20';
    $event_time = '14:00:00';
    $venue = 'Sample Venue';
    $description = 'This is a description of the sample event.';

    $stmt->execute();

    echo "Event created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
