<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\booking\booking;
use App\Models\booking\Pesan;
use App\Models\bus\master_bus;
use Illuminate\Support\Facades\Validator;
use App\Models\user\master_major;
use App\Models\user\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


class peminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    // Mendapatkan objek User yang sedang login
    $user = Auth::user();

    // Memeriksa apakah user ada sebelum melanjutkan
    if ($user) {
        // Mendapatkan nilai dari query string 'query'
        $query = $request->input('query', ''); // Menyertakan nilai default string kosong jika query tidak ada

        $bookings = Booking::with('user')
            ->where('user_id', $user->id)
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('nameActivity', 'like', "%$query%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.peminjaman', compact('bookings', 'query'));
    } else {
        // Handle jika user tidak ditemukan (mungkin mengarahkan ke halaman login, dll.)
        return redirect()->route('login');
    }
}


    
//     public function index(Request $request)
// {
//     $query = $request->input('query');

//     $bookings = booking::with('user')
//         ->when($query, function ($queryBuilder) use ($query) {
//             $queryBuilder->whereHas('user', function ($userQuery) use ($query) {
//                 $userQuery->where('name', 'like', "%$query%");
//             });
//         })
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return view('user.index', compact('bookings', 'query'));
// }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = user::all();
        $majors = master_major::all();
        $buses = master_bus::all();
        return view('user.addBooking', compact('majors','data','buses'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'nameActivity' => 'required|string',
             'destination' => 'required|string',
             'departure_date' => 'required|date',
             'date_finish' => 'required|date|after:departure_date',
             'image_latter' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
             'id_bus' => 'required', // Sesuaikan ini dengan aturan validasi yang sesuai
             'user_id' => 'required', // Sesuaikan ini dengan aturan validasi yang sesuai
             // ... tambahkan aturan validasi lainnya ...
         ]);
     
         if ($validator->fails()) {
             return redirect()->route('peminjaman.index')
                 ->withErrors($validator)
                 ->withInput();
         }
     
         $file = $request->file('image_latter')->store('images', 'public');
     
         $data = [
             'nameActivity' => $request->input('nameActivity'),
             'destination' => $request->input('destination'),
             'departure_date' => $request->input('departure_date'),
             'date_finish' => $request->input('date_finish'),
             'image_latter' => $file,
             'id_bus' => $request->input('id_bus'), // Sesuaikan ini dengan nama sebenarnya
             'id_status' => 1, // Sesuaikan ini dengan nama sebenarnya
             'id_major' => null, // Sesuaikan ini dengan nama sebenarnya
             'user_id' => $request->input('user_id'),
         ];
     
         booking::create($data);
     
         return redirect()->route('peminjaman.index')->with('success', 'Berhasil menambahkan data');
     }
     
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        // peminjamanController.php
        public function show($id)
{
    try {
        // Temukan peminjaman berdasarkan ID
        $peminjaman = booking::findOrFail($id);

        // Temukan data bus terkait berdasarkan ID bus pada peminjaman
        $bus = master_bus::findOrFail($peminjaman->id_bus);

        // Ambil pesan penolakan jika ada
        $pesanPenolakan = Pesan::where('peminjaman_id', $peminjaman->id)->first();

        return view('user.detailBooking', compact('peminjaman', 'bus', 'pesanPenolakan'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('peminjaman.index')->with('error', 'Data tidak ditemukan.');
    } catch (\Exception $e) {
        return redirect()->route('peminjaman.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
        

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // peminjamanController.php
    public function edit($id)
    {
        try {
            // Temukan peminjaman berdasarkan ID
            $peminjaman = booking::findOrFail($id);
            $data = user::all();
            $majors = master_major::all();

            return view('user.editBooking', compact('peminjaman', 'data', 'majors'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('peminjaman.index')->with('error', 'Data tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // peminjamanController.php
    public function update(Request $request, $id)
    {
        try {
            // Validasi data dari formulir
            $validator = Validator::make($request->all(), [
                'nameActivity' => 'required|string',
                'destination' => 'required|string',
                'departure_date' => 'required|date',
                'date_finish' => 'required|date|after:departure_date',
                'image_latter' => 'image|mimes:png,jpg,jpeg,svg|max:2048',
                // ... tambahkan aturan validasi lainnya ...
            ]);

            if ($validator->fails()) {
                return redirect()->route('peminjaman.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            // Temukan peminjaman berdasarkan ID
            $peminjaman = booking::findOrFail($id);

            // Update data peminjaman
            $peminjaman->update([
                'nameActivity' => $request->input('nameActivity'),
                'destination' => $request->input('destination'),
                'departure_date' => $request->input('departure_date'),
                'date_finish' => $request->input('date_finish'),
                // ... update properti lainnya ...
            ]);

            // Jika ada file gambar yang diunggah, proses dan simpan
            if ($request->hasFile('image_latter')) {
                $file = $request->file('image_latter')->store('images', 'public');
                $peminjaman->update(['image_latter' => $file]);
            }

            return redirect()->route('peminjaman.index')->with('success', 'Berhasil mengupdate data.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('peminjaman.index')->with('error', 'Data tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // peminjamanController.php
    public function destroy($id)
{
    try {
        // Temukan peminjaman berdasarkan ID
        $booking = booking::findOrFail($id);

        // Hapus file gambar dari penyimpanan
        $imagePath = public_path('storage/' . $booking->image_latter);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Hapus peminjaman dari database
        $booking->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Berhasil menghapus data.');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Tangani jika model tidak ditemukan
        return redirect()->route('peminjaman.index')->with('error', 'Data tidak ditemukan.');
    } catch (\Exception $e) {
        // Tangani kesalahan umum
        return redirect()->route('peminjaman.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


}
