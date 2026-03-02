@extends('admin.layout')

@section('title', 'Tambah Pegawai')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <form action="{{ route('admin.pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" name="nip" class="input-field w-full border-gray-300 rounded-lg mt-1" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" class="input-field w-full border-gray-300 rounded-lg mt-1" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <input type="text" name="jabatan" class="input-field w-full border-gray-300 rounded-lg mt-1">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto KTP (Image)</label>
                        <input type="file" name="foto_ktp"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700">
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="btn-primary px-6 py-2 rounded-lg text-white font-medium">Simpan
                        Pegawai</button>
                </div>
            </form>
        </div>
    </div>
@endsection
