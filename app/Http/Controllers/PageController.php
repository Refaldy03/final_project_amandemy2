<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Umkm;
use App\Models\Loker;
use App\Models\Produk;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Resources\UmkmResource;
use App\Http\Resources\ProdukResource;
use Carbon\Carbon;


class PageController extends Controller
{
    // Halaman Utama Website JUKI
    public function index()
    {
        // return view('page.juki.home', ['navbar' => 'navbarHome', 'footer' => 'footer']);
        $umkms = UMKM::limit(4)->get();
        return view('page.juki.home', ['navbar' => 'navbarHome', 'footer' => 'footer', 'umkms' => $umkms]);
    }

    // public function showUmkm()
    // {
    //     $umkms = Umkm::latest()->get();

    //     $kota_umkm = '';

    //     return view('page.juki.umkm', [
    //         'navbar' => 'navbarUmkm_InfoLoker',
    //         'footer' => 'footer',
    //         'umkms' => UmkmResource::collection($umkms),
    //         'kota_umkm' => $kota_umkm,
    //     ]);
    // }

    // public function produkResource($id)
    // {
    //     $umkm = Umkm::with('user', 'produk')->findOrFail($id);

    //     // Mengirim data UMKM ke tampilan 'umkm.blade.php'
    //     return new UmkmResource($umkm);
    // }

    // public function detailUmkm($id)
    // {
    //     // Mengambil data UMKM berdasarkan ID
    //     $umkm = Umkm::with('user', 'produk')->findOrFail($id);

    //     // Mengirim data UMKM ke tampilan 'detailUmkm.blade.php'
    //     return view('page.juki.detailUmkm', ['navbar' => 'navbarUmkm_InfoLoker', 'footer' => 'footer', 'umkm' => new UmkmResource($umkm)]);
    // }

    // public function detailUmkm($id)
    // {
    //     // Mengambil data UMKM berdasarkan ID
    //     $umkm = Umkm::findOrFail($id);

    //     // Mengambil produk terkait UMKM berdasarkan UMKM ID
    //     $produks = Produk::where('umkm_id', $umkm->id)->get();

    //     // Mengirim data UMKM ke tampilan 'umkm.blade.php'
    //     return view('page.juki.detailUmkm', ['navbar' => 'navbar2', 'footer' => 'footer', 'umkm' => $umkm, 'produks' => $produks]);
    // }

    // Metode untuk pencarian UMKM berdasarkan kota
    // public function searchUmkm(Request $request)
    // {
    //     $kota_umkm = $request->input('kota_umkm');
    //     $umkms = UMKM::where('kota_umkm', 'LIKE', '%' . $kota_umkm . '%')->get();
    //     return response()->json(['umkms' => $umkms, 'kota_umkm' => $kota_umkm,]);
    // }

    // public function showDashboard()
    // {
    //     // Mengambil data UMKM yang dimiliki oleh pengguna yang saat ini masuk
    //     $umkm = Umkm::where('user_id', auth()->id())->first();

    //     return view('page.juki.dashboard', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm]);
    // }
    
    // public function storeUmkm(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nama_umkm' => 'required|string|max:255',
    //         'kota_umkm' => 'required|string|max:255',
    //         'lokasi_umkm' => 'required|string|max:255',
    //         'deskripsi' => 'required|string|max:255',
    //         'kontak' => 'required|string|min:0|max:15',
    //         'foto_umkm' => 'required|image|max:2048',
    //     ]);

    //     // Check if user already has a UMKM
    //     if (auth()->user()->umkm) {
    //         return redirect()->route('dashboard')->with('error', 'Anda hanya dapat memiliki satu UMKM.');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         // Upload gambar
    //         $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
    //         $request->foto_umkm->storeAs('umkm_images', $fileName, 'public');

    //         // Simpan data UMKM
    //         UMKM::create([
    //             'nama_umkm' => $request->nama_umkm,
    //             'kota_umkm' => $request->kota_umkm,
    //             'lokasi_umkm' => $request->lokasi_umkm,
    //             'deskripsi' => $request->deskripsi,
    //             'kontak' => $request->kontak,
    //             'foto_umkm' => $fileName,
    //             'user_id' => auth()->user()->id,
    //         ]);

    //         // Commit transaksi
    //         DB::commit();

