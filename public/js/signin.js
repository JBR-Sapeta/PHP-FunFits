const emailInput = document.querySelector("input[name='email']");

const emailContainer = document.getElementById('email-div');

const emailError = document.getElementById('email-p');

class LoginView {
  messages = {
    email: 'Please enter a valid email.',
  };

  constructor() {
    emailInput.addEventListener('keyup', this._validateEmail.bind(this));
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

  _isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }
}

const loginForm = new LoginView();
