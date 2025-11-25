@extends('admin.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-purple-600 p-3 rounded-full mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Manajemen Divisi</h1>
                    <p class="text-gray-600 text-lg">PT PLN (Persero) - Sistem Pengelolaan Divisi Magang</p>
                </div>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-purple-400 mx-auto rounded-full"></div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-8 max-w-4xl mx-auto">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-xl shadow-lg flex items-center animate-slide-in">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Add New Division Form -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-white">Tambah Divisi Baru</h2>
                    </div>
                </div>
                
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.divisi.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Nama Divisi
                                </label>
                                <input type="text" name="nama" 
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-colors duration-200" 
                                       placeholder="Contoh: Divisi Teknik Kelistrikan"
                                       required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Kapasitas Peserta Magang
                                </label>
                                <input type="number" name="kapasitas" min="1" max="100"
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-colors duration-200" 
                                       placeholder="Maksimal peserta yang dapat diterima"
                                       required>
                            </div>
                        </div>
                        
                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="group relative px-8 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:from-purple-700 hover:to-purple-800 transform hover:scale-105 transition-all duration-300 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Divisi
                                <div class="absolute inset-0 rounded-xl bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Divisions Grid -->
        <div class="max-w-7xl mx-auto">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Divisi</h2>
                <div class="text-gray-600">
                    <span class="font-medium">{{ $divisis->count() }}</span> divisi terdaftar
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($divisis as $divisi)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-white truncate">{{ $divisi->nama }}</h3>
                            <div class="bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <!-- Statistics -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-blue-50 rounded-xl p-4 text-center border border-blue-100">
                                <div class="text-2xl font-bold text-blue-600">{{ $divisi->kapasitas }}</div>
                                <div class="text-sm text-blue-600 font-medium">Kapasitas</div>
                            </div>
                            <div class="bg-green-50 rounded-xl p-4 text-center border border-green-100">
                                <div class="text-2xl font-bold text-green-600">{{ $divisi->peserta->count() }}</div>
                                <div class="text-sm text-green-600 font-medium">Peserta Aktif</div>
                            </div>
                        </div>

                        <!-- Capacity Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="font-medium text-gray-700">Tingkat Okupansi</span>
                                <span class="text-gray-600">
                                    {{ $divisi->kapasitas > 0 ? round(($divisi->peserta->count() / $divisi->kapasitas) * 100) : 0 }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                @php
                                    $percentage = $divisi->kapasitas > 0 ? ($divisi->peserta->count() / $divisi->kapasitas) * 100 : 0;
                                    $colorClass = $percentage >= 80 ? 'bg-red-500' : ($percentage >= 60 ? 'bg-yellow-500' : 'bg-green-500');
                                @endphp
                                <div class="{{ $colorClass }} h-3 rounded-full transition-all duration-1000" 
                                     style="width: {{ min($percentage, 100) }}%"></div>
                            </div>
                        </div>

                        <!-- Participants List Toggle -->
                        <div class="mb-6">
                            <button onclick="toggleDropdown({{ $divisi->id }})" 
                                    class="flex items-center justify-between w-full p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                                <span class="font-medium text-gray-700">Daftar Peserta Magang</span>
                                <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200" 
                                     id="arrow-{{ $divisi->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div id="dropdown-{{ $divisi->id }}" class="hidden mt-3 bg-gray-50 border-2 border-gray-100 rounded-xl p-4">
                                @forelse($divisi->peserta as $index => $peserta)
                                    <div class="flex items-center py-2 {{ $index > 0 ? 'border-t border-gray-200' : '' }}">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                            {{ substr($peserta->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-800">{{ $peserta->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $peserta->university }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <p class="text-gray-500">Belum ada peserta aktif di divisi ini</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <button onclick="openEditModal({{ $divisi->id }}, '{{ addslashes($divisi->nama) }}', {{ $divisi->kapasitas }})" 
                                    class="flex-1 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-4 py-2 rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 flex items-center justify-center text-sm font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </button>
                            
                            <form method="POST" action="{{ url('/dashboard/divisi/' . $divisi->id . '/delete') }}" 
                                  onsubmit="return confirm('Yakin ingin menghapus divisi {{ addslashes($divisi->nama) }}?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 flex items-center justify-center text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            
                            <a href="{{ url('/dashboard/atur-posisi') }}" 
                               class="flex-1 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-4 py-2 rounded-xl hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 flex items-center justify-center text-sm font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Atur
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-500 mb-2">Belum Ada Divisi Terdaftar</h3>
                        <p class="text-gray-400 max-w-md mx-auto">Mulai dengan menambahkan divisi baru menggunakan form di atas untuk mengelola peserta magang PLN.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Divisi -->
<div id="editDivisiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-white">Edit Divisi</h2>
                <button onclick="closeEditModal()" class="text-white hover:text-gray-200 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <form id="editDivisiForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nama Divisi</label>
                    <input type="text" name="nama" id="editNamaDivisi" 
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-colors duration-200" 
                           required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Kapasitas Peserta Magang</label>
                    <input type="number" name="kapasitas" id="editKapasitasDivisi" min="1" max="100"
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-colors duration-200" 
                           required>
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()" 
                            class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 font-medium">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
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
    background: #3b82f6;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #2563eb;
}
</style>

<script>
function toggleDropdown(id) {
    const dropdown = document.getElementById('dropdown-' + id);
    const arrow = document.getElementById('arrow-' + id);
    
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        arrow.style.transform = 'rotate(180deg)';
    } else {
        dropdown.classList.add('hidden');
        arrow.style.transform = 'rotate(0deg)';
    }
}

function openEditModal(id, nama, kapasitas) {
    document.getElementById('editDivisiModal').classList.remove('hidden');
    document.getElementById('editNamaDivisi').value = nama;
    document.getElementById('editKapasitasDivisi').value = kapasitas;
    document.getElementById('editDivisiForm').action = '/dashboard/divisi/' + id + '/edit';
    
    // Add fade-in animation
    const modal = document.getElementById('editDivisiModal');
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.9)';
    
    setTimeout(() => {
        modal.style.transition = 'all 0.3s ease-out';
        modal.style.opacity = '1';
        modal.style.transform = 'scale(1)';
    }, 10);
}

function closeEditModal() {
    const modal = document.getElementById('editDivisiModal');
    modal.style.transition = 'all 0.3s ease-out';
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.9)';
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('editDivisiModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Add smooth scroll to top when page loads
window.addEventListener('load', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
@endsection