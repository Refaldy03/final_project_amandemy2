<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ListUserController extends Controller
{
    // Fitur List Users
    public function users()
    {
        $users = User::all();
        return view('page.admin.index', compact('users'));
    }

    // Tambah user
    public function addUser()
    {
        return view('page.admin.add');
    }

    // Store user
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_wa' => 'required|string|min:0|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.admin.add')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $userRole = 'user';

            if ($request->email === 'adminjuki5@gmail.com' && $request->password === 'adminJuki@2024') {
                $userRole = 'superadmin';
            }

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_wa' => $request->no_wa,
            ]);

            // Mengambil peran berdasarkan nama
            $role = Role::where('name', $userRole)->first();

            if ($role) {
                $user->assignRole($role);
            }

            DB::commit();
            return redirect()->route('page.admin.index')->with('success', 'User added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('page.admin.add')->with('error', 'Failed to add user: ' . $e->getMessage());
        }
    }

    // Edit User
    public function editUser($id)
    {
        $user = User::find($id);
        $user->role = $user->roles->first()->name;
        return view('page.admin.edit', compact('user'));
    }

    // Update User
    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_wa' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('page.admin.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $user = User::find($id);

            $user->nama = $request->nama;
            $user->email = $request->email;

            if ($request->password)
                $user->password = Hash::make($request->password);

            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->no_wa = $request->no_wa;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->alamat = $request->alamat;
            $user->save();

            $user->syncRoles([$request->role]);

            DB::commit();
            return redirect()->route('page.admin.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('page.admin.edit', $id)->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    // Delete User
    public function deleteUser($id)
    {
        DB::beginTransaction();

        try {
            $user = User::find($id);

            if ($user->id == Auth::user()->id)
                return redirect()->route('page.admin.index')->with('error', 'You cannot delete your own account');

            $user->delete();

            // detech role
            $user->syncRoles([]);

            DB::commit();
            return redirect()->route('page.admin.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('page.admin.index')->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }

    // Datatable List User
    public function datatableUser(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = User::with('profile');

                if ($request->filled('jenis_kelamin')) {
                    $data = $data->where('jenis_kelamin', $request->jenis_kelamin);
                }

                $filteredData = $data->get();
                
                return DataTables::of($filteredData)
                    ->addIndexColumn()
                    ->editColumn('jenis_kelamin', function ($model) {
                        if ($model->jenis_kelamin === 'laki-laki') {
                            return '<div class="rounded px-3 py-1 bg-black w-60 mx-auto text-center">laki-laki</div>';
                        } else {
                            return '<div class="rounded px-3 py-1 bg-pink text-white w-60 mx-auto text-center">perempuan</div>';
                        }
                    })
                    ->addColumn('foto_profile', function ($model) {
                        if ($model->profile && $model->profile->foto_profile) {
                            return asset('storage/' . $model->profile->foto_profile);
                        } else {
                            return null; // Jika tidak ada foto profil
                        }
                    })
                    ->addColumn('ktp', function ($model) {
                        if ($model->profile && $model->profile->ktp) {
                            return asset('storage/' . $model->profile->ktp);
                        } else {
                            return null; // Jika tidak ada foto KTP
                        }
                    })
                    ->addColumn('action', function($row){
                        $editUrl = route('page.admin.edit', ['id' => $row->id]);
                        $deleteUrl = route('page.admin.delete', ['id' => $row->id]);

                        $actionBtn = '<div class="d-flex justify-content-center">
                                        <a href="'.$editUrl.'" class="edit btn btn-warning btn-sm fw-semibold">Edit</a>
                                            <form action="'.$deleteUrl.'" method="POST" class="d-inline-block" style="margin-left: 5px;">
                                                '.csrf_field().' <button class="btn btn-danger btn-sm fw-semibold" type="submit">Delete</button>
                                            </form>
                                    </div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['jenis_kelamin', 'action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error($e);
                return response()->json(['error' => 'Something went wrong!'], 500);
            }
        }
        return abort(404);
    }
}
