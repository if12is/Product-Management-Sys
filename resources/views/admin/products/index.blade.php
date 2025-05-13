@extends('admin.layouts.app')

@section('title', 'Products')

@section('styles')
    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .custom-pagination .pagination {
            box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15);
            border-radius: 0.35rem;
            overflow: hidden;
        }

        .custom-pagination .page-item .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: var(--primary-color);
            background-color: #fff;
            border: 1px solid #e3e6f0;
            transition: all 0.2s ease;
        }

        .custom-pagination .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .custom-pagination .page-item.disabled .page-link {
            color: #858796;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #e3e6f0;
        }

        .custom-pagination .page-item:first-child .page-link {
            margin-left: 0;
            border-top-left-radius: 0.35rem;
            border-bottom-left-radius: 0.35rem;
        }

        .custom-pagination .page-item:last-child .page-link {
            border-top-right-radius: 0.35rem;
            border-bottom-right-radius: 0.35rem;
        }

        .custom-pagination .page-item .page-link:hover {
            z-index: 2;
            color: #224abe;
            text-decoration: none;
            background-color: #f8f9fc;
            border-color: #e3e6f0;
            transform: translateY(-2px);
        }

        .custom-pagination .page-item.active .page-link:hover {
            color: #fff;
            background-color: #224abe;
            border-color: #224abe;
        }

        .pagination-info {
            color: #858796;
            margin-bottom: 0.5rem;
            text-align: center;
            font-size: 0.875rem;
        }

        /* Animation for pagination */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pagination-container {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .page-item {
            transition: transform 0.2s ease;
        }

        .page-item:hover {
            transform: translateY(-2px);
        }

        /* Pagination counter badge */
        .pagination-counter {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            color: #fff;
            background-color: var(--primary-color);
            margin-left: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fade-in">Products Management</h1>
        <a href="{{ route('admin.products.create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm fade-in">
            <i class="bi bi-plus-circle me-1"></i> Add New Product
        </a>
    </div>

    <div class="card shadow mb-4 fade-in delay-1">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Filter Products</h6>
            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#filterCollapse">
                <i class="bi bi-funnel me-1"></i> Toggle Filters
            </button>
        </div>
        <div class="collapse show" id="filterCollapse">
            <div class="card-body">
                <form action="{{ route('admin.products.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ $filters['search'] ?? '' }}" placeholder="Search by name or category">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}"
                                    {{ ($filters['category'] ?? '') == $category ? 'selected' : '' }}>{{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All</option>
                            <option value="Active" {{ ($filters['status'] ?? '') == 'Active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="Inactive" {{ ($filters['status'] ?? '') == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="min_price" class="form-label">Min Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="min_price" name="min_price"
                                value="{{ $filters['min_price'] ?? '' }}" min="0" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="max_price" class="form-label">Max Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="max_price" name="max_price"
                                value="{{ $filters['max_price'] ?? '' }}" min="0" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="sort_by" class="form-label">Sort By</label>
                        <select class="form-select" id="sort_by" name="sort_by">
                            <option value="created_at"
                                {{ ($filters['sort_by'] ?? 'created_at') == 'created_at' ? 'selected' : '' }}>Date Created
                            </option>
                            <option value="name" {{ ($filters['sort_by'] ?? '') == 'name' ? 'selected' : '' }}>Name
                            </option>
                            <option value="price" {{ ($filters['sort_by'] ?? '') == 'price' ? 'selected' : '' }}>Price
                            </option>
                            <option value="category" {{ ($filters['sort_by'] ?? '') == 'category' ? 'selected' : '' }}>
                                Category
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="sort_direction" class="form-label">Sort Direction</label>
                        <select class="form-select" id="sort_direction" name="sort_direction">
                            <option value="desc"
                                {{ ($filters['sort_direction'] ?? 'desc') == 'desc' ? 'selected' : '' }}>
                                Descending</option>
                            <option value="asc" {{ ($filters['sort_direction'] ?? '') == 'asc' ? 'selected' : '' }}>
                                Ascending</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="d-grid gap-2 d-md-flex">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-filter me-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 fade-in delay-2">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
            <span class="pagination-counter">{{ $products->total() }} Products</span>
        </div>
        <div class="card-body">
            @if ($products->isEmpty())
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i> No products found. Click "Add New Product" to create one.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="img-thumbnail" width="50">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $product->status === 'Active' ? 'success' : 'warning' }}">
                                            {{ $product->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.products.show', $product->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger delete-product"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 pagination-container">
                    <div class="pagination-info">
                        Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of
                        {{ $products->total() }} products
                    </div>
                    <div class="custom-pagination">
                        {{ $products->onEachSide(1)->links('vendor.pagination.admin-pagination') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete product confirmation with SweetAlert2
            const deleteButtons = document.querySelectorAll('.delete-product');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
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
                            form.action =
                                `{{ route('admin.products.index') }}/${productId}`;
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
        });
    </script>
@endsection
