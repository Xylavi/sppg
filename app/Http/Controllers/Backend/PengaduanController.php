<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function dashboard(): View
    {
        // Get statistics
        $totalComplaints = Complaint::count();
        $newComplaints = Complaint::where('status', 'terkirim')->count();
        $readComplaints = Complaint::where('status', 'dibaca')->count();
        $inProgressComplaints = Complaint::where('status', 'diproses')->count();
        $resolvedComplaints = Complaint::where('status', 'selesai')->count();

        // Get complaints by category
        $complaintsByCategory = Complaint::selectRaw('kategori, COUNT(*) as count')
            ->groupBy('kategori')
            ->get();

        // Get recent complaints
        $recentComplaints = Complaint::latest()
            ->limit(5)
            ->get();

        // Get average resolution time (in days)
        $avgResolutionDays = Complaint::where('status', 'selesai')
            ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
            ->value('avg_days') ?? 0;

        return view('backend.pengaduan.dashboard', [
            'totalComplaints' => $totalComplaints,
            'newComplaints' => $newComplaints,
            'readComplaints' => $readComplaints,
            'inProgressComplaints' => $inProgressComplaints,
            'resolvedComplaints' => $resolvedComplaints,
            'complaintsByCategory' => $complaintsByCategory,
            'recentComplaints' => $recentComplaints,
            'avgResolutionDays' => ceil($avgResolutionDays),
        ]);
    }

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

