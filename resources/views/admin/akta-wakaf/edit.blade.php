@extends('admin.layout')

@section('title', 'Edit Akta Wakaf')
@section('page-title', 'Edit Akta Wakaf')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <form action="{{ route('admin.akta-wakaf.update', $aktaWakaf->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Sertifikat</label>
                        <input type="text" name="nomor_sertifikat"
                            value="{{ old('nomor_sertifikat', $aktaWakaf->nomor_sertifikat) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nazhir</label>
                        <input type="text" name="nazhir" value="{{ old('nazhir', $aktaWakaf->nazhir) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Tanah</label>
                        <input type="text" name="lokasi_tanah" value="{{ old('lokasi_tanah', $aktaWakaf->lokasi_tanah) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah</label>
                        <input type="text" name="luas_tanah" value="{{ old('luas_tanah', $aktaWakaf->luas_tanah) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Sertifikat (Kosongkan jika tidak
                            diubah)</label>
                        <input type="file" name="file_sertifikat" accept=".pdf,.doc,.docx"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                        @if($aktaWakaf->file_sertifikat)
                            <p class="text-xs text-gray-500 mt-1">File saat ini: {{ basename($aktaWakaf->file_sertifikat) }}</p>
                            <a href="{{ asset('storage/' . $aktaWakaf->file_sertifikat) }}" target="_blank"
                                class="text-indigo-600 text-xs hover:underline">
                                <i class="fas fa-download mr-1"></i>Download File
                            </a>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX (Max: 5MB)</p>
                        @error('file_sertifikat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.akta-wakaf.index') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection