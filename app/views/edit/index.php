<div class="container">
    <div class="row">
        <div class="mi-col-xs-12">
            <h1>Main</h1>
            <video id="video" width="400" height="300"></video>
            <canvas id="canvas" hidden  width="400" height="300"></canvas>
            <p><?php if (isset($site_data['img'])) echo $site_data['img']; ?></p>
            <form hidden method="post" enctype="multipart/form-data" action="">
                <input type="number" hidden name="user-id" value="<?php if (isset($site_data['id'])) echo $site_data['id']; ?>">
                <br>
                <label><span
                        class="error"><?php //if (isset($site_data)) echo $site_data['wrong_type']; ?></span></label>
                <br><input type="file" name="photo" required accept="image/*">
                <input type="submit" name="upload">
            </form>
            <br>
            <div class="super-images">
                <input
                    type="radio" name="emotion"
                    id="sad" value="surprise.png" class="input-hidden" />
                <label for="sad">
                    <img
                        src="<?php echo SITE_URL . '/images/surprise.png'; ?>"
                        alt="I'm sad" />
                </label>

                <input
                    type="radio" name="emotion"
                    id="happy" value="happy-cat.png" class="input-hidden" />
                <label for="happy">
                    <img
                        src="<?php echo SITE_URL . '/images/happy-cat.png'; ?>"
                        alt="I'm happy" />
                </label>
            </div>
            <button id="cam" >Open camera</button>
            <button onclick="">Upload photo</button>
        </div>
        <div class="mi-col-xs-12">
            <h1>sidebar</h1>
        </div>
    </div>
</div>