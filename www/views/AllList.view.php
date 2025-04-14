<div class="container">
  <h1>All Event</h1>
  <ul id="event-list">
        <?php foreach ($events as $event) { ?>
    <li class="event-item"><?=$event['event_title']?>

      <div class="buttons">
        <button class="view-btn"
          onclick="window.location.href='/event/<?=$event['event_id']?>'">View</button>
        <form action="/join_event/<?=$event['event_id']?>" method="post" >
        <input type="hidden" name="csrf" value="<?=$csrf?>">
        <button type="submit" class="join-btn"
          name="join"> Join</button>
        </form>
      </div>
    </li>
<?php } ?>
  </ul>
  <div class="pagination">
<?php if ($total_page != 1) {?>
    <button id="prev" onclick="window.location.href='<?=$page-1?>'"
<?php if ($page == 1) echo "disabled=''"?> >front page</button>
<?php } ?>
    <span id="page-info"> <?=$page?> / <?=$total_page?> </span>
<?php if ($total_page != 1) {?>
    <button id="next" onclick="window.location.href='<?=$page+1?>'"
<?php if ($page == $total_page) echo "disabled=''"?>>next page</button>
<?php } ?>
  </div>
</div>
