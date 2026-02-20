@extends('layouts.frontend')

@section('title', 'SPPG | Riwayat Menu')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Riwayat Menu MBG</h1>
        <p class="mt-2 text-slate-600">Gunakan filter tanggal, bulan, dan sekolah tanpa reload halaman.</p>
    </section>

    <section class="mb-6 grid gap-4 rounded-xl border border-slate-200 bg-white p-4 md:grid-cols-3">
        <label class="text-sm font-medium text-slate-700">Tanggal
            <input id="filter-date" type="date" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2">
        </label>
        <label class="text-sm font-medium text-slate-700">Bulan
            <input id="filter-month" type="month" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2">
        </label>
        <label class="text-sm font-medium text-slate-700">Sekolah
            <select id="filter-school" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2">
                <option value="">Semua sekolah</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->nama_sekolah }}">{{ $school->nama_sekolah }}</option>
                @endforeach
            </select>
        </label>
    </section>

    <section id="menu-list" class="grid gap-4 md:grid-cols-2">
        @forelse($menus as $menu)
            <article class="menu-item rounded-xl border border-slate-200 bg-white p-4 shadow-sm" data-date="{{ $menu->tanggal_menu->format('Y-m-d') }}"
                data-month="{{ $menu->tanggal_menu->format('Y-m') }}" data-school="{{ $menu->school?->nama_sekolah }}">
                <h2 class="text-lg font-semibold">{{ $menu->nama_menu }}</h2>
                <p class="text-sm text-slate-600">{{ $menu->tanggal_menu->translatedFormat('d F Y') }}</p>
                <p class="text-sm text-slate-600">{{ $menu->school?->nama_sekolah ?? '-' }}</p>
            </article>
        @empty
            <p class="text-slate-500">Belum ada riwayat menu.</p>
        @endforelse
    </section>

    <p id="empty-filter-state" class="mt-4 hidden rounded-lg border border-dashed border-slate-300 bg-white p-4 text-sm text-slate-500">
        Tidak ada data yang sesuai dengan filter.
    </p>

    <script>
        const dateInput = document.getElementById('filter-date');
        const monthInput = document.getElementById('filter-month');
        const schoolInput = document.getElementById('filter-school');
        const items = document.querySelectorAll('.menu-item');
        const emptyFilterState = document.getElementById('empty-filter-state');

        const applyFilter = () => {
            const date = dateInput.value;
            const month = monthInput.value;
            const school = schoolInput.value;
            let visibleCount = 0;

            items.forEach((item) => {
                const matchDate = !date || item.dataset.date === date;
                const matchMonth = !month || item.dataset.month === month;
                const matchSchool = !school || item.dataset.school === school;
                const isVisible = matchDate && matchMonth && matchSchool;

                item.classList.toggle('hidden', !isVisible);

                if (isVisible) {
                    visibleCount += 1;
                }
            });

            const hasActiveFilter = Boolean(date || month || school);
            emptyFilterState.classList.toggle('hidden', !(hasActiveFilter && visibleCount === 0));
        };

        [dateInput, monthInput, schoolInput].forEach((el) => {
            el.addEventListener('input', applyFilter);
            el.addEventListener('change', applyFilter);
        });
    </script>
@endsection
