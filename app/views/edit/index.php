<div class="container">
    <div class="row">
        <div class="mi-col-xs-12">
            <h1>Main</h1>
            <video id="video" width="400" height="300"></video>
            <canvas id="canvas" style="display: none;" width="400" height="300"></canvas>
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
<script>
    (function() {
        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var vendorUrl = window.URL || window.webkitURL;

        navigator.getMedia = 	navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia;
        navigator.getMedia({
            video: true,
            audio: false
        }, function(stream){
            var source = vendorUrl.createObjectURL(stream);
            video.src = source;
            video.play();
        }, function(error){
            console.log('error');
        });

        window.onload = function() {
            var save = document.getElementById('video');
            save.addEventListener('click', function(){
                context.drawImage(video, 0, 0, 400, 300);
                var dataURL = canvas.toDataURL('image/png');
                var data = 'image=' + dataURL;

                var request = new XMLHttpRequest();
                request.open('POST', 'test.php', true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onload = function(){
                    if (request.status == 200) {
                        alert(request.responseText);
                    }
                };
                request.send(data);
            }, false);
        }
    })();
</script>