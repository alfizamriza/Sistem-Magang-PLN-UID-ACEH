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
                    <nav class="text-blue-200 text-sm mb-2">
                        <a href="{{ url('/dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                        <span class="mx-2">›</span>
                        <span>Peserta Baru</span>
                    </nav>
                    <h1 class="text-4xl font-black mb-2 tracking-tight">📋 Peserta Baru Pending</h1>
                    <p class="text-xl text-blue-200">Review dan kelola pendaftar yang menunggu persetujuan</p>
                </div>
                <div class="text-right">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                        <p class="text-sm text-blue-200">Total Pending</p>
                        <p class="text-3xl font-bold">{{ $peserta->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-gradient-to-r from-green-100 to-emerald-100 border-l-4 border-green-500 text-green-800 rounded-xl shadow-lg animate-slide-in-right">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Berhasil!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Filter and Search Section -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 animate-slide-in-bottom">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari nama atau universitas..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 w-64">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <select id="magangFilter" class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    <option value="">Semua Jenis Magang</option>
                    <option value="MBKM">MBKM</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="KKP">KKP</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-600">Urutkan:</span>
                <select id="sortFilter" class="px-3 py-2 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="name">Nama A-Z</option>
                    <option value="university">Universitas</option>
                </select>
                <button id="bulkAction" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-4 py-2 rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Terima Terpilih
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 animate-slide-in-left">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Pending</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $peserta->count() }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 animate-slide-in-left" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Mandiri</p>
                    <p class="text-2xl font-bold text-green-600">{{ $peserta->where('magang_type', 'Mandiri')->count() }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 animate-slide-in-left" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">MBKM</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $peserta->where('magang_type', 'MBKM')->count() }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500 animate-slide-in-left" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Hari Ini</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $peserta->filter(function($item){ return \Carbon\Carbon::parse($item->created_at)->isToday(); })->count() }}</p>
                </div>
                <div class="p-3 bg-orange-100 rounded-full">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-in-bottom" style="animation-delay: 0.2s">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-800">📋 Daftar Peserta Pending</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Total: <span id="totalCount">{{ $peserta->count() }}</span> peserta</span>
                    <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="pesertaTable">
                <thead class="bg-gradient-to-r from-blue-900 to-indigo-900">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Informasi Peserta</span>
                                <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Universitas</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status & Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Jenis Magang</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="pesertaTableBody">
                    @forelse($peserta as $index => $row)
                    <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 animate-table-row" style="animation-delay: {{ $index * 0.1 }}s" data-name="{{ strtolower($row->name) }}" data-university="{{ strtolower($row->university) }}" data-magang="{{ $row->magang_type }}" data-date="{{ $row->created_at->timestamp }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $row->id }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ strtoupper(substr($row->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-lg font-bold text-gray-900">{{ $row->name }}</div>
                                    <div class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        ID: #{{ str_pad($row->id, 4, '0', STR_PAD_LEFT) }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 8h1m-1 4h1m4-4h1m-1 4h1"></path>
                                </svg>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $row->university }}</div>
                                    <div class="text-xs text-gray-500">Perguruan Tinggi</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="space-y-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $row->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : ($row->status == 'waiting' ? 'bg-blue-100 text-blue-800 border-blue-200' : ($row->status == 'active' ? 'bg-green-100 text-green-800 border-green-200' : ($row->status == 'finished' ? 'bg-gray-100 text-gray-800 border-gray-200' : 'bg-red-100 text-red-800 border-red-200'))) }}">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <circle cx="10" cy="10" r="8" fill="currentColor" />
                                    </svg>
                                    {{ ucfirst($row->status) }}
                                </span>
                                <div class="text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $row->created_at->format('d M Y, H:i') }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $row->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($row->magang_type)
                                @php
                                    $colors = [
                                        'PKL' => 'bg-green-100 text-green-800 border-green-200',
                                        'Magang' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'KKN' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'KKP' => 'bg-red-100 text-red-800 border-red-200',
                                        'MBKM' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'Mandiri' => 'bg-indigo-100 text-indigo-800 border-indigo-200'
                                    ];
                                    $color = $colors[$row->magang_type] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $color }}">
                                    {{ $row->magang_type }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-500 border border-gray-200">
                                    Belum ditentukan
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.peserta-detail', $row->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Review Detail
                                </a>
                                <div class="relative">
                                    <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200" onclick="toggleDropdown({{ $row->id }})">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                        </svg>
                                    </button>
                                    <div id="dropdown-{{ $row->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 z-20">
                                        <div class="py-1">
                                            <form method="POST" action="{{ route('admin.peserta-accept', $row->id) }}">
                                                @csrf
                                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-green-700 hover:bg-green-50 transition-colors">
                                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Terima Langsung
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.peserta-reject', $row->id) }}">
                                                @csrf
                                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors">
                                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada peserta pending</h3>
                                    <p class="text-gray-500 mb-4">Semua pendaftar sudah diproses atau belum ada yang mendaftar.</p>
                                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        Kembali ke Dashboard
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        @if($peserta->count() > 0)
        <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold">{{ $peserta->count() }}</span> peserta pending
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-xs text-gray-500">
                        Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
                    </div>
                    <button onclick="refreshTable()" class="inline-flex items-center px-3 py-1 text-xs text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        filterTable();
    });

    // Filter functionality
    document.getElementById('magangFilter').addEventListener('change', function() {
        filterTable();
    });

    // Sort functionality
    document.getElementById('sortFilter').addEventListener('change', function() {
        sortTable(this.value);
    });

    // Select all functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const bulkAction = document.getElementById('bulkAction');
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        
        bulkAction.disabled = !this.checked;
    });

    // Individual checkbox functionality
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('row-checkbox')) {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const selectAll = document.getElementById('selectAll');
            const bulkAction = document.getElementById('bulkAction');
            
            selectAll.checked = checkedBoxes.length === document.querySelectorAll('.row-checkbox').length;
            bulkAction.disabled = checkedBoxes.length === 0;
        }
    });

    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const magangType = document.getElementById('magangFilter').value;
        const rows = document.querySelectorAll('#pesertaTableBody tr');
        let visibleCount = 0;
        rows.forEach(row => {
            if (!row.hasAttribute('data-name')) return; // skip empty row
            const name = row.getAttribute('data-name');
            const university = row.getAttribute('data-university');
            const magang = row.getAttribute('data-magang');
            const matchesSearch = name.includes(searchTerm) || university.includes(searchTerm);
            const matchesMagang = magangType === '' || magang === magangType;
            if (matchesSearch && matchesMagang) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });
        document.getElementById('totalCount').textContent = visibleCount;
        document.getElementById('selectAll').checked = false;
        document.getElementById('bulkAction').disabled = true;
    }
    function sortTable(criteria) {
        const tbody = document.getElementById('pesertaTableBody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        rows.sort((a, b) => {
            if (criteria === 'newest') {
                return b.getAttribute('data-date') - a.getAttribute('data-date');
            } else if (criteria === 'oldest') {
                return a.getAttribute('data-date') - b.getAttribute('data-date');
            } else if (criteria === 'name') {
                return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
            } else if (criteria === 'university') {
                return a.getAttribute('data-university').localeCompare(b.getAttribute('data-university'));
            }
        });
        
        rows.forEach(row => tbody.appendChild(row));
    }
    function toggleDropdown(id) {
        const dropdown = document.getElementById(`dropdown-${id}`);
        dropdown.classList.toggle('hidden');
    }
    function refreshTable() {
        // For demo purposes, we'll just reload the page
        location.reload();
    }
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
@endsection
