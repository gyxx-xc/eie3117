<?php
require_once(dirname(__FILE__) . '/Database.class.php');
require_once(dirname(__FILE__) . "/ServerError.class.php");

class Event {
    public $title, $date, $time, $venue, $description;

    function __construct($title, $date, $time, $venue, $description) {
        $this->title = $title;
        $this->date = $date;
        $this->time = $time;
        $this->venue = $venue;
        $this->description = $description;
    }

    public function save() {
        $stmt = Database::prepare(
            "INSERT INTO events " .
            "(event_title, event_date, event_time, venue, description, creator_id) " .
            "VALUES (:event_title, :event_date, :event_time, :venue, :description, :user)");
        Database::bindParam($stmt, ':event_title', $this->title);
        Database::bindParam($stmt, ':event_date', $this->date);
        Database::bindParam($stmt, ':event_time', $this->time);
        Database::bindParam($stmt, ':venue', $this->venue);
        Database::bindParam($stmt, ':description', $this->description);
        $user_id = SessionController::getInstance()->getUser()->userid;
        Database::bindParam($stmt, ':user', $user_id, PDO::PARAM_INT);
        Database::execute($stmt);
    }

    public static function getEventById(int $event_id): Event {
        $stmt = Database::prepare("SELECT event_title, event_date, event_time, venue, description FROM events WHERE event_id = :event_id");
        Database::bindParam($stmt, ':event_id', $event_id, PDO::PARAM_INT);

        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        if ($stmt->rowCount() > 1)
            ServerError::throwError(500, "find administor");
        if ($stmt->rowCount() <= 0)
            ServerError::throwError(404, "event not found");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $event = new Event(
            $row["event_title"],
            $row["event_date"],
            $row["event_time"],
            $row["venue"],
            $row["description"]);
        return $event;
    }
}
?>
