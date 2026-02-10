@extends('layouts.backend')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar User</h1>

    <a href="{{ route('admin.users.create') }}" class="inline-block mb-4 bg-green-600 text-white px-4 py-2 rounded">
        + Tambah User
    </a>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Username</th>
                <th class="border p-2">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="border p-2">{{ $loop->iteration }}</td>
                <td class="border p-2">{{ $user->username }}</td>
                <td class="border p-2">{{ $user->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
