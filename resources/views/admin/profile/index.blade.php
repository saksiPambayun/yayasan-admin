@extends('admin.layout')

@section('title', 'Profil Admin')
@section('page-title', 'Profil Admin')

@section('content')
    {{-- REVISI: Menggunakan variabel $user yang sudah dicek --}}
    @php
        $user = auth()->user();
    @endphp

    @if($user)
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="card p-8 lg:col-span-1">
                    <div class="text-center">
                        <div
                            class="w-32 h-32 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4 shadow-lg">
                            {{ substr($user->name, 0, 2) }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-gray-500 mt-1">{{ ucfirst($user->role) }}</p>
                        <p class="text-gray-500 text-sm mt-2">{{ $user->email }}</p>
                        <p class="text-gray-500 text-sm">{{ $user->phone ?? '-' }}</p>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-500">Bergabung</span>
                                <span class="font-medium">{{ $user->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Last Login</span>
                                <span class="font-medium">{{ $user->updated_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-8 lg:col-span-2">
                    <h4 class="text-lg font-bold text-gray-900 mb-6">Edit Profil</h4>
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email (Info Kontak)</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div class="card p-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-6">
                        <i class="fas fa-key mr-2 text-indigo-600"></i>Ganti Password
                    </h4>
                    <form action="{{ route('admin.profile.change-password') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama</label>
                                <input type="password" name="current_password"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('current_password') border-red-500 @enderror">
                                @error('current_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <input type="password" name="password"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                            </div>
                        </div>
                        <button type="submit" class="btn-primary mt-6 px-6 py-3 rounded-lg text-white font-medium w-full">
                            <i class="fas fa-lock mr-2"></i>Update Password
                        </button>
                    </form>
                </div>

                <div class="card p-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-6">
                        <i class="fas fa-envelope mr-2 text-indigo-600"></i>Ganti Email Login
                    </h4>
                    <form action="{{ route('admin.profile.change-email') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Baru</label>
                                <input type="email" name="email"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Konfirmasi</label>
                                <input type="password" name="password"
                                    class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn-primary mt-6 px-6 py-3 rounded-lg text-white font-medium w-full">
                            <i class="fas fa-envelope mr-2"></i>Update Email
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        {{-- REVISI: Tampilan jika belum login --}}
        <div class="text-center py-12">
            <div class="bg-white p-8 rounded-lg shadow-md max-w-md mx-auto">
                <i class="fas fa-user-shield text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 mb-6 font-medium">Sesi Anda telah berakhir atau Anda belum login.</p>
                <a href="{{ route('login') }}" class="btn-primary px-8 py-3 rounded-lg text-white inline-block">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login Sekarang
                </a>
            </div>
        </div>
    @endif
@endsection
