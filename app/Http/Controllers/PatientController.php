<?php

namespace App\Http\Controllers;


use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


use Inertia\Inertia;

class PatientController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:admin');
    // }

    // Method untuk menampilkan data pasien
    public function index()
    {
        // Ambil semua data pasien
        $patients = Patient::all();

        // Kirim data pasien ke view menggunakan Inertia
        return Inertia::render('Patients/Index', [
            'patients' => $patients,
        ]);
    }


    public function create()
    {
        // Cek apakah user sudah memiliki data pasien
        $existingPatient = Patient::where('user_id', Auth::id())->first();
        if ($existingPatient) {
            return redirect()->route('patients.show', $existingPatient->id)
                             ->with('error', 'Anda sudah memiliki data pasien.');
        }

        return Inertia::render('Patients/Create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'medical_history' => 'nullable|string',
        ]);

        // Simpan data pasien yang terkait dengan user yang sedang login
        $patient = new Patient();
        $patient->user_id = Auth::id();  // Pastikan data pasien terhubung dengan user yang login
        $patient->name = $request->name;
        $patient->address = $request->address;
        $patient->phone = $request->phone;
        $patient->medical_history = $request->medical_history;
        $patient->save();

        // Redirect ke halaman create dengan pesan sukses
        return redirect()->route('patients.create')
                         ->with('success', 'Data pasien berhasil disimpan.');
    }


    public function show($patientId)
    {
        // Ambil data pasien berdasarkan ID yang ada di URL
        $patient = Patient::where('user_id', Auth::id())
                         ->where('id', $patientId)
                         ->first();

        // Jika pasien tidak ditemukan, arahkan ke halaman create dengan pesan error
        if (!$patient) {
            return redirect()->route('patients.create')->with('error', 'Anda belum memiliki data pasien.');
        }

        // Tampilkan data pasien
        return Inertia::render('Patients/Show', [
            'patient' => $patient,
        ]);
    }


    public function edit($patientId)
{
    // Ambil data pasien yang akan diedit berdasarkan ID yang ada di URL
    $patient = Patient::where('user_id', Auth::id())
                     ->where('id', $patientId)
                     ->first();

    // Jika pasien tidak ditemukan, arahkan ke halaman create
    if (!$patient) {
        return redirect()->route('patients.create');
    }

    // Tampilkan halaman edit dengan data pasien
    return Inertia::render('Patients/Edit', [
        'patient' => $patient,
    ]);
}

public function update(Request $request, $patientId)
{
    // Validasi data yang diterima
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:15',
        'medical_history' => 'nullable|string',
    ]);

    // Ambil data pasien berdasarkan ID yang ada di URL
    $patient = Patient::where('user_id', Auth::id())
                     ->where('id', $patientId)
                     ->first();

    // Jika pasien tidak ditemukan, arahkan ke halaman create
    if (!$patient) {
        return redirect()->route('patients.create');
    }

    // Perbarui data pasien
    $patient->name = $request->name;
    $patient->address = $request->address;
    $patient->phone = $request->phone;
    $patient->medical_history = $request->medical_history;
    $patient->save();

    // Redirect ke halaman show dengan pesan sukses
    return redirect()->route('patients.show', $patient->id)
                     ->with('success', 'Data pasien berhasil diperbarui.');
}




}


