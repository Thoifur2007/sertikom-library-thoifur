<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }
    /**
     * Tampilkan daftar pengguna.
     */
    public function index()
    {
        $users = User::all(); // Ambil semua pengguna
        return view('user.index', compact('users')); // Kirim data ke view
    }

    /**
     * Aktifkan pengguna.
     */
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['active' => true]); // Mengaktifkan user
        return redirect()->route('user.index')->with('success', 'User activated successfully!');
    }

    /**
     * Jadikan pengguna sebagai admin.
     */
    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => 'admin']); // Set role pengguna menjadi admin
        return redirect()->route('user.index')->with('success', 'User has been promoted to admin!');
    }

    /**
     * Hapus status admin dari pengguna.
     */
    public function removeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => 'anggota']); // Kembalikan role pengguna ke anggota
        return redirect()->route('user.index')->with('success', 'Admin rights removed from user!');
    }
    /**
 * Tampilkan form untuk mengedit pengguna.
 */
public function edit($id)
{
    $user = User::findOrFail($id); // Ambil data pengguna berdasarkan ID
    return view('user.edit', compact('user')); // Kirim data pengguna ke view
}

/**
 * Update data pengguna.
 */
public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:4',
    ]);

    $user = User::findOrFail($id); // Ambil data pengguna berdasarkan ID

    // Update data pengguna
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? bcrypt($request->password) : $user->password, // Jika password tidak kosong, enkripsi dan update
    ]);

    return redirect()->route('user.index')->with('success', 'User updated successfully!');
}
/**
 * Hapus pengguna.
 */
public function destroy($id)
{
    $user = User::findOrFail($id); // Ambil data pengguna berdasarkan ID

    // Pastikan pengguna yang dihapus bukan admin
    if ($user->role === 'admin') {
        return redirect()->route('user.index')->with('error', 'Cannot delete an admin user.');
    }

    $user->delete(); // Hapus pengguna dari database

    return redirect()->route('user.index')->with('success', 'User deleted successfully!');
}


}
