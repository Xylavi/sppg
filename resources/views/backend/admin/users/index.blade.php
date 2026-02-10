@extends('layouts.backend')

@section('content')
<div class="p-6">
    <h1 class="mb-4 text-2xl font-bold">Daftar User</h1>

    <a href="{{ route('admin.users.create') }}" class="inline-block px-4 py-2 mb-4 text-white bg-green-600 rounded">
        + Tambah User
    </a>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">No</th>
                <th class="p-2 border">Username</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="p-2 border">{{ $loop->iteration }}</td>
                <td class="p-2 border">{{ $user->username }}</td>
                <td class="p-2 border">{{ $user->role }}</td>
                <td class="flex gap-2 p-2 border">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">
                        Edit
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-red-600 hover:underline">
                            Hapus
                        </button>
                    </form>
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

