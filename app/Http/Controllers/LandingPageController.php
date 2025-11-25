<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Participant;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function success($id)
    {
        $participant = Participant::findOrFail($id);
        return view('success', compact('participant'));
    }

    public function cekStatus(Request $request)
    {
        $code = $request->query('unique_code');
        $participant = Participant::where('unique_code', $code)->first();
        if (!$participant) {
            return response()->json(['status' => 'not_found']);
        }
        return response()->json([
            'status' => $participant->status,
            'name' => $participant->name,
            'university' => $participant->university,
            'email' => $participant->email,
            'whatsapp' => $participant->whatsapp,
            'start_date' => $participant->start_date,
            'end_date' => $participant->end_date,
        ]);
    }
    public function index()
    {
        $participants = Participant::all();
        return view('landing', compact('participants'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required',
            'university' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'cv' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'email' => 'required|email',
            'whatsapp' => 'required',
        ]);

        // Simpan file CV yang diunggah ke dalam storage/app/private/cv_uploads dan ambil path-nya
        $cvPath = $request->file('cv')->store('cv_uploads');

        // Hitung durasi magang dalam hari dan bulan
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $durationDays = $startDate->diffInDays($endDate);
        $durationMonths = $startDate->diffInMonths($endDate);

        // Simpan data peserta magang ke database
        $uniqueCode = uniqid('PLN-');
        // Format nomor WhatsApp ke +62
        $wa = $request->whatsapp;
        if (substr($wa, 0, 1) === '0') {
            $wa = '62' . substr($wa, 1);
        } elseif (substr($wa, 0, 3) !== '62') {
            $wa = '62' . ltrim($wa, '+');
        }
        $participant = Participant::create([
            'name' => $request->name,
            'university' => $request->university,
            'description' => $request->description,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'cv' => $cvPath, // Menyimpan path file CV yang di-upload
            'email' => $request->email,
            'whatsapp' => $wa,
            'status' => 'pending',  // Status awal adalah 'pending'
            'unique_code' => $uniqueCode,
            'magang_type' => $request->magang_type,
            'other_magang' => $request->magang_type === 'Lain-lain' ? $request->other_magang : null,
        ]);

        // Redirect ke halaman sukses dan kirim data peserta
        return redirect()->route('success', ['id' => $participant->id]);
    }


}
