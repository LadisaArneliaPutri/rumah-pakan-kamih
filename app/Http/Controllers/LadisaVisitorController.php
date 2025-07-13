<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LadisaVisitor;

class LadisaVisitorController extends Controller
{
    // ✅ Menampilkan semua data visitor ke homepage
    public function index()
    {
        $visitors = LadisaVisitor::all();
        return view('ladisa-homepage', compact('visitors'));
    }

    // ✅ Form tambah pengunjung
    public function create()
    {
        return view('create-ladisa-room', [
            'formType' => 'visitor',
            'action' => route('visitor.store')
        ]);
    }

    // ✅ Simpan data pengunjung
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:ladisa_visitors,email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);

        LadisaVisitor::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('homepage')->with('success', 'Pengunjung berhasil ditambahkan.');
    }

    // ✅ Form edit pengunjung
    public function edit($id)
    {
        $visitor = LadisaVisitor::findOrFail($id);

        return view('edit-ladisa-room', [
            'formType' => 'visitor',
            'data' => $visitor,
            'action' => route('visitor.update', $id)
        ]);
    }

    // ✅ Update data pengunjung
    public function update(Request $request, $id)
    {
        $visitor = LadisaVisitor::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:ladisa_visitors,email,' . $id,
            'telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);

        $visitor->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('homepage')->with('success', 'Pengunjung berhasil diperbarui.');
    }

    // ✅ Hapus pengunjung
    public function destroy($id)
    {
        LadisaVisitor::findOrFail($id)->delete();
        return redirect()->route('homepage')->with('success', 'Pengunjung berhasil dihapus.');
    }
}
