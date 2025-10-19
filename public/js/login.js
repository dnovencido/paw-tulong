// login.js

document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    if (!email || !password) return; // let server handle

    // Basic client check; allow normal submit to Laravel
    if (!email.value.trim() || !password.value.trim()) {
      // Optionally focus the first empty field, but do not block server validation
      if (!email.value.trim()) email.focus();
      else password.focus();
    }
    // Do not preventDefault; let the form submit
  });
});