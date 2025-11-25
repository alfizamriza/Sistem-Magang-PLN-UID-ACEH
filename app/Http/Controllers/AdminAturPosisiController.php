<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Participant;
use Carbon\Carbon;

class AdminAturPosisiController extends Controller
{
    // Tampilkan halaman atur posisi
    public function index()
    {
        $divisis = Divisi::with(['peserta' => function($q){
            $q->where('end_date', '>', Carbon::now());
        }])->get();
        $peserta = Participant::where('status', 'accepted')->where('end_date', '>', Carbon::now())->get();
        return view('admin.atur-posisi', compact('divisis', 'peserta'));
    }

    // Proses atur posisi peserta ke divisi
    public function update(Request $request, $id)
    {
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
        ]);
        $peserta = Participant::findOrFail($id);
        $divisi = Divisi::withCount(['peserta' => function($q){
            $q->where('end_date', '>', Carbon::now());
        }])->findOrFail($request->divisi_id);
        if ($divisi->peserta_count >= $divisi->kapasitas) {
            return redirect()->back()->with('error', 'Kapasitas divisi sudah penuh!');
        }
        $peserta->divisi_id = $divisi->id;
        $peserta->save();
        return redirect()->route('admin.atur-posisi')->with('success', 'Posisi peserta berhasil diatur');
    }
}
