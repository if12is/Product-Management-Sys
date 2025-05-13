<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    protected $productService;
    protected $apiToken = 'IF12I1234567890@#';

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Validate API token - for backward compatibility
     */
    private function validateToken(Request $request): bool
    {
        $token = $request->header('Authorization');

        if (empty($token)) {
            return false;
        }

        // Remove "Bearer " prefix if present
        $token = str_replace('Bearer ', '', $token);

        return $token === $this->apiToken;
    }

    /**
     * Return unauthorized response
     */
    private function unauthorizedResponse(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Invalid or missing token.',
        ], 401);
    }

    /**
     * Get all active products with optional pagination and filtering
     */
    public function index(Request $request): JsonResponse
    {
        // Check if pagination is requested
        if ($request->has('paginate') && $request->paginate) {
            $perPage = $request->per_page ?? 10; // Default 10 items per page

            // Get filter parameters from request
            $filters = [
                'category' => $request->get('category'),
                'search' => $request->get('search'),
                'min_price' => $request->get('min_price'),
                'max_price' => $request->get('max_price'),
                'sort_by' => $request->get('sort_by', 'created_at'),
                'sort_direction' => $request->get('sort_direction', 'desc'),
            ];

            $products = $this->productService->getActiveProductsPaginated($perPage, $filters);

            return response()->json([
                'success' => true,
                'data' => $products->items(),
                'pagination' => [
                    'total' => $products->total(),
                    'per_page' => $products->perPage(),
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem(),
                ],
            ]);
        }

        // Return all active products without pagination
        $products = $this->productService->getActiveProducts();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Get a specific product
     */
    public function show(string $id): JsonResponse
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }

    /**
     * Create a new product
     */
    public function store(Request $request): JsonResponse
    {
        // For backward compatibility
        if (!$request->user() && !$this->validateToken($request)) {
            return $this->unauthorizedResponse();
        }

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'category' => 'required|string|max:255',
                'status' => 'required|in:Active,Inactive',
            ]);

            if (!$request->hasFile('image')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image is required',
                    'errors' => ['image' => ['The image field is required']],
                ], 422);
            }

            $product = $this->productService->createProduct(
                $validatedData,
                $request->file('image')
            );

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing product
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // For backward compatibility
        if (!$request->user() && !$this->validateToken($request)) {
            return $this->unauthorizedResponse();
        }

        try {
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'price' => 'sometimes|required|numeric|min:0',
                'category' => 'sometimes|required|string|max:255',
                'status' => 'sometimes|required|in:Active,Inactive',
                'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $product = $this->productService->updateProduct(
                $id,
                $validatedData,
                $request->hasFile('image') ? $request->file('image') : null
            );

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a product
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        // For backward compatibility
        if (!$request->user() && !$this->validateToken($request)) {
            return $this->unauthorizedResponse();
        }

        $result = $this->productService->deleteProduct($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }
}
