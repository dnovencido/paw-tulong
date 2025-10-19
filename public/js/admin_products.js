// Dropdown menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const dropdownBtn = document.getElementById('dropdownBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    
    if (dropdownBtn && dropdownMenu) {
        // Toggle dropdown menu
        dropdownBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropdownMenu.classList.toggle('open');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('open');
            }
        });
    }
    
    // Auto-hide success/error messages after 5 seconds
    const messages = document.querySelectorAll('.message');
    messages.forEach(function(message) {
        setTimeout(function() {
            message.style.opacity = '0';
            setTimeout(function() {
                message.style.display = 'none';
            }, 300);
        }, 5000);
    });
    
    // Form validation (align with Blade markup IDs)
    const addProductForm = document.querySelector('.add-product-form');
    if (addProductForm) {
        addProductForm.addEventListener('submit', function(event) {
            const nameInput = document.getElementById('name');
            const descInput = document.getElementById('description');
            const priceInput = document.getElementById('price');
            const imageInput = document.getElementById('image');

            if (!nameInput || !descInput || !priceInput || !imageInput) {
                // If expected inputs aren't found, skip JS validation (server will validate)
                return;
            }

            const productName = nameInput.value.trim();
            const productDescription = descInput.value.trim();
            const productPrice = parseFloat(priceInput.value);
            const productImage = imageInput.value.trim();
            
            if (productName.length < 2) {
                event.preventDefault();
                alert('Product name must be at least 2 characters long.');
                return;
            }
            
            if (productDescription.length < 10) {
                event.preventDefault();
                alert('Product description must be at least 10 characters long.');
                return;
            }
            
            if (isNaN(productPrice) || productPrice <= 0) {
                event.preventDefault();
                alert('Product price must be greater than 0.');
                return;
            }
            
            if (productImage.length < 1) {
                event.preventDefault();
                alert('Please enter an image filename.');
                return;
            }
        });
    }
    
    // Confirm delete action
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            if (!confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                event.preventDefault();
            }
        });
    });
    
    // Modal functionality (defensive — only if modal exists)
    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close');

    if (modal && closeBtn) {
        // Close modal when clicking X
        closeBtn.addEventListener('click', function() {
            modal.classList.remove('show');
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        });
        
        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && modal.classList.contains('show')) {
                modal.classList.remove('show');
            }
        });
    }
    
    // Add click event listeners to edit buttons (only wire up if modal exists)
    const editButtons = document.querySelectorAll('.edit-btn');
    if (modal) {
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');
                const price = this.getAttribute('data-price');
                const image = this.getAttribute('data-image');
                const category = this.getAttribute('data-category');
                const stock = this.getAttribute('data-stock');
                
                openEditModal(id, name, description, price, image, category, stock);
            });
        });
    }
});

// Function to open edit modal and populate fields
function openEditModal(id, name, description, price, image, category, stockQuantity) {
    const modal = document.getElementById('editModal');
    if (!modal) return;

    const idInput = document.getElementById('edit_product_id');
    const nameInput = document.getElementById('edit_product_name');
    const descInput = document.getElementById('edit_product_description');
    const priceInput = document.getElementById('edit_product_price');
    const imageInput = document.getElementById('edit_product_image');
    const categoryInput = document.getElementById('edit_product_category');
    const stockInput = document.getElementById('edit_stock_quantity');

    if (idInput) idInput.value = id;
    if (nameInput) nameInput.value = name;
    if (descInput) descInput.value = description;
    if (priceInput) priceInput.value = price;
    if (imageInput) imageInput.value = image;
    if (categoryInput) categoryInput.value = category;
    if (stockInput) stockInput.value = stockQuantity;

    modal.classList.add('show');
} 