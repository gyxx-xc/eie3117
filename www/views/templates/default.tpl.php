<?php
/* @var $currentView View */
/* @var $pageTitle string */
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>An app<?php echo (!empty($pageTitle) ? ' - ' . $pageTitle : '') ?></title>
  <!--CSS -->
  <?php View::IncludeUIElements('css', 'common'); // Include common.css if exists 
  ?>
  <?php View::IncludeUIElements('css', $currentView->getViewName()); // Include <viewname>.css CSS if exists
  ?>
  <!-- JS -->
  <?php View::IncludeUIElements('js', 'common'); // Include common.js if exists 
  ?>
  <?php View::IncludeUIElements('js', $currentView->getViewName(), true); // Include <viewname>.js JS if exists
  ?>
</head>

<body>
  <nav class="navbar">
      <ul class="navbar-menu">
        <li><a href="/user_event/1">Created Events</a></li>
        <li><a href="/joined_event/1">Joined Events</a></li>
        <li><a href="/all_event/1">All Events</a></li>
        <li><a href="/create_event">Create Event</a></li>
      </ul>
<?php if (SessionController::getInstance()->isUserLoggedIn()): ?>
    <div class="user-info">
      <div>
        Welcome, <?=SessionController::getInstance()->getUser()->username ?>!
        </div>
        <div class="logio">
                  <img src="/img/<?=SessionController::getInstance()->getUser()->username ?>.jpg?rand=<?php echo rand(); ?>"
                    onerror="this.src='/img/tpl.jpg'"
                    onclick="window.location.href='/upload'"
                    width="20px" height="20px" border="1"/>
          </div>
<div class="logio">
          <a href="/logout">logout</a>
        </div>
      </div>
<?php else: ?>
    <div class="user-info">
      <div class="logio">
        <a href="/login">login</a>
      </div>
      <div class="logio">
        <a href="/register">register</a>
      </div>
    </div>
<?php endif ?>
  </nav>

  <main class="">
<?php $currentView->showMainContent(compact(array_keys(get_defined_vars()))); ?>
  </main>
</body>

</html>
