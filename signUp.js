let signupbtn = document.getElementById('signupbtn');
let usernametf = document.getElementById('name');
let passwordtf = document.getElementById('pass');
let confirmpasstf = document.getElementById('confirmPassword');
let form = document.getElementById('form');

function clear(){
    usernametf = "";
    passwordtf = "";
    confirmpasstf = "";
}

function checkPass(){
    if (passwordtf.value != confirmpasstf.value){
        alert("Please check your password!");
        clear();
        return false;
    }
    else{
        return true;
    }
}

function checkBlank(){
    if(usernametf.value === "" || passwordtf.value === "" || confirmpasstf.value === ""){
        alert("Please fill in all the blanks!");
        clear();
        return false;
    }
    else{
        return true;
    }
}

function submitForm(event){
    debugger;
    event.preventDefault();
    if (checkBlank() && checkPass()){
        form.submit();
        clear();
    }
}

signupbtn.addEventListener('click', submitForm);