<div class="container">
  <h1>Register</h1>
  <form id="registerForm" role="form" method="post" action="/registerP">
    <div class="form-group">
      <label class="input-group-text" for="username">Username <span class="required">*</span>:</label>
      <input class="form-control" placeholder="Username" name="username" type="text" required autofocus>
    </div>
    <div class="form-group">
      <label class="input-group-text" for="nickname">Nickname:</label>
      <input class="form-control" placeholder="Nickname" name="nickname" type="text" >
    </div>
    <div class="form-group">
      <label class="input-group-text" for="password">Password <span class="required">*</span>:</label>
      <input class="form-control" placeholder="Password" name="password" type="password" required>
    </div>
    <div class="form-group">
      <label class="input-group-text" for="email">E-Mail Address:</label>
      <input class="form-control" placeholder="E-Mail Address" name="email" type="email">
    </div>
    <input type="hidden" name="csrf" value="<?=$csrf?>">
        <div>
          <?php if(isset($error)) echo "<p class='required'>$error</p>"; ?>
        </div>
    <button class="btn btn-lg btn-primary" type="submit">Register</button>
  </form>
</div>
