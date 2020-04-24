<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mobil_model;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;


class mobilController extends Controller
{
    public function index(){
      if(Auth::user()->level=="admin"){
        $mobil=mobil_model::get();
        return response()->json($mobil);
      } else {
        return response()->json(['status'=>'anda bukan admin']);
      }
    }

    public function store(Request $req){
      $validator = Validator::make($req->all(),
      [
        'id_jenis_mobil' => 'required',
        'nama_mobil' => 'required',
        'plat_nomor' => 'required',
        'kondisi' => 'required'
      ]);
      if($validator->fails()){
        return Response()->json($validator->errors());
      }
      $simpan = mobil_model::create([
        'id_jenis_mobil' => $req->id_jenis_mobil,
        'nama_mobil' => $req->nama_mobil,
        'plat_nomor' => $req->plat_nomor,
        'kondisi' => $req->kondisi
      ]);
      $status=1;
      $message="Yey Data Mobil Berhasil ditambahkan";
      if($simpan){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }

    public function update($id, Request $req){
      $validator = Validator::make($req->all(),
      [
        'id_jenis_mobil' => 'required',
        'nama_mobil' => 'required',
        'plat_nomor' => 'required',
        'kondisi' => 'required'
      ]);
      if($validator->fails()){
        return Response()->json($validator->errors());
      }
      $ubah = mobil_model::where('id', $id)->update([
        'nama_mobil' => $req->nama_mobil,
        'id_jenis_mobil' => $req->id_jenis_mobil,
        'plat_nomor' => $req->plat_nomor,
        'kondisi' => $req->kondisi
      ]);
      $status=1;
      $message="Yey Kamu Berhasil Mengubah Data Mobil yang ada";
      if($ubah){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }

    public function tampil(){
      $mobil=mobil_model::get();
      $count=$mobil->count();
      $arr_data=array();
      foreach ($mobil as $mobil){
        $arr_data[]=array(
          'id' => $mobil->id,
          'nama_mobil' => $mobil->nama_mobil,
          'id_jenis_mobil' => $mobil->id_jenis_mobil,
          'plat_nomor' => $mobil->plat_nomor,
          'kondisi' => $mobil->kondisi
        );
      }
      $status=1;
      return Response()->json(compact('status','count','arr_data'));
    }

    public function destroy($id){
      $hapus = mobil_model::where('id', $id)->delete();
      $status=1;
      $message="Yey Kamu Berhasil Menghapus Data filmmu";
      if($hapus){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }
}
