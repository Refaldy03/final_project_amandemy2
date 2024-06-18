<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Umkm;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListUmkmController extends Controller
{
    // Fitur List UMKM
    public function listUmkm()
    {
        $umkms = UMKM::all();
        return view('page.admin.listUmkm', compact('umkms'));
    }

    // Tambah Umkm
    public function addUmkmUser()
    {
        return view('page.admin.addUmkm');
    }

    // Menyimpan UMKM User
    public function storeUmkmUser(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'kota_umkm' => 'required|string|max:255',
            'lokasi_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kontak' => 'required|string|min:0|max:15',
            'foto_umkm' => 'required|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Upload gambar
            $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
            $request->foto_umkm->storeAs('umkm_images', $fileName, 'public');

            // Create/Menyimpan data UMKM
            Umkm::create([
                'nama_umkm' => $request->nama_umkm,
                'kota_umkm' => $request->kota_umkm,
                'lokasi_umkm' => $request->lokasi_umkm,
                'deskripsi' => $request->deskripsi,
                'kontak' => $request->kontak,
                'foto_umkm' => $fileName,
                'user_id' => auth()->user()->id,
            ]);

            DB::commit();

            return redirect()->route('page.admin.addUmkm')->with('success', 'UMKM berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();

            if (Storage::exists('public/umkm_images/' . $fileName)) {
                Storage::delete('public/umkm_images/' . $fileName);
            }

            return redirect()->route('page.admin.addUmkm')->with('error', 'Gagal menambahkan UMKM: ' . $e->getMessage());
        }
    }

    // Edit UMKM User
    public function editUmkmUser($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('page.admin.editUmkm', ['umkm' => $umkm]);
    }

    // Update UMKM User
    public function updateUmkmUser(Request $request, $id)
    {
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'kota_umkm' => 'required|string|max:255',
            'lokasi_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kontak' => 'required|string|min:0|max:15',
            'foto_umkm' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $umkm = Umkm::findOrFail($id);

            if ($request->hasFile('foto_umkm')) {
                if ($umkm->foto_umkm && Storage::exists('public/umkm_images/' . $umkm->foto_umkm)) {
                    Storage::delete('public/umkm_images/' . $umkm->foto_umkm);
                }

                $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
                $request->foto_umkm->storeAs('public/umkm_images', $fileName);

                $umkm->foto_umkm = $fileName;
            }

            $umkm->update([
                'nama_umkm' => $request->nama_umkm,
                'kota_umkm' => $request->kota_umkm,
                'lokasi_umkm' => $request->lokasi_umkm,
                'deskripsi' => $request->deskripsi,
                'kontak' => $request->kontak,
            ]);

            DB::commit();

            return redirect()->route('page.admin.listUmkm', ['id' => $id])->with('success', 'UMKM berhasil diupdate.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('page.admin.editUmkm', ['id' => $id])->with('error', 'Gagal mengupdate UMKM: ' . $e->getMessage());
        }
    }

    // Hapus Data UMKM User
    public function deleteUmkmUser($id)
    {
        DB::beginTransaction();

        try {
            $umkm = Umkm::findOrFail($id);

            if ($umkm->foto_umkm && Storage::exists('public/umkm_images/' . $umkm->foto_umkm)) {
                Storage::delete('public/umkm_images/' . $umkm->foto_umkm);
            }

            $umkm->delete();

            DB::commit();

            return redirect()->route('page.admin.listUmkm')->with('success', 'UMKM berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('page.admin.listUmkm')->with('error', 'Gagal menghapus UMKM: ' . $e->getMessage());
        }
    }

    // Datatable List UMKM
    public function datatableUmkm(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Umkm::with('user');

                if ($request->filled('kota_umkm')) {
                    if ($request->kota_umkm === 'Kota') {
                        $data = $data->where('kota_umkm', 'like', '%Kota%');
                    } elseif ($request->kota_umkm === 'Kabupaten') {
                        $data = $data->where('kota_umkm', 'like', '%Kabupaten%');
                    }
                }

                $filteredData = $data->get();
                
                return DataTables::of($filteredData)
                    ->addIndexColumn()
                    ->editColumn('kota_umkm', function ($model) {
                        $kotaUmkm = $model->kota_umkm;
                        if (stripos($kotaUmkm, 'Kota') !== false) {
                            return '<div class="rounded px-3 py-1 bg-info text-center">'.$kotaUmkm.'</div>';
                        } elseif (stripos($kotaUmkm, 'Kabupaten') !== false) {
                            return '<div class="rounded px-3 py-1 bg-success text-center">'.$kotaUmkm.'</div>';
                        } else {
                            return $kotaUmkm;
                        }
                    })
                    ->addColumn('nama', function ($model) {
                        return $model->user ? $model->user->nama : 'N/A';
                    })
                    ->addColumn('foto_umkm', function ($model) {
                        $filename = $model->foto_umkm ?: 'default_umkm.png';
                        return asset('storage/umkm_images/' . $filename);
                    })
                    ->addColumn('action', function($row){
                        $editUrl = route('page.admin.editUmkm', ['id' => $row->id]);
                        $deleteUrl = route('page.admin.deleteUmkm', ['id' => $row->id]);

                        $actionBtn = '<div class="d-flex justify-content-center">
                                        <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold">Edit</a>
                                            <form action="'.$deleteUrl.'" method="POST" class="d-inline-block" style="margin-left: 5px;">
                                                '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit">Delete</button>
                                            </form>
                                    </div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['kota_umkm', 'action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error($e);
                return response()->json(['error' => 'Something went wrong!'], 500);
            }
        }
        return abort(404);
    }
}
