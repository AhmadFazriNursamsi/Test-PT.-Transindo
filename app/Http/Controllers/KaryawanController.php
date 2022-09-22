<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\HelpersController as Helpers;
use App\Http\Controllers\AlamatController as Calamat;
use Illuminate\Support\Facades\Session;
use App\Models\Alamat;
use App\Models\Karyawan;
use App\Models\Loc_province;
use Auth;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends AController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdata(Request $request){
    // $users = $users->get();
    
    $karyawan = Karyawan::get();
    // dd($karyawans);


    	$datas = [];
		foreach($karyawan as $key => $karyawan){
            if($karyawan->logo == 0) {
                $karyawan->logo = 'default.jpg';
            }

    		$datas[$key] = [
    			$karyawan->nama,'',$karyawan->logo,'', $karyawan->id
    		];
    	}
    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }


    public function index()
    {
        $karyawan = Karyawan::get();
        // dd($karyawan);

        $this->access = Helpers::checkaccess('customers', 'view');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }
   
        return view("karyawan.index", array(
            'datas'  => array(
                'karyawan' => $karyawan,
                'title' => 'Karyawan'
            )
            ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd($request);
        // $this->access = Helpers::checkaccess('customer', 'add');
        // if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);
        
        
        $validator = Validator::make($request->all(), [
            
            'website' => 'required',
            'email' => 'unique:karyawan|email|required',
           'last_name'=> 'required',
           'first_name'=> 'required',     
       ],[
   
        'email.unique' => 'Email Sudah Terdaftar!',
        'email.required' => 'Email Tidak Boleh Kosong',
        'first_name.required' => 'First Name Tidak Boleh Kosong',
        'last_name.required' => 'Last Name Tidak Boleh Kosong',
        'website.required' => 'website Tidak Boleh Kosong',

       ]);
        
    //    dd('test');
       if ($validator->fails()) {
           return response()->json(['errors'=>$validator->errors()->all()]);
    }        
    $datas = new Karyawan;
     $datas->first_nama = $request->first_name;
     $datas->last_nama = $request->last_name;
     $first = $datas->first_nama;
     $last = $datas->last_nama; 
     $first .= $last;
     $datas->nama = $first;
     $datas->email = $request->email;
     
    //  dd($request->file('logo'));
    //  $datas->logo = $request->logo->move(public_path('images'), $imageName);
    
    //  if ($request->file() == null)  
 
    if ($request->file() != null) 
        $datas->logo = Helpers::generateKodekaryawan($first, $last);                            
        $helperuntukupload = Helpers::uploadImage($request, $datas->logo);
        $datas->logo = $helperuntukupload;
    
     $datas->website = $request->website;
    $datas->save();
                    
            return response()->json(['data' => ['success'], 'status' => '200'], 200);
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $datas = Karyawan::where('id', $id)->first();
        // dd($datas);

        return response()->json(['data' => $datas, 'status' => '200'], 200);
    }
    public function edit($id){
        // dd($id);
        $datas = Karyawan::where('id', $id)->first();
        // dd($datas);

        return response()->json(['data' => $datas, 'status' => '200'], 200);
    }
    public function update(Request $request, $id){
        
        $datas = Karyawan::where('id', $id)->first();
        $datas->first_nama = $request->first_name;
        $datas->last_nama = $request->last_name;
        $first = $datas->first_nama;
        $last = $datas->last_nama; 
        $first .= $last;
        $datas->nama = $first;
        $datas->email = $request->email;

        if ($request->file() != null) 
        $datas->logo = Helpers::generateKodekaryawan($first, $last);                            
        $helperuntukupload = Helpers::uploadImage($request, $datas->logo);
        
        $datas->logo = $helperuntukupload;
        $datas->website = $request->website;
        $datas->save();
        return response()->json(['data' => ['success'], 'status' => '200'], 200);
    }            


}
