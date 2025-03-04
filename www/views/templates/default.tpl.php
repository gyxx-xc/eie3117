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
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
    </div>
  </nav>

  <main class="container">
    <?php $currentView->showMainContent(compact(array_keys(get_defined_vars()))); ?>
  </main>
</body>

</html>
