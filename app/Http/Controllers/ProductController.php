<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        // Get filter parameters from request
        $filters = [
            'category' => $request->get('category'),
            'status' => $request->get('status'),
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
            'search' => $request->get('search'),
            'sort_by' => $request->get('sort_by', 'created_at'),
            'sort_direction' => $request->get('sort_direction', 'desc'),
        ];

        // Get products with filters and pagination
        $products = $this->productService->getAllProducts(10, $filters);

        // Get unique categories for the filter dropdown
        $categories = \App\Models\Product::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.products.index', compact('products', 'categories', 'filters'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Active,Inactive',
        ]);

        $this->productService->createProduct($validatedData, $request->file('image'));

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product not found.');
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product not found.');
        }

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Active,Inactive',
        ]);

        $product = $this->productService->updateProduct(
            $id,
            $validatedData,
            $request->hasFile('image') ? $request->file('image') : null
        );

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product not found.');
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->productService->deleteProduct($id);

        if (!$result) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product not found.');
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
