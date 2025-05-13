@extends('admin.layouts.app')

@section('title', 'View Product')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fade-in">Product Details</h1>
        <div class="d-none d-sm-inline-block fade-in">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning shadow-sm me-2">
                <i class="bi bi-pencil me-1"></i> Edit Product
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to Products
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 fade-in delay-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Image</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="img-fluid rounded" style="max-height: 300px;">
                </div>
            </div>
        </div>

        <div class="col-lg-8 fade-in delay-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 30%">ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>${{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $product->category }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span
                                        class="badge bg-{{ $product->status === 'Active' ? 'success' : 'warning' }} px-3 py-2">
                                        {{ $product->status }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $product->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $product->updated_at->format('F d, Y h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-danger delete-product" data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}">
                            <i class="bi bi-trash me-1"></i> Delete Product
                        </button>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-1"></i> Edit Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete product confirmation with SweetAlert2
            const deleteButton = document.querySelector('.delete-product');

            deleteButton.addEventListener('click', function() {
                const productId = this.dataset.id;
                const productName = this.dataset.name;

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete "${productName}". This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    cancelButtonColor: '#858796',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create and submit the form
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ route('admin.products.index') }}/${productId}`;
                        form.style.display = 'none';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';

                        const method = document.createElement('input');
                        method.type = 'hidden';
                        method.name = '_method';
                        method.value = 'DELETE';

                        form.appendChild(csrfToken);
                        form.appendChild(method);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
