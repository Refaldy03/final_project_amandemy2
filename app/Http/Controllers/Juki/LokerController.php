<?php

namespace App\Http\Controllers\Juki;
use App\Http\Controllers\Controller;

use App\Models\Umkm;
use App\Models\Loker;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LokerController extends Controller
{
    // Fitur Info Loker Menampilkan Semua Data
    public function infoLoker()
    {
        $lokers = Loker::join('umkms', 'umkms.user_id', '=', 'lokers.user_id')
            ->select('lokers.*', 'umkms.nama_umkm', 'umkms.kota_umkm', 'umkms.lokasi_umkm', 'umkms.foto_umkm')
            ->latest('lokers.created_at')
            ->get();
        
        $kota_umkm = '';

        return view('page.juki.info-loker', ['navbar' => 'navbarUmkm_InfoLoker', 'footer' => 'footer', 'lokers' => $lokers, 'kota_umkm' => $kota_umkm]);
    }

    // Fitur Pencarian Loker
    public function searchLoker(Request $request)
    {
        $kota_umkm = $request->input('kota_umkm');
        Log::info('Kota UMKM: ' . $kota_umkm);

        // Join lokers with umkms and users
        $lokers = Loker::join('umkms', 'lokers.umkm_id', '=', 'umkms.id')
            ->join('users', 'lokers.user_id', '=', 'users.id')
            ->where('umkms.kota_umkm', 'LIKE', '%' . $kota_umkm . '%')
            ->select('lokers.*', 'umkms.kota_umkm', 'umkms.nama_umkm', 'umkms.foto_umkm', 'umkms.lokasi_umkm', 'users.email as user_email')
            ->get();
        Log::info('Lokers: ' . $lokers);

        return response()->json(['lokers' => $lokers, 'kota_umkm' => $kota_umkm]);
    }

    // Halaman Detail Loker
    public function detailLoker($id)
    {
        $loker = Loker::findOrFail($id);
        $umkm = Umkm::with('user.profile')->findOrFail($loker->umkm_id);

        return view('page.juki.detailLoker', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm, 'loker' => $loker]);
    }

    // Fitur Menampilkan Loker Hanya Punya Pemilik UMKM
    public function showLoker()
    {
        $umkm = Umkm::where('user_id', auth()->id())->first();
        $loker = Loker::where('user_id', auth()->id())->first();

        return view('page.juki.loker', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm, 'loker' => $loker]);
    }

    // Menyimpan Data Loker
    public function storeLoker(Request $request)
    {
        // Validasi input
        $request->validate([
            'posisi_loker' => 'required|string|max:255',
            'jumlah_loker' => 'required|integer|min:1|max:500',
            'kualifikasi' => 'required|string|max:255',
        ]);

        // Authenticated User UMKM
        $umkm = Umkm::where('user_id', auth()->id())->first();
        if (!$umkm) {
            return redirect()->route('loker')->with('error', 'Tambahkan data umkm terlebih dahulu.');
        }

        Log::info('UMKM ID: ' . $umkm->id);

        // Memeriksa apakah pengguna sudah memiliki Loker
        if (auth()->user()->loker) {
            return redirect()->route('loker')->with('error', 'Anda hanya dapat memiliki satu loker.');
        }

        DB::beginTransaction();

        try {
            // Create/Menyimpan Data Loker
            Loker::create([
                'posisi_loker' => $request->posisi_loker,
                'jumlah_loker' => $request->jumlah_loker,
                'kualifikasi' => $request->kualifikasi,
                'user_id' => Auth::id(),
                'umkm_id' => $umkm->id,
            ]);

            DB::commit();
            return redirect()->route('loker')->with('success', 'Loker berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('loker')->with('error', 'Gagal menambahkan loker: ' . $e->getMessage());
        }
    }

    // Edit Loker
    public function editLoker($id)
    {
        $loker= Loker::findOrFail($id);
        return view('page.juki.editLoker', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'loker' => $loker]);
    }

    // Update Loker
    public function updateLoker(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'posisi_loker' => 'required|string|max:255',
            'jumlah_loker' => 'required|integer|min:1|max:500',
            'kualifikasi' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Update Loker record
            Loker::findOrFail($id)->update([
                'posisi_loker' => $request->posisi_loker,
                'jumlah_loker' => $request->jumlah_loker,
                'kualifikasi' => $request->kualifikasi,
            ]);

            DB::commit();
            return redirect()->route('loker')->with('success', 'Loker berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('loker')->with('error', 'Gagal memperbarui loker: ' . $e->getMessage());
        }
    }

    // Hapus Loker
    public function destroyLoker($id)
    {
        DB::beginTransaction();

        try {
            // Find Loker dengan ID dan hapus
            Loker::findOrFail($id)->delete();

            DB::commit();
            return redirect()->route('loker')->with('success', 'Loker berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('loker')->with('error', 'Gagal menghapus loker: ' . $e->getMessage());
        }
    }
}
