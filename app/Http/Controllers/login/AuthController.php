<?php

namespace App\Http\Controllers\login; // Adjust this according to your directory structure

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\user; // or use the correct namespace for your User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\user\master_major;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('login/login');
    }

    public function loginPost(Request $request)
{
    $credentials = $request->only('npm', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Menggunakan eager loading untuk mengambil relasi Major
        $userWithMajor = User::with('major')->find($user->id);

        // Menentukan nilai untuk majorName
        $majorName = $userWithMajor->major ? $userWithMajor->major->name : null;

        // Menyusun data tambahan berdasarkan peran (role)
        $additionalData = [
            'user_id' => $userWithMajor->id,
            'isLoggedIn' => true,
            'id_role' => $userWithMajor->id_role,
            'npm' => $userWithMajor->npm,
            'name' => $userWithMajor->name,
        ];

        // Jika pengguna adalah admin (id_role === 1)
        if ($userWithMajor->id_role === 1) {
            // Hanya menyimpan data yang sesuai untuk admin
            $additionalData['isAdmin'] = true;
        } else {
            // Jika bukan admin, tambahkan data tambahan
            $additionalData['id_major'] = $userWithMajor->id_major;
            $additionalData['prodi'] = $userWithMajor->prodi;
            $additionalData['major_name'] = $majorName;
            $additionalData['isUser'] = true;
        }

        // Menggabungkan data tambahan ke dalam response
        $responseData = [
            'success' => true,
            'additional_data' => $additionalData,
        ];

        return response()->json($responseData);
    }

    return response()->json(['success' => false, 'error' => 'Invalid login credentials']);
}







    public function register()
    {
        $majors = master_major::all();
        return view('login/register', compact('majors'));
    }

    public function registerPost(Request $request)
    {
        
        // Validasi input pengguna saat registrasi
        // Validasi input pengguna
        $validator = Validator::make($request->all(), [
            'npm' => 'required|numeric|unique:users', // Pastikan NPM unik
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'prodi' => 'required',
            'id_major' => 'required',
            'class_year' => 'required|numeric',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Simpan pengguna baru ke dalam database
            $user = new user();
            $user->npm = $request->npm;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->prodi = $request->prodi;
            $user->id_major = $request->id_major;
            $user->class_year = $request->class_year;
            $user->id_role = 2;
            $user->is_active = 1;
            $user->save();

            return back()->with('success', 'Registrasi berhasil.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tambahkan error ke sesi
            return back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.'])->withInput();
        }

            }
}
