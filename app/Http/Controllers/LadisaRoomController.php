<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LadisaRoom;
use App\Models\LadisaRoomType;
use App\Models\LadisaVisitor;
use App\Models\LadisaBooking;

class LadisaRoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        $rooms = LadisaRoom::with('roomType')->get();
        $roomTypes = LadisaRoomType::all();
        $visitors = LadisaVisitor::all();

        if ($role === 'user') {
            // Cari semua booking yang dibuat oleh user ini berdasarkan user_id
            $bookings = LadisaBooking::with(['room', 'visitor'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $bookings = LadisaBooking::with(['room', 'visitor'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('ladisa-homepage', compact('rooms', 'roomTypes', 'visitors', 'bookings', 'role'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        $roomTypes = LadisaRoomType::all();

        return view('create-ladisa-room', [
            'roomTypes' => $roomTypes,
            'action' => route('room.store'),
            'formType' => 'room',
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:100',
            'room_type_id' => 'required|exists:ladisa_room_types,id',
            'harga' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $gambar = 'uploads/' . $filename;
        }

        LadisaRoom::create([
            'nama' => $request->nama,
            'room_type_id' => $request->room_type_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()->route('homepage')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $room = LadisaRoom::with('roomType')->findOrFail($id);
        return view('show', compact('room'));
    }

    public function edit($id)
    {
        $this->authorizeAdmin();

        $data = LadisaRoom::findOrFail($id);
        $roomTypes = LadisaRoomType::all();

        return view('edit-ladisa-room', [
            'data' => $data,
            'roomTypes' => $roomTypes,
            'action' => route('room.update', $id),
            'formType' => 'room',
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:100',
            'room_type_id' => 'required|exists:ladisa_room_types,id',
            'harga' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $room = LadisaRoom::findOrFail($id);

        $gambar = $room->gambar; // Keep existing image if no new one uploaded

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $gambar = 'uploads/' . $filename;
        }

        $room->update([
            'nama' => $request->nama,
            'room_type_id' => $request->room_type_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()->route('homepage')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();

        $room = LadisaRoom::findOrFail($id);
        $room->delete();

        return redirect()->route('homepage')->with('success', 'Kamar berhasil dihapus.');
    }

    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }
}
