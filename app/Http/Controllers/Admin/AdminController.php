<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking\booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{ 
    $allCount = booking::count();
    
    $pendingCount = booking::where('id_status', 1)->count(); // Gantilah 1 dengan nilai yang sesuai
    $approvedCount = booking::where('id_status', 2)->count(); // Gantilah 2 dengan nilai yang sesuai
    $rejectedCount = booking::where('id_status', 3)->count(); // Gantilah 3 dengan nilai yang sesuai

    $bookings = booking::with('user')->orderBy('created_at', 'desc')->take(5)->get();

    return view('admin.indexAdmin', compact('bookings', 'pendingCount', 'approvedCount', 'rejectedCount','allCount'));
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
        //
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
