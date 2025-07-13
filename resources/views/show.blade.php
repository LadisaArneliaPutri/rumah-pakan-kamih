@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Detail Kamar
                </div>

                <div class="card-body">
                    <h4>{{ $room->nama }}</h4>
                    
                    @if($room->gambar)
                        <div class="mb-3">
                            <img src="{{ asset($room->gambar) }}" alt="Gambar Kamar" class="img-fluid" style="max-height: 300px;">
                        </div>
                    @endif
                    
                    <p><strong>Jenis Kamar:</strong> {{ $room->roomType->name ?? '-' }}</p>
                    <p><strong>Harga:</strong> {{ $room->harga }}</p>
                    <p><strong>Deskripsi:</strong> {{ $room->deskripsi ?? '-' }}</p>

                    <div class="mt-3">
                        <div class="btn-group" role="group">
                            <a href="{{ route('homepage') }}" class="btn btn-secondary">Kembali</a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning">Edit</a>
                            @endif
                            @if(auth()->user()->role === 'user')
                                <a href="{{ route('booking.user.create', $room->id) }}" class="btn btn-success">Booking</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
