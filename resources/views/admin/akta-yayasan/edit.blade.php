@extends('admin.layout')

@section('title', 'Edit Akta Yayasan')
@section('page-title', 'Edit Akta Yayasan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <form action="{{ route('admin.akta-yayasan.update', $aktaYayasan->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Akta</label>
                        <input type="text" name="nomor_akta" value="{{ old('nomor_akta', $aktaYayasan->nomor_akta) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akta</label>
                        <input type="date" name="tanggal_akta" value="{{ old('tanggal_akta', $aktaYayasan->tanggal_akta) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notaris</label>
                        <input type="text" name="notaris" value="{{ old('notaris', $aktaYayasan->notaris) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload File Akta (Kosongkan jika tidak
                            diubah)</label>
                        <input type="file" name="file_akta" accept=".pdf,.doc,.docx"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                        @if($aktaYayasan->file_akta)
                            <p class="text-xs text-gray-500 mt-1">File saat ini: {{ basename($aktaYayasan->file_akta) }}</p>
                            <a href="{{ asset('storage/' . $aktaYayasan->file_akta) }}" target="_blank"
                                class="text-indigo-600 text-xs hover:underline">
                                <i class="fas fa-download mr-1"></i>Download File
                            </a>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX (Max: 5MB)</p>
                        @error('file_akta')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.akta-yayasan.index') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection