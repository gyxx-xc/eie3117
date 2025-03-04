<?php
require_once(dirname(__FILE__) . '/../class/View.class.php');
require_once(dirname(__FILE__) . '/../class/Event.class.php');
class EventController {
    public static function showEventDetail() {
        $userEvent = Event::getEventById(1005);
        $mainView = new View('EventDetail', 'Event Detail');
        $mainView->addVar('event', $userEvent);
        $mainView->render();
    }

    public static function showCreateEvent() {
        $addBookmarkPageView = new View('CreateEvent', 'Create Event');
        $addBookmarkPageView->render();
    }
}
?>
