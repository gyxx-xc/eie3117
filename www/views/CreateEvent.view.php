<?php
// $event_title = 'Sample Event';
// $event_date = '2025-02-20';
// $event_time = '14:00:00';
// $venue = 'Sample Venue';
// $description = 'This is a description of the sample event.';

// $event = new Event(
//   $event_title,
//   $event_date,
//   $event_time,
//   $venue,
//   $description
// );
// $event->save();
?>

<div class="event-container">
  <h1>Create Event</h1>
  <form id="eventForm" accept-charset="UTF-8" role="form" method="post" action="/create_event">
    <div class="form-group">
      <label class="input-group-text" for="event_title">Event Title <span class="required">*</span>:</label>
      <input type="text" id="event_title" name="event_title" required>
    </div>
    <div class="form-group">
      <label class="input-group-text" for="event_date">Event Date <span class="required">*</span>:</label>
      <input type="date" id="event_date" name="event_date" required>
    </div>
    <div class="form-group">
      <label class="input-group-text" for="event_time">Event Time:</label>
      <input type="time" id="event_time" name="event_time">
    </div>
    <div class="form-group">
      <label class="input-group-text" for="venue">Venue <span class="required">*</span>:</label>
      <input type="text" id="venue" name="venue" required>
    </div>
    <div class="form-group">
      <label class="input-group-text" for="description">Description:</label>
      <input type="text" id="description" name="description">
    </div>
    <button class="btn btn-lg btn-warning" type="submit">Create Event</button>
  </form>
</div>
