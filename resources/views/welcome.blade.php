@extends('layouts.app')

@section('content')
<style>
    .welcome-section {
        background: linear-gradient(135deg, #e0f7fa, #ffffff);
        border-radius: 20px;
        padding: 60px 30px;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .welcome-section:hover {
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.15);
    }
    .welcome-title {
        font-size: 3rem;
        font-weight: 700;
        color: #00796b;
    }
    .welcome-subtitle {
        font-size: 1.5rem;
        color: #004d40;
        margin-bottom: 20px;
    }
    .welcome-desc {
        font-size: 1.1rem;
        color: #555;
        max-width: 700px;
        margin: 0 auto 30px;
    }
    .welcome-btn {
        padding: 12px 40px;
        font-size: 1.1rem;
        border-radius: 8px;
    }
</style>

<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="welcome-section text-center w-100">
        <h1 class="welcome-title">Sistem Informasi</h1>
        <h3 class="welcome-subtitle">Villa Pakan Kamih Bukittinggi</h3>
        <p class="welcome-desc">
            Sistem Informasi untuk mengelola kamar, jenis kamar, pengunjung, dan booking secara efisien dan terstruktur.
            Didesain untuk kenyamanan dan kemudahan pengelolaan Villa Pakan Kamih.
        </p>

        @auth
            <a href="{{ route('homepage') }}" class="btn btn-outline-primary welcome-btn">Masuk ke Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-success welcome-btn">Login ke Dashboard</a>
        @endauth
    </div>
</div>
@endsection
