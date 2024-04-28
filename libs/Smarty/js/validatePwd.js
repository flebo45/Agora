const passwordInput = document.getElementById('password');
const passwordMatchError = document.getElementById('passwordMatchError');
const registerForm = document.getElementById('register');

passwordInput.addEventListener('input', checkPasswordValidity);

function checkPasswordValidity() {
  // ... (password validation code) ...
}

registerForm.addEventListener('submit', function(event) {
  const password = passwordInput.value;

  const hasNumber = /\d/.test(password);
  const hasUppercase = /[A-Z]/.test(password);
  const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\\-=/]/.test(password);
  const isLengthValid = password.length >= 8;

  if (!hasNumber || !hasUppercase || !hasSpecialChar || !isLengthValid) {
    event.preventDefault(); // Prevent the form from submitting
    passwordMatchError.style.color = 'red';
    passwordMatchError.textContent = 'Password must be at least 8 characters long, containing at least 1 number, 1 uppercase letter, and 1 special character.';
    passwordMatchError.style.display = 'block';
  }
});