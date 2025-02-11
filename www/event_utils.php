<?php
class Event {
    public $title;
    public $date;
    public $time;
    public $venue;
    public $description;

    function __construct($title, $date, $time, $venue, $description) {
        $this->title = $title;
        $this->date = $date;
        $this->time = $time;
        $this->venue = $venue;
        $this->description = $description;
    }

    public function save($pdo) {
        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO events (event_title, event_date, event_time, venue, description) VALUES (:event_title, :event_date, :event_time, :venue, :description)");

            // Bind parameters
            $stmt->bindParam(':event_title', $this->title);
            $stmt->bindParam(':event_date', $this->date);
            $stmt->bindParam(':event_time', $this->time);
            $stmt->bindParam(':venue', $this->venue);
            $stmt->bindParam(':description', $this->description);

            // Execute the statement
            $stmt->execute();

            echo "Event created successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

function get_event_info($event_id) {
    $dsn = 'mysql:host=database;dbname=database';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT event_title, event_date, event_time, venue, description FROM events WHERE event_id = :event_id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $event = new Event($row["event_title"],
                               $row["event_date"],
                               $row["event_time"],
                               $row["venue"],
                               $row["description"]);
        } else {
            echo "event not found";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
    return $event;
}
?>
