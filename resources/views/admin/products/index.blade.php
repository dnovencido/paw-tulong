@extends('layouts.app')

@section('title', 'Admin Products | PawTulong')

@php
    $layoutCss = 'admin_products.css';
    $layoutJs = 'admin_products.js';
    $page = 'add_product';
@endphp

@section('content')
<h1 class="page-title" style="text-align:center; font-weight:700; margin-bottom:30px;">
    Product Management
</h1>

@if(session('success'))
    <div class="message success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="message error">
        <i class="fas fa-triangle-exclamation"></i> {{ $errors->first() }}
    </div>
@endif

{{-- Section Header --}}


<div style="
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding-left: 40px;   /* keep small space for the title */
    padding-right: 0;     /* push button all the way right */
">
 
    <button id="openAddModal" class="add-btn"
        style="padding:8px 14px; font-size:14px; border-radius:6px; font-weight:600; display:flex; align-items:center; gap:6px; margin-right:85px;">
        <i class="fas fa-plus-circle"></i> Add New Product
    </button>
   
</div>
</div>



{{-- 📦 Products Table --}}
<div class="products-section">
    <div class="products-table">
        <table>
            <thead>
                <tr>
                    <th>Image</th><th>Name</th><th>Description</th><th>Category</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td><img src="{{ asset($product->image_path) }}" class="product-thumbnail"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category }}</td>
                    <td>
                        <button class="edit-btn" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-description="{{ $product->description }}"
                                data-image="{{ str_replace('img/', '', $product->image_path) }}"
                                data-category="{{ $product->category }}">
                            <i class="fas fa-edit"></i> 
                        </button>

                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash"></i> 
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="no-products">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


{{-- 🟣 Add Product Modal --}}
<div id="addProductModal" class="modal" style="display:none;">
    <div class="modal-content" style="max-width:500px;">
        <span class="close">&times;</span>
        <h2><i class="fas fa-plus-circle"></i> Add Product</h2>
        <form id="addProductForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Product Name:</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" required></textarea>
            </div>

            <div class="form-group">
    <label>Category:</label>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="Vaccines">Vaccines</option>
        <option value="Dewormers">Dewormers</option>
        <option value="Tick & Flea Preventives">Tick & Flea Preventives</option>
        <option value="Heartworm Preventives">Heartworm Preventives</option>
    </select>
</div>


            <div class="form-group">
                <label>Product Image</label>
                <div id="add-drop-zone"
                     style="border:2px dashed #a86ca8;border-radius:10px;padding:20px;text-align:center;background:#fdf9fd;cursor:pointer;">
                    <p style="margin:0;color:#6b4a6b;">📸 Drag & drop image here or click to browse</p>
                    <input type="file" id="add_image" name="image" accept="image/*" style="display:none;" required>
                    <img id="add_preview" src="#" alt="Preview" style="max-width:120px;margin-top:10px;border-radius:10px;display:none;">
                </div>
            </div>

            <button type="submit" class="add-btn" style="width:100%;">Save Product</button>
        </form>
    </div>
</div>

{{-- ✏️ Edit Modal --}}
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2><i class="fas fa-pen"></i> Edit Product</h2>
        <form id="editProductForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_product_id" name="product_id">

            <div class="form-group">
                <label for="edit_product_name">Product Name:</label>
                <input type="text" id="edit_product_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit_product_description">Description:</label>
                <textarea id="edit_product_description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label>Product Image</label>
                <div id="edit-drop-zone"
                     style="border:2px dashed #a86ca8;border-radius:10px;padding:20px;text-align:center;background:#fdf9fd;cursor:pointer;">
                    <p style="margin:0;color:#6b4a6b;">📸 Drag & drop image here or click to browse</p>
                    <input type="file" id="edit_image" name="image" accept="image/*" style="display:none;">
                    <img id="edit_preview" src="#" alt="Preview" style="max-width:120px;margin-top:10px;border-radius:10px;display:none;">
                </div>
            </div>

            <div class="form-group">
                <label>Category:</label>
                <select id="edit_product_category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Vaccines">Vaccines</option>
                    <option value="Dewormers">Dewormers</option>
                    <option value="Tick & Flea Preventives">Tick & Flea Preventives</option>
                    <option value="Heartworm Preventives">Heartworm Preventives</option>
                </select>
            </div>


            <div class="form-actions">
                <button type="submit" class="save-btn">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// 🟣 Add Product Modal
