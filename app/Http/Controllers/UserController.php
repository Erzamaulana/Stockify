<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Events\ActivityOccurred; // Import event

class UserController extends Controller
{
    protected $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }
    
    // Menampilkan form tambah pengguna
    public function create()
    {
        return view('admin.users.create');
    }
    
    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|string',
        ]);
        
        // Buat pengguna baru dan ambil data pengguna yang baru dibuat
        $user = $this->userService->createUser($validated);
        
        // Dispatch event untuk mencatat aktivitas pembuatan pengguna
        event(new ActivityOccurred(
            auth()->id(),
            "Membuat Pengguna",
            "Pengguna {$user->name} berhasil ditambahkan."
        ));
        
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
    
    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = $this->userService->getUser($id);
        return view('admin.users.edit', compact('user'));
    }
    
    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|string',
        ]);
        
        // Update data pengguna dan ambil data pengguna yang telah diperbarui
        $user = $this->userService->updateUser($id, $validated);
        
        // Dispatch event untuk mencatat aktivitas pembaruan pengguna
        event(new ActivityOccurred(
            auth()->id(),
            "Memperbarui Pengguna",
            "Pengguna {$user->name} berhasil diperbarui."
        ));
        
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }
    
    // Menghapus pengguna
    public function destroy($id)
    {
        // Ambil data pengguna terlebih dahulu untuk keperluan logging
        $user = $this->userService->getUser($id);
        $this->userService->deleteUser($id);
        
        // Dispatch event untuk mencatat aktivitas penghapusan pengguna
        event(new ActivityOccurred(
            auth()->id(),
            "Menghapus Pengguna",
            "Pengguna {$user->name} berhasil dihapus."
        ));
        
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
