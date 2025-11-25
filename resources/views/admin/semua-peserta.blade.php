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
                        <span>Semua Peserta</span>
                    </nav>
                    <h1 class="text-4xl font-black mb-2 tracking-tight">👥 Semua Peserta Magang</h1>
                    <p class="text-xl text-blue-200">Kelola dan pantau seluruh peserta program magang PLN UID Aceh</p>
                </div>
                <div class="text-right">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                        <p class="text-sm text-blue-200">Total Peserta</p>
                        <p class="text-3xl font-bold">{{ $peserta->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        @php
            $stats = [
                'pending' => ['label' => 'Pending', 'color' => 'yellow', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                'waiting' => ['label' => 'Menunggu', 'color' => 'orange', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                'active' => ['label' => 'Sedang Magang', 'color' => 'blue', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6'],
                'finished' => ['label' => 'Selesai', 'color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                'rejected' => ['label' => 'Ditolak', 'color' => 'red', 'icon' => 'M6 18L18 6M6 6l12 12']
            ];
            $colorClasses = [
                'yellow' => 'border-yellow-500 bg-yellow-50',
                'orange' => 'border-orange-500 bg-orange-50',
                'blue' => 'border-blue-500 bg-blue-50',
                'green' => 'border-green-500 bg-green-50',
                'red' => 'border-red-500 bg-red-50'
            ];
            $iconColors = [
                'yellow' => 'text-yellow-600 bg-yellow-100',
                'orange' => 'text-orange-600 bg-orange-100',
                'blue' => 'text-blue-600 bg-blue-100',
                'green' => 'text-green-600 bg-green-100',
                'red' => 'text-red-600 bg-red-100'
            ];
            $textColors = [
                'yellow' => 'text-yellow-700',
                'orange' => 'text-orange-700',
                'blue' => 'text-blue-700',
                'green' => 'text-green-700',
                'red' => 'text-red-700'
            ];
        @endphp

        @foreach($stats as $status => $config)
        @php 
            $count = $peserta->where('status', $status)->count();
        @endphp
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 {{ $colorClasses[$config['color']] }} hover:shadow-xl transform hover:scale-105 transition-all duration-300 animate-slide-in-left" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">{{ $config['label'] }}</p>
                    <p class="text-2xl font-bold {{ $textColors[$config['color']] }}">{{ $count }}</p>
                </div>
                <div class="p-3 {{ $iconColors[$config['color']] }} rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                    </svg>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Advanced Filter Section -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 animate-slide-in-bottom">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">🔍 Filter & Pencarian</h3>
            <button type="button" id="toggleFilter" class="text-blue-600 hover:text-blue-800 font-medium">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                </svg>
                Advanced Filter
            </button>
        </div>

        <form method="GET" class="space-y-6" id="filterForm">
            <!-- Search Bar -->
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau universitas..." 
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 text-lg">
                <svg class="absolute left-4 top-3.5 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <!-- Filter Grid -->
            <div id="filterGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">📊 Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>⏳ Pending</option>
                        <option value="waiting" {{ request('status')=='waiting'?'selected':'' }}>⏰ Menunggu</option>
                        <option value="active" {{ request('status')=='active'?'selected':'' }}>💼 Sedang Magang</option>
                        <option value="finished" {{ request('status')=='finished'?'selected':'' }}>✅ Selesai</option>
                        <option value="accepted" {{ request('status')=='accepted'?'selected':'' }}>👍 Diterima</option>
                        <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>❌ Ditolak</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">📅 Bulan Selesai</label>
                    <select name="bulan" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Pilih Bulan</option>
                        @for($m=1;$m<=12;$m++)
                            <option value="{{ $m }}" {{ request('bulan')==$m?'selected':'' }}>{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">🗓️ Tahun Selesai</label>
                    <select name="tahun" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Pilih Tahun</option>
                        @for($y=date('Y')-2;$y<=date('Y')+1;$y++)
                            <option value="{{ $y }}" {{ request('tahun')==$y?'selected':'' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">🎓 Jenis Magang</label>
                    <select name="magang_type" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Semua Jenis</option>
                        <option value="PKL" {{ request('magang_type')=='PKL'?'selected':'' }}>PKL</option>
                        <option value="Magang" {{ request('magang_type')=='Magang'?'selected':'' }}>Magang</option>
                        <option value="KKN" {{ request('magang_type')=='KKN'?'selected':'' }}>KKN</option>
                    </select>
                </div>
            </div>

            <!-- Date Range -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">📅 Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">📅 Tanggal Selesai</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" 
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-600">Hasil: <span class="font-bold text-blue-600">{{ $peserta->count() }}</span> peserta</span>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ url()->current() }}" class="px-6 py-3 text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 font-bold shadow-lg">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-in-bottom" style="animation-delay: 0.3s">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800">📋 Data Peserta Magang</h3>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.peserta-export', request()->query()) }}" class="px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-colors font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export Excel
                    </a>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">{{ $peserta->total() ?? $peserta->count() }}</span> dari total peserta
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-900 to-indigo-900">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Peserta</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 8h1m-1 4h1m4-4h1m-1 4h1"></path>
                                </svg>
                                <span>Universitas</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Divisi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($peserta as $index => $row)
                    <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 animate-table-row" style="animation-delay: {{ $index * 0.05 }}s">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ strtoupper(substr($row->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-lg font-bold text-gray-900">{{ $row->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $row->email }}</div>
                                    @if($row->phone)
                                        <div class="text-xs text-gray-400">📱 {{ $row->phone }}</div>
                                    @endif
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
                                    @if($row->magang_type)
                                        <div class="text-xs text-gray-500">{{ $row->magang_type }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusConfig = [
                                    'pending' => ['label' => 'Pending', 'class' => 'bg-yellow-100 text-yellow-800 border-yellow-200', 'icon' => '⏳'],
                                    'waiting' => ['label' => 'Menunggu', 'class' => 'bg-orange-100 text-orange-800 border-orange-200', 'icon' => '⏰'],
                                    'active' => ['label' => 'Sedang Magang', 'class' => 'bg-blue-100 text-blue-800 border-blue-200', 'icon' => '💼'],
                                    'finished' => ['label' => 'Selesai', 'class' => 'bg-green-100 text-green-800 border-green-200', 'icon' => '✅'],
                                    'accepted' => ['label' => 'Diterima', 'class' => 'bg-emerald-100 text-emerald-800 border-emerald-200', 'icon' => '👍'],
                                    'rejected' => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-800 border-red-200', 'icon' => '❌'],
                                ];
                                $config = $statusConfig[$row->status] ?? ['label' => ucfirst($row->status), 'class' => 'bg-gray-100 text-gray-800 border-gray-200', 'icon' => '❓'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $config['class'] }}">
                                <span class="mr-2">{{ $config['icon'] }}</span>
                                {{ $config['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">
                                <div class="font-semibold text-gray-900">
                                    📅 {{ $row->start_date ? \Carbon\Carbon::parse($row->start_date)->format('d M Y') : 'Belum ditentukan' }}
                                </div>
                                <div class="text-gray-500">
                                    🏁 {{ $row->end_date ? \Carbon\Carbon::parse($row->end_date)->format('d M Y') : 'Belum ditentukan' }}
                                </div>
                                @if($row->start_date && $row->end_date)
                                    @php
                                        $start = \Carbon\Carbon::parse($row->start_date);
                                        $end = \Carbon\Carbon::parse($row->end_date);
                                        $duration = $start->diffInDays($end);
                                    @endphp
                                    <div class="text-xs text-blue-600">⏱️ {{ $duration }} hari</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($row->divisi)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                    🏢 {{ $row->divisi->nama }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-500 border border-gray-200">
                                    📍 Belum ditempatkan
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="showDetail({{ $row->id }})" 
                                        class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold rounded-lg hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-md">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Detail
                                </button>
                                <button type="button" onclick="showEdit({{ $row->id }})" 
                                        class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs font-bold rounded-lg hover:from-yellow-600 hover:to-yellow-700 transform hover:scale-105 transition-all duration-300 shadow-md">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('admin.peserta-delete', $row->id) }}" onsubmit="return confirm('⚠️ Yakin ingin menghapus peserta {{ $row->name }}? Tindakan ini tidak dapat dibatalkan!')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold rounded-lg hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-md">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Detail -->
                    <div id="modal-{{ $row->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 relative animate-modal-in">
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-t-2xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-2xl font-bold">👤 Detail Peserta Magang</h2>
                                        <p class="text-blue-100">Informasi lengkap peserta</p>
                                    </div>
                                    <button type="button" onclick="closeDetail({{ $row->id }})" class="text-white hover:text-gray-200 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                {{ strtoupper(substr($row->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-xl text-gray-900">{{ $row->name }}</h3>
                                                <p class="text-gray-500">ID: #{{ str_pad($row->id, 4, '0', STR_PAD_LEFT) }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-gray-600 font-medium">Email</p>
                                                    <p class="font-semibold">{{ $row->email }}</p>
                                                </div>
                                            </div>
                                            
                                            @if($row->phone)
                                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-gray-600 font-medium">No HP</p>
                                                    <p class="font-semibold">{{ $row->phone }}</p>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 8h1m-1 4h1m4-4h1m-1 4h1"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm text-gray-600 font-medium">Universitas</p>
                                                    <p class="font-semibold">{{ $row->university }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        @if($row->magang_type)
                                        <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                                            <h4 class="font-bold text-blue-900 mb-2">📚 Jenis Magang</h4>
                                            <p class="text-blue-700 font-semibold">{{ $row->magang_type }}</p>
                                        </div>
                                        @endif
                                        
                                        <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                            <h4 class="font-bold text-green-900 mb-3">📅 Periode Magang</h4>
                                            <div class="space-y-2">
                                                <div class="flex justify-between">
                                                    <span class="text-green-700">Mulai:</span>
                                                    <span class="font-semibold">{{ $row->start_date ? \Carbon\Carbon::parse($row->start_date)->format('d M Y') : 'Belum ditentukan' }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-green-700">Selesai:</span>
                                                    <span class="font-semibold">{{ $row->end_date ? \Carbon\Carbon::parse($row->end_date)->format('d M Y') : 'Belum ditentukan' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-200">
                                            <h4 class="font-bold text-purple-900 mb-3">🏢 Penempatan</h4>
                                            @if($row->divisi)
                                                <p class="text-purple-700 font-semibold">{{ $row->divisi->nama }}</p>
                                            @else
                                                <p class="text-gray-500 italic">Belum ditempatkan</p>
                                            @endif
                                        </div>
                                        
                                        <div class="p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border border-yellow-200">
                                            <h4 class="font-bold text-yellow-900 mb-2">📊 Status</h4>
                                            @php $config = $statusConfig[$row->status] ?? ['label' => ucfirst($row->status), 'class' => 'bg-gray-100 text-gray-800 border-gray-200', 'icon' => '❓']; @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $config['class'] }}">
                                                <span class="mr-2">{{ $config['icon'] }}</span>
                                                {{ $config['label'] }}
                                            </span>
                                        </div>
                                        
                                        @if($row->cv)
                                        <div class="p-4 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl border border-gray-200">
                                            <h4 class="font-bold text-gray-900 mb-2">📄 Dokumen</h4>
                                            <a href="{{ route('admin.download-cv', $row->cv) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Download CV
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div id="edit-{{ $row->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 relative animate-modal-in max-h-[90vh] overflow-y-auto">
                            <div class="bg-gradient-to-r from-yellow-600 to-orange-600 text-white rounded-t-2xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-2xl font-bold">✏️ Edit Peserta Magang</h2>
                                        <p class="text-yellow-100">Perbarui informasi peserta</p>
                                    </div>
                                    <button type="button" onclick="closeEdit({{ $row->id }})" class="text-white hover:text-gray-200 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-8">
                                <form method="POST" action="{{ route('admin.peserta-update', $row->id) }}" class="space-y-6">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">👤 Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ $row->name }}" 
                                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300" required>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">📧 Email</label>
                                            <input type="email" name="email" value="{{ $row->email }}" 
                                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300" required>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">📱 No HP</label>
                                            <input type="text" name="phone" value="{{ $row->phone ?? '' }}" 
                                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">🏫 Universitas</label>
                                            <input type="text" name="university" value="{{ $row->university }}" 
                                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300" required>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">📚 Jenis Magang</label>
                                            <select name="magang_type" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300">
                                                <option value="">Pilih Jenis Magang</option>
                                                <option value="PKL" {{ $row->magang_type == 'PKL' ? 'selected' : '' }}>PKL</option>
                                                <option value="Magang" {{ $row->magang_type == 'Magang' ? 'selected' : '' }}>Magang</option>
                                                <option value="KKN" {{ $row->magang_type == 'KKN' ? 'selected' : '' }}>KKN</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">📊 Status</label>
                                            <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300" required>
                                                <option value="pending" {{ $row->status=='pending'?'selected':'' }}>⏳ Pending</option>
                                                <option value="accepted" {{ $row->status=='accepted'?'selected':'' }}>👍 Diterima</option>
                                                <option value="rejected" {{ $row->status=='rejected'?'selected':'' }}>❌ Ditolak</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">📅 Tanggal Mulai</label>
                                            <input type="date" name="start_date" value="{{ $row->start_date }}" 
                                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">🏁 Tanggal Selesai</label>
                                            <input type="date" name="end_date" value="{{ $row->end_date }}" 
                                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300">
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-bold text-gray-700 mb-2">🏢 Divisi</label>
                                            <input type="number" name="divisi_id" value="{{ $row->divisi_id ?? '' }}" placeholder="ID Divisi (contoh: 1, 2, 3)" 
                                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300">
                                            <p class="text-xs text-gray-500 mt-1">Masukkan ID divisi. Kosongkan jika belum ditempatkan.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                                        <button type="button" onclick="closeEdit({{ $row->id }})" 
                                                class="px-6 py-3 text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium">
                                            Batal
                                        </button>
                                        <button type="submit" 
                                                class="px-8 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 text-white rounded-xl hover:from-yellow-700 hover:to-orange-700 transform hover:scale-105 transition-all duration-300 font-bold shadow-lg">
                                            💾 Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada peserta ditemukan</h3>
                                    <p class="text-gray-500 mb-6 max-w-md">Tidak ada data peserta yang sesuai dengan filter yang Anda pilih. Coba ubah kriteria pencarian atau reset filter.</p>
                                    <div class="flex items-center justify-center space-x-4">
                                        <a href="{{ url()->current() }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-medium">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            Reset Filter
                                        </a>
                                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-6 py-3 text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                            Kembali ke Dashboard
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-white border-t">
            {{ $peserta->links() }}
        </div>

        <!-- Table Footer -->
        @if($peserta->count() > 0)
        <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-bold text-blue-600">{{ $peserta->count() }}</span> peserta dari total database
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-xs text-gray-500">
                        Terakhir diperbarui: {{ now()->format('d M Y, H:i') }} WIB
                    </div>
                    <button onclick="window.location.reload()" class="inline-flex items-center px-4 py-2 text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-all duration-300 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh Data
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
// Modal Functions
function showDetail(id) {
    document.getElementById('modal-' + id).classList.remove('hidden');
    document.getElementById('modal-' + id).classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeDetail(id) {
    document.getElementById('modal-' + id).classList.add('hidden');
    document.getElementById('modal-' + id).classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

function showEdit(id) {
    document.getElementById('edit-' + id).classList.remove('hidden');
    document.getElementById('edit-' + id).classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function closeEdit(id) {
    document.getElementById('edit-' + id).classList.add('hidden');
    document.getElementById('edit-' + id).classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('bg-black')) {
        const modals = document.querySelectorAll('[id^="modal-"], [id^="edit-"]');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
        document.body.classList.remove('overflow-hidden');
    }
});

// Advanced Filter Toggle
document.getElementById('toggleFilter').addEventListener('click', function() {
    const filterGrid = document.getElementById('filterGrid');
    const isHidden = filterGrid.style.display === 'none';
    
    if (isHidden) {
        filterGrid.style.display = 'grid';
        this.innerHTML = `
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
            </svg>
            Hide Filters
        `;
    } else {
        filterGrid.style.display = 'none';
        this.innerHTML = `
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
            </svg>
            Advanced Filter
        `;
    }
});

// Auto-submit form when filters change
document.querySelectorAll('#filterForm select').forEach(select => {
    select.addEventListener('change', function() {
        // Auto-submit could be implemented here if desired
        // document.getElementById('filterForm').submit();
    });
});

// Search functionality with debounce
let searchTimeout;
document.querySelector('input[name="search"]').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        // Auto-search could be implemented here if desired
        // document.getElementById('filterForm').submit();
    }, 500);
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // ESC to close modals
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('[id^="modal-"], [id^="edit-"]');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
        document.body.classList.remove('overflow-hidden');
    }
    
    // Ctrl+F to focus search
    if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        document.querySelector('input[name="search"]').focus();
    }
});

// Loading animation for form submissions
document.addEventListener('submit', function(e) {
    const submitButton = e.target.querySelector('button[type="submit"]');
    if (submitButton && !e.target.hasAttribute('onsubmit')) {
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin w-4 h-4 inline mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;
        
        setTimeout(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        }, 2000);
    }
});
</script>

<style>
/* Enhanced Animations */
@keyframes
modal-in {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-modal-in {
    animation: modal-in 0.3s ease-out;
}
@keyframes modal-out {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}
.animate-modal-out {
    animation: modal-out 0.3s ease-in;
}
/* Scrollbar for modals */
[id^="edit-"]::-webkit-scrollbar {
    width: 8px;
}
[id^="edit-"]::-webkit-scrollbar-thumb {
    background-color: rgba(107, 114, 128, 0.5);
    border-radius: 4px;
}
[id^="edit-"]::-webkit-scrollbar-thumb:hover {
    background-color: rgba(107, 114, 128, 0.7);
}
[id^="modal-"]::-webkit-scrollbar {
    width: 8px;
}
[id^="modal-"]::-webkit-scrollbar-thumb {
    background-color: rgba(107, 114, 128, 0.5);
    border-radius: 4px;
}
[id^="modal-"]::-webkit-scrollbar-thumb:hover {
    background-color: rgba(107, 114, 128, 0.7);
}
</style>
@endsection