    //         return redirect()->route('dashboard')->with('success', 'UMKM berhasil ditambahkan.');

    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollBack();

    //         // Hapus gambar yang sudah terupload jika terjadi kesalahan
    //         if (Storage::exists('public/umkm_images/' . $fileName)) {
    //             Storage::delete('public/umkm_images/' . $fileName);
    //         }

    //         return redirect()->route('dashboard')->with('error', 'Gagal menambahkan UMKM: ' . $e->getMessage());
    //     }
    // }

    // public function editUmkm($id)
    // {
    //     $umkm = Umkm::findOrFail($id);
    //     return view('page.juki.editUmkm', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm]);
    // }

    // public function updateUmkm(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nama_umkm' => 'required|string|max:255',
    //         'kota_umkm' => 'required|string|max:255',
    //         'lokasi_umkm' => 'required|string|max:255',
    //         'deskripsi' => 'required|string|max:255',
    //         'kontak' => 'required|string|min:0|max:15',
    //         'foto_umkm' => 'nullable|image|max:2048', // nullable untuk tidak wajib mengupload ulang
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // Cari data UMKM berdasarkan ID
    //         $umkm = Umkm::findOrFail($id);

    //         // Jika ada file foto yang diupload
    //         if ($request->hasFile('foto_umkm')) {
    //             // Hapus file foto lama jika ada
    //             if ($umkm->foto_umkm && Storage::exists('public/umkm_images/' . $umkm->foto_umkm)) {
    //                 Storage::delete('public/umkm_images/' . $umkm->foto_umkm);
    //             }

    //             // Upload file foto baru
    //             $fileName = time() . '_' . $request->foto_umkm->getClientOriginalName();
    //             $request->foto_umkm->storeAs('public/umkm_images', $fileName);

    //             // Update nama file foto di database
    //             $umkm->foto_umkm = $fileName;
    //         }

    //         // Update data UMKM di database
    //         $umkm->update([
    //             'nama_umkm' => $request->nama_umkm,
    //             'kota_umkm' => $request->kota_umkm,
    //             'lokasi_umkm' => $request->lokasi_umkm,
    //             'deskripsi' => $request->deskripsi,
    //             'kontak' => $request->kontak,
    //         ]);

    //         // Commit transaksi
    //         DB::commit();

    //         return redirect()->route('dashboard')->with('success', 'UMKM berhasil diupdate.');

    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollBack();
    //         return redirect()->route('dashboard')->with('error', 'Gagal mengupdate UMKM: ' . $e->getMessage());
    //     }

    // }

    // public function destroyUmkm($id)
    // {
    //     // Mulai transaksi
    //     DB::beginTransaction();

    //     try {
    //         // Find UMKM dengan ID
    //         $umkm = Umkm::findOrFail($id);

    //         // Hapus file foto jika ada
    //         if ($umkm->foto_umkm && Storage::exists('public/umkm_images/' . $umkm->foto_umkm)) {
    //             Storage::delete('public/umkm_images/' . $umkm->foto_umkm);
    //         }

    //         // Delete UMKM
    //         $umkm->delete();

    //         // Commit transaksi
    //         DB::commit();

    //         return redirect()->route('dashboard')->with('success', 'UMKM berhasil dihapus.');

    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollBack();
    //         return redirect()->route('dashboard')->with('error', 'Gagal menghapus UMKM: ' . $e->getMessage());
    //     }
    // }

    public function like(Request $request)
    {
        $likeableId = $request->input('likeable_id');
        $likeableType = $request->input('likeable_type');

        $user = Auth::user();

        if ($likeableType === 'umkm') {
            $likeable = Umkm::findOrFail($likeableId);
        } elseif ($likeableType === 'produk') {
            $likeable = Produk::findOrFail($likeableId);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid likeable type'], 400);
        }

        if ($likeable->likes()->where('user_id', $user->id)->exists()) {
            $likeable->likes()->where('user_id', $user->id)->delete();
            $status = 'unliked';
            $message = ($likeableType === 'umkm') ? 'UMKM diunlike' : 'Produk diunlike';
        } else {
            $likeable->likes()->create(['user_id' => $user->id]);
            $status = 'liked';
            $message = ($likeableType === 'umkm') ? 'UMKM dilike' : 'Produk dilike';
        }

        $likesCount = $likeable->likes()->count();

        return response()->json([
            'status' => $status,
            'likes_count' => $likesCount,
            'message' => $message,
        ]);
    }

