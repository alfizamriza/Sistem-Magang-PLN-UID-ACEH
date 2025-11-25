@extends('admin.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-blue-600 p-3 rounded-full mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Detail Peserta Magang</h1>
                    <p class="text-gray-600 text-lg">PT PLN (Persero) - Sistem Manajemen Magang</p>
                </div>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-400 mx-auto rounded-full"></div>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">{{ $peserta->name }}</h2>
                        <p class="text-blue-100">{{ $peserta->university }}</p>
                    </div>
                    <div class="text-right">
                        <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                            {{ $peserta->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border border-yellow-300' : 
                               ($peserta->status == 'diterima' ? 'bg-green-100 text-green-800 border border-green-300' : 
                                'bg-red-100 text-red-800 border border-red-300') }}">
                            @if($peserta->status == 'pending')
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($peserta->status == 'diterima')
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            @endif
                            {{ ucfirst($peserta->status) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                <!-- Personal Information Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-6">
                        <!-- Contact Info -->
                        <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-blue-500">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Informasi Kontak
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Email</label>
                                    <div class="text-gray-800 font-medium">{{ $peserta->email }}</div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">WhatsApp</label>
                                    <div class="text-gray-800 font-medium">{{ $peserta->whatsapp }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Info -->
                        <div class="bg-blue-50 rounded-xl p-6 border-l-4 border-blue-600">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                                Informasi Akademik
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Universitas</label>
                                    <div class="text-gray-800 font-medium">{{ $peserta->university }}</div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Jenis Magang</label>
                                    <div class="text-gray-800 font-medium">{{ $peserta->magang_type ?? 'Tidak disebutkan' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Schedule Info -->
                        <div class="bg-green-50 rounded-xl p-6 border-l-4 border-green-500">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Jadwal Magang
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tanggal Mulai</label>
                                    <div class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($peserta->start_date)->format('d F Y') }}</div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tanggal Selesai</label>
                                    <div class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($peserta->end_date)->format('d F Y') }}</div>
                                </div>
                                <div class="bg-white rounded-lg p-3 mt-4">
                                    <div class="text-sm text-gray-600">Durasi Magang</div>
                                    <div class="text-lg font-bold text-green-600">
                                        {{ \Carbon\Carbon::parse($peserta->start_date)->diffInDays(\Carbon\Carbon::parse($peserta->end_date)) }} hari
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents -->
                        <div class="bg-purple-50 rounded-xl p-6 border-l-4 border-purple-500">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Dokumen CV
                            </h3>
                            @if($peserta->cv)
                                <a href="{{ route('admin.download-cv', basename($peserta->cv)) }}" target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Download CV
                                </a>
                            @else
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    CV tidak tersedia
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        Deskripsi & Motivasi
                    </h3>
                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                        <p class="text-gray-700 leading-relaxed">{{ $peserta->description }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if($peserta->status == 'pending')
                <div class="border-t border-gray-200 pt-8">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Tindakan Review</h3>
                        <form method="POST" action="{{ route('admin.peserta-review', $peserta->id) }}" class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            @csrf
                            <button name="action" value="terima" type="submit" 
                                    class="group relative px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-xl shadow-lg hover:from-green-700 hover:to-green-800 transform hover:scale-105 transition-all duration-300 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Terima Peserta
                                <div class="absolute inset-0 rounded-xl bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            </button>
                            
                            <button name="action" value="tolak" type="submit" 
                                    class="group relative px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl shadow-lg hover:from-red-700 hover:to-red-800 transform hover:scale-105 transition-all duration-300 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tolak Peserta
                                <div class="absolute inset-0 rounded-xl bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="border-t border-gray-200 pt-8">
                    <div class="text-center">
                        <div class="inline-flex items-center px-6 py-3 rounded-xl {{ $peserta->status == 'diterima' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300' }}">
                            @if($peserta->status == 'diterima')
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Peserta telah diterima
                            @else
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Peserta telah ditolak
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ route('admin.peserta-index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Peserta
            </a>
        </div>
    </div>
</div>

<style>
    /* Custom animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slide-in-up {
        animation: slideInUp 0.6s ease-out;
    }
    
    /* Hover effects for cards */
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    /* Custom scrollbar for better UX */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #3b82f6;
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #2563eb;
    }
</style>
@endsection