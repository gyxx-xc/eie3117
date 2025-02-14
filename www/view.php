<?php

if (isset($_GET['event_id'])) {
    $event_id = (int) $_GET['event_id'];

    
    echo "Viewing details for event with ID: $event_id";
} else {
    echo "No event ID provided.";
}
?>
