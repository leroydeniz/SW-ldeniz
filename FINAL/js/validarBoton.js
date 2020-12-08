setInterval(function() {
        
    var validateEmail = document.getElementById('validaUsuario').innerText;
    var validatePass = document.getElementById('validaPassword').innerText;
    if (validateEmail.length == 14 && validatePass.length == 9) {
        document.getElementById('submit').disabled = false;
    } else {
        document.getElementById('submit').disabled = true;
    }
    
}, 2000);