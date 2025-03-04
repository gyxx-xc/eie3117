<?php
require_once(dirname(__FILE__) . '/../class/View.class.php');
require_once(dirname(__FILE__) . '/../class/Event.class.php');
class EventController {
    public static function showEventDetail($event_id) {
        $userEvent = Event::getEventById($event_id);
        $mainView = new View('EventDetail', 'Event Detail');
        $mainView->addVar('event', $userEvent);
        $mainView->render();
    }

    public static function showCreateEvent() {
        $addBookmarkPageView = new View('CreateEvent', 'Create Event');
        $addBookmarkPageView->render();
    }

    public static function processCreateEvent() {
        $event = new Event(
            $_POST["event_title"],
            $_POST["event_date"],
            $_POST["event_time"],
            $_POST["venue"],
            $_POST["description"]);
        $event->save();
        echo("ok");
    }
}
?>
