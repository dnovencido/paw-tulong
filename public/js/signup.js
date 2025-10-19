// signup.js

document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  if (!form) return;
  // Allow normal Laravel form submit; optional minimal checks without preventing submit
  form.addEventListener('submit', function () {
    // no preventDefault here
  });
});