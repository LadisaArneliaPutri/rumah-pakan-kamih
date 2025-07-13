@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header text-white text-center fw-bold
            @if($formType == 'roomtype') bg-warning text-dark
            @elseif($formType == 'visitor') bg-info
            @elseif($formType == 'booking') bg-warning text-dark
            @else bg-primary @endif">
            @if($formType == 'roomtype')
                Edit Jenis Kamar
            @elseif($formType == 'visitor')
                Edit Pengunjung
            @elseif($formType == 'booking')
                Edit Booking
            @else
                Edit Kamar
            @endif
        </div>

        <div class="card-body">
            <form method="POST" action="{{ $action }}" 
                @if(!isset($formType) || $formType == 'room') enctype="multipart/form-data" @endif>
                @csrf
                @method('PUT')

                {{-- ========== FORM EDIT KAMAR ========== --}}
                @if(!isset($formType) || $formType == 'room')
                    <div class="mb-3">
                        <label class="form-label">Nama Kamar</label>
                        <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kamar</label>
                        <select name="room_type_id" class="form-select" required>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}" {{ $data->room_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" name="harga" class="form-control" value="{{ $data->harga }}" placeholder="Contoh: Rp 525.000 NET/PAX" required>
                        <small class="text-muted">Masukkan harga dalam format yang diinginkan (contoh: Rp 525.000 NET/PAX)</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $data->deskripsi }}</textarea>
                    </div>

                    <!-- Tampilkan gambar yang sudah ada -->
                    @if($data->gambar)
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini:</label><br>
                            <img src="{{ asset($data->gambar) }}" alt="Gambar Kamar" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Upload Gambar Baru (Opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                    </div>

                {{-- ========== FORM EDIT JENIS KAMAR ========== --}}
                @elseif($formType == 'roomtype')
                    <div class="mb-3">
                        <label class="form-label">Nama Jenis</label>
                        <input type="text" name="nama_jenis" class="form-control" value="{{ $data->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $data->description }}</textarea>
                    </div>

                {{-- ========== FORM EDIT PENGUNJUNG ========== --}}
                @elseif($formType == 'visitor')
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="{{ $data->telepon }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ $data->alamat }}</textarea>
                    </div>

                {{-- ========== FORM EDIT BOOKING ========== --}}
                @elseif($formType == 'booking')
                    @php $isAdmin = auth()->user()->role === 'admin'; @endphp

                    @if($isAdmin)
                    <div class="mb-3">
                        <label class="form-label">Pengunjung</label>
                        <select name="visitor_id" class="form-select" required>
                            @foreach($visitors as $visitor)
                                <option value="{{ $visitor->id }}" {{ $data->visitor_id == $visitor->id ? 'selected' : '' }}>
                                    {{ $visitor->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Kamar</label>
                        <select name="room_id" class="form-select" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ $data->room_id == $room->id ? 'selected' : '' }}>
                                    {{ $room->nama }} - {{ $room->roomType->name ?? 'N/A' }} ({{ $room->harga }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Check-In</label>
                        <input type="date" name="checkin" class="form-control" value="{{ $data->checkin }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Check-Out</label>
                        <input type="date" name="checkout" class="form-control" value="{{ $data->checkout }}" required>
                    </div>
                @endif

                <div class="text-end">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn 
                            @if($formType == 'roomtype') btn-warning
                            @elseif($formType == 'visitor') btn-info
                            @elseif($formType == 'booking') btn-warning
                            @else btn-primary @endif">Update</button>
                        <a href="{{ route('homepage') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
