
@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto py-10 animate-fade-in">
  <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-xl p-8 text-center animate-slide-up">
    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center bg-green-100 rounded-full animate-bounce">
      <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
      </svg>
    </div>
    <h2 class="text-3xl font-bold text-green-700 mb-4 animate-fade-in">Pendaftaran Berhasil!</h2>
    <p class="text-gray-600 mb-8 animate-fade-in">Terima kasih telah mendaftar. Berikut data pendaftaran Anda:</p>
    <div class="text-left mb-6 animate-slide-up">
      <ul class="space-y-2">
        <li><span class="font-semibold">Nama Lengkap:</span> {{ $participant->name }}</li>
        <li><span class="font-semibold">Universitas/Sekolah:</span> {{ $participant->university }}</li>
        <li><span class="font-semibold">Email:</span> {{ $participant->email }}</li>
        <li><span class="font-semibold">WhatsApp:</span> {{ $participant->whatsapp }}</li>
        <li><span class="font-semibold">Tanggal Mulai:</span> {{ $participant->start_date }}</li>
        <li><span class="font-semibold">Tanggal Akhir:</span> {{ $participant->end_date }}</li>
        <li><span class="font-semibold">Kode Unik:</span> <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">{{ $participant->unique_code }}</span></li>
      </ul>
    </div>
    <div class="mt-8 animate-fade-in">
      <form id="statusFormInline" class="max-w-md mx-auto">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-center">
          <input type="text" id="inputUniqueCodeInline" name="unique_code" value="{{ $participant->unique_code }}" placeholder="Masukkan kode unik Anda" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none form-focus transition-all duration-300">
          <button type="submit" class="bg-pln-green bg-green-700 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300">Cek Status</button>
        </div>
      </form>
      <div id="statusResultInline" class="mt-4 text-center"></div>
    </div>
  </div>
</div>

<script>
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
        <div class="bg-white rounded-lg p-6 shadow text-left max-w-lg mx-auto animate-fade-in">
          <h3 class="text-xl font-bold mb-4">Status Pendaftaran Anda</h3>
          <div class="mb-2"><strong>Status:</strong> ${statusLabel}</div>
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
</script>
@endsection
