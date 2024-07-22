const $passwordInput = $("#password");
const $confirmPasswordInput = $("#confirmPassword");
const $passwordMatchError = $("#passwordMatchError");

// Function to check if passwords match
function checkPasswordsMatch() {
  const password = $passwordInput.val();
  const confirmPassword = $confirmPasswordInput.val();

  if (password === confirmPassword) {
    $passwordMatchError.hide();
    $confirmPasswordInput.css("border", "1px solid #ccc");
  } else {
    $passwordMatchError.show();
    $confirmPasswordInput.css("border", "1px solid red");
  }
}

$passwordInput.on("input", checkPasswordsMatch);
$confirmPasswordInput.on("input", checkPasswordsMatch);
