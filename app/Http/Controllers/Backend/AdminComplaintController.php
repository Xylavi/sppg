<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminComplaintController extends Controller
{
    /**
     * Display a listing of all complaints for admin monitoring.
     */
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $kategori = $request->string('kategori')->toString();

        $complaints = Complaint::query()
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->when($kategori !== '', fn ($query) => $query->where('kategori', $kategori))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statuses = ['terkirim', 'dibaca', 'diproses', 'selesai'];
        $categories = Complaint::select('kategori')->distinct()->pluck('kategori');

        return view('backend.admin.complaints.index', [
            'complaints' => $complaints,
            'selectedStatus' => $status,
            'selectedKategori' => $kategori,
            'statuses' => $statuses,
            'categories' => $categories,
        ]);
    }

    /**
     * Display complaint statistics.
     */
    public function statistics(): View
    {
        $totalComplaints = Complaint::count();
        $complaintsByStatus = Complaint::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->keyBy('status');
        $complaintsByCategory = Complaint::selectRaw('kategori, count(*) as count')
            ->groupBy('kategori')
            ->get();

        return view('backend.admin.complaints.statistics', [
            'totalComplaints' => $totalComplaints,
            'complaintsByStatus' => $complaintsByStatus,
            'complaintsByCategory' => $complaintsByCategory,
        ]);
    }

    /**
     * Show complaint detail for admin.
     */
    public function show(Complaint $complaint): View
    {
        return view('backend.admin.complaints.show', [
            'complaint' => $complaint,
        ]);
    }
}
