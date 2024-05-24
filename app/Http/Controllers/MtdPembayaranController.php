<?php

namespace App\Http\Controllers;

use App\Http\Requests\PembayaranRequest\Store;
use App\Http\Requests\PembayaranRequest\Update;
use App\Models\MtdPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MtdPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MtdPembayaran::get();
            return DataTables::of($query)->make(true);
        }

        return view('pages.mtdpembayaran.index');
    }

    public function create()
    {
        return view('pages.mtdpembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $data = [
            'wallet' => $request->wallet,
            'no_wallet' => $request->no_wallet,
            'an' => $request->an,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('image', 'public');
        }

        MtdPembayaran::create($data);

        return redirect('metode-pembayaran')->with('toast', 'showToast("Data berhasil disimpan")');
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
        $item = MtdPembayaran  ::findOrFail($id);

        return view('pages.mtdpembayaran.edit',[
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id)
    {
        $mtd_pembayaran = MtdPembayaran::findOrFail($id);

        $data = [
            'wallet' => $request->wallet,
            'no_wallet' => $request->no_wallet,
            'an' => $request->an,
        ];

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $path = "image/";
            $oldfile = $path.basename($mtd_pembayaran->image);
            Storage::disk('public')->delete($oldfile);
            $data['image'] = Storage::disk('public')->put($path, $request->file('image'));
        }
        $mtd_pembayaran->update($data);

        return redirect('metode-pembayaran')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mtd_pembayaran =MtdPembayaran::findOrFail($id);
        $mtd_pembayaran->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
