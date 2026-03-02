<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Yayasan Management</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f6;
        }

        .sidebar {
            background: linear-gradient(180deg, #4f46e5 0%, #3730a3 100%);
            transition: all 0.3s ease;
        }

        .sidebar-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.15);
            border-left-color: #fff;
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar-item.active {
            background: rgba(255, 255, 255, 0.2);
            border-left-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar-item .icon-wrapper {
            transition: all 0.3s ease;
        }

        .sidebar-item:hover .icon-wrapper {
            transform: scale(1.1);
        }

        .main-content {
            transition: all 0.3s ease;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            transition: all 0.3s ease;
        }

        .stat-card:hover::before {
            width: 6px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: #f9fafb;
            transform: scale(1.01);
        }

        .modal {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 1024px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                position: fixed;
                left: -280px;
                top: 0;
                height: 100vh;
                z-index: 1000;
            }

            .sidebar.open {
                left: 0;
            }

            .main-content {
                margin-left: 0 !important;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .overlay.active {
                display: block;
            }
        }

        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="flex h-screen overflow-hidden">
        <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

        <aside class="sidebar w-72 flex flex-col shadow-2xl" id="sidebar">
            <div class="h-20 flex items-center justify-center border-b border-indigo-400/30 px-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">Admin Yayasan</h1>
                        <p class="text-xs text-indigo-200">Management System</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 px-4">
                <div class="mb-6">
                    <p class="text-xs font-semibold text-indigo-200 uppercase tracking-wider mb-3 px-3">Main Menu</p>
                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-white rounded-lg mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <div
                            class="icon-wrapper w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-3">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="text-xs font-semibold text-indigo-200 uppercase tracking-wider mb-3 px-3">Pendaftaran</p>
                    <a href="{{ route('admin.santri.index') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-indigo-100 rounded-lg mb-1 {{ request()->routeIs('admin.santri.*') ? 'active' : '' }}">
                        <div
                            class="icon-wrapper w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-3">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <span class="font-medium">Data Santri</span>
                        @php
                            // Menggunakan try-catch agar jika tabel belum ada tidak bikin error se-aplikasi
                            try {
                                $pendingCount = \App\Models\SantriRegistration::where('status', 'pending')->count();
                            } catch (\Exception $e) {
                                $pendingCount = 0;
                            }
                        @endphp
                        @if($pendingCount > 0)
                            <span
                                class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </div>

                <div class="mb-6">
                    <p class="text-xs font-semibold text-indigo-200 uppercase tracking-wider mb-3 px-3">Kepegawaian</p>
                    <a href="{{ route('admin.pegawai.index') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-indigo-100 rounded-lg mb-1 {{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
                        <div
                            class="icon-wrapper w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="font-medium">Data Pegawai</span>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="text-xs font-semibold text-indigo-200 uppercase tracking-wider mb-3 px-3">Dokumen Legal
                    </p>
                    <a href="{{ route('admin.sk.index') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-indigo-100 rounded-lg mb-1 {{ request()->routeIs('admin.sk.*') ? 'active' : '' }}">
                        <div
                            class="icon-wrapper w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-3">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <span class="font-medium">Data SK</span>
                    </a>
                    <a href="{{ route('admin.akta-yayasan.index') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-indigo-100 rounded-lg mb-1 {{ request()->routeIs('admin.akta-yayasan.*') ? 'active' : '' }}">
                        <div
                            class="icon-wrapper w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-3">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <span class="font-medium">Akta Yayasan</span>
                    </a>
                    <a href="{{ route('admin.akta-wakaf.index') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-indigo-100 rounded-lg mb-1 {{ request()->routeIs('admin.akta-wakaf.*') ? 'active' : '' }}">
                        <div
                            class="icon-wrapper w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-3">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <span class="font-medium">Akta Wakaf</span>
                    </a>
                </div>

                <div>
                    <p class="text-xs font-semibold text-indigo-200 uppercase tracking-wider mb-3 px-3">Pengaturan</p>
                    <a href="{{ route('admin.profile') }}"
                        class="sidebar-item flex items-center px-4 py-3 text-indigo-100 rounded-lg mb-1 {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <div
                            class="icon-wrapper w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-3">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <span class="font-medium">Profil Admin</span>
                    </a>
                </div>
            </nav>

            <div class="p-4 border-t border-indigo-400/30">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-3 text-red-200 hover:text-white transition rounded-lg hover:bg-white/10">
                        <div class="w-10 h-10 rounded-lg bg-red-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <header class="bg-white shadow-sm h-20 flex items-center justify-between px-8 sticky top-0 z-50">
                <div class="flex items-center space-x-4">
                    <button class="mobile-menu-btn p-2 rounded-lg hover:bg-gray-100" onclick="toggleSidebar()">
                        <i class="fas fa-bars text-gray-600 text-xl"></i>
                    </button>
                    <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <button class="p-2 rounded-lg hover:bg-gray-100 relative">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ auth()->user()?->name ?? 'Administrator' }}
                            </p>
                            <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()?->role ?? 'Admin') }}</p>
                        </div>
                        <div
                            class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg">
                            {{ substr(auth()->user()?->name ?? 'AD', 0, 2) }}
                        </div>
                    </div>
                </div>
            </header>

            <div class="container mx-auto px-8 py-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg relative mb-6"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                            <i class="fas fa-times cursor-pointer"></i>
                        </span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg relative mb-6"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                            <i class="fas fa-times cursor-pointer"></i>
                        </span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('active');
        }

        function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
            return confirm(message);
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function () {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>

</html>
