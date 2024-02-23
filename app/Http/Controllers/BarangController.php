<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                return $next($request);
            } else {
                return redirect('/');
            }
        });
    }
    public function index(): View
    {
        $Barangs = Barang::latest()->paginate(5);
        return view('barang', compact('Barangs'));
    }


    public function create(): View
    {
        return view('insertformbarang');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_produk' => 'required|min:2',
            'merk' => 'required|min:3',
            'harga' => 'required|min:3'
        ]);
        $image = $request->file('image');
        $image->storeAs('public/product', $image->hashName());
        Barang::create([
            'image'     => $image->hashName(),
            'nama_produk' => $request->nama_produk,
            'merk'   => $request->merk,
            'harga'   => $request->harga
        ]);

        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit($id): View
    {
        $Barang = Barang::findOrFail($id);
        return view('updateformbarang', compact('Barang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_produk' => 'required|min:2',
            'merk' => 'required|min:3',
            'harga' => 'required|min:3',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);
        $Barang = Barang::findOrFail($id);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/product', $image->hashName());

            $Barang->update([
                'nama_produk' => $request->nama_produk,
                'merk' => $request->merk,
                'harga' => $request->harga,
                'image' => $image->hashName(),
            ]);
        } else {
            $Barang->update([
                'nama_produk' => $request->nama_produk,
                'merk' => $request->merk,
                'harga' => $request->harga,
            ]);
        }

        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    public function destroy($id)
    {
        $Barang = Barang::findOrFail($id);

        $Barang->delete();

        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