    // public function showProduk()
    // {
    //     $produks = Produk::all();
    //     return view('page.juki.produk', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'produks' => $produks]);
    // }

    // public function addProduk()
    // {
    //     return view('page.juki.addProduk', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer']);
    // }

    // public function storeProduk(Request $request)
    // {
    //     $request->validate([
    //         'nama_produk' => 'required|string|max:255',
    //         'harga' => 'required|numeric|min:0',
    //         'foto_produk' => 'required|image|max:2048',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $fileName = time() . '_' . $request->foto_produk->getClientOriginalName();
    //         $request->foto_produk->storeAs('produk_images', $fileName, 'public');

    //         Produk::create([
    //             'nama_produk' => $request->nama_produk,
    //             'harga' => $request->harga,
    //             'foto_produk' => $fileName,
    //             'umkm_id' => auth()->user()->umkm->id,
    //         ]);

    //         DB::commit();

    //         return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('produk')->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
    //     }
    // }

    // public function editProduk($id)
    // {
    //     $produk = Produk::findOrFail($id);
    //     return view('page.juki.editProduk', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'produk' => $produk]);
    // }

    // public function updateProduk(Request $request, $id)
    // {
    //     $request->validate([
    //         'nama_produk' => 'required|string|max:255',
    //         'harga' => 'required|numeric|min:0',
    //         'foto_produk' => 'nullable|image|max:2048',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $produk = Produk::findOrFail($id);

    //         if ($request->hasFile('foto_produk')) {
    //             if ($produk->foto_produk && Storage::exists('public/produk_images/' . $produk->foto_produk)) {
    //                 Storage::delete('public/produk_images/' . $produk->foto_produk);
    //             }
    //             $fileName = time() . '_' . $request->foto_produk->getClientOriginalName();
    //             $request->foto_produk->storeAs('produk_images', $fileName, 'public');
    //             $produk->foto_produk = $fileName;
    //         }

    //         $produk->nama_produk = $request->nama_produk;
    //         $produk->harga = $request->harga;
    //         $produk->save();

    //         DB::commit();

    //         return redirect()->route('produk')->with('success', 'Produk berhasil diupdate.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('produk')->with('error', 'Gagal mengupdate produk: ' . $e->getMessage());
    //     }
    // }

    // public function destroyProduk($id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $produk = Produk::findOrFail($id);
    //         if ($produk->foto_produk && Storage::exists('public/produk_images/' . $produk->foto_produk)) {
    //             Storage::delete('public/produk_images/' . $produk->foto_produk);
    //         }
    //         $produk->delete();

    //         DB::commit();

    //         return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('produk')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
    //     }
    // }

    // public function datatableProduk(Request $request)
    // {
    //     if ($request->ajax()) {
    //         try {
    //             $data = Produk::query()->get();
                
    //             return DataTables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('foto_produk', function ($row) {
    //                     return $row->foto_produk;
    //                 })
    //                 ->addColumn('action', function($row){
    //                     $editUrl = route('produk.edit', ['id' => $row->id]);
    //                     $deleteUrl = route('produk.destroy', ['id' => $row->id]);

    //                     $actionBtn = '<div class="d-flex justify-content-center">
    //                                     <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold"><i class="bi bi-pen-fill"></i> Edit</a>
    //                                         <form action="'.$deleteUrl.'" method="POST" class="d-inline-block ms-1">
    //                                             '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit"><i class="bi bi-trash3-fill"></i> Delete</button>
    //                                         </form>
    //                                 </div>';
    //                     return $actionBtn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //         } catch (\Exception $e) {
    //             Log::error($e);
    //             return response()->json(['error' => 'Something went wrong!'], 500);
    //         }
    //     }
    //     return abort(404);
    // }

    // public function showProfil()
    // {
    //     $user = Auth::user();
    //     $profile = $user->profile;
    //     return view('page.juki.profil', [ 'user' => $user, 'profile' => $profile, 'navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer' ]);
    // }

    // public function updateProfil(Request $request)
    // {
    //     $user = Auth::user();
    //     $profile = $user->profile;

