@extends('admin.layout')

@section('title', 'Edit SK')
@section('page-title', 'Edit Data SK')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <form action="{{ route('admin.sk.update', $sk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor SK <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nomor_sk" value="{{ old('nomor_sk', $sk->nomor_sk) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('nomor_sk') border-red-500 @enderror"
                            required>
                        @error('nomor_sk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal SK</label>
                        <input type="date" name="tanggal_sk" value="{{ old('tanggal_sk', $sk->tanggal_sk) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tentang</label>
                        <input type="text" name="tentang" value="{{ old('tentang', $sk->tentang) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload File SK (Kosongkan jika tidak
                            diubah)</label>
                        <input type="file" name="file_sk" accept=".pdf,.doc,.docx"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                        @if($sk->file_sk)
                            <p class="text-xs text-gray-500 mt-1">File saat ini: {{ basename($sk->file_sk) }}</p>
                            <a href="{{ asset('storage/' . $sk->file_sk) }}" target="_blank"
                                class="text-indigo-600 text-xs hover:underline">
                                <i class="fas fa-download mr-1"></i>Download File
                            </a>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX (Max: 5MB)</p>
                        @error('file_sk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.sk.index') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection