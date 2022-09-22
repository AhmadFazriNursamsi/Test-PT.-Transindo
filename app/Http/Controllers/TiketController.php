<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Http\Controllers\HelpersController as Helpers;


class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
        
    public function index2(Request $request)
    {
        return view('tiket');
    }
    public function index(Request $request)
    {
        $datas = new Tiket;
        
        $datas->nama = $request->nama;
        $datas->email = $request->email;
        $datas->jk = $request->jk;
        $first =  $request->nama;
        $last = $datas->id;
        $datas->created_at = date('Y-m-d H:i:s');
        $datas_tiket = $datas->id_tiket = $datas->id_tiket = Helpers::generateKodetiket($first, $last);;
        $datas->save();

        // return redirect("tiket/$last")->with('status', 'Profile updated!');
        return redirect("tiket")->with('status', "Tiket Sudah Terpesan, Dengan  Nama: $first Nomor Id : $datas_tiket");
        // if($last){
        //     return redirect("/tiketoutput/$last");
        // }

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
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function edit(Tiket $tiket, $id)
    {
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tiket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tiket $tiket)
    {
        //
    }
}
