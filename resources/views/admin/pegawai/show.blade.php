@extends('admin.layout')

@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Data Pegawai')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                        {{ substr($pegawai->nama, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $pegawai->nama }}</h3>
                        <p class="text-gray-500">NIP: {{ $pegawai->nip }}</p>
                        @if($pegawai->status == 'aktif')
                            <span class="badge badge-success mt-2">Aktif</span>
                        @elseif($pegawai->status == 'cuti')
                            <span class="badge badge-pending mt-2">Cuti</span>
                        @else
                            <span class="badge badge-danger mt-2">Nonaktif</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Jabatan</p>
                    <p class="font-medium text-gray-900">{{ $pegawai->jabatan ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Divisi</p>
                    <p class="font-medium text-gray-900">{{ $pegawai->divisi ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Tanggal Bergabung</p>
                    <p class="font-medium text-gray-900">
                        {{ $pegawai->tanggal_bergabung ? $pegawai->tanggal_bergabung->format('d M Y') : '-' }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="border border-gray-200 rounded-lg p-4">
                    <p class="text-sm text-gray-500 mb-2 font-medium">KTP</p>
                    @if($pegawai->foto_ktp)
                        <img src="{{ asset('storage/' . $pegawai->foto_ktp) }}" alt="KTP"
                            class="w-full h-48 object-cover rounded">
                    @else
                        <div class="bg-gray-100 h-48 rounded flex items-center justify-center">
                            <i class="fas fa-id-card text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                </div>
                <div class="border border-gray-200 rounded-lg p-4">
                    <p class="text-sm text-gray-500 mb-2 font-medium">NPWP</p>
                    @if($pegawai->foto_npwp)
                        <img src="{{ asset('storage/' . $pegawai->foto_npwp) }}" alt="NPWP"
                            class="w-full h-48 object-cover rounded">
                    @else
                        <div class="bg-gray-100 h-48 rounded flex items-center justify-center">
                            <i class="fas fa-file-invoice text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="{{ route('admin.pegawai.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div class="space-x-3">
                    <a href="{{ route('admin.pegawai.edit', $pegawai->id) }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection