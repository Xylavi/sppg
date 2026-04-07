@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Data Sekolah Penerima MBG</h1>
        <p class="text-sm text-slate-600">Kelola daftar sekolah penerima dana Makanan Bergizi Gratis</p>
    </div>

    @if (session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('admin.schools.create') }}" class="inline-flex items-center rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
            + Tambah Sekolah
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">No</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Nama Sekolah</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Alamat</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($schools as $school)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-slate-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $school->nama_sekolah }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $school->alamat }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.schools.edit', $school) }}" class="text-cyan-700 hover:text-cyan-800 font-medium text-sm">
                                    Edit
                                </a>

                                <button type="button" class="text-red-600 hover:text-red-700 font-medium text-sm" onclick="openDeleteModal('{{ $school->id }}', '{{ $school->nama_sekolah }}')">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                            Belum ada data sekolah. <a href="{{ route('admin.schools.create') }}" class="text-cyan-700 hover:underline">Tambah sekolah</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full mx-4">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Hapus Sekolah</h3>
            <p class="text-slate-600 mb-6">Anda yakin ingin menghapus sekolah <span id="deleteSchoolName" class="font-semibold text-slate-900"></span>? Tindakan ini tidak dapat dibatalkan.</p>

            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(schoolId, schoolName) {
        document.getElementById('deleteSchoolName').textContent = schoolName;
        document.getElementById('deleteForm').action = `/backend/admin/schools/${schoolId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'deleteModal') {
            closeDeleteModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
            closeDeleteModal();
        }
    });
</script>
@endsection
