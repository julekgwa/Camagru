/**
 * Created by julekgwa on 2016/10/23.
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var url = 'http:\/\/localhost:8080\/Camagru\/public\/';
var clean_url = 'http://localhost:8080/Camagru/public/';

window.onload = function () {
    //Ajax registration
    var form = document.forms.namedItem('reg_user');
    if (form) {
        form.addEventListener('submit', function (e) {
            if (validatePassword('passwd', 'passwd-error') && validateUsername('username', 'user-error') && validateEmail('email', 'email-error')) {
                var data = new FormData(form);
                var req = new XMLHttpRequest();
                var btn = document.getElementById('register');
                btn.value = 'Registering, Please wait...';

                req.open('POST', url + 'register/reg_ajax', true);
                req.onload = function (event) {
                    if (req.status == 200) {
                        var result = JSON.parse(req.responseText);
                        if (result.hasOwnProperty('results')) {
                            if (result.results == 'success') {
                                window.location = url + 'login\/registered';
                            }
                        }
                        if (result.hasOwnProperty('email')) {
                            var email = document.getElementById('email-error');
                            email.innerHTML = result.email;
                        }
                        if (result.hasOwnProperty('passwd')) {
                            var passwd = document.getElementById('passwd-error');
                            passwd.innerHTML = result.passwd;
                        }

                        if (result.hasOwnProperty('username')) {
                            var username = document.getElementById('user-error');
                            username.innerHTML = result.username;
                        }
                        btn.value = 'Register';
                    } else {
                        alert('Error');
                    }
                };
                req.send(data);
            }
            e.preventDefault();
        }, false);
    }

    //ajax login
    var login = document.forms.namedItem('login_user');
    if (login) {
        login.addEventListener('submit', function (e) {
            if (validatePassword('passwd', 'passwd-error')) {
                var data = new FormData(login);
                var userlogin = new XMLHttpRequest();
                var btn = document.getElementById('login');
                btn.value = 'Login, Please wait...';

                userlogin.open('POST', url + 'login/login_user_ajax', true);
                userlogin.onload = function (event) {
                    if (userlogin.status == 200) {
                        var result = JSON.parse(userlogin.responseText);
                        if (result.results == 'success.') {
                            alert('Remember to create popup form');
                        } else {
                            document.getElementById('cred-error').innerHTML = result.results;
                        }
                        btn.value = 'Login';
                    }
                };
                userlogin.send(data);
            }
            e.preventDefault();
        }, false);
    }

    //ajax reset password
    var resetPass = document.forms.namedItem('reset-passwd');
    if (resetPass) {
        resetPass.addEventListener('submit', function (e) {
            if (validateEmail('reset-email', 'reset-email-error')) {
                var data = new FormData(resetPass);
                var reset = new XMLHttpRequest();
                var btn = document.getElementById('reset-sub');
                btn.value = 'Resetting, please wait...';
                reset.open('POST', url + 'reset/reset_passwd_ajax', true);
                reset.onload = function (event) {
                    if (reset.status == 200) {
                        var res = JSON.parse(reset.responseText);
                        if (res.hasOwnProperty('results')) {
                            if (res.results == 'success.') {
                                window.location = url + 'login/reset';
                            } else if (res.results == 'email') {
                                var error = document.getElementById('reset-email-error');
                                error.innerHTML = res.results;
                            }
                        }
                        btn.value = 'Reset password';
                    }
                };
                reset.send(data);
            }
            e.preventDefault();
        }, false);
    }

    //set new password
    var newPass = document.forms.namedItem('new-passwd');
    if (newPass) {
        newPass.addEventListener('submit', function (e) {
            if (validatePassword('new-passwd-set', 'new-passwd-error')) {
                var data = new FormData(newPass);
                var pass = new XMLHttpRequest();
                var btn = document.getElementById('new-pass-sub');
                btn.value = 'Setting new password, please wait...';
                pass.open('POST', url + 'reset/new_passwd_ajax', true);
                pass.onload = function (event) {
                    if (pass.status == 200) {
                        var res = JSON.parse(pass.responseText);
                        if (res.hasOwnProperty('results')) {
                            if (res.results == 'success.') {
                                window.location = url + 'login/changed';
                            }
                        } else if (res.hasOwnProperty('passwd')) {
                            var error = document.getElementById('new-passwd-error');
                            error.innerHTML = res.passwd;
                        }
                    }
                    btn.value = 'Set new password';
                };
                pass.send(data);
            }
            e.preventDefault();
        }, false);
    }

    //like and dislike buttons
    var like = document.forms.namedItem('love-hate');
    if (like) {
        like.addEventListener('submit', function (e) {
            var data = new FormData(like);
            var request = new XMLHttpRequest();
            request.open('POST', url + 'img\/like_ajax', true);
            request.onload = function (event) {
                if (request.status == 200) {
                    var res = JSON.parse(request.responseText);
                    if (res.hasOwnProperty('nouser')) {
                        document.getElementById('nouser').innerHTML = res.nouser;
                    } else {
                        var likes = document.getElementById('likes');
                        var dislikes = document.getElementById('dislikes');
                        likes.innerHTML = res.likes;
                        dislikes.innerHTML = res.dislikes;
                    }
                }
            };
            request.send(data);
            e.preventDefault();
        }, false);
    }

    //comments with ajax
    var opinion = document.forms.namedItem('opinion');
    if (opinion) {
        opinion.addEventListener('submit', function (e) {
            var text = document.getElementById('opinion');
            var nouser = document.getElementById('nouser');
            nouser.innerHTML = '';
            if (text.value.trim() === '') {
                nouser.innerHTML = 'Please add a comment.';
            } else {
                var data = new FormData(opinion);
                var comment = new XMLHttpRequest();
                comment.open('POST', url + 'img/add_comment_ajax', true);
                comment.onload = function (event) {
                    if (comment.status == 200) {
                        var res = JSON.parse(comment.responseText);
                        var div = document.getElementById('comment-area');
                        if (res.hasOwnProperty('comment')) {
                            var divCom = document.createElement('div');
                            divCom.className = 'comment-area';
                            divCom.innerHTML = res.comment;
                            div.insertBefore(divCom, div.firstChild);
                        }
                        if (res.hasOwnProperty('nouser')) {
                            var nouser = document.getElementById('nouser');
                            nouser.innerHTML = res.nouser;
                        }
                    }
                };
                comment.send(data);
            }
            e.preventDefault();
        }, false);
    }

    addListeners();
};

//validate passwod
function validatePassword(passwdId, errorId) {
    var p = document.getElementById(passwdId).value,
        errors = [];
    var error = document.getElementById(errorId);
    if (p.length < 8) {
        errors.push("Your password must be at least 8 characters");
    }
    if (p.search(/[a-z]/i) < 0) {
        errors.push("Your password must contain at least one letter.");
    }
    if (p.search(/[0-9]/) < 0) {
        errors.push("Your password must contain at least one digit.");
    }
    if (errors.length > 0) {
        error.innerHTML = (errors.join(", "));
        return false;
    }
    return true;
}

//validate username
function validateUsername(userId, errorId) {
    var username = document.getElementById(userId).value;
    var error = document.getElementById(errorId);
    var errors = [];
    var regexp = /^[a-zA-Z0-9_]+$/; //allow only alphanumeric and underscore

    if (username.length < 2) {
        errors.push('Your username must be at least 2 characters.');
    }
    if (username.search(regexp) == -1) {
        errors.push('Your username must contain alphanumeric characters and underscore.');
    }

    if (errors.length > 0) {
        error.innerHTML = errors.join(', ');
        return false;
    }
    return true;
}

//validate email
function validateEmail(emailId, errorId) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var error = document.getElementById(errorId);
    var email = document.getElementById(emailId);

    if (reg.test(email.value) == false) {
        error.innerHTML = 'Invalid Email Address';
        return false;
    }
    return true;

}

function hideElement(hideId) {
    var hide = document.getElementById(hideId);
    hide.style.display = 'none';
}

function unHide(unhideId) {
    var h = document.getElementById(unhideId);
    h.style.display = 'block';
}

//working with the webcam
var cam = document.getElementById('cam'); //open and take picture button
var video = document.getElementById('video'); //the video div
var canvas = document.getElementById('canvas'); //the canvas div
var drawCanvas = document.getElementById('from-form'); //the canvas div
var canvasWidth = 400;
var canvasHeight = 300;
// var superImages = document.getElementById('super-images'); //superimposed div
var upload = document.getElementById('upload-photo'); //upload photo button
var save = document.getElementById('save-photo'); //save photo image
var img = null; //check if image is selected.
var srcXPosition = 75; //75 pixels from the left.
var srcYPosition = 0; //0 pixels from the top.
var image = document.getElementById('image'); //uploaded image from form.
if (cam) {
    cam.addEventListener('click', saveImage, false);
}

function saveImage(upload) {
    if (document.querySelector('input[name="super"]:checked')) {
        img = document.querySelector('input[name="super"]:checked').value;
    }
    var val = (this.innerHTML);
    var context = canvas.getContext('2d');
    if (val === 'Open camera') {
        cam.innerHTML = 'Take photo';
        this.disabled = true;
        enableEl(['video', 'super-images']);
        disableEl(['upload-image', 'save-photo']);
        openCam()
    } else if (val === 'Take photo') {
        if (img) {
            context.drawImage(video, 0, 0, canvasWidth, canvasHeight);
            var dataURL = canvas.toDataURL('image/png');
            playShutter();
            uploadImage(dataURL);
        } else {
            alert('Please pick superimpose image'); //display error here
        }
    }
}

function openCam() {
    var vendorUrl = window.URL || window.webkitURL;
    navigator.getMedia = navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia;
    navigator.getMedia({
        video: true,
        audio: false
    }, function (stream) {
        var source = vendorUrl.createObjectURL(stream);
        video.src = source;
        video.play();
        upload.addEventListener('click', function () {
            stopStream(stream);
        });
        // video.src = vendorUrl.createObjectURL(stream);
        // MediaStream = stream.getTracks()[0];
    }, function (error) {
        console.log(error);
    });
}

function stopStream(stream) {
    stream.getVideoTracks().forEach(function (track) {
        track.stop();
    });
    video.src = '';
    cam.innerHTML = 'Open camera';
    if (cam.hasAttribute('disabled')) {
        cam.removeAttribute('disabled');
    }
    disableEl(['video'])
    enableEl(['upload-image', 'save-photo']);
}

function uploadImage(dataURL) {
    var data = 'image=' + dataURL + '&src=' + img + '&x=' + srcXPosition + '&y=' + srcYPosition;
    var request = new XMLHttpRequest();
    request.open('POST', url + 'edit\/upload_image_cam', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onload = function () {
        if (request.status === 200) {
            var res = JSON.parse(request.responseText);
            if (res.hasOwnProperty('src')) {
                createDiv('uploaded-imgs', clean_url + '/uploads/user-img/' + res.src, 'side-img');
                // console.log(res);
            }
            //    handle errors here
        }
    };
    request.send(data);
}

// if (upload) {
//     upload.addEventListener('click', function () {
//         var val = this.innerHTML;
//         if (val === 'Upload photo') {
//             video.pause();
//         }
//     });
// }

if (save) {
    save.addEventListener('click', function () {
        if (document.querySelector('input[name="super"]:checked')) {
            img = document.querySelector('input[name="super"]:checked').value;
        }
        if (img) {
            var context = drawCanvas.getContext('2d');
            // context.drawImage(video, 0, 0, drawCanvas.width, drawCanvas.height);
            var dataURL = drawCanvas.toDataURL('image/png');
            playShutter();
            uploadImage(dataURL);
        } else {
            alert('Please pick superimpose image'); //display error here
        }
    })
}


if (image) {
    image.addEventListener('change', function () {

        var context = drawCanvas.getContext('2d');
        if (this.files && this.files[0]) {
            var fr = new FileReader();
            fr.onload = function (ev) {
                var img = new Image();
                img.onload = function () {
                    // canvasWidth = img.naturalWidth;
                    // canvasHeight = img.naturalHeight;
                    drawCanvas.width = img.naturalWidth;
                    drawCanvas.height = img.naturalHeight;
                    enableEl(['super-images']);
                    context.drawImage(img, 0, 0, drawCanvas.width, drawCanvas.height);
                };
                img.src = ev.target.result;
            };
            fr.readAsDataURL(this.files[0]);
        }
    }, false);
}

function stopcam() {
    MediaStream.stop();
    cam.innerHTML = 'Open camera';
}

function disableEl(params) {
    for (var el in params) {
        var dis = document.getElementById(params[el]);
        if (dis) {
            if (!dis.hasAttribute('hidden')) {
                dis.setAttribute('hidden', true);
            }
        }
    }
}

function enableEl(params) {
    for (var el in params) {
        var dis = document.getElementById(params[el]);
        if (dis) {
            if (dis.hasAttribute('hidden')) {
                dis.removeAttribute('hidden');
            }
        }
    }
}

function playShutter() {
    var audio = document.getElementById('shutter');
    audio.play();
}

function createDiv(idParent, innerContent, clsName) {
    var div = document.createElement('div');
    var parent = document.getElementById(idParent);
    var img = new Image();
    img.src = innerContent;
    div.className = clsName;
    div.appendChild(img);
    parent.insertBefore(div, parent.childNodes[0]);
}

var radios = document.getElementsByName('super');
if (radios) {
    var overlay = document.getElementById('impose');
    for (var radio in radios) {
        radios[radio].onclick = function () {
            var cam = document.getElementById('cam');
            overlay.src = url + '/images/' + document.querySelector('input[name="super"]:checked').value;
            if (cam.hasAttribute('disabled')) {
                cam.removeAttribute('disabled');
            }
        }
    }
}

// function moveImage(e) {
//     var move = document.getElementById('impose');
//     // move.style.position = 'absolute';
//     // move.style.top = e.clientY + 'px';
//     // move.style.left = e.clientX + 'px';
//     move.style.top = e.clientY - 75 + 'px';
//     move.style.left = e.clientX - 75 + 'px';
//     // console.log('Y: ' +e.clientY);
//     // console.log('X: ' +e.clientX);
// }
//
// function addListeners(){
//     document.getElementById('impose').addEventListener('mousedown', mouseDown, false);
//     window.addEventListener('mouseup', mouseUp, false);
//
// }
//
// function mouseUp()
// {
//     window.removeEventListener('mousemove', moveImage, true);
// }
//
//
// function mouseDown(e){
//   window.addEventListener('mousemove', moveImage, true);
// }

function moveImage(e) {
    var move = document.getElementById('impose');
    // move.style.position = 'absolute';
    move.style.top = e.clientY - 75 + 'px';
    move.style.left = e.clientX - 75 + 'px';
    srcYPosition = parseInt(move.style.top);
    srcXPosition = parseInt(move.style.left);
}

function addListeners() {
    var imp = document.getElementById('impose');
    if (imp) {
        imp.addEventListener('mousedown', mouseDown, false);
    }
    window.addEventListener('mouseup', mouseUp, false);
}

function mouseUp() {
    window.removeEventListener('mousemove', moveImage, true);
}

function mouseDown(e) {
    window.addEventListener('mousemove', moveImage, true);
}