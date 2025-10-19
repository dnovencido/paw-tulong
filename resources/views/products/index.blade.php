@extends('layouts.app')

@section('title', 'Product Catalogue | PawTulong')

@php
    $layoutCss = 'Product.css';
    $layoutJs = 'Product.js';
    $page = 'products';
@endphp

@section('content')
    <div class="info-boxes">
        <div class="info-box">
            <h3><i class="fas fa-star"></i> Featured Products</h3>
            <p>Discover our handpicked selection of premium pet care products. From essential supplies to luxury items, we have everything your furry friends need to stay happy and healthy.</p>
        </div>
    </div>

    <div class="filter-box">
    <form method="GET" action="{{ route('products.index') }}" style="display:flex; align-items:center; gap:10px;">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">All</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ $selected_category === $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
        <button type="submit">Apply</button>
    </form>
</div>

    <div class="product-grid">
    @forelse($products as $product)
        <div class="product-card"
             data-name="{{ $product->name }}"
             data-description="{{ $product->description }}"
             data-image="{{ $product->image_path }}"
             onclick="showProductModal(this)">
            <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="product-img">
            <div class="product-title"><b>{{ $product->name }}</b></div>
            <div class="product-desc">{{ Str::limit($product->description, 60) }}</div>
        </div>
    @empty
        <div class="no-products">
            <p>No products available at the moment.</p>
        </div>
    @endforelse
</div>


{{-- ✅ Product Popup Modal --}}
<div id="productModal" class="modal" style="display:none;">
    <div class="modal-content" style="
        position: relative;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    ">
        <span class="close" onclick="closeModal()" 
              style="position:absolute;top:10px;right:15px;font-size:28px;cursor:pointer;">&times;</span>
        <img id="modalImage" src="" alt="Product Image" 
             style="width:100%;max-height:300px;object-fit:contain;border-radius:8px;">
        <h2 id="modalName" style="margin-top:15px;color:#5a2d5a;"></h2>
        <p id="modalDescription" style="color:#333;font-size:15px;"></p>
    </div>
</div>


@endsection
