<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Product Management System - Manage your products efficiently">

        <title>{{ config('app.name', 'Product Management System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind CSS */
                @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
            </style>
        @endif

        <style>
            .bg-gradient {
                background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            }

            .feature-card {
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-5px);
            }

            .animate-fade-in {
                animation: fadeIn 0.8s ease-in-out;
            }

            .animate-slide-up {
                animation: slideUp 0.8s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes slideUp {
                from {
                    transform: translateY(20px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>
    </head>

    <body class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-indigo-600 dark:text-indigo-400 text-2xl font-bold">PMS</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Auth::check())
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('admin.products.index') }}"
                                        class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        Products
                                    </a>
                                    <a href="https://ahmed-9464583.postman.co/workspace/Ahmed's-Workspace~c43dcbc3-0fa1-494a-892f-64e670144e40/collection/44910971-8adc12e5-cb56-40ab-bd9d-533721937fbd?action=share&creator=44910971"
                                        target="_blank"
                                        class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        API Documentation
                                    </a>
                                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                            Logout
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        Log in
                                    </a>
                                    <a href="https://ahmed-9464583.postman.co/workspace/Ahmed's-Workspace~c43dcbc3-0fa1-494a-892f-64e670144e40/collection/44910971-8adc12e5-cb56-40ab-bd9d-533721937fbd?action=share&creator=44910971"
                                        target="_blank"
                                        class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                        API Documentation
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="bg-gradient text-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 animate-fade-in">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl mb-6">
                        Product Management System
                    </h1>
                    <p class="text-xl max-w-3xl mb-8">
                        Streamline your product operations with our comprehensive management solution. Handle inventory,
                        track sales, and manage your product catalog with ease.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-white text-indigo-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium text-md shadow-md transition duration-150 ease-in-out">
                                Go to Dashboard
                            </a>
                            <a href="{{ route('admin.products.index') }}"
                                class="bg-indigo-800 text-white hover:bg-indigo-900 px-6 py-3 rounded-lg font-medium text-md shadow-md transition duration-150 ease-in-out">
                                Manage Products
                            </a>
                            <a href="https://ahmed-9464583.postman.co/workspace/Ahmed's-Workspace~c43dcbc3-0fa1-494a-892f-64e670144e40/collection/44910971-8adc12e5-cb56-40ab-bd9d-533721937fbd?action=share&creator=44910971"
                                target="_blank"
                                class="bg-white text-indigo-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium text-md shadow-md transition duration-150 ease-in-out">
                                API Documentation
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="bg-white text-indigo-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium text-lg shadow-md transition duration-150 ease-in-out">
                                Log In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="bg-indigo-800 text-white hover:bg-indigo-900 px-6 py-3 rounded-lg font-medium text-lg shadow-md transition duration-150 ease-in-out">
                                    Create Account
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center animate-slide-up">
                    <img src="https://builtin.com/sites/www.builtin.com/files/2024-10/product-management_0.png"
                        alt="Product Management" class="rounded-lg shadow-xl max-w-full h-auto" />
                </div>
            </div>
        </header>

        <!-- Features Section -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                        System Features
                    </h2>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-300">
                        Everything you need to manage your products efficiently
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 feature-card">
                        <div
                            class="h-12 w-12 bg-indigo-100 dark:bg-indigo-900 rounded-md flex items-center justify-center mb-4">
                            <i class="bi bi-box text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Product CRUD Operations</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Create, read, update, and delete products with our intuitive interface. Manage your entire
                            product catalog from one place.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 feature-card">
                        <div
                            class="h-12 w-12 bg-indigo-100 dark:bg-indigo-900 rounded-md flex items-center justify-center mb-4">
                            <i class="bi bi-filter text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Advanced Filtering</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Filter products by category, status, price range, and more. Find exactly what you're looking
                            for in seconds.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 feature-card">
                        <div
                            class="h-12 w-12 bg-indigo-100 dark:bg-indigo-900 rounded-md flex items-center justify-center mb-4">
                            <i class="bi bi-graph-up text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Analytics Dashboard</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Track product performance with detailed analytics. Monitor inventory levels, sales trends,
                            and category distribution.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 feature-card">
                        <div
                            class="h-12 w-12 bg-indigo-100 dark:bg-indigo-900 rounded-md flex items-center justify-center mb-4">
                            <i class="bi bi-gear text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">RESTful API</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Integrate with other systems using our comprehensive API. Access and manage products
                            programmatically.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 feature-card">
                        <div
                            class="h-12 w-12 bg-indigo-100 dark:bg-indigo-900 rounded-md flex items-center justify-center mb-4">
                            <i class="bi bi-people text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">User Management</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Control access with role-based permissions. Ensure the right people have the right level of
                            access.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-6 feature-card">
                        <div
                            class="h-12 w-12 bg-indigo-100 dark:bg-indigo-900 rounded-md flex items-center justify-center mb-4">
                            <i class="bi bi-file-earmark-text text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Custom Pagination</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Navigate through large product catalogs with ease using our custom pagination system with
                            beautiful animations.
                        </p>
                    </div>
                </div>
            </div>
        </section>



        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div
                    class="border-t border-gray-200 dark:border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-6 md:mb-0">
                        <p class="text-gray-500 dark:text-gray-400">
                            &copy; {{ date('Y') }} Product Management System. All rights reserved made by <a
                                href="https://github.com/if12is" target="_blank">Ahmed</a>
                        </p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="https://github.com/if12is" target="_blank"
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <i class="bi bi-github text-xl"></i>
                        </a>

                        <a href="https://www.linkedin.com/in/ahmed-elsayed-elngar-933bb01b5/" target="_blank"
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <i class="bi bi-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>

</html>
