<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Events\ActivityOccurred; // Import event ActivityOccurred

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Tampilkan daftar kategori.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // Buat kategori baru
        $category = $this->categoryService->createCategory($validated);

        // Dispatch event untuk mencatat aktivitas pembuatan kategori
        event(new ActivityOccurred(
            auth()->id(),
            "Membuat Kategori",
            "Kategori '{$category->name}' berhasil ditambahkan."
        ));

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit kategori.
     */
    public function edit($id)
    {
        $category = $this->categoryService->getCategory($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Perbarui data kategori.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        // Update kategori
        $category = $this->categoryService->updateCategory($id, $validated);

        // Dispatch event untuk mencatat aktivitas update kategori
        event(new ActivityOccurred(
            auth()->id(),
            "Memperbarui Kategori",
            "Kategori '{$category->name}' berhasil diperbarui."
        ));

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori.
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);

        // Dispatch event untuk mencatat aktivitas penghapusan kategori
        event(new ActivityOccurred(
            auth()->id(),
            "Menghapus Kategori",
            "Kategori dengan ID {$id} berhasil dihapus."
        ));

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
