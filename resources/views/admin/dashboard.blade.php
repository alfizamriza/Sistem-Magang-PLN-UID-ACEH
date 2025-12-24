@extends('admin.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 animate-fade-in-up">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 text-white rounded-2xl shadow-2xl p-8 mb-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-5xl font-black mb-2 tracking-tight">Dashboard Admin</h1>
                    <p class="text-xl text-blue-200">Sistem Magang PLN UID Aceh</p>
                </div>
                <div class="text-right">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                        <p class="text-sm text-blue-200">{{ date('l, d F Y') }}</p>
                        <p class="text-2xl font-bold" id="current-time"></p>
                    </div>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 animate-pulse-soft">
                <p class="text-lg font-medium">🎯 Selamat datang di sistem magang PLN UID Aceh - Membangun generasi unggul bidang kelistrikan</p>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border-l-4 border-blue-500 animate-slide-in-left">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Hari Ini</span>
            </div>
            <div class="text-3xl font-black text-blue-700 mb-2">{{ $pendaftarHariIni }}</div>
            <p class="text-gray-600 font-medium">Pendaftar Baru</p>
            <div class="mt-2 flex items-center text-sm text-green-600">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                +{{ round(($pendaftarHariIni / max($total, 1)) * 100, 1) }}% dari total
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border-l-4 border-yellow-500 animate-slide-in-left" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Review</span>
            </div>
            <div class="text-3xl font-black text-yellow-600 mb-2">{{ $pending }}</div>
            <p class="text-gray-600 font-medium">Menunggu Review</p>
            <div class="mt-2 flex items-center text-sm text-yellow-600">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                Butuh perhatian
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border-l-4 border-green-500 animate-slide-in-left" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <div class="text-3xl font-black text-green-600 mb-2">{{ $diterima }}</div>
            <p class="text-gray-600 font-medium">Peserta Aktif</p>
            <div class="mt-2 flex items-center text-sm text-green-600">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ round(($diterima / max($total, 1)) * 100, 1) }}% tingkat penerimaan
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border-l-4 border-purple-500 animate-slide-in-left" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full">Total</span>
            </div>
            <div class="text-3xl font-black text-purple-600 mb-2">{{ $total }}</div>
            <p class="text-gray-600 font-medium">Total Peserta</p>
            <div class="mt-2 flex items-center text-sm text-purple-600">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Sejak sistem diluncurkan
            </div>
        </div>
    </div>

    <!-- Chart and Quick Info Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl p-8 animate-slide-in-bottom">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">📊 Grafik Pendaftar per Bulan</h2>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">6 Bulan</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full">1 Tahun</button>
                </div>
            </div>
            <div class="w-full md:w-2/3 mx-auto">
                <canvas id="chartPendaftar" style="max-height:320px;max-width:100%;height:320px;width:100%;"></canvas>
            </div>
        </div>

        <!-- Quick Info Panel -->
        <div class="space-y-6 animate-slide-in-right">
            <!-- Expiring Soon (1 week) -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">⏳ Berakhir Dalam 1 Minggu</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Total</span>
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">{{ $expiringSoonCount ?? 0 }}</span>
                    </div>

                    @if(isset($expiringSoon) && $expiringSoon->count() > 0)
                        <ul class="text-sm text-gray-700 space-y-2 max-h-40 overflow-auto">
                            @foreach($expiringSoon->take(6) as $p)
                                <li class="flex items-center justify-between">
                                    <div>
                                        <span class="font-semibold">{{ $p->name }}</span>
                                        <div class="text-xs text-gray-500">{{ optional($p->divisi)->name ?? '—' }}</div>
                                    </div>
                                    <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($p->end_date)->format('d M Y') }}</div>
                                </li>
                            @endforeach
                        </ul>
                        @if($expiringSoon->count() > 6)
                            <div class="text-right mt-2">
                                <a href="{{ url('/dashboard/semua-peserta') }}?filter=expiring" class="text-sm text-blue-600 font-semibold">Lihat semua &rarr;</a>
                            </div>
                        @endif
                    @else
                        <p class="text-sm text-gray-500">Tidak ada peserta yang akan berakhir dalam 1 minggu.</p>
                    @endif
                </div>
            </div>
            <!-- System Status -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">🔋 Status Sistem</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Server</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Online</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Database</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Normal</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Last Backup</span>
                        <span class="text-xs text-gray-500">2 jam lalu</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">⚡ Aktivitas Terbaru</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">3 pendaftar baru</span>
                        <span class="text-xs text-gray-400">10 menit lalu</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">2 peserta diterima</span>
                        <span class="text-xs text-gray-400">1 jam lalu</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">5 berkas di-review</span>
                        <span class="text-xs text-gray-400">2 jam lalu</span>
                    </div>
                </div>
            </div>

            <!-- Target Progress -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">🎯 Target Periode Ini</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Peserta Magang</span>
                            <span class="font-semibold">{{ $diterima }}/100</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ min(($diterima / 100) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <!-- Action Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="group bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white rounded-2xl shadow-xl p-8 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 relative overflow-hidden animate-slide-in-bottom">
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ $pendaftarHariIni }} Baru</span>
                </div>
                <h3 class="text-2xl font-bold mb-2">Peserta Baru</h3>
                <p class="text-blue-100 mb-6">Review dan kelola pendaftar terbaru dengan sistem evaluasi terintegrasi.</p>
                <a href="{{ url('/dashboard/peserta-baru') }}" class="inline-flex items-center bg-white text-blue-700 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:bg-blue-50 transition-all duration-300">
                    Kelola Peserta
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="group bg-gradient-to-br from-emerald-500 via-green-600 to-emerald-700 text-white rounded-2xl shadow-xl p-8 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 relative overflow-hidden animate-slide-in-bottom" style="animation-delay: 0.1s">
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 8h1m-1 4h1m4-4h1m-1 4h1"></path>
                        </svg>
                    </div>
                    <span class="bg-white/20 text-xs px-2 py-1 rounded-full">Aktif</span>
                </div>
                <h3 class="text-2xl font-bold mb-2">Divisi Kantor</h3>
                <p class="text-emerald-100 mb-6">Manajemen divisi dan alokasi peserta berdasarkan kebutuhan operasional.</p>
                <a href="{{ url('/dashboard/divisi') }}" class="inline-flex items-center text-emerald-700 bg-black  px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:bg-emerald-50 transition-all duration-300">
                    Kelola Divisi
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="group bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-700 text-white rounded-2xl shadow-xl p-8 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 relative overflow-hidden animate-slide-in-bottom" style="animation-delay: 0.2s">
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ $diterima }} Peserta</span>
                </div>
                <h3 class="text-2xl font-bold mb-2">Atur Posisi</h3>
                <p class="text-purple-100 mb-6">Penempatan strategis peserta sesuai kompetensi dan kebutuhan divisi.</p>
                <a href="{{ url('/dashboard/atur-posisi') }}" class="inline-flex items-center bg-white text-purple-700 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:bg-purple-50 transition-all duration-300">
                    Atur Posisi
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="group bg-gradient-to-br from-pink-600 via-rose-600 to-pink-700 text-white rounded-2xl shadow-xl p-8 transform hover:scale-105 hover:shadow-2xl transition-all duration-300 relative overflow-hidden animate-slide-in-bottom" style="animation-delay: 0.3s">
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0-12h6m-6 0v12m6-12h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m0-12v12"></path>
                        </svg>
                    </div>
                    <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ $total }} Total</span>
                </div>
                <h3 class="text-2xl font-bold mb-2">Semua Peserta</h3>
                <p class="text-pink-100 mb-6">Database lengkap peserta dengan filter advanced dan export data.</p>
                <a href="{{ url('/dashboard/semua-peserta') }}" class="inline-flex items-center bg-white text-pink-700 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:bg-pink-50 transition-all duration-300">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white rounded-2xl shadow-xl p-8 animate-fade-in">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="text-lg font-bold mb-4">📍 PLN UID Aceh</h4>
                <p class="text-gray-300 text-sm leading-relaxed">Unit Induk Distribusi Aceh berkomitmen mengembangkan SDM muda melalui program magang yang berkualitas dan terstruktur.</p>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">🎓 Program Unggulan</h4>
                <ul class="text-gray-300 text-sm space-y-2">
                    <li>• Teknik Kelistrikan</li>
                    <li>• Sistem Distribusi</li>
                    <li>• Teknologi Informasi</li>
                    <li>• Manajemen Operasi</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">📊 Pencapaian 2025</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-300">Peserta Magang:</span>
                        <span class="font-semibold text-white">{{ $total }} orang</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-300">Tingkat Penyelesaian:</span>
                        <span class="font-semibold text-green-400">95%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Real-time clock
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;
    }
    updateClock();
    setInterval(updateClock, 1000);

    // Enhanced Chart
    const ctx = document.getElementById('chartPendaftar').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($bulanArr),
            datasets: [{
                label: 'Pendaftar',
                data: @json($jumlahArr),
                backgroundColor: (ctx) => {
                    const canvas = ctx.chart.ctx;
                    const gradient = canvas.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
                    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.4)');
                    return gradient;
                },
                borderRadius: 12,
                borderWidth: 2,
                borderColor: 'rgba(59, 130, 246, 1)',
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: false 
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        title: function(context) {
                            return 'Bulan ' + context[0].label;
                        },
                        label: function(context) {
                            return context.parsed.y + ' pendaftar';
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutBounce'
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6B7280',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(156, 163, 175, 0.1)'
                    },
                    ticks: { 
                        stepSize: 1,
                        color: '#6B7280',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });

    // Smooth scroll for navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add loading animation to buttons
    document.querySelectorAll('a[href*="/dashboard/"]').forEach(button => {
        button.addEventListener('click', function(e) {
            const originalText = this.innerHTML;
            this.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-current inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading...
            `;
            setTimeout(() => {
                this.innerHTML = originalText;
            }, 1000);
        });
    });

    // Counter animation for statistics
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            start += increment;
            element.textContent = Math.floor(start);
            if (start >= target) {
                element.textContent = target;
                clearInterval(timer);
            }
        }, 16);
    }

    // Trigger counter animations when page loads
    window.addEventListener('load', () => {
        setTimeout(() => {
            const counters = document.querySelectorAll('.text-3xl.font-black');
            counters.forEach(counter => {
                const target = parseInt(counter.textContent);
                if (!isNaN(target)) {
                    counter.textContent = '0';
                    animateCounter(counter, target);
                }
            });
        }, 500);
    });
</script>

<style>
    /* Enhanced Animations */
    @keyframes fade-in-up {
        0% { 
            opacity: 0; 
            transform: translateY(60px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    @keyframes slide-in-left {
        0% { 
            opacity: 0; 
            transform: translateX(-50px); 
        }
        100% { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }

    @keyframes slide-in-right {
        0% { 
            opacity: 0; 
            transform: translateX(50px); 
        }
        100% { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }

    @keyframes slide-in-bottom {
        0% { 
            opacity: 0; 
            transform: translateY(50px); 
        }
        100% { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    @keyframes fade-in {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes pulse-soft {
        0%, 100% { 
            opacity: 1; 
        }
        50% { 
            opacity: 0.8; 
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 1s cubic-bezier(0.23, 1, 0.320, 1) both;
    }

    .animate-slide-in-left {
        animation: slide-in-left 0.8s cubic-bezier(0.23, 1, 0.320, 1) both;
    }

    .animate-slide-in-right {
        animation: slide-in-right 0.8s cubic-bezier(0.23, 1, 0.320, 1) both;
    }

    .animate-slide-in-bottom {
        animation: slide-in-bottom 0.8s cubic-bezier(0.23, 1, 0.320, 1) both;
    }

    .animate-fade-in {
        animation: fade-in 1.2s ease-in both;
    }

    .animate-pulse-soft {
        animation: pulse-soft 3s ease-in-out infinite;
    }

    /* Hover Effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #3b82f6, #6366f1);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #2563eb, #4f46e5);
    }

    /* Glassmorphism Effect */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    /* Enhanced Shadow */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Progress Bar Animation */
    @keyframes progress-fill {
        from { width: 0; }
        to { width: var(--progress-width); }
    }

    .progress-bar {
        animation: progress-fill 2s ease-out forwards;
    }

    /* Card Entrance Stagger */
    .animate-slide-in-left:nth-child(1) { animation-delay: 0.1s; }
    .animate-slide-in-left:nth-child(2) { animation-delay: 0.2s; }
    .animate-slide-in-left:nth-child(3) { animation-delay: 0.3s; }
    .animate-slide-in-left:nth-child(4) { animation-delay: 0.4s; }

    .animate-slide-in-bottom:nth-child(1) { animation-delay: 0.1s; }
    .animate-slide-in-bottom:nth-child(2) { animation-delay: 0.2s; }
    .animate-slide-in-bottom:nth-child(3) { animation-delay: 0.3s; }
    .animate-slide-in-bottom:nth-child(4) { animation-delay: 0.4s; }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .text-5xl { font-size: 2.5rem; }
        .text-4xl { font-size: 2rem; }
        .text-3xl { font-size: 1.5rem; }
        
        .p-8 { padding: 1.5rem; }
        .p-6 { padding: 1rem; }
        
        .grid-cols-4 { grid-template-columns: repeat(2, 1fr); }
        .lg\:col-span-2 { grid-column: span 1; }
    }

    /* Print Styles */
    @media print {
        .animate-fade-in-up,
        .animate-slide-in-left,
        .animate-slide-in-right,
        .animate-slide-in-bottom {
            animation: none;
        }
        
        .shadow-xl,
        .shadow-2xl {
            box-shadow: none;
            border: 1px solid #e5e7eb;
        }
    }
</style>
@endsection