<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * Get all products with pagination and optional filtering
     *
     * @param int $perPage
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllProducts(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = Product::query();

        // Apply category filter
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        // Apply status filter
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Apply price range filter
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        // Apply search term
        if (!empty($filters['search'])) {
            $searchTerm = '%' . $filters['search'] . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('category', 'like', $searchTerm);
            });
        }

        // Apply sorting
        $sortField = $filters['sort_by'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';

        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['id', 'name', 'price', 'category', 'status', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $query->orderBy($sortField, $sortDirection);

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Get all active products with pagination and optional filtering
     *
     * @param int $perPage
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getActiveProductsPaginated(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $filters['status'] = 'Active';
        return $this->getAllProducts($perPage, $filters);
    }

    /**
     * Get product by ID
     *
     * @param int $id
     * @return Product|null
     */
    public function getProductById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * Create a new product
     *
     * @param array $data
     * @param UploadedFile $image
     * @return Product
     */
    public function createProduct(array $data, UploadedFile $image): Product
    {
        $imagePath = $this->uploadImage($image);

        $data['image'] = $imagePath;

        return Product::create($data);
    }

    /**
     * Update an existing product
     *
     * @param int $id
     * @param array $data
     * @param UploadedFile|null $image
     * @return Product|null
     */
    public function updateProduct(int $id, array $data, ?UploadedFile $image = null): ?Product
    {
        $product = Product::find($id);

        if (!$product) {
            return null;
        }

        if ($image) {
            // Delete old image
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            $data['image'] = $this->uploadImage($image);
        }

        $product->update($data);

        return $product;
    }

    /**
     * Delete a product
     *
     * @param int $id
     * @return bool
     */
    public function deleteProduct(int $id): bool
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        // Delete image
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        return $product->delete();
    }

    /**
     * Upload product image
     *
     * @param UploadedFile $image
     * @return string
     */
    private function uploadImage(UploadedFile $image): string
    {
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('products', $filename, 'public');
        return $path;
    }

    /**
     * Get all active products
     *
     * @return Collection
     */
    public function getActiveProducts(): Collection
    {
        return Product::where('status', 'Active')->latest()->get();
    }
}
