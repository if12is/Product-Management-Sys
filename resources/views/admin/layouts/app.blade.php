<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Admin Dashboard') - Product Management System</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <!-- Custom CSS -->
        <style>
            :root {
                --primary-color: #4e73df;
                --secondary-color: #858796;
                --success-color: #1cc88a;
                --info-color: #36b9cc;
                --warning-color: #f6c23e;
                --danger-color: #e74a3b;
            }

            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f8f9fc;
            }

            .sidebar {
                min-height: 100vh;
                background: linear-gradient(180deg, var(--primary-color) 10%, #224abe 100%);
                box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15);
                transition: all 0.3s ease;
            }

            .sidebar .nav-link {
                color: rgba(255, 255, 255, .8);
                padding: 1rem;
                transition: all 0.3s ease;
            }

            .sidebar .nav-link:hover {
                color: #fff;
                background-color: rgba(255, 255, 255, .1);
                border-radius: 0.35rem;
            }

            .sidebar .nav-link.active {
                color: #fff;
                font-weight: 700;
                background-color: rgba(255, 255, 255, .2);
                border-radius: 0.35rem;
            }

            .sidebar .sidebar-brand {
                height: 4.375rem;
                text-decoration: none;
                font-size: 1.2rem;
                font-weight: 800;
                text-align: center;
                text-transform: uppercase;
                letter-spacing: .05rem;
                color: #fff;
                padding: 1.5rem 1rem;
            }

            .sidebar-divider {
                border-top: 1px solid rgba(255, 255, 255, .15);
                margin: 0 1rem 1rem;
            }

            .card {
                border: none;
                border-radius: 0.35rem;
                box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 .5rem 2rem 0 rgba(58, 59, 69, .15);
            }

            .card-header {
                background-color: #f8f9fc;
                border-bottom: 1px solid #e3e6f0;
            }

            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            .btn-primary:hover {
                background-color: #2e59d9;
                border-color: #2653d4;
            }

            .topbar {
                height: 4.375rem;
                box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15);
                background-color: #fff;
            }

            .content-wrapper {
                min-height: calc(100vh - 4.375rem);
                padding: 1.5rem;
            }

            .dropdown-menu {
                box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15);
                border: none;
            }

            .stat-card {
                border-left: 4px solid;
                border-radius: 0.35rem;
            }

            .stat-card.primary {
                border-left-color: var(--primary-color);
            }

            .stat-card.success {
                border-left-color: var(--success-color);
            }

            .stat-card.info {
                border-left-color: var(--info-color);
            }

            .stat-card.warning {
                border-left-color: var(--warning-color);
            }

            /* Animations */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in {
                animation: fadeIn 0.5s ease-out forwards;
            }

            .delay-1 {
                animation-delay: 0.1s;
            }

            .delay-2 {
                animation-delay: 0.2s;
            }

            .delay-3 {
                animation-delay: 0.3s;
            }

            .delay-4 {
                animation-delay: 0.4s;
            }
        </style>
        @yield('styles')
    </head>

    <body>
        <div class="d-flex">
            @include('admin.layouts.sidebar')

            <div class="d-flex flex-column flex-grow-1">
                @include('admin.layouts.header')

                <div class="content-wrapper">
                    @yield('content')
                </div>

                @include('admin.layouts.footer')
            </div>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- jQuery (for any additional plugins) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Initialize SweetAlert2 for flash messages
            document.addEventListener('DOMContentLoaded', function() {
                // Success message
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                @endif

                // Error message
                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: "{{ session('error') }}",
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                @endif
            });
        </script>

        @yield('scripts')
    </body>

</html>
