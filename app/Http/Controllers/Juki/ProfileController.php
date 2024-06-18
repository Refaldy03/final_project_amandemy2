<?php

namespace App\Http\Controllers\Juki;
use App\Http\Controllers\Controller;

use App\Models\Profile;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProfileController extends Controller
{
    // Menampilkan Profile
    public function showProfil()
    {
        $user = Auth::user();
        $profile = $user->profile;
        return view('page.juki.profil', [ 'user' => $user, 'profile' => $profile, 'navbar' => 'navbarDashboard_Profil_Loker', 'footer' => 'footer' ]);
    }

    // Update Profile
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        $validator = Validator::make($request->all(), [
            'foto_profile' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => $request->filled('password') ? 'required|min:8|confirmed' : '',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|min:0|max:15',
            'ktp' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profil')
                ->withErrors($validator)
                ->withInput();
        }

        // Mengecek apakah perubahan password diperbolehkan (setiap seminggu sekali)
        $lastPasswordChange = $user->password_changed_at;
        $oneWeekAgo = now()->subWeek();

        if ($lastPasswordChange !== null && $lastPasswordChange >= $oneWeekAgo && $request->filled('password')) {
            return redirect()->route('profil')->with('error', 'Anda hanya dapat mengubah profile sekali dalam seminggu.');
        }

        DB::beginTransaction();

        try {
            // Update Data User
            $userData = [
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_wa' => $request->no_wa,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
                $userData['password_changed_at'] = Carbon::now();
            }

            // Menimpan Data User
            $userSaved = DB::table('users')->where('id', $user->id)->update($userData);
            
            if (!$userSaved) {
                throw new \Exception('Gagal memperbarui data user');
            }

            // Update Data Profile
            if ($request->hasFile('foto_profile')) {
                if ($profile->foto_profile) {
                    Storage::delete('public/' . $profile->foto_profile);
                }
                $foto_profile = $request->file('foto_profile');
                $foto_profile_path = $foto_profile->store('public/profile_images');
                $profile->foto_profile = str_replace('public/', '', $foto_profile_path);
            }

            if ($request->hasFile('ktp')) {
                if ($profile->ktp) {
                    Storage::delete('public/' . $profile->ktp);
                }
                $ktp = $request->file('ktp');
                $ktp_path = $ktp->store('public/ktps');
                $profile->ktp = str_replace('public/', '', $ktp_path);
            }

            // Menyimpan Data Profile
            if (!$profile->save()) {
                throw new \Exception('Gagal memperbarui profile');
            }

            DB::commit();
            return redirect()->route('profil')->with('success', 'Profile berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('profil')->with('error', 'Gagal memperbarui profile: ' . $e->getMessage());
        }
    }
}
