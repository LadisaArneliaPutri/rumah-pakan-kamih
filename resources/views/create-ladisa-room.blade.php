@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header text-white text-center fw-bold
            @if(isset($formType) && $formType == 'roomtype') bg-primary
            @elseif(isset($formType) && $formType == 'visitor') bg-info
            @elseif(isset($formType) && $formType == 'booking') bg-warning text-dark
            @elseif(isset($formType) && $formType == 'userbooking') bg-success
            @else bg-success @endif">
            @if(isset($formType) && $formType == 'roomtype')
                Tambah Jenis Kamar
            @elseif(isset($formType) && $formType == 'visitor')
                Tambah Pengunjung
            @elseif(isset($formType) && $formType == 'booking')
                Tambah Booking
            @elseif(isset($formType) && $formType == 'userbooking')
                Booking Kamar - {{ $room->nama }}
            @else
                Tambah Kamar
            @endif
        </div>

        <div class="card-body">
            <form method="POST" action="{{ $action }}" 
                @if(!isset($formType) || $formType != 'roomtype') enctype="multipart/form-data" @endif>
                @csrf

                @if(isset($formType) && $formType == 'roomtype')
                    <!-- Form Jenis Kamar -->
                    <div class="mb-3">
                        <label class="form-label">Nama Jenis Kamar</label>
                        <input type="text" name="nama_jenis" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                    </div>
                @elseif(isset($formType) && $formType == 'visitor')
                    <!-- Form Pengunjung -->
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat (Opsional)</label>
                        <textarea name="alamat" class="form-control" rows="3"></textarea>
                    </div>
                @elseif(isset($formType) && $formType == 'booking')
                    <!-- Form Booking -->
                    <div class="mb-3">
                        <label class="form-label">Pengunjung</label>
                        <select name="visitor_id" class="form-select" required>
                            <option selected disabled>-- Pilih Pengunjung --</option>
                            @foreach ($visitors as $visitor)
                                <option value="{{ $visitor->id }}">{{ $visitor->nama }} ({{ $visitor->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kamar</label>
                        <select name="room_id" class="form-select" required>
                            <option selected disabled>-- Pilih Kamar --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->nama }} - {{ $room->roomType->name ?? 'N/A' }} ({{ $room->harga }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Check-In</label>
                        <input type="date" name="checkin" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Check-Out</label>
                        <input type="date" name="checkout" class="form-control" required>
                    </div>
                @elseif(isset($formType) && $formType == 'userbooking')
                    <!-- Form Booking untuk User -->
                    <div class="alert alert-info">
                        <strong>Informasi Kamar:</strong><br>
                        <strong>Nama:</strong> {{ $room->nama }}<br>
                        <strong>Jenis:</strong> {{ $room->roomType->name ?? 'N/A' }}<br>
                        <strong>Harga:</strong> {{ $room->harga }}
                    </div>

                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="{{ auth()->user()->name }}" required>
                        <small class="text-muted">Masukkan nama lengkap Anda</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        <small class="text-muted">Masukkan email Anda</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat (Opsional)</label>
                        <textarea name="alamat" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Check-In <span class="text-danger">*</span></label>
                        <input type="date" name="checkin" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Check-Out <span class="text-danger">*</span></label>
                        <input type="date" name="checkout" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>
                @else
                    <!-- Form Kamar -->
                    <div class="mb-3">
                        <label class="form-label">Nama Kamar</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kamar</label>
                        <select name="room_type_id" class="form-select" required>
                            <option selected disabled>-- Pilih Jenis Kamar --</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" name="harga" class="form-control" placeholder="Contoh: Rp 525.000 NET/PAX" required>
                        <small class="text-muted">Masukkan harga dalam format yang diinginkan (contoh: Rp 525.000 NET/PAX)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                @endif

                <div class="text-end">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn 
                            @if(isset($formType) && $formType == 'roomtype') btn-primary
                            @elseif(isset($formType) && $formType == 'visitor') btn-info
                            @elseif(isset($formType) && $formType == 'booking') btn-warning
                            @elseif(isset($formType) && $formType == 'userbooking') btn-success
                            @else btn-success @endif">
                            @if(isset($formType) && $formType == 'userbooking')
                                Buat Booking
                            @else
                                Simpan
                            @endif
                        </button>
                        <a href="{{ route('homepage') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
