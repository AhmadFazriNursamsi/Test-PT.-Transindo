<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Http\Controllers\HelpersController as Helpers;

class AdmintiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdata(Request $request){
        // $users = $users->get();
        
        $admin = Tiket::get();
        // dd($admin);
      
    
            $datas = [];
            foreach($admin as $key => $admin){
              
                $datas[$key] = [
                    $admin->id_tiket,$admin->nama,$admin->email,$admin->id,$admin->jk, 
                ];
            }
            return response()->json(['data' => $datas, 'status' => '200'], 200);
        }

    public function index()
    {
        
        $tiket = Tiket::get();
        // dd($karyawan);
   
        
        return view("tiket.index", array(
            'datas'  => array(
                'Tiket' => $tiket,
                'title' => 'Tiket'
            )
            ));

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
        $datas = new Tiket;
        
        $datas->nama = $request->nama;
        $datas->email = $request->email;
        $datas->jk = $request->jk;
        $first =  $request->nama;
        $last = $datas->id;
        $datas->created_at = date('Y-m-d H:i:s');
        $datas->id_tiket = $datas->id_tiket = Helpers::generateKodetiket($first, $last);;
        $datas->save();


        return response()->json(['data' => ['success'], 'status' => '200'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = Tiket::where('id', $id)->first();
      

        return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = Tiket::where('id', $id)->first();
        // dd($datas);

        return response()->json(['data' => $datas, 'status' => '200'], 200);
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
         $datas = Tiket::where('id', $id)->first();
         $datas->nama = $request->nama;
         $datas->email = $request->email;
         $datas->jk = $request->jk;
         $first =  $request->nama;
         $last = $datas->id;
         $datas->created_at = date('Y-m-d H:i:s');
         $datas->id_tiket = $datas->id_tiket = Helpers::generateKodetiket($first, $last);;
         
        $datas->save();
        return response()->json(['data' => ['success'], 'status' => '200'], 200);
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
