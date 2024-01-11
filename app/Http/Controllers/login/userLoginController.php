<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\user\master_major;
use App\Models\user\user;
use Illuminate\Support\Facades\Validator;

class userLoginController extends Controller
{
    public function login()
    {
        return view('login/login');
    }
    public function loginPost(Request $request)
{
    // Validasi input pengguna
    $request->validate([
        'npm' => 'required|numeric',
        'password' => 'required',
    ]);

    // Mencari pengguna berdasarkan NPM
    $user = User::where('npm', $request->npm)->first();

    // Memeriksa apakah pengguna ditemukan
    if (!$user) {
        return redirect()->route('login')->with('failed', 'Invalid login, NPM Tidak Ditemukan');
    }

    // Memeriksa apakah NPM yang diberikan sesuai dengan NPM pengguna yang terotentikasi
    if ($user->npm != $request->npm) {
        return redirect()->route('login')->with('failed', 'Invalid login, NPM Salah');
    }

    // Memeriksa apakah password sesuai
    if (Hash::check($request->password, $user->password)) {
        // Menyiapkan data untuk dikirim ke frontend
        $major = $user->major;
        $majorName = $major->name ? $major->name : null;
        $prodi = $user->prodi;

        // Menyiapkan data untuk dikirim ke frontend
        $userData = [
            'user_id' => $user->id,
            'isLoggedIn' => true,
            'id_role' => $user->id_role,
            'npm' => $user->npm,
            'name' => $user->name,
            'id_major' => $user->id_major,
            'major_name' => $majorName, // Menambahkan data jurusan
            'prodi' => $prodi, // Menambahkan data prodi
        ];

        // Mengirim respons JSON ke frontend
        return response()->json($userData);
    } else {
        // Jika password tidak sesuai
        return redirect()->route('login')->with('failed', 'Invalid login, Password Salah');
    }
}


    //     public function loginPost(Request $request)
    // {
    //     // Validasi input pengguna
    //     $request->validate([
    //         'npm' => 'required|numeric',
    //         'password' => 'required',
    //     ]);

    //     // Mencari pengguna berdasarkan NPM
    //     $user = User::where('npm', $request->npm)->first();

    //     // Memeriksa apakah pengguna ditemukan
    //     if (!$user) {
    //         return redirect()->route('login')->with('failed', 'Invalid login, NPM Tidak Ditemukan');
    //     }

    //     // Memeriksa apakah NPM yang diberikan sesuai dengan NPM pengguna yang terotentikasi
    //     if ($user->npm != $request->npm) {
    //         return redirect()->route('login')->with('failed', 'Invalid login, NPM Salah');
    //     }

    //     // Memeriksa apakah password sesuai
    //     if (Hash::check($request->password, $user->password)) {
    //         // Simpan informasi sesi login di local storage menggunakan JavaScript
    //         echo "<script>
    //                 localStorage.setItem('isLoggedIn', 'true');
    //                 localStorage.setItem('username', '" . $user->username . "');
    //                 </script>";

    //         // Memeriksa peran pengguna dan mengarahkan sesuai
    //         if ($user->id_role == 2) {
    //             return redirect()->route('dashboard.index');
    //         } else {
    //             return redirect()->route('AdminDashboard.index');
    //         }
    //     } else {
    //         // Jika password tidak sesuai
    //         return redirect()->route('login')->with('failed', 'Invalid login, Password Salah');
    //     }


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
