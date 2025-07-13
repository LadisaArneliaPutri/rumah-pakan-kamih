@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="container mt-4">
    <h2 class="mb-4 text-center text-success fw-bold">Dashboard Villa Pakan Kamih Bukittinggi</h2>

    <ul class="nav nav-pills mb-4 justify-content-center" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#rooms" type="button">Kamar</button>
        </li>
        @if($role === 'admin')
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#roomtypes" type="button">Jenis Kamar</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#visitors" type="button">Pengunjung</button>
            </li>
        @endif
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#bookings" type="button">
                {{ $role === 'admin' ? 'Booking' : 'Riwayat Booking' }}
            </button>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Kamar -->
        <div class="tab-pane fade show active" id="rooms">
            <div class="d-flex justify-content-between align-items-center mb-3 section-header">
                <div>
                    <h5 class="text-success mb-0">
                        <i class="fas fa-bed me-2"></i>Data Kamar
                    </h5>
                    <small class="text-muted">Daftar semua kamar yang tersedia</small>
                </div>
                @if($role === 'admin')
                    <a href="{{ route('room.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus me-1"></i>Tambah Kamar
                    </a>
                @endif
            </div>
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Deskripsi / Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->nama }}</td>
                            <td>{{ $room->roomType->name ?? '-' }}</td>
                            <td>{{ $room->harga }}</td>
                            <td>
                                @if($room->gambar)
                                    <div class="d-flex align-items-start">
                                        <img src="{{ asset($room->gambar) }}" alt="Gambar" class="img-thumbnail me-2" style="max-height: 100px;">
                                        @if($room->deskripsi)
                                            <div class="flex-grow-1">
                                                <small class="text-muted">{{ $room->deskripsi }}</small>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    {{ $room->deskripsi ?? '-' }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('room.show', $room->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                    @if($role === 'user')
                                        <a href="{{ route('booking.user.create', $room->id) }}" class="btn btn-sm btn-success">Booking</a>
                                    @endif
                                    @if($role === 'admin')
                                        <a href="{{ route('room.edit', $room->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('room.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kamar ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Jenis Kamar -->
        @if($role === 'admin')
        <div class="tab-pane fade" id="roomtypes">
            <div class="d-flex justify-content-between align-items-center mb-3 section-header">
                <div>
                    <h5 class="text-primary mb-0">
                        <i class="fas fa-tags me-2"></i>Jenis Kamar
                    </h5>
                    <small class="text-muted">Kategori dan tipe kamar</small>
                </div>
                <a href="{{ route('roomtype.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus me-1"></i>Tambah Jenis
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roomTypes as $type)
                        <tr>
                            <td>{{ $type->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('roomtype.edit', $type->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('roomtype.destroy', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jenis ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Pengunjung -->
        @if($role === 'admin')
        <div class="tab-pane fade" id="visitors">
            <div class="d-flex justify-content-between align-items-center mb-3 section-header">
                <div>
                    <h5 class="text-info mb-0">
                        <i class="fas fa-users me-2"></i>Data Pengunjung
                    </h5>
                    <small class="text-muted">Daftar pengunjung yang terdaftar</small>
                </div>
                <a href="{{ route('visitor.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus me-1"></i>Tambah Pengunjung
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-info">
                    <tr>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->nama }}</td>
                            <td>{{ $visitor->telepon }}</td>
                            <td>{{ $visitor->email }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('visitor.edit', $visitor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengunjung ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Booking -->
        <div class="tab-pane fade" id="bookings">
            <div class="d-flex justify-content-between align-items-center mb-3 section-header">
                <div>
                    <h5 class="text-warning mb-0">
                        <i class="fas fa-calendar-check me-2"></i>
                        {{ $role === 'admin' ? 'Semua Data Booking' : 'Riwayat Booking' }}
                    </h5>
                    <small class="text-muted">
                        {{ $role === 'admin' ? 'Daftar semua booking yang masuk' : 'Daftar Booking Pengunjung Villa' }}
                    </small>
                </div>
            </div>
            

            
            @if($bookings->count() > 0)
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>Pengunjung</th>
                        <th>Kamar</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Status</th>
                        @if($role === 'admin') <th>Aksi</th> @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->visitor->nama ?? '-' }}</td>
                            <td>{{ $booking->room->nama ?? '-' }}</td>
                            <td>{{ $booking->checkin }}</td>
                            <td>{{ $booking->checkout }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $booking->status == 'confirmed' ? 'success' : 
                                    ($booking->status == 'cancelled' ? 'danger' : 'warning') 
                                }}">
                                    {{ $booking->status == 'confirmed' ? 'Dikonfirmasi' : 
                                       ($booking->status == 'cancelled' ? 'Dibatalkan' : 'Menunggu Konfirmasi') }}
                                </span>
                            </td>
                            @if($role === 'admin')
                            <td>
                                <div class="btn-group" role="group">
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('booking.confirm', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi booking ini?')">
                                                Konfirmasi
                                            </button>
                                        </form>
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan booking ini?')">
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus booking ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info text-center">
                @if($role === 'admin')
                    <strong>Belum ada data booking.</strong><br>
                    Silakan buat booking baru atau tunggu user melakukan booking.
                @else
                    <strong>Anda belum memiliki riwayat booking.</strong><br>
                    Silakan pilih kamar dan lakukan booking untuk melihat riwayat di sini.
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
