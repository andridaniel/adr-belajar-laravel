<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{

    public function index(){
    	return view('pages.dashboard');
    }

    public function profile(){
    	return view('pages.profile');
    }


    // function untuk menampilkan data product
    public function products(Request $request)
{
    $jumlahDataPerHalaman = 5;
    $sortingColumn = 'products.id';
    $search = $request->input('search', '');

    if ($request->has('cari')) {
        $keyword = $request->input('keyword_search');
        $products = Product::select('products.*', 'product_categories.category_name')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->where('products.product_name', 'LIKE', "%$keyword%")
            ->orWhere('product_categories.category_name', 'LIKE', "%$keyword%")
            ->orWhere('products.product_code', 'LIKE', "%$keyword%")
            ->orWhere('products.description', 'LIKE', "%$keyword%")
            ->orderBy($sortingColumn)
            ->simplePaginate($jumlahDataPerHalaman);
    } else {
        $products = Product::select('products.*', 'product_categories.category_name')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->orderBy($sortingColumn)
            ->simplePaginate($jumlahDataPerHalaman);
    }

    return view('pages.products', compact('products', 'jumlahDataPerHalaman'));
}

    public function search(Request $request)
    {
    // Kode pencarian Anda di sini
    $keyword = $request->input('keyword_search'); // Mendapatkan nilai keyword dari input form

    $jumlahDataPerHalaman = 5; // Inisialisasi variabel $jumlahDataPerHalaman

    $products = Product::select('products.*', 'product_categories.category_name')
        ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->where('products.product_name', 'LIKE', "%$keyword%")
        ->orWhere('product_categories.category_name', 'LIKE', "%$keyword%")
        ->orWhere('products.product_code', 'LIKE', "%$keyword%")
        ->orWhere('products.description', 'LIKE', "%$keyword%")
        ->paginate($jumlahDataPerHalaman);

    return view('pages.products', compact('products', 'jumlahDataPerHalaman'));
    }
   // function untuk menambah data
   public function create()
    {
        // Assuming you have a method to retrieve categories, adjust as needed
        $categories = ProductCategory::all();

        return view('pages.create', compact('categories'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'namaproduct' => 'required|string|max:255',
            'kategoriproduct' => 'required|integer',
            'kodeproduct' => 'required|string|max:10',
            'deskripsi' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:100',
            'stock' => 'required|integer|min:5',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload gambar
        $gambarArray = $this->upload($request->file('gambar'));

        $product = Product::create([
            'product_name' => $request->input('namaproduct'),
            'category_id' => $request->input('kategoriproduct'),
            'product_code' => $request->input('kodeproduct'),
            'description' => $request->input('deskripsi'),
            'price' => $request->input('harga'),
            'stock' => $request->input('stock'),
            'image' => $gambarArray,
        ]);

        return redirect()->route('products');
    }

    // function update data

    public function update(Request $request, $id)
    {
    $request->validate([
        'namaproduct' => 'required|string|max:255',
        'kategoriproduct' => 'required|integer',
        'kodeproduct' => 'required|string|max:10',
        'deskripsi' => 'nullable|string|max:255',
        'harga' => 'required|numeric|min:100',
        'stock' => 'required|integer|min:5',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = Product::findOrFail($id);

    // Hapus gambar yang ada sebelumnya jika ada perubahan gambar
    if ($request->hasFile('gambar')) {
        $this->deleteExistingImages($product);
    }

    // Update gambar jika ada gambar baru yang diunggah
    if ($request->hasFile('gambar')) {
        $gambarArray = $this->upload($request->file('gambar'));
        $product->image = $gambarArray;
    }

    // Update field lainnya
    $product->product_name = $request->input('namaproduct');
    $product->category_id = $request->input('kategoriproduct');
    $product->product_code = $request->input('kodeproduct');
    $product->description = $request->input('deskripsi');
    $product->price = $request->input('harga');
    $product->stock = $request->input('stock');

    // Simpan perubahan
    $product->save();

    // Redirect ke halaman daftar produk
    return redirect()->route('products')->with('success', 'Product updated successfully!');
}

private function upload($files)
{
    $gambarArray = [];

    foreach ($files as $file) {
        $namaFileBaru = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $namaFileBaru);
        $gambarArray[] = $namaFileBaru;
    }

    return json_encode($gambarArray);
}


public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404); // Or handle the not found product in your own way
        }

        $categories = ProductCategory::all();

        return view('pages.update', compact('product', 'categories'));
    }

private function deleteExistingImages($product)
{
    if (!empty($product->image)) {
        $existingImages = json_decode($product->image);
        foreach ($existingImages as $image) {
            $filePath = public_path('uploads/' . $image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}

// funtion delete
public function delete($id)
    {
        // Hapus produk berdasarkan ID menggunakan Query Builder
        DB::table('products')->where('id', $id)->delete();

        // Redirect kembali ke halaman tabel produk setelah penghapusan.
        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }
   
}
