<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Sekolah;

class SekolahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(Request $request)
    {
        $sekolah = Sekolah::get();
        $message = "";

            if ($sekolah->count() > 0) {
                $message = "Berhasil Mengambil Data sekolah.";
            } else {
                $message = "Data Kosong.";
            }

        $result = array(
            "message" => $message,
            "data" => $sekolah
        );

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        $insert = Sekolah::create([
            'nama' => $request->nama,
        ]);

        $result = array(
            'message' => 'Data Sekolah Berhasil di Simpan.',
            'data' => $insert
        );

        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $sekolah = Sekolah::find($id);

        $result = ["message" => "data tidak ditemukan"];

            if($sekolah){
                $sekolah->nama = $request->nama;
            
                $sekolah->save();

                $result = array(
                    "message" => "data berhasil di update",
                    "data" => $sekolah
                );

                return response()->json($result);
            }

        return response()->json($result);
    }

    public function delete(Request $request, $id)
    {
        $sekolah = Sekolah::find($id);

        $result = ["message" => "data tidak ditemukan"];
        
            if ($sekolah) {
                $sekolah->delete();

                $result = ["message" => "data berhasil dihapus"];

                return response()->json($result);
            }
            return response()->json($result);
    }
}
