<?php
require_once(dirname(__FILE__) . '/../class/View.class.php');
require_once(dirname(__FILE__) . '/../class/Event.class.php');
class EventController {
    public static function showEventDetail($event_id) {
        $userEvent = Event::getEventById($event_id);
        $mainView = new View('EventDetail', 'Event Detail');

        // get all user from user_events table join user table
        $stmt = Database::prepare("SELECT users.username
FROM user_events JOIN users ON user_events.user_id = users.user_id
 WHERE event_id = :event_id");
        Database::bindParam($stmt, ':event_id', $event_id, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $mainView->addVar('users', $users);
        $mainView->addVar('event', $userEvent);
        $mainView->render();
    }

    public static function showCreateEvent() {
        SessionController::getInstance()->makeSureLoggedIn('/login');
        $createEventView = new View('CreateEvent', 'Create Event');
        $createEventView->render();
    }

    public static function processCreateEvent() {
        $event = new Event(
            $_POST["event_title"],
            $_POST["event_date"],
            $_POST["event_time"],
            $_POST["venue"],
            $_POST["description"]);
        $event->save();
        header("Location: /");
    }
}
?>
