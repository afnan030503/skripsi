<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    // Tampilkan home dengan menu dari database
    public function index()
    {
        try {
            $categories = Category::with([
                'subcategories.menus' => function ($query) {
                    $query->where('is_available', true)->orderBy('name');
                }
            ])->orderBy('order')->get();

            $formatted = $categories->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'subcategories' => $cat->subcategories->map(function ($sub) {
                        return [
                            'id' => $sub->id,
                            'name' => $sub->name,
                            'menus' => $sub->menus->map(function ($menu) {
                                return [
                                    'id' => $menu->id,
                                    'name' => $menu->name,
                                    'price' => (float)$menu->price,
                                    'description' => $menu->description,
                                    'image' => $menu->image,
                                ];
                            })->toArray()
                        ];
                    })->toArray()
                ];
            })->toArray();

            return Inertia::render('Home', ['categories' => $formatted]);
        } catch (\Exception $e) {
            \Log::error('MenuController@index error: ' . $e->getMessage());
            return Inertia::render('Home', ['categories' => []]);
        }
    }

    // Tambah menu baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Validasi subcategory milik category
        if (!Subcategory::where('id', $validated['subcategory_id'])
            ->where('category_id', $validated['category_id'])->exists()) {
            return redirect()->back()->withErrors(['subcategory_id' => 'Subcategory tidak sesuai dengan Category'])->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu-images', 'public');
        }

        Menu::create([
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'is_available' => true,
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
    }

    // Update menu
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Validasi subcategory milik category
        if (!Subcategory::where('id', $validated['subcategory_id'])
            ->where('category_id', $validated['category_id'])->exists()) {
            return redirect()->back()->withErrors(['subcategory_id' => 'Subcategory tidak sesuai dengan Category'])->withInput();
        }

        $data = [
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image) {
                \Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menu-images', 'public');
        }

        $menu->update($data);

        return redirect()->back()->with('success', 'Menu berhasil diperbarui!');
    }

    // Hapus menu
    public function destroy(Menu $menu)
    {
        try {
            if ($menu->image) {
                \Storage::disk('public')->delete($menu->image);
            }

            $menu->delete();

            return redirect()->back()->with('success', 'Menu berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus menu');
        }
    }
   public function adminMenuPage()
{
    $foodsCategoryId = 1;
    $drinksCategoryId = 2;

    $foodsMenus = Menu::where('category_id', $foodsCategoryId)
        ->where('is_available', true)
        ->get();

    $drinksMenus = Menu::where('category_id', $drinksCategoryId)
        ->where('is_available', true)
        ->get();

    // 🔥 Tambahkan ini
    $foodsSubcategories = Subcategory::where('category_id', $foodsCategoryId)
        ->orderBy('order')
        ->get();

    $drinksSubcategories = Subcategory::where('category_id', $drinksCategoryId)
        ->orderBy('order')
        ->get();

    $totalSubcategories = $foodsSubcategories->count() + $drinksSubcategories->count();

    return Inertia::render('HomeAdmin', [
        'foodsMenus' => $foodsMenus,
        'drinksMenus' => $drinksMenus,
        'foodsSubcategories' => $foodsSubcategories,
        'drinksSubcategories' => $drinksSubcategories,
        'totalSubcategories' => $totalSubcategories, // kirim ke frontend
    ]);
}


}
