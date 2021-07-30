const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#id_password');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});

const togglePassword2 = document.querySelector('#togglePassword2');
const password2 = document.querySelector('#id_password2');

togglePassword2.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
  password2.setAttribute('type', type);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});

const togglePassword3 = document.querySelector('#togglePassword3');
const password3 = document.querySelector('#id_password3');

togglePassword3.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
  password3.setAttribute('type', type);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});
