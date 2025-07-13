<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Villa Pakan Kamih Bukittinggi - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #F8F5F1, #E2B6B6);
            font-family: 'Segoe UI', sans-serif;
            color: #4A4A4A;
        }
        .navbar-custom {
            background-color: #A3B18A;
        }
        .navbar-brand, .nav-link, .btn-outline-light {
            color: #fff !important;
        }
        footer {
            background-color: #A3B18A;
            color: #fff;
            padding: 10px 0;
            margin-top: 40px;
            text-align: center;
        }
        .btn-primary {
            background-color: #6B4F4F;
            border-color: #6B4F4F;
        }
        .btn-success {
            background-color: #4A7C59;
            border-color: #4A7C59;
        }
        
        /* Styling untuk tombol aksi */
        .btn-group {
            gap: 2px;
        }
        
        .btn-group .btn {
            border-radius: 4px;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        /* Styling untuk header section */
        .section-header h5 {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .section-header small {
            font-size: 0.875rem;
        }
        
        .section-header i {
            opacity: 0.8;
        }
        
        /* Responsive button group */
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
                gap: 4px;
            }
            
            .btn-group .btn {
                width: 100%;
            }
        }
        

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4 shadow">
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">🌿 Villa Pakan Kamih Bukittinggi</a>
        <div class="ms-auto">
            @auth
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">Logout</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login Dashboard</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        By Ladisa Arnelia Putri - MI 2C
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
