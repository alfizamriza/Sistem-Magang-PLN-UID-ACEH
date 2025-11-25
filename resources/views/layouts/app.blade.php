<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magang PLN UID Aceh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body>
    <nav class="gradient-bg text-white relative overflow-hidden">
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
                <a href="/" class="text-5xl font-bold mb-4 animate-slide-up">PT PLN UID Aceh</a>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16 animate-pulse-slow"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-pln-yellow opacity-20 rounded-full -ml-12 -mb-12 animate-bounce-slow"></div>
    </nav>
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">PLN UID Aceh</a>
        </div>
    </nav> --}}
    <main>
        @yield('content')
    </main>
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
    {{-- <footer class="bg-dark text-white text-center py-4 mt-5">
        <p>&copy; 2025 PLN UID Aceh. All rights reserved.</p>
    </footer> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
