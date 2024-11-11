<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Dokter;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        $userRole = Auth::user()->getRoleNames()->first();
        $dokters = Dokter::all();
        return Inertia::render('Dokter/Index', [
            'dokters' => $dokters,
        ]);
    }

    public function create()
    {
        return Inertia::render('Dokter/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:dokters',
            'specialty' => 'required|string',
            'phone' => 'required|string',
        ]);

        Dokter::create($validated);

        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return Inertia::render('Dokter/Edit', [
            'dokter' => $dokter
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:dokters,email,' . $id,
            'specialty' => 'required|string',
            'phone' => 'required|string',
        ]);

        $dokter = Dokter::findOrFail($id);
        $dokter->update($validated);

        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil dihapus');
    }
}
