const $passwordInput = $("#password");
const $passwordMatchError = $("#passwordMatchError");
const $registerForm = $("#register");

$passwordInput.on("input", checkPasswordValidity);

$registerForm.on("submit", function (event) {
  const password = $passwordInput.val();

  const hasNumber = /\d/.test(password);
  const hasUppercase = /[A-Z]/.test(password);
  const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\\-=/]/.test(password);
  const isLengthValid = password.length >= 8;

  if (!hasNumber || !hasUppercase || !hasSpecialChar || !isLengthValid) {
    event.preventDefault(); // Prevent the form from submitting
    $passwordMatchError.css("color", "red");
    $passwordMatchError.text(
      "Password must be at least 8 characters long, containing at least 1 number, 1 uppercase letter, and 1 special character."
    );
    $passwordMatchError.show();
  }
});
