// client.js

document.addEventListener('DOMContentLoaded', function () {
  // Dropdown menu (already working)
  const dropdownBtn = document.getElementById('dropdownBtn');
  const dropdownMenu = document.getElementById('dropdownMenu');
  if (dropdownBtn && dropdownMenu) {
    const dropdown = dropdownBtn.parentElement;
    dropdownBtn.addEventListener('click', e => {
      e.stopPropagation();
      dropdown.classList.toggle('open');
    });
    dropdownMenu.addEventListener('click', () => dropdown.classList.remove('open'));
    document.addEventListener('click', e => {
      if (!dropdown.contains(e.target)) dropdown.classList.remove('open');
    });
  }

  // Chat system
  const chatForm = document.getElementById('chat-form');
  const chatInput = document.getElementById('chat-input');
  const chatBox = document.getElementById('chat-box');

  if (!chatForm || !chatInput || !chatBox) return;

  chatForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = chatInput.value.trim();
    if (!message) return;

    // Show user message immediately
    chatBox.innerHTML += `<div style="margin:6px 0;text-align:right;">
      <span style="display:inline-block;background:#e6b6d6;color:#000;padding:8px 12px;border-radius:10px;">${message}</span>
    </div>`;
    chatBox.scrollTop = chatBox.scrollHeight;
    chatInput.value = "";

    try {
      const response = await fetch('/chatbot/send', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ message })
      });

      const data = await response.json();

      // Show bot reply
      chatBox.innerHTML += `<div style="margin:6px 0;text-align:left;">
        <span style="display:inline-block;background:#f1f1f1;color:#333;padding:8px 12px;border-radius:10px;">${data.reply}</span>
      </div>`;
      chatBox.scrollTop = chatBox.scrollHeight;

    } catch (error) {
      console.error('Chat error:', error);
      chatBox.innerHTML += `<div style="color:red;">⚠️ Error sending message.</div>`;
    }
  });
});
