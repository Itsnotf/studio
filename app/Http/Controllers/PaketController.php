<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaketRequest\Store;
use App\Http\Requests\PaketRequest\Update;
use App\Models\Paket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Paket::with('product')->get(); // Eager load the 'product' relationship
            return DataTables::of($query)->make(true); // Return data as JSON for DataTables
        }

        return view('pages.paket.index');
    }

    public function create()
    {
        $products = Product::get();
        return view('pages.paket.create' , compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $data = [
            'product_id' => $request->product_id,
            'price' => $request->price,
            'desc' => $request->desc,
            'note' => $request->note,
        ];


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('image', 'public');
        }

        // dd($data);
        Paket::create($data);

        return redirect('paket')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $products = Product::get();
        $item = Paket::findOrFail($id);

        return view('pages.paket.edit',[
            'item'  =>  $item,
            'products'  =>  $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id)
    {
        $paket = Paket::findOrFail($id);

        $data = [
            'product_id' => $request->product_id,
            'price' => $request->price,
            'desc' => $request->desc,
            'note' => $request->note,
        ];

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $path = "image/";
            $oldfile = $path.basename($paket->image);
            Storage::disk('public')->delete($oldfile);
            $data['image'] = Storage::disk('public')->put($path, $request->file('image'));
        }
        $paket->update($data);

        return redirect('paket')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
