<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $search = $request->katakunci;
    if(strlen($search)){
            $query= mahasiswa::where("NPM", "like" , "%$search%")->
            orwhere("nama", "like" , "%$search%")->
            orwhere("jurusan", "like" , "%$search%")->
            paginate(2);
    } else {
        $query = mahasiswa::orderby("NPM", "asc")->paginate(2);
    }
        return view("mahasiswa.index")->with("query", $query);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("mahasiswa.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash("NPM", $request->NPM);
        Session::flash("nama", $request->nama);
        Session::flash("jurusan", $request->jurusan);

        $request->validate([
            "NPM" => "required|numeric|unique:mahasiswas,NPM|digits:11",
            "nama" => "required",
            "jurusan" => "required",
        ],[
            "NPM.required" => "NPM WAJIB DI ISI",
            "NPM.digits" => "NPM HANYA DAPAT BERISI 11 HURUF",
            "NPM.numeric" => "NPM WAJIB BERUPA ANGKA",
            "NPM.unique" => "NPM YANG ANDA GUNAKAN SUDAH ADA PENGGUNA LAIN,COBA DENGAN NPM LAIN",
            "nama.required" => "NAMA WAJIB DI ISI",
            "jurusan.required" => "JURUSAN WAJIB DI ISI",
        ]);
        
        $input = [
            "NPM" => $request->NPM,
            "nama" => $request->nama,
            "jurusan" => $request->jurusan,
        ];

        mahasiswa::create($input);

        return redirect("mahasiswa")->with('success', 'DATA TELAH BERHASIL DIBUAT');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $query = mahasiswa::where("NPM", $id)->first();
        return view("mahasiswa.edit")->with("query", $query);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nama" => "required",
            "jurusan" => "required",
        ],[
            "nama.required" => "NAMA WAJIB DI ISI",
            "jurusan.required" => "JURUSAN WAJIB DI ISI",
        ]);
        
        $input = [
            "nama" => $request->nama,
            "jurusan" => $request->jurusan,
        ];
        mahasiswa::where("NPM",$id)->update($input);
        return redirect("mahasiswa")->with('success', 'DATA TELAH BERHASIL DIUBAH');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        mahasiswa::where("NPM", $id)->delete();
        return redirect("mahasiswa")->with("success", "DATA TELAH BERHASIL DI HAPUS");
    }
}
