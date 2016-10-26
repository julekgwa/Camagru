<div id="overlay-box">
        <img style="width: 150px; height: 150px" id="impose">
        <video id="video" style="display: none" width="400" height="300">
        </video>
    </div>
    <img alt="" id="preview">
    <canvas id="canvas" style="display: none"  width="400" height="300"></canvas>
    <canvas id="from-form" style="display: none"  width="400" height="300"></canvas>
    <audio src="<?php echo SITE_URL; ?>/audio/camera-shutter-click-01.mp3" id="shutter"></audio>
    <p><?php if (isset($site_data['img'])) echo $site_data['img']; ?></p>
    <form style="display: none" id="upload-image" method="post" enctype="multipart/form-data" action="">
        <input type="number" style="display: none" name="user-id" value="<?php if (isset($site_data['id'])) echo $site_data['id']; ?>">
        <br>
        <label><span
                class="error"><?php //if (isset($site_data)) echo $site_data['wrong_type']; ?></span></label>
        <br><input type="file" name="photo" id="image" required accept="image/*">
    </form>
    <br>
    <div class="super-images" style="display: none" id="super-images">
        <input
            type="radio" name="super"
            id="sad" value="surprise.png" class="input-hidden"/>
        <label for="sad">
            <img
                src="<?php echo SITE_URL . '/images/surprise.png'; ?>"
                alt="I'm sad"/>
        </label>

        <input
            type="radio" name="super"
            id="happy" value="happy-cat.png" class="input-hidden"/>
        <label for="happy">
            <img
                src="<?php echo SITE_URL . '/images/happy-cat.png'; ?>"
                alt="I'm happy"/>
        </label>

        <input
            type="radio" name="super"
            id="shrek" value="Shrek_emoji.png" class="input-hidden"/>
        <label for="shrek">
            <img
                src="<?php echo SITE_URL . '/images/Shrek_emoji.png'; ?>"
                alt="I'm happy"/>
        </label>
    </div>
    <button id="cam">Open camera</button>
    <button id="upload-photo">Upload photo</button>
    <button id="save-photo">Save photo</button>
<div class="mi-col-xs-12">
    <h3>myUPLOADS</h3>
    <div id="uploaded-imgs">
        <?php if (isset($site_data['uploads'])) : ?>
            <?php foreach ($site_data['uploads'] as $image) : ?>
                <div class="side-img">
                    <img src="<?php echo SITE_URL . '/uploads/user-img/' . $image['image_url']; ?>">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>