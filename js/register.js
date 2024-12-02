const firstNameError = document.getElementById("first_error");
const lastNameError = document.getElementById("last_error");
const emailError = document.getElementById("email_error");
const phoneError = document.getElementById("phone_error");
const addressError = document.getElementById("address_error");
const passwordError = document.getElementById("pass_error");
const confirmPasswordError = document.getElementById("conpass_error");

function validFirstName() {
  const firstName = document.getElementById("first_name").value.trim();
  if (firstName.length === 0) {
    firstNameError.innerHTML = "Please enter your first name!";
    return false;
  }
  firstNameError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
  return true;
}

function validLastName() {
  const lastName = document.getElementById("last_name").value.trim();
  if (lastName.length === 0) {
    lastNameError.innerHTML = "Please enter your last name!";
    return false;
  }
  lastNameError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
  return true;
}

function validemail() {
  const email = document.getElementById("email").value.trim();
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{3}$/;

  if (email.length === 0) {
    emailError.innerHTML = 'Please enter your email address!';
    return false;
  } else if (!emailRegex.test(email)) {
    emailError.innerHTML = 'Please enter a valid email address!';
    return false;
  }

  emailError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
  return true;
}

function validPhone() {
  const phone = document.getElementById("phone").value.trim();

  if (phone.length === 0) {
    phoneError.innerHTML = "Please enter your phone number!";
    return false;
  } else if (phone.length !== 10) {
    phoneError.innerHTML = "Phone number should be of 10 digits!";
    return false;
  } else if (!phone.match(/^[0-9]{10}$/)) {
    phoneError.innerHTML = "Phone number should contain only digits!";
    return false;
  }
  phoneError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
  return true;
}

function validPassword() {
  const password = document.getElementById('password').value.trim();

  if (password.length === 0) {
    passwordError.innerHTML = 'Please enter a password!';
    return false;
  } else if (password.length < 6) {
    passwordError.innerHTML = 'Password must be at least 6 characters long!';
    return false;
  } else if (!/[A-Z]/.test(password)) {
    passwordError.innerHTML = 'Password must contain at least one uppercase letter!';
    return false;
  } else if (!/[0-9]/.test(password)) {
    passwordError.innerHTML = 'Password must contain at least one number!';
    return false;
  }

  passwordError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
  return true;
}

function validConfirmPassword() {
  const password = document.getElementById('password').value.trim();
  const confirmPassword = document.getElementById('confirm_password').value.trim();

  if (confirmPassword.length === 0) {
    confirmPasswordError.innerHTML = 'Please confirm your password!';
    return false;
  } else if (confirmPassword !== password) {
    confirmPasswordError.innerHTML = 'Passwords do not match!';
    return false;
  }

  confirmPasswordError.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
  return true;
}

function validateForm(){
  if(!validFirstName() || !validLastName() || !validemail() || !validPhone() || !validPassword() || !validConfirmPassword()){
    return false;
  }
}

