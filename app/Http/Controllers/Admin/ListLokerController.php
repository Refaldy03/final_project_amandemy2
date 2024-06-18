<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Loker;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ListLokerController extends Controller
{
    // Fitur List Loker
    public function listLoker()
    {
        $lokers = Loker::all();
        return view('page.admin.listLoker', compact('lokers'));
    }

    // Form tambah Loker User
    public function addLokerUser()
    {
        return view('page.admin.addLoker');
    }

    // Menyimpan Loker User
    public function storeLokerUser(Request $request)
    {
        $request->validate([
            'posisi_loker' => 'required|string|max:255',
            'jumlah_loker' => 'required|integer|min:1',
            'kualifikasi' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            Loker::create([
                'posisi_loker' => $request->posisi_loker,
                'jumlah_loker' => $request->jumlah_loker,
                'kualifikasi' => $request->kualifikasi,
                'user_id' => Auth::id(),
            ]);

            DB::commit();
            return redirect()->route('page.admin.listLoker')->with('success', 'Loker berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('page.admin.addLoker')->with('error', 'Gagal menambahkan loker: ' . $e->getMessage());
        }
    }

    // Form Edit Loker User
    public function editLokerUser($id)
    {
        $loker = Loker::findOrFail($id);
        return view('page.admin.editLoker', compact('loker'));
    }

    // Update Loker User
    public function updateLokerUser(Request $request, $id)
    {
        $request->validate([
            'posisi_loker' => 'required|string|max:255',
            'jumlah_loker' => 'required|integer|min:1',
            'kualifikasi' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            Loker::findOrFail($id)->update([
                'posisi_loker' => $request->posisi_loker,
                'jumlah_loker' => $request->jumlah_loker,
                'kualifikasi' => $request->kualifikasi,
            ]);

            DB::commit();
            return redirect()->route('page.admin.listLoker')->with('success', 'Loker berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('page.admin.editLoker', ['id' => $id])->with('error', 'Gagal memperbarui loker: ' . $e->getMessage());
        }
    }

    // Hapus Loker User
    public function deleteLokerUser($id)
    {
        DB::beginTransaction();

        try {
            Loker::findOrFail($id)->delete();

            DB::commit();
            return redirect()->route('page.admin.listLoker')->with('success', 'Loker berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('page.admin.listLoker')->with('error', 'Gagal menghapus loker: ' . $e->getMessage());
        }
    }

    // Datatable List Loker
    public function datatableLoker(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Loker::with('umkm', 'user')->get();
                
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('nama', function ($model) {
                        return $model->user ? $model->user->nama : 'N/A';
                    })
                    ->addColumn('nama_umkm', function ($model) {
                        return $model->umkm ? $model->umkm->nama_umkm : 'N/A';
                    })
                    ->addColumn('action', function($row){
                        $editUrl = route('page.admin.editLoker', ['id' => $row->id]);
                        $deleteUrl = route('page.admin.deleteLoker', ['id' => $row->id]);

                        $actionBtn = '<div class="d-flex justify-content-center">
                                        <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold">Edit</a>
                                            <form action="'.$deleteUrl.'" method="POST" class="d-inline-block" style="margin-left: 5px;">
                                                '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit">Delete</button>
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
