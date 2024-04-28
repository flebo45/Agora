const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const passwordMatchError = document.getElementById('passwordMatchError');

passwordInput.addEventListener('input', checkPasswordsMatch);
confirmPasswordInput.addEventListener('input', checkPasswordsMatch);

function checkPasswordsMatch() {
  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;

  if (password === confirmPassword) {
    passwordMatchError.style.display = 'none';
    confirmPasswordInput.style.border = '1px solid #ccc';
  } else {
    passwordMatchError.style.display = 'block';
    confirmPasswordInput.style.border = '1px solid red';
  }
}