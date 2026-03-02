@extends('admin.layout')

@section('title', 'Detail Akta Wakaf')
@section('page-title', 'Detail Akta Wakaf')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $aktaWakaf->nomor_sertifikat ?? 'Sertifikat Wakaf' }}
                    </h3>
                    <p class="text-gray-500 mt-1">Dokumen Sertifikat Tanah Wakaf</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Nomor Sertifikat</p>
                    <p class="font-medium text-gray-900">{{ $aktaWakaf->nomor_sertifikat ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Nazhir</p>
                    <p class="font-medium text-gray-900">{{ $aktaWakaf->nazhir ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Lokasi Tanah</p>
                    <p class="font-medium text-gray-900">{{ $aktaWakaf->lokasi_tanah ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Luas Tanah</p>
                    <p class="font-medium text-gray-900">{{ $aktaWakaf->luas_tanah ?? '-' }}</p>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-6 mb-8">
                <h4 class="text-sm text-gray-500 mb-4 font-medium">File Sertifikat</h4>
                @if($aktaWakaf->file_sertifikat)
                    <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-file-pdf text-red-500 text-3xl mr-4"></i>
                            <div>
                                <p class="font-medium text-gray-900">{{ basename($aktaWakaf->file_sertifikat) }}</p>
                                <p class="text-xs text-gray-500">Sertifikat Wakaf</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $aktaWakaf->file_sertifikat) }}" target="_blank"
                            class="btn-primary px-4 py-2 rounded-lg text-white text-sm">
                            <i class="fas fa-download mr-2"></i>Download
                        </a>
                    </div>
                @else
                    <div class="bg-gray-100 p-8 rounded-lg text-center">
                        <i class="fas fa-file text-gray-400 text-4xl mb-2"></i>
                        <p class="text-gray-500">Tidak ada file yang diupload</p>
                    </div>
                @endif
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="{{ route('admin.akta-wakaf.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div class="space-x-3">
                    <a href="{{ route('admin.akta-wakaf.edit', $aktaWakaf->id) }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection