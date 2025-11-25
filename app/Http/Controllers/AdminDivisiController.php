<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Participant;
use Carbon\Carbon;

class AdminDivisiController extends Controller
{
    // Tampilkan halaman divisi
    public function index()
    {
        $divisis = Divisi::with(['peserta' => function($q){
            $q->where('end_date', '>', Carbon::now());
        }])->get();
        return view('admin.divisi', compact('divisis'));
    }

    // Simpan divisi baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);
        Divisi::create([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);
        return redirect()->route('admin.divisi')->with('success', 'Divisi berhasil ditambahkan');
    }
    // Update divisi
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
        ]);
        $divisi = Divisi::findOrFail($id);
        $divisi->update([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);
        return redirect()->route('admin.divisi')->with('success', 'Divisi berhasil diupdate');
    }

    // Hapus divisi
    public function destroy($id)
    {
        $divisi = Divisi::findOrFail($id);
        $divisi->delete();
        return redirect()->route('admin.divisi')->with('success', 'Divisi berhasil dihapus');
    }
}
