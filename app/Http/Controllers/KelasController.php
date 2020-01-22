<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Kelas;

class KelasController extends Controller
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
        $data = Kelas::get();
        $message = "";

        if ($data->count() > 0) {
            $message = "Berhasil mengambil data kelas";
        } else {
            $message = "Data Kosong";
        }

        $result = [
            "message" => $message,
            "data" => $data
        ];

        return response()->json($result);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'id_sekolah' => 'required'
        ]);

        $input = Kelas::create([
            'nama' => $request->nama,
            'id_sekolah' => $request->id_sekolah
        ]);

        if ($input) {
              $result = array(
                    'message' => 'Data Sekolah Berhasil di Simpan.',
                    'data' => $input
                );
            return response()->json($result);
        } else {
            $result = array(
                    'message' => 'Data gagal diinput.'
                );
            return response()->json($result);
        }
    }

    public function update(Request $request, $id)
    {
        $data = Kelas::find($id);

        $result = ["message" => "data tidak ditemukan"];

        if ($data) {
            $data->nama = $request->nama;
            $data->id_sekolah = $request->id_sekolah;
        
            $data->save();

            $result = [
                "message" => "Data berhasil di update",
                "data" => $data
            ];
            return response()->json($result);
        } else {
            return response()->json($result);
        }
    }

    public function delete(Request $request, $id)
    {
        $data = Kelas::find($id);

        $result = ["message" => "data tidak ditemukan"];

        if ($data) {
            $data->delete();

            $result = ["message" => "data berhasil dihapus"];

            return response()->json($result);
        } else {
            return response()->json($result);
        }
    }

}
