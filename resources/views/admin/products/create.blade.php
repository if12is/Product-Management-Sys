@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fade-in">Create New Product</h1>
        <a href="{{ route('admin.products.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm fade-in">
            <i class="bi bi-arrow-left me-1"></i> Back to Products
        </a>
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

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price" name="price"
                                value="{{ old('price') }}" min="0" step="0.01" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="category" name="category"
                            value="{{ old('category') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    <small class="text-muted">Upload an image (JPEG, PNG, JPG, GIF) with maximum size of 2MB</small>
                </div>

                <div class="mb-3">
                    <label for="image-preview" class="form-label">Image Preview</label>
                    <div id="image-preview" class="mt-2 border rounded p-2 text-center bg-light">
                        <p class="mb-0 text-muted">No image selected</p>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Create Product
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
                        imagePreview.innerHTML = `
                        <img src="${e.target.result}" alt="Image Preview" class="img-fluid" style="max-height: 200px;">
                    `;
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreview.innerHTML = `<p class="mb-0 text-muted">No image selected</p>`;
                }
            });
        });
    </script>
@endsection
