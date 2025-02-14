<?php

if (isset($_GET['event_id'])) {
    $event_id = (int) $_GET['event_id'];

    echo "You have joined the event with ID: $event_id";
} else {
    echo "No event ID provided.";
}
?>
