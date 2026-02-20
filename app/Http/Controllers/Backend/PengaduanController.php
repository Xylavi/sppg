<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();

        $complaints = Complaint::query()
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backend.pengaduan.index', [
            'complaints' => $complaints,
            'selectedStatus' => $status,
        ]);
    }

    public function show(Complaint $complaint): View
    {
        return view('backend.pengaduan.show', [
            'complaint' => $complaint,
        ]);
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:terkirim,dibaca,diproses,selesai'],
            'catatan_tindak_lanjut' => ['nullable', 'string'],
        ]);

        $complaint->update($validated);

        return redirect()
            ->route('backend.pengaduan.show', $complaint)
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
