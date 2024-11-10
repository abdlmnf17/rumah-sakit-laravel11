<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->get();
        return Inertia::render('Users/Index', [
            'users' => $users
        ]);

    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'array']
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['roles']);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dibuat.');
    }


    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles
            ],
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => $request->password ? ['string', 'min:8', 'confirmed'] : '',
            'roles' => ['required', 'array']
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($validated['password'])
            ]);
        }

        // Sync roles
        $user->syncRoles($validated['roles']);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
{
    try {
        // Menghapus user
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    } catch (\Exception $e) {
        // Jika terjadi kesalahan, redirect dengan pesan error
        return redirect()->route('users.index')
            ->with('error', 'Gagal menghapus user: ' . $e->getMessage());
    }
}


}
