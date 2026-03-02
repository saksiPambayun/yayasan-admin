@extends('admin.layout')

@section('title', 'Data SK')
@section('page-title', 'Data Surat Keputusan')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Data Surat Keputusan (SK)</h3>
            <p class="text-gray-500 text-sm mt-1">Kelola dokumen SK yayasan</p>
        </div>
        <a href="{{ route('admin.sk.create') }}"
            class="btn-primary px-6 py-2 rounded-lg text-white font-medium inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah SK
        </a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nomor SK</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tentang</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">File</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($sk as $item)
                        <tr class="table-row">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->nomor_sk }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item->tentang }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $item->tanggal_sk ? $item->tanggal_sk->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->file_sk)
                                    <a href="{{ asset('storage/' . $item->file_sk) }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-900 text-sm">
                                        <i class="fas fa-file-pdf mr-1"></i>{{ basename($item->file_sk) }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.sk.show', $item->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-3" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.sk.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-3"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.sk.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-file-signature text-4xl mb-2 text-gray-300"></i>
                                <p>Belum ada data SK</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-200">
            {{ $sk->links() }}
        </div>
    </div>
@endsection