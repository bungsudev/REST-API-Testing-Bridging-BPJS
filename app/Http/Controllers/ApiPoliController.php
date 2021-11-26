<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiPoliModel; //deklarasi model pada controller

class ApiPoliController extends Controller
{
    //ambil data poli dari db
    public function get_all_poli(){
        return response([
            'metadata' => array(
                'code' => '1',
                'message' => 'OK'
            ),
            'response' => array(
                'list' => ApiPoliModel::all()
            )
        ], 200);

        //standart output json
        // response()->json(ApiPoliModel::all(), 200);
    }

    //tambah data poli
    public function insert_poli(Request $request){
        try {
            $insert_poli = new ApiPoliModel();
            $insert_poli->nmpoli = $request->nmpoli;
            $insert_poli->nmsubspesialis = $request->nmsubspesialis;
            $insert_poli->kdsubspesialis = $request->kdsubspesialis;
            $insert_poli->kdpoli = $request->kdpoli;
            $insert_poli->save();
            return response([
                'status' => 'OK',
                'message' => 'Berhasil menambah poli',
                'data' => $insert_poli
            ], 200);
        } catch (\Exception $e) {
            return $this->gagal_post('Gagal menambah poli');
        }
    }

    //edit data poli
    public function update_poli(Request $request, $id){
        try {
            $checkPoli = ApiPoliModel::firstWhere('id', $id);
            if ($checkPoli) {
                $data_poli = ApiPoliModel::find($id);
                $data_poli->nmpoli = $request->nmpoli;
                $data_poli->nmsubspesialis = $request->nmsubspesialis;
                $data_poli->kdsubspesialis = $request->kdsubspesialis;
                $data_poli->kdpoli = $request->kdpoli;
                $data_poli->save();
                return response([
                    'status' => 'OK',
                    'message' => 'Berhasil merubah poli',
                    'data' => $data_poli
                ], 200);
            }else{
                return response([
                    'status' => 'Not Found',
                    'message' => 'ID poli tidak di temukan',
                ], 404);
            }
        } catch (\Exception $e) {
            return $this->gagal_post('Gagal merubah poli');
        }
    }

    //delete data poli
    public function delete_poli(Request $request, $id){
        try {
            $checkPoli = ApiPoliModel::firstWhere('id', $id);
            if ($checkPoli) {
                ApiPoliModel::destroy($id);
                return response([
                    'status' => 'OK',
                    'message' => 'Berhasil menghapus poli'
                ], 200);
            }else{
                return response([
                    'status' => 'Not Found',
                    'message' => 'ID poli tidak di temukan',
                ], 404);
            }
        } catch (\Exception $e) {
            return $this->gagal_post('Gagal menghapus poli');
        }
    }

    private function gagal_post($pesan = 'Anda tidak memiliki akses / Layanan tidak tersedia.')
    {
        $response = array(
            'metadata' => array(
                'status' => '422',
                'message' => $pesan
            )
        );
        return $response;
    }
}