    //     if (!$profile) {
    //         $profile = new Profile();
    //         $profile->user_id = $user->id;
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'foto_profile' => 'image|mimes:jpeg,png,jpg|max:2048',
    //         'nama' => 'required|string|max:255',
    //         'email' => [
    //             'required',
    //             'email',
    //             'max:255',
    //             Rule::unique('users')->ignore($user->id),
    //         ],
    //         'password' => $request->filled('password') ? 'required|min:8|confirmed' : '',
    //         'alamat' => 'required|string|max:255',
    //         'no_wa' => 'required|string|min:0|max:15',
    //         'ktp' => 'image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('profil')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Check apakah perubahan password diperbolehkan (setiap seminggu sekali)
    //     $lastPasswordChange = $user->password_changed_at;
    //     $oneWeekAgo = now()->subWeek();

    //     if ($lastPasswordChange !== null && $lastPasswordChange >= $oneWeekAgo && $request->filled('password')) {
    //         return redirect()->route('profil')->with('error', 'Anda hanya dapat mengubah profile sekali dalam seminggu.');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         // Update user data
    //         $userData = [
    //             'nama' => $request->nama,
    //             'email' => $request->email,
    //             'alamat' => $request->alamat,
    //             'no_wa' => $request->no_wa,
    //         ];

    //         if ($request->filled('password')) {
    //             $userData['password'] = Hash::make($request->password);
    //             $userData['password_changed_at'] = Carbon::now();
    //         }

    //         // Save user data
    //         $userSaved = DB::table('users')->where('id', $user->id)->update($userData);
            
    //         if (!$userSaved) {
    //             throw new \Exception('Gagal memperbarui data user');
    //         }

    //         // Update profile data
    //         if ($request->hasFile('foto_profile')) {
    //             if ($profile->foto_profile) {
    //                 Storage::delete('public/' . $profile->foto_profile);
    //             }
    //             $foto_profile = $request->file('foto_profile');
    //             $foto_profile_path = $foto_profile->store('public/profile_images');
    //             $profile->foto_profile = str_replace('public/', '', $foto_profile_path);
    //         }

    //         if ($request->hasFile('ktp')) {
    //             if ($profile->ktp) {
    //                 Storage::delete('public/' . $profile->ktp);
    //             }
    //             $ktp = $request->file('ktp');
    //             $ktp_path = $ktp->store('public/ktps');
    //             $profile->ktp = str_replace('public/', '', $ktp_path);
    //         }

    //         // Save profile data
    //         if (!$profile->save()) {
    //             throw new \Exception('Gagal memperbarui profile');
    //         }

    //         DB::commit();
    //         return redirect()->route('profil')->with('success', 'Profile berhasil diperbarui');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('profil')->with('error', 'Gagal memperbarui profile: ' . $e->getMessage());
    //     }
    // }

    // public function showLoker()
    // {
    //     $umkm = Umkm::where('user_id', auth()->id())->first();
    //     $loker = Loker::where('user_id', auth()->id())->first();

    //     return view('page.juki.loker', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm, 'loker' => $loker]);
    // }

    // public function storeLoker(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'posisi_loker' => 'required|string|max:255',
    //         'jumlah_loker' => 'required|integer|min:1',
    //         'kualifikasi' => 'required|string|max:255',
    //     ]);

    //     // Authenticated user UMKM
    //     $umkm = Umkm::where('user_id', auth()->id())->first();
    //     if (!$umkm) {
    //         return redirect()->route('loker')->with('error', 'Tambahkan data umkm terlebih dahulu.');
    //     }

    //     Log::info('UMKM ID: ' . $umkm->id);

    //     // Check if user already has a Loker
    //     if (auth()->user()->loker) {
    //         return redirect()->route('loker')->with('error', 'Anda hanya dapat memiliki satu loker.');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         // Menyimpan data Loker
    //         Loker::create([
    //             'posisi_loker' => $request->posisi_loker,
    //             'jumlah_loker' => $request->jumlah_loker,
    //             'kualifikasi' => $request->kualifikasi,
    //             'user_id' => Auth::id(),
    //             'umkm_id' => $umkm->id,
    //         ]);

    //         DB::commit();
    //         return redirect()->route('loker')->with('success', 'Loker berhasil ditambahkan.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('loker')->with('error', 'Gagal menambahkan loker: ' . $e->getMessage());
    //     }
    // }

