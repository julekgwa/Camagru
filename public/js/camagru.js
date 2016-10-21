/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var url = 'http:\/\/localhost\/Camagru\/public\/';

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
            request.open('POST', url + 'img/like_ajax', true);
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
}

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

//webcam code
var cam = document.getElementById('cam');
if (cam) {
    cam.onclick = function () {
        var img = null;
        if (document.querySelector('input[name="emotion"]:checked')) {
            img = document.querySelector('input[name="emotion"]:checked').value;
        }
        var val = (this.innerHTML);
        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var vendorUrl = window.URL || window.webkitURL;
        if (val == 'Open camera') {
            cam.innerHTML = 'Take photo';
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
            }, function (error) {
                console.log('error');
            });
        } else if (val == 'Take photo') {
            if (img) {
                context.drawImage(video, 0, 0, 400, 300);
                var dataURL = canvas.toDataURL('image/png');
                var data = 'image=' + dataURL + '&src=' + img;
                playShutter();
                var request = new XMLHttpRequest();
                request.open('POST', url + 'edit\/image_test', true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onload = function () {
                    if (request.status == 200) {
                        console.log(request.responseText);
                    }
                };
                request.send(data);
            } else {
                alert('Please pick superimpose image');
            }
        }
    }
}

function playShutter() {
    var audio = document.getElementById('shutter');
    audio.play();
}