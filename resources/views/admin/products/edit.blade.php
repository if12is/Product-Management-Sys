@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fade-in">Edit Product: {{ $product->name }}</h1>
        <div class="d-none d-sm-inline-block fade-in">
            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info shadow-sm me-2">
                <i class="bi bi-eye me-1"></i> View Product
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to Products
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 fade-in delay-1">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price" name="price"
                                value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="category" name="category"
                            value="{{ old('category', $product->category) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Active" {{ old('status', $product->status) == 'Active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="Inactive" {{ old('status', $product->status) == 'Inactive' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <small class="text-muted">Upload a new image (JPEG, PNG, JPG, GIF) with maximum size of 2MB. Leave empty
                        to keep the current image.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label>
                    <div class="d-flex align-items-center">
                        <div class="current-image border rounded p-2 me-3">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="img-thumbnail" style="max-height: 150px;">
                        </div>
                        <div id="image-preview" class="border rounded p-2 text-center bg-light"
                            style="display: none; min-width: 150px;">
                            <p class="mb-0 text-muted">New image preview</p>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview functionality
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.style.display = 'block';
                        imagePreview.innerHTML = `
                        <img src="${e.target.result}" alt="New Image Preview" class="img-fluid" style="max-height: 150px;">
                    `;
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreview.style.display = 'none';
                }
            });
        });
    </script>
@endsection
