passwordtf = document.getElementById('password');
checkbox = document.getElementById('showPass');

function toggleVisibility(){
    if (passwordtf.type === 'password'){
        passwordtf.type = 'text';
    }
    else{
        passwordtf.type = 'password';
    }
}



checkbox.addEventListener('click', toggleVisibility);