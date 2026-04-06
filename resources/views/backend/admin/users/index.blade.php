@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Daftar User</h1>
        <p class="text-sm text-slate-600">Kelola akun pengguna sistem SPPG</p>
    </div>

    <div class="mb-6">
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
            + Tambah User
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">No</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Username</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Role</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-slate-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $user->username }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-cyan-700 hover:text-cyan-800 font-medium text-sm">
                                    Edit
                                </a>

                                <button type="button" class="text-red-600 hover:text-red-700 font-medium text-sm" onclick="openDeleteModal('{{ $user->id }}', '{{ $user->username }}')">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full mx-4">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Hapus User</h3>
            <p class="text-slate-600 mb-6">Anda yakin ingin menghapus user <span id="deleteUsername" class="font-semibold text-slate-900"></span>? Tindakan ini tidak dapat dibatalkan.</p>

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
    function openDeleteModal(userId, username) {
        document.getElementById('deleteUsername').textContent = username;
        document.getElementById('deleteForm').action = `/backend/admin/users/${userId}`;
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

