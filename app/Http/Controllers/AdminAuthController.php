<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Participant;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Authenticate against admins table with hashed password
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('is_admin', true);
            // optionally store admin id/name in session
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
        // $admin = Admin::where('username', $request->username)->first();

        // if ($admin && $request->password === $admin->password) {
        //     Session::put('is_admin', true);
        //     Session::put('admin_id', $admin->id);
        //     Session::put('admin_name', $admin->name);

        //     return redirect()->route('dashboard');
        // } else {
        //     return back()->withErrors(['login' => 'Username atau password salah.']);
        // }
    }

    // Dashboard admin
    public function dashboard()
    {
        if (!Session::get('is_admin')) {
            return redirect()->route('login');
        }

        $today = now()->toDateString();
        $pendaftarHariIni = \App\Models\Participant::whereDate('created_at', $today)->count();
        $pending = \App\Models\Participant::where('status', 'pending')->count();
    $diterima = \App\Models\Participant::where('status', 'accepted')->count();
        $total = \App\Models\Participant::count();

        // Statistik bulanan
        $monthlyStats = \App\Models\Participant::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanArr = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
        $jumlahArr = array_fill(0, 12, 0);
        foreach ($monthlyStats as $stat) {
            $idx = (int)$stat->bulan - 1;
            if ($idx >= 0 && $idx < 12) {
                $jumlahArr[$idx] = $stat->jumlah;
            }
        }

        // Peserta yang masa magangnya akan berakhir dalam 7 hari ke depan
        $todayCarbon = Carbon::today();
        $weekEnd = $todayCarbon->copy()->addDays(7);
        $expiringSoon = Participant::where('status', 'accepted')
            ->whereNotNull('end_date')
            ->whereDate('end_date', '>=', $todayCarbon->toDateString())
            ->whereDate('end_date', '<=', $weekEnd->toDateString())
            ->with('divisi')
            ->get();

        // Aktvitas terbaru (7 hari terakhir): pendaftaran & pembaruan status/profil
        $since = Carbon::now()->subDays(7);
        $recentRegs = Participant::where('created_at', '>=', $since)
            ->orderByDesc('created_at')
            ->get();

        $recentUpdates = Participant::where('updated_at', '>=', $since)
            ->whereColumn('updated_at', '>', 'created_at')
            ->orderByDesc('updated_at')
            ->get();

        $activities = collect();

        foreach ($recentRegs as $r) {
            $activities->push([
                'type' => 'registered',
                'message' => "{$r->name} mendaftar",
                'time' => $r->created_at,
            ]);
        }

        foreach ($recentUpdates as $u) {
            if ($u->status === 'accepted') {
                $msg = "{$u->name} diterima";
            } elseif ($u->status === 'rejected') {
                $msg = "{$u->name} ditolak";
            } else {
                $msg = "{$u->name} diperbarui";
            }
            $activities->push([
                'type' => 'updated',
                'message' => $msg,
                'time' => $u->updated_at,
            ]);
        }

        $recentActivities = $activities->sortByDesc('time')->values()->take(6);

        return view('admin.dashboard', [
            'pendaftarHariIni' => $pendaftarHariIni,
            'pending' => $pending,
            'diterima' => $diterima,
            'total' => $total,
            'expiringSoonCount' => $expiringSoon->count(),
            'expiringSoon' => $expiringSoon,
            'bulanArr' => $bulanArr,
            'jumlahArr' => $jumlahArr,
        ]);
    }

    // Show form to create a new admin (only for logged-in admins)
    public function create()
    {
        if (!Session::get('is_admin')) {
            return redirect()->route('login');
        }

        return view('admin.register');
    }

    // Store a new admin account
    public function store(Request $request)
    {
        if (!Session::get('is_admin')) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:admins,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create admin (hash password)
        $admin = Admin::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
        ]);

        return redirect()->route('dashboard')->with('success', 'Akun admin baru berhasil dibuat.');
    }
}