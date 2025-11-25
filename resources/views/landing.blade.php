<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magang PLN UID Aceh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pln-blue': '#1e40af',
                        'pln-dark-blue': '#1e3a8a',
                        'pln-light-blue': '#3b82f6',
                        'pln-yellow': '#fbbf24',
                        'pln-green': '#10b981'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'float': 'float 3s ease-in-out infinite'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 50%, #312e81 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .form-focus:focus {
            border-color: #1e40af;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Header with Gradient Background -->
<header class="gradient-bg text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="container mx-auto px-6 py-16 relative z-10">
        <div class="flex items-center justify-center mb-8 animate-fade-in">
            <!-- PLN Logo -->
            <div class="bg-white rounded-full p-4 mr-6 animate-float">
                <svg width="60" height="60" viewBox="0 0 100 100" class="text-pln-blue">
                    <rect x="10" y="20" width="80" height="60" rx="5" fill="currentColor"/>
                    <rect x="15" y="25" width="70" height="50" rx="3" fill="white"/>
                    <rect x="20" y="35" width="15" height="30" fill="currentColor"/>
                    <rect x="42.5" y="35" width="15" height="30" fill="currentColor"/>
                    <rect x="65" y="35" width="15" height="30" fill="currentColor"/>
                    <circle cx="27.5" cy="45" r="3" fill="#fbbf24"/>
                    <circle cx="50" cy="45" r="3" fill="#fbbf24"/>
                    <circle cx="72.5" cy="45" r="3" fill="#fbbf24"/>
                </svg>
            </div>
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4 animate-slide-up">PT PLN (Persero)</h1>
                <h2 class="text-3xl font-semibold text-pln-yellow animate-slide-up">UID Aceh</h2>
            </div>
        </div>
        <div class="text-center animate-fade-in">
            <h3 class="text-2xl font-bold mb-4">Program Magang 2025</h3>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">Bergabunglah dengan Program Magang PLN UID Aceh dan kembangkan karir Anda di industri kelistrikan terdepan di Indonesia</p>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16 animate-pulse-slow"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-pln-yellow opacity-20 rounded-full -ml-12 -mb-12 animate-bounce-slow"></div>
</header>

