const changeBtn = document.getElementById('changePW');
const logoutBtn = document.getElementById('logOut');
const deleteBtn = document.getElementById('deleteAcc');
const form = document.getElementById('passwordForm');

const changePassDiv = document.getElementById('changePWDiv');
const changePassBtn = document.getElementById('changePass');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPass');

const delAcc = document.getElementById('deleteAcc');
const noButton = document.getElementById('noButton');
const confimationDiv = document.getElementById('delAccConfirmation');

function changePassword() {
    changePassDiv.style.display = 'flex';
}

function clear(){
    password.value = "";
    confirmPassword.value = "";
}

function checkValidity() {
    debugger;

    if (password.value === '' || confirmPassword.value === '') {
        alert('Please fill in all the input fields!');
        return false;
    } else if (password.value === confirmPassword.value) {
        changePassDiv.style.display = 'none';
        alert('Password changed successfully!');
        return true;
    } else {
        alert('Passwords do not match!');
        clear();
        return false;
    }
}

function submitPassword(event) {
    event.preventDefault();
    if (checkValidity()) {
        form.submit();
    }
}

function hideConfirmation(){
    confimationDiv.style.display = "flex";
}

changePassDiv.addEventListener('click', function(event) {
    if (event.target === changePassDiv) {
        changePassDiv.style.display = 'none';
    }
});

function closeWindow(){
    confimationDiv.style.display = 'none';
}

changeBtn.addEventListener('click', changePassword);
changePassBtn.addEventListener('click', submitPassword);

delAcc.addEventListener('click', hideConfirmation);

noButton.addEventListener('click', closeWindow);
