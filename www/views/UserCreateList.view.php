<div class="container">
    <h2><?=$title?></h2>
    <ul id="event-list">
        <?php foreach ($events as $event) { ?>
        <li class="event-item"><?=$event['event_title']?>
            <a href='/event/<?=$event['event_id']?>'><button class="view-btn"
            >View</button></li></a>
        <?php } ?>
    </ul>
    <div class="pagination">
        <?php if ($total_page != 1) {?>
        <a href='<?=$page-1?>'><button id="prev"
            <?php if ($page == 1) echo "disabled=''"?> >front page</button> </a>
        <?php } ?>
        <span id="page-info"> <?=$page?> / <?=$total_page?> </span>
        <?php if ($total_page != 1) {?>
        <a href='<?=$page+1?>'><button id="next"
            <?php if ($page == $total_page) echo "disabled=''"?>>next page</button></a>
        <?php } ?>
    </div>
</div>
