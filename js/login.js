const eError = document.getElementById('emailError');
const pError = document.getElementById('passError');

function emailValidate(){
  const email = document.getElementById('email').value.trim();
  if(email.length === 0){
    eError.innerHTML = 'Email is required!';
    return false;
  }
  eError.innerHTML = '';
  return true;
}

function passValidate(){
  const password = document.getElementById('password').value.trim();
  if(password.length === 0){
    pError.innerHTML = 'Password is required!';
    return false;
  }
  pError.innerHTML = '';
  return true;
}

function validateForm(){
  if(!emailValidate() || !passValidate()){
    return false;
  }
}

const cross = document.querySelector('#cross');
if (cross) {
  cross.addEventListener('click', () => {
    const myDiv = document.querySelector('.error_message');
    if (myDiv) {
      myDiv.classList.add('hide');
    }
  });
}
