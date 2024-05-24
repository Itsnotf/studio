<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiRequest\Store;
use App\Models\MtdPembayaran;
use App\Models\Paket;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Transaksi::with('product','paket','user','metode')->get();
            return DataTables::of($query)
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('product', function($row) {
                    return $row->product->title;
                })
                ->addColumn('paket', function($row) {
                    return $row->paket->price;
                })
                ->addColumn('metode', function($row) {
                    return $row->metode->wallet;
                })
                ->make(true);
        }

        return view('pages.transaksi.index');
    }


    /**
     * Show the form for creating a new resource.
     */

     public function create()
     {
         $products = Product::get();
         $users = User::get();
         $pakets = Paket::get();
         $mtds = MtdPembayaran::get();

        //  dd($selected_product_id);
         return view('pages.transaksi.create', compact('products', 'users', 'pakets', 'mtds'));
     }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        // dd($request);
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'paket_id' => $request->paket_id,
            'mtd_pembayaran_id' => $request->mtd_pembayaran_id,
            'telpon' => $request->telpon,
        ];


        if ($request->hasFile('bukti_pembayaran')) {
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        if($request->bukti_pembayaran != null){
            $data['status'] = "sedang diproses";
        }

        Transaksi::create($data);
        return redirect('transaksi')->with('toast', 'showToast("Data berhasil disimpan")');
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Transaksi::find($id);
        return view('pages.transaksi.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
