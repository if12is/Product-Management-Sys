<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Process admin login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user is an admin
            if ($user->admin) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            // If not admin, logout
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'You do not have admin privileges.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Show admin dashboard with analytics data
     */
    public function dashboard()
    {
        // Get total products count
        $totalProducts = Product::count();

        // Get active and inactive product counts
        $activeProducts = Product::where('status', 'Active')->count();
        $inactiveProducts = Product::where('status', 'Inactive')->count();

        // Get total categories count
        $totalCategories = Product::select('category')->distinct()->count();

        // Get latest products
        $latestProducts = Product::latest()->take(5)->get();

        // Get products by category for chart
        $categoryCounts = Product::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $categoryLabels = $categoryCounts->pluck('category')->toArray();
        $categoryData = $categoryCounts->pluck('count')->toArray();

        // Price range analysis
        $priceRanges = [
            '0-50' => [0, 50],
            '51-100' => [51, 100],
            '101-500' => [101, 500],
            '501-1000' => [501, 1000],
            '1000+' => [1001, PHP_INT_MAX]
        ];

        $priceRangeData = [];
        $priceRangeLabels = [];

        foreach ($priceRanges as $label => $range) {
            $count = Product::whereBetween('price', $range)->count();
            $priceRangeLabels[] = $label;
            $priceRangeData[] = $count;
        }

        return view('admin.dashboard.index', compact(
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'totalCategories',
            'latestProducts',
            'categoryLabels',
            'categoryData',
            'priceRangeLabels',
            'priceRangeData'
        ));
    }

    /**
     * Initialize default admin user
     * This is just for demo purposes - in a real app, you'd use proper seeding
     */
    public function createDefaultAdmin()
    {
        // Check if admin exists
        $existingAdmin = User::whereHas('admin')->first();

        if (!$existingAdmin) {
            // Create user
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
            ]);

            // Create admin
            Admin::create([
                'user_id' => $user->id,
                'username' => 'admin',
            ]);

            return "Default admin created: admin@example.com / password123";
        }

        return "Admin already exists!";
    }
}
