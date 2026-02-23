@extends('layouts.backend')

@section('content')
<h1 class="mb-4 text-2xl font-bold">Dashboard Petugas Gizi</h1>

<a href="{{ route('gizi.menus.index') }}"
    class="px-4 py-2 text-white bg-blue-600 rounded">
    Kelola Menu & Gizi
</a>
@endsection
