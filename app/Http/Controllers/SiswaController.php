<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Siswa;
use App\Kelas;
use App\Sekolah;

class SiswaController extends Controller
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
        $data = Siswa::get();
        $message = "";

        if ($data->count() > 0) {
            $message = "Berhasil mengambil data Siswa";
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
            'email' => 'required',
            'id_kelas' => 'required',
            'gender' => 'required'
        ]);

        $input = Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'id_kelas' => $request->id_kelas,
            'gender' => $request->gender
        ]);

        if ($input) {
              $result = [
                    'message' => 'Data Siswa Berhasil di Simpan.',
                    'data' => $input
                ];
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
        $data = Siswa::find($id);

        $result = ["message" => "data tidak ditemukan"];

        if ($data) {
            $data->nama = $request->nama;
            $data->email = $request->email;
            $data->id_kelas = $request->id_kelas;
            $data->gender = $request->gender;
        
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
        $data = Siswa::find($id);

        $result = ["message" => "data tidak ditemukan"];

        if ($data) {
            $data->delete();

            $result = ["message" => "data berhasil dihapus"];

            return response()->json($result);
        } else {
            return response()->json($result);
        }
    }

    public function showbykelas(Request $request, $id_kelas)
    {
        $siswa = Siswa::where('id_kelas', $id_kelas)->get();

        $result = ["message" => "data tidak ditemukan"];

            if ($siswa){
                $result = array(
                    "message" => "data ditemukan",
                    "data" => $siswa
                );
                return response()->json($result);
            }

    return response()->json($result);
   }
    
    public function showbysekolah(Request $request, $id)
    {
        //=====================WhereIn===================
        $kelas = Kelas::where('id_sekolah', $id)->get();

        $kelasId = $kelas->pluck('id');  // [1,2]

        $siswa = Siswa::whereIn('id_kelas', $kelasId)->get();

        $result = array(
            'message' => 'Data Berhasil di Tampilkan.',
            'data' => $siswa
        );

        return response()->z($result);
        //========================================
    //     $sekolah = Sekolah::find($id);
    //     $kelas = Kelas::where('id_sekolah', $id)->get();

    //     $data = [];
        
    //     foreach ($kelas as $kelas) {
    //         $siswa = Siswa::where('id_kelas', $kelas['id'])->get();
    //             foreach ($siswa as $siswas) {
    //                 $data[] = $siswas;
    //             }
    //     }

    //     $result = ["message" => "data tidak ditemukan"];

    //         if ($siswa){
    //             $result = array(
    //                 "message" => "data ditemukan",
    //                 "data" => $data
    //             );
    //             return response()->json($result);
    //         }

    // return response()->json($result);
    }

    public function sortirkelas(Request $request, $id)
    {
        $sekolah = Sekolah::with([
            'kelas' => function($q) {
                $q->with('siswa');
            }
        ])->find($id);
        
        $result = array(
            'message' => 'Data Berhasil di Tampilkan.',
            'data' => $sekolah
        );
        return response()->json($result);
     


        //========================================

    //     $sekolah = Sekolah::find($id);
    //     $kelas = Kelas::where('id_sekolah', $id)->get();
        
    //     $data = [];

    //         foreach ($kelas as $kelass) {
    //             $siswa = Siswa::where('id_kelas', $kelass['id'])->get();
    //             $data[] = $siswa;
    //         }

    //      $result = ["message" => "data tidak ditemukan"];

    //         if ($data){
    //             $result = array(
    //                 "message" => "data ditemukan",
    //                 "data" => $data
    //             );
    //             return response()->json($result);
    //         }

    //     return response()->json($result);
    // }
            }
        }

