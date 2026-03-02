@extends('admin.layout')

@section('title', 'Edit Pegawai')
@section('page-title', 'Edit Data Pegawai')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card p-8">
            <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <h4 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informasi Pribadi</h4>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIP <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nip" value="{{ old('nip', $pegawai->nip) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('nip') border-red-500 @enderror"
                            required>
                        @error('nip')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('nama') border-red-500 @enderror"
                            required>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Divisi</label>
                        <input type="text" name="divisi" value="{{ old('divisi', $pegawai->divisi) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                            <option value="aktif" {{ old('status', $pegawai->status) == 'aktif' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="cuti" {{ old('status', $pegawai->status) == 'cuti' ? 'selected' : '' }}>Cuti
                            </option>
                            <option value="nonaktif" {{ old('status', $pegawai->status) == 'nonaktif' ? 'selected' : '' }}>
                                Nonaktif</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                        <input type="date" name="tanggal_bergabung"
                            value="{{ old('tanggal_bergabung', $pegawai->tanggal_bergabung) }}"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                    </div>

                    <div class="col-span-2">
                        <h4 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2 mt-4">Upload Dokumen</h4>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload KTP (Kosongkan jika tidak
                            diubah)</label>
                        <input type="file" name="foto_ktp" accept="image/*"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                        @if($pegawai->foto_ktp)
                            <p class="text-xs text-gray-500 mt-1">File saat ini: {{ basename($pegawai->foto_ktp) }}</p>
                        @endif
                        @error('foto_ktp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload NPWP (Kosongkan jika tidak
                            diubah)</label>
                        <input type="file" name="foto_npwp" accept="image/*"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none">
                        @if($pegawai->foto_npwp)
                            <p class="text-xs text-gray-500 mt-1">File saat ini: {{ basename($pegawai->foto_npwp) }}</p>
                        @endif
                        @error('foto_npwp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.pegawai.index') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection