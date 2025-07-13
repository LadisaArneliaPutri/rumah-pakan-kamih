<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LadisaBooking;
use App\Models\LadisaVisitor;
use App\Models\LadisaRoom;

class LadisaBookingController extends Controller
{
    // ✅ Tampilkan data booking tergantung role
    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            $bookings = LadisaBooking::with(['visitor', 'room'])->get();
        } else {
            // Cari visitor berdasarkan email user yang login
            $userEmail = auth()->user()->email;
            $visitor = LadisaVisitor::where('email', $userEmail)->first();
            $bookings = $visitor ? $visitor->bookings()->with('room')->get() : collect([]);
        }

        return view('ladisa-homepage', compact('bookings', 'role'));
    }

    // ✅ Form tambah booking (khusus admin)
    public function create()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return view('create-ladisa-room', [
                'formType' => 'booking',
                'visitors' => LadisaVisitor::all(),
                'rooms' => LadisaRoom::all(),
                'action' => route('booking.store')
            ]);
        }

        return redirect()->route('homepage')->with('error', 'Akses ditolak.');
    }

    // ✅ Form booking untuk user (dengan data pengunjung)
    public function createUserBooking($roomId)
    {
        $room = LadisaRoom::findOrFail($roomId);
        
        return view('create-ladisa-room', [
            'formType' => 'userbooking',
            'room' => $room,
            'action' => route('booking.user.store')
        ]);
    }

    // ✅ Simpan booking untuk user
    public function storeUserBooking(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'room_id' => 'required|exists:ladisa_rooms,id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after_or_equal:checkin',
        ]);

        // Gunakan email yang diisi user di form
        $visitorEmail = $request->email;
        
        // Buat visitor baru dengan data yang diisi user
        $visitor = LadisaVisitor::create([
            'nama' => $request->nama,
            'email' => $visitorEmail,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        // Buat booking
        LadisaBooking::create([
            'visitor_id' => $visitor->id,
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => 'pending',
        ]);

        return redirect()->route('homepage')->with('success', 'Booking berhasil dibuat! Silakan cek riwayat booking Anda.');
    }

    // ✅ Simpan data booking (admin & user)
    public function store(Request $request)
    {
        $role = auth()->user()->role;

        $request->validate([
            'room_id' => 'required|exists:ladisa_rooms,id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after_or_equal:checkin',
        ]);

        if ($role === 'admin') {
            $request->validate([
                'visitor_id' => 'required|exists:ladisa_visitors,id',
            ]);
            $visitorId = $request->visitor_id;
        } else {
            $visitor = auth()->user()->visitor;
            if (!$visitor) {
                return redirect()->route('homepage')->with('error', 'Data pengunjung tidak ditemukan.');
            }
            $visitorId = $visitor->id;
        }

        LadisaBooking::create([
            'visitor_id' => $visitorId,
            'room_id' => $request->room_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => 'pending',
        ]);

        return redirect()->route('homepage')->with('success', 'Booking berhasil ditambahkan.');
    }

    // ✅ Form edit booking (khusus admin)
    public function edit($id)
    {
        $role = auth()->user()->role;
        if ($role !== 'admin') {
            return redirect()->route('homepage')->with('error', 'Akses ditolak.');
        }

        $booking = LadisaBooking::findOrFail($id);

        return view('edit-ladisa-room', [
            'formType' => 'booking',
            'data' => $booking,
            'visitors' => LadisaVisitor::all(),
            'rooms' => LadisaRoom::all(),
            'action' => route('booking.update', $id)
        ]);
    }

    // ✅ Update data booking (khusus admin)
    public function update(Request $request, $id)
    {
        $role = auth()->user()->role;
        if ($role !== 'admin') {
            return redirect()->route('homepage')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'visitor_id' => 'required|exists:ladisa_visitors,id',
            'room_id' => 'required|exists:ladisa_rooms,id',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after_or_equal:checkin',
        ]);

        $booking = LadisaBooking::findOrFail($id);
        $booking->update([
            'visitor_id' => $request->visitor_id,
            'room_id' => $request->room_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
        ]);

        return redirect()->route('homepage')->with('success', 'Booking berhasil diperbarui.');
    }

    // ✅ Hapus booking (khusus admin)
    public function destroy($id)
    {
        $role = auth()->user()->role;
        if ($role !== 'admin') {
            return redirect()->route('homepage')->with('error', 'Akses ditolak.');
        }

        $booking = LadisaBooking::findOrFail($id);
        $booking->delete();

        return redirect()->route('homepage')->with('success', 'Booking berhasil dihapus.');
    }

    // ✅ Konfirmasi booking (khusus admin)
    public function confirm($id)
    {
        $role = auth()->user()->role;
        if ($role !== 'admin') {
            return redirect()->route('homepage')->with('error', 'Akses ditolak.');
        }

        $booking = LadisaBooking::findOrFail($id);
        $booking->update(['status' => 'confirmed']);

        return redirect()->route('homepage')->with('success', 'Booking berhasil dikonfirmasi.');
    }

    // ✅ Batalkan booking (khusus admin)
    public function cancel($id)
    {
        $role = auth()->user()->role;
        if ($role !== 'admin') {
            return redirect()->route('homepage')->with('error', 'Akses ditolak.');
        }

        $booking = LadisaBooking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);

        return redirect()->route('homepage')->with('success', 'Booking berhasil dibatalkan.');
    }
}
