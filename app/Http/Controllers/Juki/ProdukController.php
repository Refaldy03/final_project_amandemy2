<?php

namespace App\Http\Controllers\Juki;
use App\Http\Controllers\Controller;

use App\Models\Produk;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Fitur Menampilkan List Produk
    public function showProduk()
    {
        $produks = Produk::all();
        return view('page.juki.produk', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'produks' => $produks]);
    }

    // Tambah Produk
    public function addProduk()
    {
        return view('page.juki.addProduk', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer']);
    }

    // Menyimpan Data Produk
    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'foto_produk' => 'required|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $fileName = time() . '_' . $request->foto_produk->getClientOriginalName();
            $request->foto_produk->storeAs('produk_images', $fileName, 'public');

            Produk::create([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'foto_produk' => $fileName,
                'umkm_id' => auth()->user()->umkm->id,
            ]);

            DB::commit();

            return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('produk')->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    // Edit Produk
    public function editProduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('page.juki.editProduk', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'produk' => $produk]);
    }

    // Update Produk
    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'foto_produk' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $produk = Produk::findOrFail($id);

            if ($request->hasFile('foto_produk')) {
                if ($produk->foto_produk && Storage::exists('public/produk_images/' . $produk->foto_produk)) {
                    Storage::delete('public/produk_images/' . $produk->foto_produk);
                }
                $fileName = time() . '_' . $request->foto_produk->getClientOriginalName();
                $request->foto_produk->storeAs('produk_images', $fileName, 'public');
                $produk->foto_produk = $fileName;
            }

            $produk->nama_produk = $request->nama_produk;
            $produk->harga = $request->harga;
            $produk->save();

            DB::commit();

            return redirect()->route('produk')->with('success', 'Produk berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('produk')->with('error', 'Gagal mengupdate produk: ' . $e->getMessage());
        }
    }

    // Hapus Produk
    public function destroyProduk($id)
    {
        DB::beginTransaction();

        try {
            $produk = Produk::findOrFail($id);
            if ($produk->foto_produk && Storage::exists('public/produk_images/' . $produk->foto_produk)) {
                Storage::delete('public/produk_images/' . $produk->foto_produk);
            }
            $produk->delete();

            DB::commit();

            return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('produk')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }

    // Datatable List Produk
    public function datatableProduk(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Produk::query()->get();
                
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('foto_produk', function ($row) {
                        return $row->foto_produk;
                    })
                    ->addColumn('action', function($row){
                        $editUrl = route('produk.edit', ['id' => $row->id]);
                        $deleteUrl = route('produk.destroy', ['id' => $row->id]);

                        $actionBtn = '<div class="d-flex justify-content-center">
                                        <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold"><i class="bi bi-pen-fill"></i> Edit</a>
                                            <form action="'.$deleteUrl.'" method="POST" class="d-inline-block ms-1">
                                                '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit"><i class="bi bi-trash3-fill"></i> Delete</button>
                                            </form>
                                    </div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error($e);
                return response()->json(['error' => 'Something went wrong!'], 500);
            }
        }
        return abort(404);
    }
}
