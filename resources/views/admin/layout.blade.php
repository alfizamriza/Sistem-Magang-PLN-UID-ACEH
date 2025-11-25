<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin PLN</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar-container w-72 bg-white shadow-2xl flex flex-col relative overflow-hidden">
            <!-- PLN Brand Header -->
            <div class="sidebar-header px-6 py-8 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-white relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 opacity-20"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-white bg-opacity-10 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white border-opacity-20">
                            <i class="fas fa-bolt text-3xl text-yellow-400"></i>
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-center mb-1">PLN Admin</h1>
                    <p class="text-blue-200 text-center text-sm">Sistem Manajemen Magang</p>
                </div>
                <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-blue-600 opacity-10 rounded-full"></div>
                <div class="absolute -top-4 -left-4 w-16 h-16 bg-blue-400 opacity-10 rounded-full"></div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6 bg-gray-50">
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ url('/dashboard') }}" class="nav-item group">
                        <div class="nav-icon-wrapper bg-gradient-to-br from-blue-500 to-blue-600">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="flex-1">
                            <span class="nav-title">Dashboard</span>
                            <span class="nav-subtitle">Ringkasan sistem</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600 transition-colors duration-200"></i>
                    </a>

                    <!-- Peserta Baru -->
                    <a href="{{ url('/dashboard/peserta-baru') }}" class="nav-item group">
                        <div class="nav-icon-wrapper bg-gradient-to-br from-green-500 to-green-600">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="flex-1">
                            <span class="nav-title">Peserta Baru</span>
                            <span class="nav-subtitle">Pendaftar terbaru</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-600 transition-colors duration-200"></i>
                    </a>

                    <!-- Divisi Kantor -->
                    <a href="{{ url('/dashboard/divisi') }}" class="nav-item group">
                        <div class="nav-icon-wrapper bg-gradient-to-br from-purple-500 to-purple-600">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="flex-1">
                            <span class="nav-title">Divisi Kantor</span>
                            <span class="nav-subtitle">Manajemen divisi</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-600 transition-colors duration-200"></i>
                    </a>

                    <!-- Tambah Admin -->
                    <a href="{{ route('admin.admins.create') }}" class="nav-item group">
                        <div class="nav-icon-wrapper bg-gradient-to-br from-teal-500 to-teal-600">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="flex-1">
                            <span class="nav-title">Tambah Admin</span>
                            <span class="nav-subtitle">Buat akun admin baru</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-teal-600 transition-colors duration-200"></i>
                    </a>

                    <!-- Atur Posisi -->
                    <a href="{{ url('/dashboard/atur-posisi') }}" class="nav-item group">
                        <div class="nav-icon-wrapper bg-gradient-to-br from-orange-500 to-orange-600">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="flex-1">
                            <span class="nav-title">Atur Posisi</span>
                            <span class="nav-subtitle">Penempatan peserta</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-orange-600 transition-colors duration-200"></i>
                    </a>

                    <!-- Semua Peserta -->
                    <a href="{{ url('/dashboard/semua-peserta') }}" class="nav-item group">
                        <div class="nav-icon-wrapper bg-gradient-to-br from-indigo-500 to-indigo-600">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="flex-1">
                            <span class="nav-title">Semua Peserta</span>
                            <span class="nav-subtitle">Data lengkap peserta</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-indigo-600 transition-colors duration-200"></i>
                    </a>
                </div>

                <!-- Divider -->
                <div class="my-8">
                    <div class="border-t border-gray-200"></div>
                    <div class="flex items-center justify-center -mt-3">
                        <div class="bg-gray-50 px-4">
                            <i class="fas fa-grip-lines text-gray-300"></i>
                        </div>
                    </div>
                </div>

                <!-- Additional Menu -->
                {{-- <div class="space-y-2">
                    <a href="#" class="nav-item-simple group">
                        <i class="fas fa-chart-bar text-gray-500 group-hover:text-blue-600"></i>
                        <span>Laporan</span>
                    </a>
                    <a href="#" class="nav-item-simple group">
                        <i class="fas fa-cog text-gray-500 group-hover:text-blue-600"></i>
                        <span>Pengaturan</span>
                    </a>
                </div> --}}
            </nav>

            <!-- User Profile & Logout -->
            <div class="border-t border-gray-200 p-4 bg-white">
                <div class="flex items-center mb-4 p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                        A
                    </div>
                    <div class="ml-3 flex-1">
                        <div class="font-semibold text-gray-800">Admin PLN</div>
                        <div class="text-sm text-gray-500">Administrator</div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn w-full">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-50">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    {{-- <div>
                        <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
                        <p class="text-gray-600">Selamat datang di sistem manajemen magang PLN</p>
                    </div> --}}
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <style>
        /* Custom Styles */
        .sidebar-container {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 0.75rem;
            transition: all 0.2s;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .nav-item:hover {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-color: rgba(229, 231, 235, 1);
            transform: translateX(4px);
        }

        .nav-icon-wrapper {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .nav-title {
            display: block;
            font-weight: 600;
            color: rgba(31, 41, 55, 1);
            font-size: 0.875rem;
        }

        .nav-subtitle {
            display: block;
            font-size: 0.75rem;
            color: rgba(107, 114, 128, 1);
            margin-top: 0.125rem;
        }

        .nav-badge {
            background-color: rgba(239, 68, 68, 1);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-weight: 500;
            min-width: 20px;
            text-align: center;
        }

        .nav-item-simple {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .nav-item-simple:hover {
            background-color: white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .nav-item-simple i {
            margin-right: 0.75rem;
            width: 1.25rem;
        }

        .nav-item-simple span {
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(55, 65, 81, 1);
            transition: color 0.2s;
        }

        .nav-item-simple:hover span {
            color: rgba(37, 99, 235, 1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1rem;
            background: linear-gradient(to right, rgba(239, 68, 68, 1), rgba(220, 38, 38, 1));
            color: white;
            border-radius: 0.75rem;
            font-weight: 500;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: linear-gradient(to right, rgba(220, 38, 38, 1), rgba(185, 28, 28, 1));
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar-container {
                width: 100%;
                position: fixed;
                top: 0;
                left: -100%;
                z-index: 50;
                height: 100vh;
            }

            .sidebar-container.mobile-open {
                left: 0;
            }
        }

        /* Scrollbar Styling */
        .sidebar-container::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-container::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.3);
            border-radius: 2px;
        }

        .sidebar-container::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.5);
        }
    </style>

    <script>
        // Add some interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add active state management
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                const href = item.getAttribute('href');
                if (href && currentPath.includes(href.replace(window.location.origin, ''))) {
                    item.style.backgroundColor = 'rgba(239, 246, 255, 1)';
                    item.style.borderColor = 'rgba(191, 219, 254, 1)';
                    const title = item.querySelector('.nav-title');
                    if (title) {
                        title.style.color = 'rgba(29, 78, 216, 1)';
                    }
                }
            });
        });
    </script>
</body>
</html>