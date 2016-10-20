/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var url = 'http:\/\/localhost\/Camagru\/public\/';
var form = document.forms.namedItem('reg_user');
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