    // public function editLoker($id)
    // {
    //     $loker= Loker::findOrFail($id);
    //     return view('page.juki.editLoker', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'loker' => $loker]);
    // }

    // public function updateLoker(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'posisi_loker' => 'required|string|max:255',
    //         'jumlah_loker' => 'required|integer|min:1',
    //         'kualifikasi' => 'required|string|max:255',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // Update Loker record
    //         Loker::findOrFail($id)->update([
    //             'posisi_loker' => $request->posisi_loker,
    //             'jumlah_loker' => $request->jumlah_loker,
    //             'kualifikasi' => $request->kualifikasi,
    //         ]);

    //         DB::commit();
    //         return redirect()->route('loker')->with('success', 'Loker berhasil diperbarui.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('loker')->with('error', 'Gagal memperbarui loker: ' . $e->getMessage());
    //     }
    // }

    // public function destroyLoker($id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         // Find Loker dengan ID dan hapus
    //         Loker::findOrFail($id)->delete();

    //         DB::commit();
    //         return redirect()->route('loker')->with('success', 'Loker berhasil dihapus.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('loker')->with('error', 'Gagal menghapus loker: ' . $e->getMessage());
    //     }
    // }

    public function about()
    {
        return view('page.juki.about', ['navbar' => 'navbarAboutUs_Service', 'footer' => 'footer']);
    }

    // public function infoLoker()
    // {
    //     $lokers = Loker::join('umkms', 'umkms.user_id', '=', 'lokers.user_id')
    //         ->select('lokers.*', 'umkms.nama_umkm', 'umkms.kota_umkm', 'umkms.lokasi_umkm', 'umkms.foto_umkm')
    //         ->latest('lokers.created_at')
    //         ->get();
        
    //     $kota_umkm = '';

    //     return view('page.juki.info-loker', ['navbar' => 'navbarUmkm_InfoLoker', 'footer' => 'footer', 'lokers' => $lokers, 'kota_umkm' => $kota_umkm]);
    // }

    // public function detailLoker($id)
    // {
    //     $loker = Loker::findOrFail($id);
    //     $umkm = Umkm::with('user.profile')->findOrFail($loker->umkm_id);

    //     return view('page.juki.detailLoker', ['navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer', 'umkm' => $umkm, 'loker' => $loker]);
    // }

    // public function searchLoker(Request $request)
    // {
    //     $kota_umkm = $request->input('kota_umkm');
    //     Log::info('Kota UMKM: ' . $kota_umkm);

    //     // Join lokers with umkms and users
    //     $lokers = Loker::join('umkms', 'lokers.umkm_id', '=', 'umkms.id')
    //         ->join('users', 'lokers.user_id', '=', 'users.id')
    //         ->where('umkms.kota_umkm', 'LIKE', '%' . $kota_umkm . '%')
    //         ->select('lokers.*', 'umkms.kota_umkm', 'umkms.nama_umkm', 'umkms.foto_umkm', 'umkms.lokasi_umkm', 'users.email as user_email')
    //         ->get();
    //     Log::info('Lokers: ' . $lokers);

    //     return response()->json(['lokers' => $lokers, 'kota_umkm' => $kota_umkm]);
    // }

    public function service()
    {
        return view('page.juki.service', ['navbar' => 'navbarAboutUs_Service', 'footer' => 'footer']);
    }

    // // Users
    // public function users()
    // {
    //     $users = User::all();
    //     return view('page.admin.index', compact('users'));
    // }

    // // add user
    // public function addUser()
    // {
    //     return view('page.admin.add');
    // }

    // // store user
    // public function storeUser(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email|max:255|unique:users',
    //         'password' => 'required|min:8|confirmed',
    //         'alamat' => 'required|string|max:255',
    //         'tanggal_lahir' => 'required|date',
    //         'jenis_kelamin' => 'required|in:laki-laki,perempuan',
    //         'no_wa' => 'required|string|min:0|max:15',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('page.admin.add')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $userRole = 'user';

    //         if ($request->email === 'adminjuki5@gmail.com' && $request->password === 'adminJuki@2024') {
    //             $userRole = 'superadmin';
    //         }

