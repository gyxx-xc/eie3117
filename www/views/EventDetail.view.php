<div class="event-container">
  <h1 id="event_title"><?=$event->title;?></h1>
  <div class="event-details">
    <span>Date:</span> <span id="event_date"><?=$event->date;?></span><br>
    <span>Time:</span> <span id="event_time"><?=$event->time;?></span><br>
    <span>Venue:</span> <span id="venue"><?=$event->venue;?></span><br>
    <span>Description:</span> <span id="description"><?=$event->description;?></span>
  </div>
<br>
  <div class="event-details">
     <span>Joined User:</span><br>
  <ul id="event-list">
<?php foreach ($users as $event) { ?>
        <li class="event-item"><?=$event['username']?></li>
<?php } ?>
  </ul>
      </div>

</div>