const addModal = document.getElementById('addProductModal');
const openAddBtn = document.getElementById('openAddModal');
const closeAddBtn = addModal.querySelector('.close');

openAddBtn.addEventListener('click', () => addModal.style.display = 'flex');
closeAddBtn.addEventListener('click', () => addModal.style.display = 'none');
window.addEventListener('click', e => { if (e.target === addModal) addModal.style.display = 'none'; });

// Drag-drop Add modal
const addDropZone = document.getElementById('add-drop-zone');
const addFileInput = document.getElementById('add_image');
const addPreview = document.getElementById('add_preview');

addDropZone.addEventListener('click', () => addFileInput.click());
addDropZone.addEventListener('dragover', e => { e.preventDefault(); addDropZone.style.background = '#f3e6f6'; });
addDropZone.addEventListener('dragleave', e => { e.preventDefault(); addDropZone.style.background = '#fdf9fd'; });
addDropZone.addEventListener('drop', e => {
    e.preventDefault();
    addDropZone.style.background = '#fdf9fd';
    const file = e.dataTransfer.files[0];
    addFileInput.files = e.dataTransfer.files;
    previewAddImage(file);
});
addFileInput.addEventListener('change', e => { const file = e.target.files[0]; previewAddImage(file); });
function previewAddImage(file) {
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        addPreview.src = e.target.result;
        addPreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

// 🟣 Edit modal logic remains the same
const editDropZone = document.getElementById('edit-drop-zone');
const editFileInput = document.getElementById('edit_image');
const editPreview = document.getElementById('edit_preview');
// 🟣 Edit Modal Close Functionality
const editModal = document.getElementById('editModal');
const closeEditBtn = editModal.querySelector('.close');

closeEditBtn.addEventListener('click', () => {
    editModal.style.display = 'none';
});

window.addEventListener('click', e => {
    if (e.target === editModal) {
        editModal.style.display = 'none';
    }
});

editDropZone.addEventListener('click', () => editFileInput.click());
editDropZone.addEventListener('dragover', e => { e.preventDefault(); editDropZone.style.background = '#f3e6f6'; });
editDropZone.addEventListener('dragleave', e => { e.preventDefault(); editDropZone.style.background = '#fdf9fd'; });
editDropZone.addEventListener('drop', e => {
    e.preventDefault();
    editDropZone.style.background = '#fdf9fd';
    const file = e.dataTransfer.files[0];
    editFileInput.files = e.dataTransfer.files;
    previewEditImage(file);
});
editFileInput.addEventListener('change', e => { const file = e.target.files[0]; previewEditImage(file); });
function previewEditImage(file) {
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        editPreview.src = e.target.result;
        editPreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

// 🟣 Populate Edit Modal
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const description = btn.dataset.description;
        const image = btn.dataset.image;
        const category = btn.dataset.category?.trim().toLowerCase(); // normalize category text

        // fill inputs
        document.getElementById('edit_product_id').value = id;
        document.getElementById('edit_product_name').value = name;
        document.getElementById('edit_product_description').value = description;

        // ✅ set correct category (case-insensitive match)
        const select = document.getElementById('edit_product_category');
        let found = false;
        for (const option of select.options) {
            if (option.value.trim().toLowerCase() === category) {
                option.selected = true;
                found = true;
                break;
            }
        }
        if (!found) select.selectedIndex = 0; // fallback to "Select Category"

        // ✅ image preview
        if (image) {
            editPreview.src = '/img/' + image;
            editPreview.style.display = 'block';
        } else {
            editPreview.style.display = 'none';
        }

        document.getElementById('editModal').style.display = 'flex';
    });
});

// 🟣 Edit form dynamic route
(function() {
    const form = document.getElementById('editProductForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        const id = document.getElementById('edit_product_id').value;
        form.action = '{{ url('admin/products') }}/' + encodeURIComponent(id);
    });
})();
</script>
@endsection