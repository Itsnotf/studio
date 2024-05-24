<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest\Store;
use App\Http\Requests\ProductRequest\Update;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Product::get();
            return DataTables::of($query)->make();
        }

        return view('pages.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'desc' => $request->desc,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('image', 'public');
        }

        Product::create($data);

        return redirect('product')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::findOrFail($id);

        return view('pages.product.edit',[
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'desc' => $request->desc,
        ];

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $path = "image/";
            $oldfile = $path.basename($product->image);
            Storage::disk('public')->delete($oldfile);
            $data['image'] = Storage::disk('public')->put($path, $request->file('image'));
        }
        $product->update($data);

        return redirect('product')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
