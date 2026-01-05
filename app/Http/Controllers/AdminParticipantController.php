<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use function Laravel\Prompts\alert;

class AdminParticipantController extends Controller
{
    public function update(Request $request, $id)
    {
        $peserta = Participant::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'university' => 'nullable|string|max:255',
            'magang_type' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'divisi_id' => 'nullable|integer',
            'status' => 'nullable|string',
        ]);

        // Map UI status values to DB canonical statuses
        $status = $validated['status'] ?? null;
        if ($status) {
            $status = strtolower($status);
            $allowedDbStatuses = ['pending', 'accepted', 'rejected'];
            if (!in_array($status, $allowedDbStatuses)) {
                // map derived/display statuses to a DB status
                if (in_array($status, ['active', 'waiting', 'finished'])) {
                    $status = 'accepted';
                } else {
                    // default fallback
                    $status = 'pending';
                }
            }
            $validated['status'] = $status;
        }

        // Normalize empty magang_type to null
        if (isset($validated['magang_type']) && $validated['magang_type'] === '') {
            $validated['magang_type'] = null;
        }

        $peserta->fill($validated);
        $peserta->save();

        return redirect()->route('admin.semua-peserta')->with('success', 'Data peserta berhasil diupdate.');
    }

    // Hapus peserta magang
    public function destroy($id)
    {
        $peserta = Participant::findOrFail($id);
        $peserta->delete();
        return redirect()->route('admin.semua-peserta')->with('success', 'Peserta berhasil dihapus.');
    }
    // Terima peserta baru
    public function accept($id)
    {
        $peserta = Participant::findOrFail($id);
        $peserta->status = 'accepted';
        $peserta->save();
        // Kirim email ke peserta
        $start = \Carbon\Carbon::parse($peserta->start_date);
        $end = \Carbon\Carbon::parse($peserta->end_date);
        $durasi = $start->diffInMonths($end);
        \Mail::raw(
            "Halo {$peserta->name},\n\n
            Selamat! Anda telah diterima sebagai peserta magang di PT PLN UID Aceh.\n\n
            Program magang akan dimulai pada: {$start->format('d M Y')}\n
            Durasi magang: {$durasi} bulan\n\n
            Untuk informasi lebih lanjut, silakan bergabung dengan grup WhatsApp kami:\n[Grup Peserta Magang PLN UID Aceh](https://wa.me/1234567890)\n\n
            Terima kasih dan sampai bertemu di program magang kami!\n\n
            Salam Hormat,\nTim Program Magang\nPT PLN UID Aceh",
            function ($message) use ($peserta) {
                $message->to($peserta->email)
                    ->subject('Selamat Anda Diterima Magang di PLN UID Aceh');
            }
        );
        return redirect()->route('admin.peserta-index')->with('success', 'Peserta berhasil diterima.');
    }

    // Tolak peserta baru
    public function reject($id)
    {
        $peserta = Participant::findOrFail($id);
        $peserta->status = 'rejected';
        $peserta->save();
        return redirect()->route('admin.peserta-index')->with('success', 'Peserta berhasil ditolak.');
    }
    // Tampilkan semua peserta (untuk route admin.peserta-index)
    public function index()
    {
        $peserta = Participant::where('status', 'pending')->orderByDesc('created_at')->get();
        return view('admin.peserta-baru', compact('peserta'));
    }
    // Tampilkan peserta baru yang pending
    public function pending()
    {
        $peserta = Participant::where('status', 'pending')->orderByDesc('created_at')->get();
        return view('admin.peserta-baru', compact('peserta'));
    }

    // Tampilkan detail peserta
    public function detail($id)
    {
        $peserta = Participant::findOrFail($id);
        return view('admin.peserta-detail', compact('peserta'));
    }

    // Download CV dari storage/app/private/cv_uploads
    public function downloadCv($filename)
    {
        $path = storage_path('app/private/cv_uploads/' . $filename);
        
        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return abort(404, 'File not found');
        }
    }

    // Proses terima/tolak peserta
    public function review(Request $request, $id)
    {
        $peserta = Participant::findOrFail($id);
        $action = $request->input('action');
        
        if ($action === 'terima') {
            $peserta->status = 'accepted';
            
            // Kirim email ke peserta
            $start = \Carbon\Carbon::parse($peserta->start_date);
            $end = \Carbon\Carbon::parse($peserta->end_date);
            $durasi = $start->diffInMonths($end);
            
            // Template Email HTML dengan Design Modern
            $emailHtml = "
            <!DOCTYPE html>
            <html lang='id'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Penerimaan Magang PLN UID Aceh</title>
            </head>
            <body style='margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f3f4f6;'>
                <table width='100%' cellpadding='0' cellspacing='0' style='background-color: #f3f4f6; padding: 40px 20px;'>
                    <tr>
                        <td align='center'>
                            <!-- Main Container -->
                            <table width='600' cellpadding='0' cellspacing='0' style='background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);'>
                                
                                <!-- Header dengan Gradient -->
                                <tr>
                                    <td style='background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 40px 30px; text-align: center;'>
                                        <table width='100%' cellpadding='0' cellspacing='0'>
                                            <tr>
                                                <td align='center'>
                                                    <!-- Logo PLN -->
                                                    <div style='background-color: #fbbf24; width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 8px 16px rgba(251, 191, 36, 0.4);'>
                                                        <svg width='48' height='48' viewBox='0 0 24 24' fill='white'>
                                                            <path d='M13 10V3L4 14h7v7l9-11h-7z'/>
                                                        </svg>
                                                    </div>
                                                    <h1 style='color: #ffffff; font-size: 32px; font-weight: bold; margin: 0 0 10px 0; text-shadow: 0 2px 4px rgba(0,0,0,0.1);'>
                                                        🎉 Selamat!
                                                    </h1>
                                                    <p style='color: #dbeafe; font-size: 18px; margin: 0; font-weight: 500;'>
                                                        Anda Diterima sebagai Peserta Magang
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Content -->
                                <tr>
                                    <td style='padding: 40px 30px;'>
                                        <!-- Greeting -->
                                        <p style='color: #1f2937; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0;'>
                                            Halo <strong style='color: #1e3a8a;'>{$peserta->name}</strong>,
                                        </p>
                                        
                                        <!-- Success Message Box -->
                                        <div style='background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-left: 4px solid #10b981; padding: 20px; border-radius: 8px; margin-bottom: 30px;'>
                                            <p style='color: #065f46; font-size: 15px; line-height: 1.6; margin: 0; font-weight: 600;'>
                                                ✅ Selamat! Kami dengan senang hati menginformasikan bahwa Anda telah <strong>diterima</strong> sebagai peserta magang di <strong>PT PLN UID Aceh</strong>.
                                            </p>
                                        </div>
                                        
                                        <p style='color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 30px 0;'>
                                            Kami sangat senang Anda bergabung dengan kami untuk mengembangkan keterampilan dan pengalaman di industri kelistrikan terdepan di Indonesia. Ini adalah kesempatan luar biasa untuk belajar dan berkembang bersama tim profesional kami.
                                        </p>
                                        
                                        <!-- Info Cards -->
                                        <div style='margin-bottom: 30px;'>
                                            <h2 style='color: #1e3a8a; font-size: 20px; font-weight: bold; margin: 0 0 20px 0; border-bottom: 2px solid #3b82f6; padding-bottom: 10px;'>
                                                📋 Informasi Program Magang
                                            </h2>
                                            
                                            <!-- Info Card 1 -->
                                            <table width='100%' cellpadding='0' cellspacing='0' style='margin-bottom: 15px;'>
                                                <tr>
                                                    <td style='background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 10px; padding: 20px; border-left: 4px solid #3b82f6;'>
                                                        <table width='100%' cellpadding='0' cellspacing='0'>
                                                            <tr>
                                                                <td width='40' valign='top'>
                                                                    <div style='background-color: #3b82f6; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;'>
                                                                        <span style='color: white; font-size: 20px;'>📅</span>
                                                                    </div>
                                                                </td>
                                                                <td style='padding-left: 15px;'>
                                                                    <p style='color: #1e3a8a; font-size: 13px; font-weight: bold; margin: 0 0 5px 0; text-transform: uppercase;'>Tanggal Mulai</p>
                                                                    <p style='color: #1f2937; font-size: 16px; font-weight: bold; margin: 0;'>{$start->format('d F Y')}</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                            <!-- Info Card 2 -->
                                            <table width='100%' cellpadding='0' cellspacing='0' style='margin-bottom: 15px;'>
                                                <tr>
                                                    <td style='background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 10px; padding: 20px; border-left: 4px solid #f59e0b;'>
                                                        <table width='100%' cellpadding='0' cellspacing='0'>
                                                            <tr>
                                                                <td width='40' valign='top'>
                                                                    <div style='background-color: #f59e0b; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;'>
                                                                        <span style='color: white; font-size: 20px;'>⏱️</span>
                                                                    </div>
                                                                </td>
                                                                <td style='padding-left: 15px;'>
                                                                    <p style='color: #92400e; font-size: 13px; font-weight: bold; margin: 0 0 5px 0; text-transform: uppercase;'>Durasi Program</p>
                                                                    <p style='color: #1f2937; font-size: 16px; font-weight: bold; margin: 0;'>{$durasi} Bulan</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                            <!-- Info Card 3 -->
                                            <table width='100%' cellpadding='0' cellspacing='0'>
                                                <tr>
                                                    <td style='background: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%); border-radius: 10px; padding: 20px; border-left: 4px solid #a855f7;'>
                                                        <table width='100%' cellpadding='0' cellspacing='0'>
                                                            <tr>
                                                                <td width='40' valign='top'>
                                                                    <div style='background-color: #a855f7; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center;'>
                                                                        <span style='color: white; font-size: 20px;'>🏁</span>
                                                                    </div>
                                                                </td>
                                                                <td style='padding-left: 15px;'>
                                                                    <p style='color: #6b21a8; font-size: 13px; font-weight: bold; margin: 0 0 5px 0; text-transform: uppercase;'>Tanggal Selesai</p>
                                                                    <p style='color: #1f2937; font-size: 16px; font-weight: bold; margin: 0;'>{$end->format('d F Y')}</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <!-- WhatsApp Group CTA -->
                                        <div style='background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); border-radius: 12px; padding: 25px; text-align: center; margin-bottom: 30px; border: 2px solid #10b981;'>
                                            <h3 style='color: #065f46; font-size: 18px; font-weight: bold; margin: 0 0 15px 0;'>
                                                💬 Bergabung dengan Komunitas Kami
                                            </h3>
                                            <p style='color: #047857; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;'>
                                                Untuk informasi lebih lanjut dan komunikasi dengan peserta magang lainnya, bergabunglah dengan grup WhatsApp resmi kami:
                                            </p>
                                            <a href='https://wa.me/1234567890' style='display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff; text-decoration: none; padding: 15px 40px; border-radius: 8px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);'>
                                                🚀 Gabung Grup WhatsApp
                                            </a>
                                        </div>
                                        
                                        <!-- Important Notes -->
                                        <div style='background-color: #fef9c3; border-left: 4px solid #eab308; padding: 20px; border-radius: 8px; margin-bottom: 30px;'>
                                            <h3 style='color: #854d0e; font-size: 16px; font-weight: bold; margin: 0 0 15px 0;'>
                                                ⚠️ Catatan Penting:
                                            </h3>
                                            <ul style='color: #713f12; font-size: 14px; line-height: 1.8; margin: 0; padding-left: 20px;'>
                                                <li>Pastikan untuk selalu memperbarui informasi Anda</li>
                                                <li>Ikuti petunjuk lebih lanjut dari tim kami</li>
                                                <li>Hadir tepat waktu pada hari pertama magang</li>
                                                <li>Bawa dokumen yang diperlukan (KTP, CV, Surat Pengantar)</li>
                                                <li>Kenakan pakaian formal pada hari pertama</li>
                                            </ul>
                                        </div>
                                        
                                        <!-- Closing Message -->
                                        <p style='color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 20px 0;'>
                                            Kami menantikan kontribusi Anda dalam program magang ini. Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut.
                                        </p>
                                        
                                        <p style='color: #1f2937; font-size: 16px; font-weight: 600; margin: 0 0 30px 0;'>
                                            Terima kasih dan sampai bertemu di program magang kami! 🎓
                                        </p>
                                        
                                        <!-- Signature -->
                                        <div style='border-top: 2px solid #e5e7eb; padding-top: 20px;'>
                                            <p style='color: #1f2937; font-size: 15px; font-weight: bold; margin: 0 0 5px 0;'>
                                                Salam Hormat,
                                            </p>
                                            <p style='color: #3b82f6; font-size: 16px; font-weight: bold; margin: 0 0 5px 0;'>
                                                Tim Program Magang
                                            </p>
                                            <p style='color: #6b7280; font-size: 14px; margin: 0;'>
                                                PT PLN (Persero) Unit Induk Distribusi Aceh
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Footer -->
                                <tr>
                                    <td style='background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 30px; text-align: center;'>
                                        <table width='100%' cellpadding='0' cellspacing='0'>
                                            <tr>
                                                <td align='center'>
                                                    <p style='color: #dbeafe; font-size: 14px; margin: 0 0 15px 0; font-weight: 500;'>
                                                        PT PLN (Persero) Unit Induk Distribusi Aceh
                                                    </p>
                                                    <p style='color: #93c5fd; font-size: 13px; margin: 0 0 15px 0; line-height: 1.6;'>
                                                        Jl. Contoh No. 123, Banda Aceh, Aceh 23111<br>
                                                        📧 magang@pln-aceh.co.id | 📱 (0651) 123-4567
                                                    </p>
                                                    <p style='color: #93c5fd; font-size: 12px; margin: 0;'>
                                                        © 2025 PLN UID Aceh. All rights reserved.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ";
            
            Mail::send([], [], function ($message) use ($peserta, $emailHtml) {
                $message->to($peserta->email)
                    ->subject('🎉 Selamat! Anda Diterima Magang di PLN UID Aceh')
                    ->html($emailHtml);
            });
            
        } elseif ($action === 'tolak') {
            $peserta->status = 'rejected';
            
            // Template Email untuk Penolakan
            $emailHtml = "
            <!DOCTYPE html>
            <html lang='id'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Pemberitahuan Magang PLN UID Aceh</title>
            </head>
            <body style='margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f3f4f6;'>
                <table width='100%' cellpadding='0' cellspacing='0' style='background-color: #f3f4f6; padding: 40px 20px;'>
                    <tr>
                        <td align='center'>
                            <table width='600' cellpadding='0' cellspacing='0' style='background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);'>
                                
                                <!-- Header -->
                                <tr>
                                    <td style='background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%); padding: 40px 30px; text-align: center;'>
                                        <table width='100%' cellpadding='0' cellspacing='0'>
                                            <tr>
                                                <td align='center'>
                                                    <div style='background-color: #fbbf24; width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;'>
                                                        <svg width='48' height='48' viewBox='0 0 24 24' fill='white'>
                                                            <path d='M13 10V3L4 14h7v7l9-11h-7z'/>
                                                        </svg>
                                                    </div>
                                                    <h1 style='color: #ffffff; font-size: 28px; font-weight: bold; margin: 0 0 10px 0;'>
                                                        Pemberitahuan Program Magang
                                                    </h1>
                                                    <p style='color: #fecaca; font-size: 16px; margin: 0;'>
                                                        PT PLN UID Aceh
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Content -->
                                <tr>
                                    <td style='padding: 40px 30px;'>
                                        <p style='color: #1f2937; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0;'>
                                            Halo <strong style='color: #1e3a8a;'>{$peserta->name}</strong>,
                                        </p>
                                        
                                        <p style='color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 25px 0;'>
                                            Terima kasih atas minat dan waktu yang Anda luangkan untuk mendaftar program magang di PT PLN UID Aceh.
                                        </p>
                                        
                                        <div style='background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-left: 4px solid #ef4444; padding: 20px; border-radius: 8px; margin-bottom: 25px;'>
                                            <p style='color: #7f1d1d; font-size: 15px; line-height: 1.6; margin: 0;'>
                                                Setelah melalui proses seleksi yang ketat, dengan berat hati kami informasikan bahwa untuk saat ini Anda belum dapat kami terima dalam program magang kami.
                                            </p>
                                        </div>
                                        
                                        <p style='color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 20px 0;'>
                                            Keputusan ini bukan berarti mengakhiri peluang Anda. Kami sangat menghargai dedikasi dan antusiasme Anda, dan kami mendorong Anda untuk:
                                        </p>
                                        
                                        <ul style='color: #4b5563; font-size: 15px; line-height: 1.8; margin: 0 0 25px 0; padding-left: 20px;'>
                                            <li>Mendaftar kembali di periode rekrutmen berikutnya</li>
                                            <li>Terus mengembangkan keterampilan dan pengalaman Anda</li>
                                            <li>Tetap mengikuti informasi terbaru dari kami</li>
                                        </ul>
                                        
                                        <p style='color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 30px 0;'>
                                            Kami berharap dapat bertemu dengan Anda di kesempatan yang akan datang. Sukses selalu untuk perjalanan karir Anda!
                                        </p>
                                        
                                        <div style='border-top: 2px solid #e5e7eb; padding-top: 20px;'>
                                            <p style='color: #1f2937; font-size: 15px; font-weight: bold; margin: 0 0 5px 0;'>
                                                Salam Hormat,
                                            </p>
                                            <p style='color: #3b82f6; font-size: 16px; font-weight: bold; margin: 0 0 5px 0;'>
                                                Tim Program Magang
                                            </p>
                                            <p style='color: #6b7280; font-size: 14px; margin: 0;'>
                                                PT PLN (Persero) Unit Induk Distribusi Aceh
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Footer -->
                                <tr>
                                    <td style='background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 30px; text-align: center;'>
                                        <p style='color: #dbeafe; font-size: 14px; margin: 0 0 15px 0;'>
                                            PT PLN (Persero) Unit Induk Distribusi Aceh
                                        </p>
                                        <p style='color: #93c5fd; font-size: 13px; margin: 0 0 15px 0;'>
                                            📧 magang@pln-aceh.co.id | 📱 (0651) 123-4567
                                        </p>
                                        <p style='color: #93c5fd; font-size: 12px; margin: 0;'>
                                            © 2025 PLN UID Aceh. All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ";
            
            Mail::send([], [], function ($message) use ($peserta, $emailHtml) {
                $message->to($peserta->email)
                    ->subject('Pemberitahuan Program Magang PLN UID Aceh')
                    ->html($emailHtml);
            });
        }
        
        $peserta->save();
        return redirect()->route('admin.peserta-index')->with('success', 'Status peserta berhasil diupdate dan email telah dikirim.');
    }
    // Tampilkan semua peserta dengan filter
    public function semuaPeserta(Request $request)
    {
        $query = Participant::query();

        // Search (name, email, university)
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('university', 'like', "%{$search}%");
            });
        }

        // Filter status - accept UI display statuses and map to DB conditions
        if ($request->filled('status')) {
            $statusFilter = strtolower($request->status);
            if (in_array($statusFilter, ['pending','accepted','rejected'])) {
                $query->where('status', $statusFilter);
            } elseif ($statusFilter === 'active') {
                // accepted and within start/end
                $query->where('status', 'accepted')
                      ->whereDate('start_date', '<=', now())
                      ->whereDate('end_date', '>=', now());
            } elseif ($statusFilter === 'waiting') {
                // accepted and (no start_date OR start_date in future)
                $query->where('status', 'accepted')
                      ->where(function($q) {
                          $q->whereNull('start_date')
                            ->orWhere('start_date', '>', now());
                      });
            } elseif ($statusFilter === 'finished') {
                // accepted and end_date < now
                $query->where('status', 'accepted')
                      ->whereDate('end_date', '<', now());
            }
        }

        // Filter magang_type
        if ($request->filled('magang_type')) {
            $query->where('magang_type', $request->magang_type);
        }

        // Filter bulan/tahun (if provided)
        if ($request->filled('bulan')) {
            $query->whereMonth('end_date', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('end_date', $request->tahun);
        }

        // Filter rentang tanggal (allow partial range)
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '<=', $request->end_date);
        }

        // Pagination
        $perPage = 15;
        $peserta = $query->orderByDesc('created_at')->paginate($perPage)->withQueryString();

        // Hitung berapa peserta yang masa magangnya akan berakhir dalam 7 hari ke depan
        $today = Carbon::today();
        $weekEnd = $today->copy()->addDays(7);
        $expiringThisWeekCount = Participant::where('status', 'accepted')
            ->whereNotNull('end_date')
            ->whereDate('end_date', '>=', $today->toDateString())
            ->whereDate('end_date', '<=', $weekEnd->toDateString())
            ->count();

        return view('admin.semua-peserta', compact('peserta', 'expiringThisWeekCount'));
    }

    /**
     * Export participants (current filters) to CSV
     */
    public function export(Request $request)
    {
        $query = Participant::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('university', 'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $statusFilter = strtolower($request->status);
            if (in_array($statusFilter, ['pending','accepted','rejected'])) {
                $query->where('status', $statusFilter);
            } elseif ($statusFilter === 'active') {
                $query->where('status', 'accepted')
                      ->whereDate('start_date', '<=', now())
                      ->whereDate('end_date', '>=', now());
            } elseif ($statusFilter === 'waiting') {
                $query->where('status', 'accepted')
                      ->where(function($q) {
                          $q->whereNull('start_date')
                            ->orWhere('start_date', '>', now());
                      });
            } elseif ($statusFilter === 'finished') {
                $query->where('status', 'accepted')
                      ->whereDate('end_date', '<', now());
            }
        }
        if ($request->filled('magang_type')) {
            $query->where('magang_type', $request->magang_type);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('end_date', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('end_date', $request->tahun);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '<=', $request->end_date);
        }

        $rows = $query->orderByDesc('created_at')->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=peserta_export_' . now()->format('Ymd_His') . '.csv',
        ];

        $callback = function() use ($rows) {
            $handle = fopen('php://output', 'w');
            // Header row
            fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'University', 'Magang Type', 'Status', 'Start Date', 'End Date', 'Divisi']);

            foreach ($rows as $r) {
                fputcsv($handle, [
                    $r->id,
                    $r->name,
                    $r->email,
                    $r->phone,
                    $r->university,
                    $r->magang_type,
                    $r->status,
                    $r->start_date,
                    $r->end_date,
                    $r->divisi?->nama ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}