    //         $user = User::create([
    //             'nama' => $request->nama,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //             'alamat' => $request->alamat,
    //             'tanggal_lahir' => $request->tanggal_lahir,
    //             'jenis_kelamin' => $request->jenis_kelamin,
    //             'no_wa' => $request->no_wa,
    //         ]);

    //         // Mengambil peran berdasarkan nama
    //         $role = Role::where('name', $userRole)->first();

    //         if ($role) {
    //             $user->assignRole($role);
    //         }

    //         DB::commit();
    //         return redirect()->route('page.admin.index')->with('success', 'User added successfully');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('page.admin.add')->with('error', 'Failed to add user: ' . $e->getMessage());
    //     }
    // }

    // // edit user
    // public function editUser($id)
    // {
    //     $user = User::find($id);
    //     $user->role = $user->roles->first()->name;
    //     return view('page.admin.edit', compact('user'));
    // }

    // // update user
    // public function updateUser(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255',
    //         'password' => 'nullable|string|min:8',
    //         'jenis_kelamin' => 'required|in:laki-laki,perempuan',
    //         'no_wa' => 'required|string',
    //         'tanggal_lahir' => 'required|date',
    //         'alamat' => 'required|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('page.admin.edit', $id)
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $user = User::find($id);

    //         $user->nama = $request->nama;
    //         $user->email = $request->email;

    //         if ($request->password)
    //             $user->password = Hash::make($request->password);

    //         $user->jenis_kelamin = $request->jenis_kelamin;
    //         $user->no_wa = $request->no_wa;
    //         $user->tanggal_lahir = $request->tanggal_lahir;
    //         $user->alamat = $request->alamat;
    //         $user->save();

    //         $user->syncRoles([$request->role]);

    //         DB::commit();
    //         return redirect()->route('page.admin.index')->with('success', 'User updated successfully');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('page.admin.edit', $id)->with('error', 'Failed to update user: ' . $e->getMessage());
    //     }
    // }

    // // delete user
    // public function deleteUser($id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $user = User::find($id);

    //         if ($user->id == Auth::user()->id)
    //             return redirect()->route('page.admin.index')->with('error', 'You cannot delete your own account');

    //         $user->delete();

    //         // detech role
    //         $user->syncRoles([]);

    //         DB::commit();
    //         return redirect()->route('page.admin.index')->with('success', 'User deleted successfully');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('page.admin.index')->with('error', 'Failed to delete user: ' . $e->getMessage());
    //     }
    // }

    // public function datatableUser(Request $request)
    // {
    //     if ($request->ajax()) {
    //         try {
    //             $data = User::with('profile');

    //             if ($request->filled('jenis_kelamin')) {
    //                 $data = $data->where('jenis_kelamin', $request->jenis_kelamin);
    //             }

    //             $filteredData = $data->get();
                
    //             return DataTables::of($filteredData)
    //                 ->addIndexColumn()
    //                 ->editColumn('jenis_kelamin', function ($model) {
    //                     if ($model->jenis_kelamin === 'laki-laki') {
    //                         return '<div class="rounded px-3 py-1 bg-black w-60 mx-auto text-center">laki-laki</div>';
    //                     } else {
    //                         return '<div class="rounded px-3 py-1 bg-pink text-white w-60 mx-auto text-center">perempuan</div>';
    //                     }
    //                 })
    //                 ->addColumn('foto_profile', function ($model) {
    //                     if ($model->profile && $model->profile->foto_profile) {
    //                         return asset('storage/profile_images/' . $model->profile->foto_profile);
    //                     } else {
    //                         return null; // Jika tidak ada foto profil
    //                     }
    //                 })
    //                 ->addColumn('ktp', function ($model) {
    //                     if ($model->profile && $model->profile->ktp) {
    //                         return asset('storage/ktps/' . $model->profile->ktp);
    //                     } else {
    //                         return null; // Jika tidak ada foto KTP
    //                     }
    //                 })
    //                 ->addColumn('action', function($row){
    //                     $editUrl = route('page.admin.edit', ['id' => $row->id]);
    //                     $deleteUrl = route('page.admin.delete', ['id' => $row->id]);