<!-- Program Information Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Tentang Program Magang</h2>
            <div class="w-24 h-1 bg-pln-blue mx-auto mb-8"></div>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="animate-slide-up">
                <h3 class="text-2xl font-bold text-pln-dark-blue mb-6">Mengapa Memilih PLN?</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Program Magang PLN UID Aceh memberikan kesempatan berharga bagi mahasiswa dan pelajar untuk mengembangkan 
                    keterampilan profesional dalam berbagai divisi strategis seperti Keuangan, Niaga, Operasi, dan Teknik. 
                    Dapatkan pengalaman langsung yang akan memperkaya masa depan karir Anda.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-pln-green rounded-full flex items-center justify-center mr-4">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700">Pengalaman di perusahaan BUMN terkemuka</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-pln-green rounded-full flex items-center justify-center mr-4">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700">Mentoring dari profesional berpengalaman</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-pln-green rounded-full flex items-center justify-center mr-4">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700">Sertifikat resmi dari PLN</span>
                    </div>
                </div>
            </div>
            
            <div class="animate-slide-up">
                <div class="bg-gradient-to-br from-pln-blue to-pln-dark-blue rounded-2xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6">Syarat & Ketentuan</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-pln-yellow rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-xs font-bold text-pln-dark-blue">1</span>
                            </div>
                            <span>Mahasiswa aktif atau pelajar dari institusi terakreditasi</span>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-pln-yellow rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-xs font-bold text-pln-dark-blue">2</span>
                            </div>
                            <span>Memiliki motivasi tinggi dan semangat untuk belajar</span>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-pln-yellow rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-xs font-bold text-pln-dark-blue">3</span>
                            </div>
                            <span>Mampu bekerja dalam tim dan berkomunikasi dengan baik</span>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-pln-yellow rounded-full flex items-center justify-center mr-4 mt-1">
                                <span class="text-xs font-bold text-pln-dark-blue">4</span>
                            </div>
                            <span>Berkomitmen untuk magang minimal 1 bulan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Registration Form Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Daftar Sekarang</h2>
            <div class="w-24 h-1 bg-pln-blue mx-auto mb-8"></div>
            <p class="text-gray-600 text-lg">Isi formulir di bawah ini untuk memulai perjalanan magang Anda di PLN UID Aceh</p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden card-hover animate-slide-up">
                <div class="bg-gradient-to-r from-pln-blue to-pln-dark-blue p-8 text-white">
                    <h3 class="text-2xl font-bold mb-2">Formulir Pendaftaran</h3>
                    <p class="opacity-90">Lengkapi data diri Anda dengan benar</p>
                </div>
                
                <form class="p-8 space-y-6" action="{{ url('/daftar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                        </div>
                        <div>
                            <label for="university" class="block text-sm font-semibold text-gray-700 mb-2">Instansi/Universitas/Sekolah</label>
                            <input type="text" id="university" name="university" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                        </div>
                    </div>
                    <div>
                        <label for="magang_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Magang</label>
                        <select id="magang_type" name="magang_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300" onchange="toggleOtherMagang()">
                            <option value="Mandiri">Mandiri</option>
                            <option value="MBKM">Program MBKM</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                        <div id="otherMagangDiv" class="mt-4 hidden">
                            <label for="other_magang" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Magang Lainnya</label>
                            <input type="text" id="other_magang" name="other_magang" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                        </div>
                    </div>
                    <script>
                        function toggleOtherMagang() {
                            var select = document.getElementById('magang_type');
                            var otherDiv = document.getElementById('otherMagangDiv');
                            if (select.value === 'Lain-lain') {
                                otherDiv.classList.remove('hidden');
                                document.getElementById('other_magang').required = true;
                            } else {
                                otherDiv.classList.add('hidden');
                                document.getElementById('other_magang').required = false;
                            }
                        }
                    </script>
                    
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsikan Diri Anda</label>
                        <textarea id="description" name="description" rows="4" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300 resize-none"></textarea>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai Magang</label>
                            <input type="date" id="start_date" name="start_date" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Akhir Magang</label>
                            <input type="date" id="end_date" name="end_date" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                        </div>
                    </div>
                    
                    <div>
                        <label for="cv" class="block text-sm font-semibold text-gray-700 mb-2">Upload CV</label>
                        <input type="file" id="cv" name="cv" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Aktif</label>
                            <input type="email" id="email" name="email" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                        </div>
                        <div>
                            <label for="whatsapp" class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp</label>
                            <input type="text" id="whatsapp" name="whatsapp" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                        </div>
                    </div>
                    
                    <div class="text-center pt-6">
                        <button type="submit" 
                            class="bg-gradient-to-r from-pln-blue to-pln-dark-blue hover:from-pln-dark-blue hover:to-blue-900 text-white font-bold py-4 px-12 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Kirim Pendaftaran
                            <svg class="w-5 h-5 inline-block ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Status Check Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 text-center">
        <div class="animate-fade-in">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Cek Status Pendaftaran</h2>
            <p class="text-gray-600 mb-8 text-lg">Sudah mendaftar? Cek status pendaftaran Anda dengan kode unik</p>
            <form id="statusFormInline" class="max-w-md mx-auto mb-6">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-center">
                    <input type="text" id="inputUniqueCodeInline" name="unique_code" placeholder="Masukkan kode unik Anda" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
                    <button type="submit" class="bg-pln-green hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300">Cek Status</button>
                </div>
            </form>
            <div id="statusResultInline" class="mt-4 text-center"></div>
        </div>
    </div>
</section>

