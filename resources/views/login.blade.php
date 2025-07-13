<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Villa Pakan Kamih Bukittinggi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #27ae60);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-box {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
        }
        .login-box h3 {
            margin-bottom: 30px;
            font-weight: 700;
            color: #27ae60;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #27ae60;
        }
        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
        }
        .btn-success:hover {
            background-color: #219150;
            border-color: #219150;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3 class="text-center">Login Dashboard</h3>
    <p class="text-center text-muted mb-4">Villa Pakan Kamih Bukittinggi</p>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Masukkan email" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Masukkan password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Login ke Dashboard</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
