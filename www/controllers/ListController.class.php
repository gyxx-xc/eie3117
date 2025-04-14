<?php
require_once(dirname(__FILE__) . '/../class/View.class.php');
require_once(dirname(__FILE__) . '/../class/Event.class.php');
require_once(dirname(__FILE__) . '/../class/SessionController.class.php');
class ListController {
    public static function showMain() {
        header("Location: /all_event/1");
    }

    public static function showAllList($page) {
        $allEventView = new View('AllList', 'All Event');

        $stmt = Database::prepare("SELECT COUNT(*) as total_events FROM events;");
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        if ($stmt->rowCount() > 1)
            ServerError::throwError(500, "find administor");
        if ($stmt->rowCount() <= 0)
            ServerError::throwError(404, "no event");
        $total_events = $stmt->fetch()['total_events'];
        $total_page = ceil($total_events / 10);
        if ($total_page == 0) {
            $total_page = 1;
        }

        self::checkPage($page, $total_page);
        $stmt = Database::prepare("SELECT * FROM events LIMIT :start, 10;");
        $temp = ($page - 1) * 10;
        $stmt->bindParam(':start', $temp, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        $events = $stmt->fetchAll();

        $allEventView->addVar('page', $page);
        $allEventView->addVar('total_page', $total_page);
        $allEventView->addVar('events', $events);
        $allEventView->render();
    }

    public static function showUserCreateList($page) {
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedIn('/login');
        $userCreateListView = new View('UserCreateList', 'Created Event');

        $stmt = Database::prepare("SELECT COUNT(*) as total_events FROM events WHERE creator_id = :user;");
        $stmt->bindParam(':user', $sessionController->getUser()->userid, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        if ($stmt->rowCount() > 1)
            ServerError::throwError(500, "find administor");
        if ($stmt->rowCount() <= 0)
            ServerError::throwError(404, "no event");
        $total_events = $stmt->fetch()['total_events'];
        $total_page = ceil($total_events / 10);
        if ($total_page == 0) {
            $total_page = 1;
        }

        self::checkPage($page, $total_page);
        $stmt = Database::prepare(
            "SELECT * ".
            "FROM events ".
            "WHERE creator_id = :user ".
            "LIMIT :start, 10;"
        );
        $temp = ($page - 1) * 10;
        $stmt->bindParam(':start', $temp, PDO::PARAM_INT);
        $stmt->bindParam(':user', $sessionController->getUser()->userid, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        $events = $stmt->fetchAll();

        $userCreateListView->addVar('title', "Created by user");
        $userCreateListView->addVar('page', $page);
        $userCreateListView->addVar('total_page', $total_page);
        $userCreateListView->addVar('events', $events);
        $userCreateListView->render();
    }

    public static function showUserJoinList($page) {
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedIn('/login');
        $userCreateListView = new View('UserCreateList', 'Joined Event');

        $stmt = Database::prepare("SELECT COUNT(*) as total_events FROM user_events WHERE user_id = :user;");
        $stmt->bindParam(':user', $sessionController->getUser()->userid, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        if ($stmt->rowCount() > 1)
            ServerError::throwError(500, "find administor");
        if ($stmt->rowCount() <= 0)
            ServerError::throwError(404, "no event");
        $total_events = $stmt->fetch()['total_events'];
        $total_page = ceil($total_events / 10);
        if ($total_page == 0) {
            $total_page = 1;
        }

        self::checkPage($page, $total_page);
        $stmt = Database::prepare(
            "SELECT e.* ".
            "FROM events e ".
            "JOIN user_events ue ON e.event_id = ue.event_id ".
            "WHERE ue.user_id = :user ".
            "LIMIT :start, 10;"
        );
        $temp = ($page - 1) * 10;
        $stmt->bindParam(':start', $temp, PDO::PARAM_INT);
        $stmt->bindParam(':user', $sessionController->getUser()->userid, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        $events = $stmt->fetchAll();

        $userCreateListView->addVar('title', "Joined by user");
        $userCreateListView->addVar('page', $page);
        $userCreateListView->addVar('total_page', $total_page);
        $userCreateListView->addVar('events', $events);
        $userCreateListView->render();
    }

    public static function processJoinEvent($event_id) {
        $sessionController = SessionController::getInstance();
        $sessionController->makeSureLoggedIn('/login');

        // insert a (user_id, event_id, created = false)
        // check if already joined
        $stmt = Database::prepare("SELECT * FROM user_events WHERE user_id = :user AND event_id = :event;");
        $user_id = $sessionController->getUser()->userid;
        $stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':event', $event_id, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        if ($stmt->rowCount() > 0){
            $registerPageView = new View('notice', 'Already Joined');
            $registerPageView->addVar('title', 'Already Joined');
            $registerPageView->addVar('content', 'You have already joined this event.');
            $registerPageView->addVar('link', '/');
            $registerPageView->addVar('linkText', 'Back to the event list');
            $registerPageView->render();
            exit();
        }

        Event::getEventById($event_id); // check if event exists first
        $stmt = Database::prepare("INSERT INTO user_events (user_id, event_id) VALUES (:user, :event);");
        $user_id = $sessionController->getUser()->userid;
        $stmt->bindParam(':user', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':event', $event_id, PDO::PARAM_INT);
        if (!Database::execute($stmt))
            ServerError::throwError(500, "can't access database");
        $registerPageView = new View('notice', 'Join Succeed');
        $registerPageView->addVar('title', 'Joining: Succeed');
        $registerPageView->addVar('content', 'You have successfully joined this event.');
        $registerPageView->addVar('link', '/');
        $registerPageView->addVar('linkText', 'Back to the event list');
        $registerPageView->render();
        exit();
    }

    private static function checkPage($page, $max_page) {
        if ($page < 1 || $page > $max_page) {
            ServerError::throwError(404, "Page not found");
        }
    }
}
?>
