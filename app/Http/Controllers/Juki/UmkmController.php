<?php

namespace App\Http\Controllers\Juki;
use App\Http\Controllers\Controller;

use App\Models\Umkm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UmkmResource;

class UmkmController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->only('show');
    // }

    // Fitur Menampilkan Semua Data UMKM
    public function showUmkm()
    {
        $umkms = Umkm::latest()->get();

        $kota_umkm = '';

        return view('page.juki.umkm', [
            'navbar' => 'navbarUmkm_InfoLoker',
            'footer' => 'footer',
            'umkms' => UmkmResource::collection($umkms),
            'kota_umkm' => $kota_umkm,
        ]);
    }

    public function detailUmkm($id)
    {
        // Mengambil data UMKM berdasarkan ID
        $umkm = Umkm::with('user', 'produk')->findOrFail($id);

        // Mengirim data UMKM ke tampilan 'detailUmkm.blade.php'
        return view('page.juki.detailUmkm', ['navbar' => 'navbarUmkm_InfoLoker', 'footer' => 'footer', 'umkm' => new UmkmResource($umkm)]);
    }

    public function searchUmkm(Request $request)
    {
        $kota_umkm = $request->input('kota_umkm');
        $umkms = UMKM::where('kota_umkm', 'LIKE', '%' . $kota_umkm . '%')->get();
        return response()->json(['umkms' => $umkms, 'kota_umkm' => $kota_umkm,]);
    }

        public function showDashboard()
    {
        // Mengambil data UMKM yang dimiliki oleh pengguna yang saat ini masuk
        $umkm = Umkm::where('user_id', auth()->id())->first();

        return view('page.juki.dashboard', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm]);
    }
    
    public function storeUmkm(Request $request)
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

        // Check if user already has a UMKM
        if (auth()->user()->umkm) {
            return redirect()->route('dashboard')->with('error', 'Anda hanya dapat memiliki satu UMKM.');
        }

        DB::beginTransaction();

        try {
            // Upload gambar
            $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
            $request->foto_umkm->storeAs('umkm_images', $fileName, 'public');

            // Simpan data UMKM
            UMKM::create([
                'nama_umkm' => $request->nama_umkm,
                'kota_umkm' => $request->kota_umkm,
                'lokasi_umkm' => $request->lokasi_umkm,
                'deskripsi' => $request->deskripsi,
                'kontak' => $request->kontak,
                'foto_umkm' => $fileName,
                'user_id' => auth()->user()->id,
            ]);

            // Commit transaksi
            DB::commit();

            return redirect()->route('dashboard')->with('success', 'UMKM berhasil ditambahkan.');

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Hapus gambar yang sudah terupload jika terjadi kesalahan
            if (Storage::exists('public/umkm_images/' . $fileName)) {
                Storage::delete('public/umkm_images/' . $fileName);
            }

            return redirect()->route('dashboard')->with('error', 'Gagal menambahkan UMKM: ' . $e->getMessage());
        }
    }

    public function editUmkm($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('page.juki.editUmkm', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm]);
    }

    public function updateUmkm(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'kota_umkm' => 'required|string|max:255',
            'lokasi_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'kontak' => 'required|string|min:0|max:15',
            'foto_umkm' => 'nullable|image|max:2048', // nullable untuk tidak wajib mengupload ulang
        ]);

        DB::beginTransaction();

        try {
            // Cari data UMKM berdasarkan ID
            $umkm = Umkm::findOrFail($id);

            // Jika ada file foto yang diupload
            if ($request->hasFile('foto_umkm')) {
                // Hapus file foto lama jika ada
                if ($umkm->foto_umkm && Storage::exists('public/umkm_images/' . $umkm->foto_umkm)) {
                    Storage::delete('public/umkm_images/' . $umkm->foto_umkm);
                }

                // Upload file foto baru
                $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
                $request->foto_umkm->storeAs('public/umkm_images', $fileName);

                // Update nama file foto di database
                $umkm->foto_umkm = $fileName;
            }

            // Update data UMKM di database
            $umkm->update([
                'nama_umkm' => $request->nama_umkm,
                'kota_umkm' => $request->kota_umkm,
                'lokasi_umkm' => $request->lokasi_umkm,
                'deskripsi' => $request->deskripsi,
                'kontak' => $request->kontak,
            ]);

            // Commit transaksi
            DB::commit();

            return redirect()->route('dashboard')->with('success', 'UMKM berhasil diupdate.');

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', 'Gagal mengupdate UMKM: ' . $e->getMessage());
        }

    }

    public function destroyUmkm($id)
    {
        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Find UMKM dengan ID
            $umkm = Umkm::findOrFail($id);

            // Hapus file foto jika ada
            if ($umkm->foto_umkm && Storage::exists('public/umkm_images/' . $umkm->foto_umkm)) {
                Storage::delete('public/umkm_images/' . $umkm->foto_umkm);
            }

            // Delete UMKM
            $umkm->delete();

            // Commit transaksi
            DB::commit();

            return redirect()->route('dashboard')->with('success', 'UMKM berhasil dihapus.');

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', 'Gagal menghapus UMKM: ' . $e->getMessage());
        }
    }
}
