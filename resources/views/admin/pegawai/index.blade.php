@extends('admin.layout')

@section('title', 'Data Pegawai')
@section('page-title', 'Data Pegawai')

@section('content')

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-800">Daftar Pegawai</h2>

        <a href="{{ route('admin.pegawai.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            + Tambah Pegawai
        </a>
    </div>

    <div class="card p-6">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">No</th>
                    <th class="p-3">NIP</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Jabatan</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pegawai as $key => $p)
                    <tr class="border-b">
                        <td class="p-3">{{ $key + 1 }}</td>
                        <td class="p-3">{{ $p->nip }}</td>
                        <td class="p-3">{{ $p->nama }}</td>
                        <td class="p-3">{{ $p->jabatan }}</td>
                        <td class="p-3">{{ $p->status ?? '-' }}</td>

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.pegawai.show', $p->id) }}" class="text-blue-600">Detail</a>

                            <a href="{{ route('admin.pegawai.edit', $p->id) }}" class="text-yellow-600">Edit</a>

                            <form action="{{ route('admin.pegawai.destroy', $p->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center p-6 text-gray-500">
                            Belum ada data pegawai
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
