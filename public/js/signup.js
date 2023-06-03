const usernameInput = document.querySelector("input[name='username']");
const emailInput = document.querySelector("input[name='email']");
const passwordInput = document.querySelector("input[name='password']");
const confirmInput = document.querySelector("input[name='confirm']");

const usernameContainer = document.getElementById('username-div');
const emailContainer = document.getElementById('email-div');
const passwordContainer = document.getElementById('password-div');
const confirmContainer = document.getElementById('confirm-div');

const usernameError = document.getElementById('username-p');
const emailError = document.getElementById('email-p');
const passwordError = document.getElementById('password-p');
const confirmError = document.getElementById('confirm-p');

class RegisterView {
  messages = {
    username: 'Username must be at least 2 characters long.',
    email: 'Please enter a valid email.',
    password: 'Password must be at least 6 characters long.',
    confirm: "Entered passwords don't match.",
  }; 

  constructor() {
    usernameInput.addEventListener('keyup', this._validateUsername.bind(this));
    emailInput.addEventListener('keyup', this._validateEmail.bind(this));
    passwordInput.addEventListener('keyup', this._validatePassword.bind(this));
    confirmInput.addEventListener(
      'keyup',
      this._validateConfirmedPassword.bind(this)
    );
  }

  _validateUsername() {
    setTimeout(() => {
      const isValid = this._min(usernameInput.value, 2);
      isValid
        ? this._deleteMessage(usernameError)
        : this._setMessage(usernameError, this.messages.username);
      this._markValidation(usernameContainer, isValid);
    }, 1000);
  }

  _validateEmail() {
    setTimeout(() => {
      const isValid = this._isEmail(emailInput.value);
      isValid
        ? this._deleteMessage(emailError)
        : this._setMessage(emailError, this.messages.email);
      this._markValidation(emailContainer, isValid);
    }, 1000);
  }

  _validatePassword() {
    setTimeout(() => {
      const isValid = this._min(passwordInput.value, 6);
      isValid
        ? this._deleteMessage(passwordError)
        : this._setMessage(passwordError, this.messages.password);
      this._markValidation(passwordContainer, isValid);
    }, 1000);
  }

  _validateConfirmedPassword() {
    setTimeout(() => {
      const isValid = this._arePasswordsSame(
        passwordInput.value,
        confirmInput.value
      );
      isValid
        ? this._deleteMessage(confirmError)
        : this._setMessage(confirmError, this.messages.confirm);
      this._markValidation(confirmContainer, isValid);
    }, 1000);
  }

  _deleteMessage(element) {
    element.innerHTML = '';
  }

  _setMessage(element, message) {
    element.innerHTML = message;
  }

  _markValidation(element, condition) {
    !condition
      ? element.classList.add('base-input__field--error')
      : element.classList.remove('base-input__field--error');
  }

  _min(string, minLength) {
    return string.length >= minLength;
  }

  _isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }

  _arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
  }
}

const registerForm = new RegisterView();
