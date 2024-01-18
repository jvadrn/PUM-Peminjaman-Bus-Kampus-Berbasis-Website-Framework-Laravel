<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking\booking;
use App\Models\booking\Pesan;
use App\Models\bus\master_bus;
use Illuminate\Http\Request;

class AdminPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = $request->input('query');
    $userName = $request->input('userName'); // Tambahkan ini untuk mendapatkan input nama user
    
    $bookings = booking::with(['user' => function ($queryBuilder) use ($userName) {
            // Menambahkan kondisi pencarian berdasarkan nama user
            $queryBuilder->where('name', 'like', "%$userName%");
        }])
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('nameActivity', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(7);
    
    return view('admin.peminjamanAdmin', compact('bookings', 'query', 'userName'));
    

}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
{
    try {
        // Temukan peminjaman berdasarkan ID
        $peminjaman = booking::findOrFail($id);
        $bus = master_bus::findOrFail($peminjaman->id_bus);

        // Inisialisasi $downloadSuratUrl
        $downloadSuratUrl = null;

        // Jika formulir untuk menolak dikirim
        if ($request->isMethod('get') && $request->has('tolak')) {
            // Ambil nilai pesan dari request
            $pesanText = $request->input('pesan');

            // Lakukan logika penolakan, set id_status menjadi 3
            $peminjaman->id_status = 3;
            $peminjaman->save();

            // Simpan pesan ke dalam tabel Pesan
            Pesan::create([
                'peminjaman_id' => $peminjaman->id,
                'pesan' => $pesanText,
            ]);

            // Tetapkan URL unduhan
            $downloadSuratUrl = route('download-surat', ['id' => $peminjaman->id]);

            // Redirect dengan memberi tahu bahwa peminjaman berhasil ditolak
            return redirect()->route('AdminPeminjaman.index')->with('success', 'Peminjaman berhasil ditolak');
        }

        // Jika formulir untuk menyetujui dikirim
        if ($request->isMethod('get') && $request->has('setuju')) {
            // Lakukan logika persetujuan, set id_status menjadi 2
            $peminjaman->id_status = 2;
            $peminjaman->save();

            // Redirect dengan memberi tahu bahwa peminjaman berhasil disetujui
            return redirect()->route('AdminPeminjaman.index')->with('success', 'Peminjaman berhasil disetujui');
        }

        // Load view atau lakukan logika lainnya jika metode bukan POST
        return view('admin.DetailAdmin', compact('peminjaman', 'bus', 'downloadSuratUrl'));
    } catch (\Exception $e) {
        // Handle error jika peminjaman tidak ditemukan atau terjadi kesalahan lainnya
        return redirect()->route('AdminPeminjaman.index')->with('error', 'Terjadi kesalahan. Peminjaman tidak ditemukan.');
    }
}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
