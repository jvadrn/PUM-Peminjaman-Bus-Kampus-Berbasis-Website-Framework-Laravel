<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking\booking;
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
    public function show($id)
{
    try {
        // Temukan peminjaman berdasarkan ID
        $peminjaman = booking::findOrFail($id);

        if (request()->isMethod('get')) {
            // Jika formulir untuk menolak dikirim
            if (request()->has('tolak')) {
                // Lakukan logika penolakan, set id_status menjadi 2
                $peminjaman->id_status = 3;
                $peminjaman->save();

                // Redirect dengan memberi tahu bahwa peminjaman berhasil ditolak
                return redirect()->route('AdminPeminjaman.index')->with('success', 'Peminjaman berhasil ditolak');
            }

            // Jika formulir untuk menyetujui dikirim
            if (request()->has('setuju')) {
                // Lakukan logika persetujuan, set id_status menjadi 3
                $peminjaman->id_status = 2;
                $peminjaman->save();

                // Redirect dengan memberi tahu bahwa peminjaman berhasil disetujui
                return redirect()->route('AdminPeminjaman.index')->with('success', 'Peminjaman berhasil disetujui');
            }
        }

        return view('admin.DetailAdmin', compact('peminjaman'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('AdminPeminjaman.index')->with('error', 'Data tidak ditemukan.');
    } catch (\Exception $e) {
        return redirect()->route('AdminPeminjaman.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
