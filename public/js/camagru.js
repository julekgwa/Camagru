/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var url = 'http:\/\/localhost:8080\/Camagru\/public\/';
var form = document.forms.namedItem('reg_user');
form.addEventListener('submit', function (e) {
    var data = new FormData(form);
    var req  = new XMLHttpRequest();

    req.open('POST', url + 'register', true);
    req.onload = function (event) {
        if (req.status == 200) {
            alert('Yes');
        }else {
            alert('Error');
        }
    };
    req.send(data);
    e.preventDefault();
}, false);


