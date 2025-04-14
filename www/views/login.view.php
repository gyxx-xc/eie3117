<div class="event-container">
  <h1>Login into the Application</h1>
  <form id="eventForm" accept-charset="UTF-8" role="form" method="post" action="/login">
    <div class="form-group">
      <input placeholder="Username" name="username" type="text" required autofocus>
    </div>
    <div class="form-group">
      <input placeholder="Password" name="password" type="password" value="" required>
    </div>
    <div>
      <?php if(isset($error)) echo "<p class='required'>$error</p>"; ?>
      </div>
    <button class="btn btn-lg btn-warning" type="submit">Login</button>
  </form>
</div>

