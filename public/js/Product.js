document.addEventListener('DOMContentLoaded', function() {
    const dropdownBtn = document.getElementById('dropdownBtn');
    const dropdown = dropdownBtn.parentElement;
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('open');
    });

    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });
}); 

function showProductModal(element) {
    const modal = document.getElementById('productModal');
    document.getElementById('modalImage').src = element.dataset.image;
    document.getElementById('modalName').textContent = element.dataset.name;
    document.getElementById('modalDescription').textContent = element.dataset.description;
    modal.style.display = 'flex'; // ✅ show modal
}

function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

window.onclick = function(e) {
    const modal = document.getElementById('productModal');
    if (e.target === modal) closeModal();
};
