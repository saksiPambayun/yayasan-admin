@extends('admin.layout')

@section('title', 'Detail Santri')
@section('page-title', 'Detail Data Santri')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                        {{ substr($santri->nama_lengkap, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $santri->nama_lengkap }}</h3>
                        <p class="text-gray-500">NISN: {{ $santri->nisn ?? '-' }}</p>
                    </div>
                </div>
                <div>
                    @if($santri->status == 'pending')
                        <span class="badge badge-pending text-lg px-4 py-2">Pending</span>
                    @elseif($santri->status == 'diterima')
                        <span class="badge badge-success text-lg px-4 py-2">Diterima</span>
                    @else
                        <span class="badge badge-danger text-lg px-4 py-2">Ditolak</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Asal Sekolah</p>
                    <p class="font-medium text-gray-900">{{ $santri->asal_sekolah }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Tanggal Lahir</p>
                    <p class="font-medium text-gray-900">
                        {{ $santri->tanggal_lahir ? $santri->tanggal_lahir->format('d M Y') : '-' }}
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Email</p>
                    <p class="font-medium text-gray-900">{{ $santri->email ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">No. Wali</p>
                    <p class="font-medium text-gray-900">{{ $santri->no_wali }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                    <p class="text-sm text-gray-500 mb-1">Alamat Lengkap</p>
                    <p class="font-medium text-gray-900">{{ $santri->alamat ?? '-' }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="{{ route('admin.santri.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div class="space-x-3">
                    <a href="{{ route('admin.santri.edit', $santri->id) }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    @if($santri->status == 'pending')
                        <form action="{{ route('admin.santri.verify', $santri->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white">
                                <i class="fas fa-check mr-2"></i>Verifikasi
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection