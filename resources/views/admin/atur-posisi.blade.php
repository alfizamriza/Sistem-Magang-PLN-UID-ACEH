@extends('admin.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-indigo-600 p-3 rounded-full mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Atur Posisi Peserta Magang</h1>
                    <p class="text-gray-600 text-lg">PT PLN (Persero) - Sistem Penempatan Peserta ke Divisi</p>
                </div>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-indigo-600 to-indigo-400 mx-auto rounded-full"></div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="mb-8 max-w-5xl mx-auto">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-xl shadow-lg flex items-center animate-slide-in">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-8 max-w-5xl mx-auto">
            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-4 rounded-xl shadow-lg flex items-center animate-slide-in">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Left Column - Active Participants -->
            <div class="xl:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <h2 class="text-2xl font-bold text-white">Daftar Peserta Magang Aktif</h2>
                            </div>
                            <div class="bg-white bg-opacity-20 px-4 py-2 rounded-full">
                                <span class="text-white font-semibold">{{ $peserta->count() }} Peserta</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        @forelse($peserta as $index => $row)
                        <div class="mb-6 {{ $index > 0 ? 'border-t border-gray-100 pt-6' : '' }}">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all duration-200">
                                <!-- Participant Info -->
                                <div class="flex items-center space-x-4">
                                    <!-- Avatar -->
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($row->name, 0, 1) }}
                                    </div>
                                    
                                    <!-- Details -->
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-lg">{{ $row->name }}</h3>
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                                </svg>
                                                {{ $row->university }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <span class="font-medium text-blue-600">
                                                    {{ $row->divisi ? $row->divisi->nama : 'Belum ditempatkan' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Assignment Form -->
                                <div class="flex-shrink-0">
                                    <form method="POST" action="{{ route('admin.atur-posisi.update', $row->id) }}" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="divisi_id" class="border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 min-w-[200px]" required>
                                            <option value="">Pilih Divisi</option>
                                            @foreach($divisis as $divisi)
                                                @php $count = $divisi->peserta->count(); @endphp
                                                <option value="{{ $divisi->id }}" 
                                                        @if($row->divisi_id == $divisi->id) selected @endif 
                                                        @if($count >= $divisi->kapasitas && $row->divisi_id != $divisi->id) disabled @endif>
                                                    {{ $divisi->nama }} ({{ $count }}/{{ $divisi->kapasitas }})
                                                    @if($count >= $divisi->kapasitas && $row->divisi_id != $divisi->id) - PENUH @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-3 rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 font-medium flex items-center justify-center whitespace-nowrap">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                            Atur Posisi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-500 mb-2">Tidak Ada Peserta Aktif</h3>
                            <p class="text-gray-400">Belum ada peserta magang yang terdaftar dalam sistem saat ini.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column - Divisions Overview -->
            <div class="xl:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-8">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-6">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <h2 class="text-xl font-bold text-white">Status Divisi & Kapasitas</h2>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($divisis as $divisi)
                            @php 
                                $count = $divisi->peserta->count();
                                $percentage = $divisi->kapasitas > 0 ? ($count / $divisi->kapasitas) * 100 : 0;
                                $statusColor = $percentage >= 100 ? 'red' : ($percentage >= 80 ? 'yellow' : 'green');
                            @endphp
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 hover:shadow-md transition-all duration-200">
                                <!-- Division Header -->
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="font-bold text-gray-800 text-lg truncate">{{ $divisi->nama }}</h3>
                                    <div class="flex items-center space-x-2">
                                        @if($statusColor == 'red')
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            PENUH
                                        </span>
                                        @elseif($statusColor == 'yellow')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            HAMPIR PENUH
                                        </span>
                                        @else
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            TERSEDIA
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Capacity Info -->
                                <div class="mb-3">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Kapasitas Terisi</span>
                                        <span class="font-semibold">{{ $count }}/{{ $divisi->kapasitas }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        @php
                                            $colorClass = $statusColor == 'red' ? 'bg-red-500' : 
                                                         ($statusColor == 'yellow' ? 'bg-yellow-500' : 'bg-green-500');
                                        @endphp
                                        <div class="{{ $colorClass }} h-2 rounded-full transition-all duration-1000" 
                                             style="width: {{ min($percentage, 100) }}%"></div>
                                    </div>
                                </div>

                                <!-- Percentage Display -->
                                <div class="text-center">
                                    <span class="text-2xl font-bold {{ $statusColor == 'red' ? 'text-red-600' : ($statusColor == 'yellow' ? 'text-yellow-600' : 'text-green-600') }}">
                                        {{ round($percentage) }}%
                                    </span>
                                </div>

                                <!-- Quick Actions -->
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>Sisa tempat:</span>
                                        <span class="font-semibold">{{ max(0, $divisi->kapasitas - $count) }} peserta</span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-500 mb-1">Belum Ada Divisi</h3>
                                <p class="text-gray-400 text-sm">Buat divisi terlebih dahulu untuk mengelola posisi peserta.</p>
                            </div>
                            @endforelse
                        </div>

                        <!-- Summary Stats -->
                        @if($divisis->count() > 0)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="font-semibold text-gray-700 mb-3">Ringkasan Sistem</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Divisi:</span>
                                    <span class="font-semibold text-gray-800">{{ $divisis->count() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Kapasitas:</span>
                                    <span class="font-semibold text-gray-800">{{ $divisis->sum('kapasitas') }} peserta</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Peserta Ditempatkan:</span>
                                    <span class="font-semibold text-green-600">{{ $divisis->sum(fn($d) => $d->peserta->count()) }} peserta</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sisa Kapasitas:</span>
                                    <span class="font-semibold text-blue-600">{{ $divisis->sum('kapasitas') - $divisis->sum(fn($d) => $d->peserta->count()) }} tempat</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Bar -->
        <div class="mt-8 max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Aksi Cepat</h3>
                            <p class="text-sm text-gray-600">Kelola sistem manajemen magang dengan mudah</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ url('/dashboard/divisi') }}" 
                           class="px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl hover:from-purple-700 hover:to-purple-800 transition-all duration-200 flex items-center text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Kelola Divisi
                        </a>
                        <a href="{{ url('/dashboard/semua-peserta') }}" 
                           class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Semua Peserta
                        </a>
                        <a href="{{ url('/dashboard') }}" 
                           class="px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-200 flex items-center text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Animations */
@keyframes slide-in {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-in {
    animation: slide-in 0.5s ease-out;
}

/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #6366f1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #4f46e5;
}

/* Progress bar animations */
.progress-bar {
    transition: width 1s ease-in-out;
}
</style>

<script>
// Add form validation and user experience enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Add loading states to forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = 'Memproses...';
            }
        });
    });
});
</script>
@endsection
