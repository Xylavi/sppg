<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of schools.
     */
    public function index(): View
    {
        $schools = School::all();

        return view('backend.admin.schools.index', [
            'schools' => $schools,
        ]);
    }

    /**
     * Show the form for creating a new school.
     */
    public function create(): View
    {
        return view('backend.admin.schools.create');
    }

    /**
     * Store a newly created school.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        School::create($validated);

        return redirect()
            ->route('admin.schools.index')
            ->with('success', 'Sekolah berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a school.
     */
    public function edit(School $school): View
    {
        return view('backend.admin.schools.edit', [
            'school' => $school,
        ]);
    }

    /**
     * Update the school.
     */
    public function update(Request $request, School $school): RedirectResponse
    {
        $validated = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        $school->update($validated);

        return redirect()
            ->route('admin.schools.index')
            ->with('success', 'Sekolah berhasil diperbarui.');
    }

    /**
     * Delete the school.
     */
    public function destroy(School $school): RedirectResponse
    {
        $school->delete();

        return redirect()
            ->route('admin.schools.index')
            ->with('success', 'Sekolah berhasil dihapus.');
    }
}
