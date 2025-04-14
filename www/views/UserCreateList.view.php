<div class="container">
    <h2><?=$title?></h2>
    <ul id="event-list">
        <?php foreach ($events as $event) { ?>
        <li class="event-item"><?=$event['event_title']?>
            <button class="view-btn"
                    onclick="window.location.href='/event/<?=$event['event_id']?>'">View</button></li>
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
