<div class="event-container">
  <h3 class="card-title">Upload image</h3>
  <div class="card-body text-center">

    <form action="/upload" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label class="input-group-text" for="venue">Select profile image to upload: </label>
      <input type="file" name="profile_image" id="profile_image">
    </div>
      <button class="btn btn-lg btn-warning" type="submit">Upload Image</button>
    <?php if(isset($error)) echo "<p class='required'>$error</p>"; ?>
    </form>

  </div>
</div>
