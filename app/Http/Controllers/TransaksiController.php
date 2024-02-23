<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class TransaksiController extends Controller
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
        $Transaksis = Transaksi::all();
        return view('dashboard', compact('Transaksis'));
    }
    public function create(): View
    {
        $Barangs = Barang::all();
        return view('insertformtransaksi', compact('Barangs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'barang' => 'required',
            'total_item' => 'required|min:1',
            'total_harga' => 'required|min:1',
            'status_pembayaran' => 'required'
        ]);
        Transaksi::create([
            'id_barang'  => $request->barang,
            'total_item' => $request->total_item,
            'total_harga' => $request->total_harga,
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function destroy($id): RedirectResponse
    {
        $Transaksis = Transaksi::where('id_transaksi',$id)->firstOrFail();
        $Transaksis->where('id_transaksi',$id)->delete();

        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function NotaTransaksi($id)
    {
        $detail = Transaksi::where('id_transaksi',$id)->firstOrFail();
        $detail = Transaksi::where('id_transaksi',$id)->get();

        return view('nota', compact('detail'));
    }
}