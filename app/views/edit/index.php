<div class="container">
    <div class="row">
        <div class="mi-col-xs-12">
            <h1>Main</h1>
            <video id="video" width="400" height="300"></video>
            <canvas id="canvas"  width="400" height="300"></canvas>
            <button onclick="startCam()">Take photo</button>
            <p><?php if (isset($site_data['img'])) echo $site_data['img']; ?></p>
            <form method="post" enctype="multipart/form-data" action="">
                <label>Title</label>
                <input type="text" name="title" required>
                <input type="number" hidden name="user-id" value="<?php if (isset($site_data['id'])) echo $site_data['id']; ?>">
                <br>
                <label><span
                        class="error"><?php if (isset($site_data)) echo $site_data['wrong_type']; ?></span></label>
                <br><input type="file" name="photo" required accept="image/*">
                <input type="submit" name="upload">
            </form>
        </div>
        <div class="mi-col-xs-12">
            <h1>sidebar</h1>
        </div>
    </div>
</div>