    //                     $actionBtn = '<div class="d-flex justify-content-center">
    //                                     <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold">Edit</a>
    //                                         <form action="'.$deleteUrl.'" method="POST" class="d-inline-block" style="margin-left: 5px;">
    //                                             '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit">Delete</button>
    //                                         </form>
    //                                 </div>';
    //                     return $actionBtn;
    //                 })
    //                 ->rawColumns(['jenis_kelamin', 'action'])
    //                 ->make(true);
    //         } catch (\Exception $e) {
    //             Log::error($e);
    //             return response()->json(['error' => 'Something went wrong!'], 500);
    //         }
    //     }
    //     return abort(404);
    // }
    
    // // Fitur List Loker
    // public function listLoker()
    // {
    //     $lokers = Loker::all();
    //     return view('page.admin.listLoker', compact('lokers'));
    // }

    // // Form tambah Loker User
    // public function addLokerUser()
    // {
    //     return view('page.admin.addLoker');
    // }

    // // Simpan Loker User
    // public function storeLokerUser(Request $request)
    // {
    //     $request->validate([
    //         'posisi_loker' => 'required|string|max:255',
    //         'jumlah_loker' => 'required|integer|min:1',
    //         'kualifikasi' => 'required|string|max:255',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         Loker::create([
    //             'posisi_loker' => $request->posisi_loker,
    //             'jumlah_loker' => $request->jumlah_loker,
    //             'kualifikasi' => $request->kualifikasi,
    //             'user_id' => Auth::id(),
    //         ]);

    //         DB::commit();
    //         return redirect()->route('page.admin.listLoker')->with('success', 'Loker berhasil ditambahkan.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('page.admin.addLoker')->with('error', 'Gagal menambahkan loker: ' . $e->getMessage());
    //     }
    // }

    // // Form edit Loker User
    // public function editLokerUser($id)
    // {
    //     $loker = Loker::findOrFail($id);
    //     return view('page.admin.editLoker', compact('loker'));
    // }

    // // Update Loker User
    // public function updateLokerUser(Request $request, $id)
    // {
    //     $request->validate([
    //         'posisi_loker' => 'required|string|max:255',
    //         'jumlah_loker' => 'required|integer|min:1',
    //         'kualifikasi' => 'required|string|max:255',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         Loker::findOrFail($id)->update([
    //             'posisi_loker' => $request->posisi_loker,
    //             'jumlah_loker' => $request->jumlah_loker,
    //             'kualifikasi' => $request->kualifikasi,
    //         ]);

    //         DB::commit();
    //         return redirect()->route('page.admin.listLoker')->with('success', 'Loker berhasil diperbarui.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('page.admin.editLoker', ['id' => $id])->with('error', 'Gagal memperbarui loker: ' . $e->getMessage());
    //     }
    // }

    // // Hapus Loker User
    // public function deleteLokerUser($id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         Loker::findOrFail($id)->delete();

    //         DB::commit();
    //         return redirect()->route('page.admin.listLoker')->with('success', 'Loker berhasil dihapus.');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->route('page.admin.listLoker')->with('error', 'Gagal menghapus loker: ' . $e->getMessage());
    //     }
    // }

    // public function datatableLoker(Request $request)
    // {
    //     if ($request->ajax()) {
    //         try {
    //             $data = Loker::with('umkm', 'user')->get();
                
    //             return DataTables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('nama', function ($model) {
    //                     return $model->user ? $model->user->nama : 'N/A';
    //                 })
    //                 ->addColumn('nama_umkm', function ($model) {
    //                     return $model->umkm ? $model->umkm->nama_umkm : 'N/A';
    //                 })
    //                 ->addColumn('action', function($row){
    //                     $editUrl = route('page.admin.editLoker', ['id' => $row->id]);
    //                     $deleteUrl = route('page.admin.deleteLoker', ['id' => $row->id]);

    //                     $actionBtn = '<div class="d-flex justify-content-center">
    //                                     <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold">Edit</a>
    //                                         <form action="'.$deleteUrl.'" method="POST" class="d-inline-block" style="margin-left: 5px;">
    //                                             '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit">Delete</button>
    //                                         </form>
    //                                 </div>';
    //                     return $actionBtn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //         } catch (\Exception $e) {
    //             Log::error($e);
    //             return response()->json(['error' => 'Something went wrong!'], 500);
    //         }
    //     }
    //     return abort(404);
    // }
}
