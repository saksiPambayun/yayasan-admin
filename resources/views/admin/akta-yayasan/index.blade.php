@extends('admin.layout')

@section('title', 'Akta Yayasan')
@section('page-title', 'Dokumen Akta Yayasan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Akta Yayasan</h3>
            <p class="text-gray-500 text-sm">Daftar dokumen legalitas yayasan</p>
        </div>
        <a href="{{ route('admin.akta-yayasan.create') }}" class="btn-primary px-6 py-2 rounded-lg text-white font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Akta
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($aktaYayasan as $item)
            <div class="card p-6 border-t-4 border-purple-600">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                        <i class="fas fa-gavel text-xl"></i>
                    </div>
                    <span class="text-xs font-mono text-gray-400">#{{ $item->id }}</span>
                </div>
                <h4 class="text-lg font-bold text-gray-900 leading-tight mb-2">{{ $item->nama_akta }}</h4>
                <p class="text-sm text-gray-500 mb-1"><span class="font-semibold">No:</span> {{ $item->nomor_akta }}</p>
                <p class="text-sm text-gray-500 mb-4"><span class="font-semibold">Notaris:</span> {{ $item->notaris ?? '-' }}
                </p>

                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    @if($item->file_akta)
                        <a href="{{ asset('storage/' . $item->file_akta) }}" target="_blank"
                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                            <i class="fas fa-download mr-1"></i> Lihat File
                        </a>
                    @else
                        <span class="text-gray-400 text-sm italic">No File</span>
                    @endif

                    <div class="flex space-x-2">
                        <a href="{{ route('admin.akta-yayasan.edit', $item->id) }}" class="text-gray-400 hover:text-blue-600"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.akta-yayasan.destroy', $item->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 card p-12 text-center text-gray-500">
                <p>Belum ada data Akta Yayasan.</p>
            </div>
        @endforelse
    </div>
@endsection
