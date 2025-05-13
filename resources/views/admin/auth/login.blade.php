<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - Product Management System</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <style>
            :root {
                --primary-color: #4e73df;
                --secondary-color: #858796;
            }

            body {
                font-family: 'Nunito', sans-serif;
                background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-card {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
                overflow: hidden;
                max-width: 500px;
                width: 100%;
                animation: fadeInUp 0.5s ease-out forwards;
            }

            .login-header {
                background: linear-gradient(to right, #4e73df, #224abe);
                color: white;
                padding: 2rem;
                text-align: center;
            }

            .login-body {
                padding: 2rem;
            }

            .form-control {
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                border: 1px solid #d1d3e2;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .form-control:focus {
                border-color: #bac8f3;
                box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            }

            .btn-login {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
                color: white;
                border-radius: 0.5rem;
                padding: 0.75rem;
                font-weight: 600;
                transition: all 0.2s ease;
            }

            .btn-login:hover {
                background-color: #2e59d9;
                border-color: #2653d4;
                transform: translateY(-2px);
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            }

            .login-brand {
                font-size: 2rem;
                font-weight: 800;
            }

            .login-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            .form-check-input:checked {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .input-group-text {
                background-color: #f8f9fc;
                border: 1px solid #d1d3e2;
                border-radius: 0.5rem 0 0 0.5rem;
            }

            .form-floating>.form-control {
                padding-top: 1.625rem;
                padding-bottom: 0.625rem;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="login-card">
                        <div class="login-header">
                            <i class="bi bi-box-seam login-icon"></i>
                            <div class="login-brand">PMS Admin</div>
                            <p class="mb-0">Product Management System</p>
                        </div>

                        <div class="login-body">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.login.submit') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <div class="form-floating flex-grow-1">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email Address" value="{{ old('email') }}" required
                                                autofocus>
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <div class="form-floating flex-grow-1">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password" required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-login">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Initialize SweetAlert2 for flash messages
            document.addEventListener('DOMContentLoaded', function() {
                // Error message
                @if ($errors->any())
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: "{{ $errors->first() }}",
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                @endif
            });
        </script>
    </body>

</html>
