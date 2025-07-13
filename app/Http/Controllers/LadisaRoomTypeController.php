<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LadisaRoomType;

class LadisaRoomTypeController extends Controller
{
    // Menampilkan semua data jenis kamar (opsional ditampilkan di homepage)
    public function index()
    {
        $types = LadisaRoomType::all();
        return view('ladisa-homepage', compact('types'));
    }

    // Form tambah jenis kamar
    public function create()
    {
        return view('create-ladisa-room', [
            'formType' => 'roomtype',
            'action' => route('roomtype.store')
        ]);
    }

    // Simpan data jenis kamar
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        LadisaRoomType::create([
            'name' => $request->nama_jenis,
            'description' => $request->keterangan,
        ]);

        return redirect()->route('homepage')->with('success', 'Jenis kamar berhasil ditambahkan.');
    }

    // Form edit jenis kamar
    public function edit($id)
    {
        $type = LadisaRoomType::findOrFail($id);

        return view('edit-ladisa-room', [
            'formType' => 'roomtype',
            'data' => $type,
            'action' => route('roomtype.update', $id),
        ]);
    }

    // Update jenis kamar
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $type = LadisaRoomType::findOrFail($id);
        $type->update([
            'name' => $request->nama_jenis,
            'description' => $request->keterangan,
        ]);

        return redirect()->route('homepage')->with('success', 'Jenis kamar berhasil diperbarui.');
    }

    // Hapus jenis kamar
    public function destroy($id)
    {
        $type = LadisaRoomType::findOrFail($id);
        $type->delete();

        return redirect()->route('homepage')->with('success', 'Jenis kamar berhasil dihapus.');
    }
}
