<div class="event-container">
    <h3 class="card-title">Upload image</h3>
    <div class="card-body text-center">

        <form action="/uploadP" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label class="input-group-text" for="venue">Select profile image to upload: </label>
                <input type="file" accept="image/*" name="profile_image" id="profile_image">
            </div>
            <input type="hidden" name="csrf" value="<?= $csrf ?>">
            <button id='submit' class="btn btn-lg btn-warning" type="submit">Upload Image</button>

            <p id='error' class='required'><?php if (isset($error)) echo $error; ?></p>
            <script>
                var fileInput = document.getElementById('profile_image');
                var fileResult = document.getElementById('error');
                var fileSubmit = document.getElementById('submit');
                fileInput.addEventListener("change", function() {
                    if (fileInput.files.length > 0) {
                        const fileSize = fileInput.files.item(0).size;
                        const fileMb = fileSize / 1024 ** 2;
                        if (fileMb >= 2) {
                            fileResult.innerHTML = "Please select a file less than 2MB.";
                            fileSubmit.disabled = true;
                        } else {
                            fileResult.innerHTML = "";
                            fileSubmit.disabled = false;
                        }
                    }
                });
            </script>
        </form>
    </div>
</div>