<!-- Program Information Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Statistik Peserta Magang</h2>
            <div class="w-24 h-1 bg-pln-blue mx-auto"></div>
        </div>
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-up p-8 text-center">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-yellow-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-yellow-700 mb-2">Pending</h3>
                    <p class="text-4xl font-bold text-yellow-700">{{ isset($participants) ? $participants->where('status', 'pending')->count() : 0 }}</p>
                    <p class="text-gray-500 mt-2">Menunggu verifikasi.</p>
                </div>
                <div class="bg-green-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-green-700 mb-2">Diterima</h3>
                    <p class="text-4xl font-bold text-green-700">{{ isset($participants) ? $participants->where('status', 'accepted')->count() : 0 }}</p>
                    <p class="text-gray-500 mt-2">Peserta yang sudah diterima.</p>
                </div>
                <div class="bg-blue-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-blue-700 mb-2">Sedang Magang</h3>
                    <p class="text-4xl font-bold text-blue-700">{{ isset($participants) ? $participants->where('status', 'magang')->count() : 0 }}</p>
                    <p class="text-gray-500 mt-2">Peserta yang sedang magang.</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Total Peserta</h3>
                    <p class="text-4xl font-bold text-gray-700">{{ isset($participants) ? $participants->count() : 0 }}</p>
                    <p class="text-gray-500 mt-2">Seluruh peserta magang.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Status Modal -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Cek Status Pendaftaran</h3>
            <p class="text-gray-600">Masukkan kode unik yang Anda terima</p>
        </div>
        
        <form id="statusForm" class="space-y-4">
            <div>
                <label for="inputUniqueCode" class="block text-sm font-semibold text-gray-700 mb-2">Kode Unik</label>
                <input type="text" id="inputUniqueCode" name="unique_code" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
            </div>
            
            <button type="submit" 
                class="w-full bg-pln-blue hover:bg-pln-dark-blue text-white font-bold py-3 rounded-lg transition-all duration-300">
                Cek Status
            </button>
        </form>
        
        <div id="statusResult" class="mt-4 text-center"></div>
        
        <button onclick="hideStatusModal()" 
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-6 text-center">
        <div class="flex items-center justify-center mb-6">
            <div class="bg-white rounded-full p-3 mr-4">
                <svg width="40" height="40" viewBox="0 0 100 100" class="text-pln-blue">
                    <rect x="10" y="20" width="80" height="60" rx="5" fill="currentColor"/>
                    <rect x="15" y="25" width="70" height="50" rx="3" fill="white"/>
                    <rect x="20" y="35" width="15" height="30" fill="currentColor"/>
                    <rect x="42.5" y="35" width="15" height="30" fill="currentColor"/>
                    <rect x="65" y="35" width="15" height="30" fill="currentColor"/>
                    <circle cx="27.5" cy="45" r="3" fill="#fbbf24"/>
                    <circle cx="50" cy="45" r="3" fill="#fbbf24"/>
                    <circle cx="72.5" cy="45" r="3" fill="#fbbf24"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold">PT PLN (Persero) UID Aceh</h3>
                <p class="text-gray-400">Listrik untuk Kehidupan yang Lebih Baik</p>
            </div>
        </div>
        <p class="text-gray-400">&copy; 2025 PT PLN (Persero) UID Aceh. All rights reserved.</p>
    </div>
</footer>

<script>
function showStatusModal() {
    const modal = document.getElementById('statusModal');
    const content = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    setTimeout(() => {
        content.style.transform = 'scale(1)';
        content.style.opacity = '1';
    }, 10);
}

function hideStatusModal() {
    const modal = document.getElementById('statusModal');
    const content = document.getElementById('modalContent');
    content.style.transform = 'scale(0.95)';
    content.style.opacity = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

document.getElementById('statusFormInline').onsubmit = function(e) {
    e.preventDefault();
    const code = document.getElementById('inputUniqueCodeInline').value;
    fetch('/cek-status?unique_code=' + code)
        .then(response => response.json())
        .then(data => {
            let statusText = '';
            if (data.status === 'accepted' || data.status === 'pending' || data.status === 'rejected' || data.status === 'magang') {
                let statusLabel = '';
                if (data.status === 'accepted') {
                    statusLabel = '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full">Diterima</span>';
                } else if (data.status === 'rejected') {
                    statusLabel = '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full">Ditolak</span>';
                } else if (data.status === 'magang') {
                    statusLabel = '<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">Sedang Magang</span>';
                } else {
                    statusLabel = '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">Sedang Diproses</span>';
                }
                statusText = `
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow text-left max-w-lg mx-auto">
                    <h3 class="text-xl font-bold mb-4">Data Pendaftaran Anda</h3>
                    <div class="mb-2"><strong>Status:</strong> ${statusLabel}</div>
                    <ul class="mb-4">
                        <li><strong>Nama:</strong> ${data.name}</li>
                        <li><strong>Universitas/Sekolah:</strong> ${data.university}</li>
                        <li><strong>Email:</strong> ${data.email}</li>
                        <li><strong>WhatsApp:</strong> ${data.whatsapp}</li>
                        <li><strong>Tanggal Mulai:</strong> ${data.start_date}</li>
                        <li><strong>Tanggal Akhir:</strong> ${data.end_date}</li>
                    </ul>
                </div>
                `;
            } else {
                statusText = '<div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded-lg">\n                    <strong class="font-bold">Kode Tidak Ditemukan</strong>\n                    <span class="block sm:inline">Silakan periksa kembali kode unik Anda.</span>\n                </div>';
            }
            document.getElementById('statusResultInline').innerHTML = statusText;
        })
        .catch(error => {
            document.getElementById('statusResultInline').innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">\n                <strong class="font-bold">Error</strong>\n                <span class="block sm:inline">Terjadi kesalahan. Silakan coba lagi nanti.</span>\n            </div>';
        });
};
@if(session('success'))
    document.getElementById('successModal').classList.remove('hidden');
@endif
</script>
</body>
</html>