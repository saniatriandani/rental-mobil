<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pelanggan_model;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;


class pelangganController extends Controller
{
    public function index(){
      if(Auth::user()->level=="admin"){
        $pelanggan=pelanggan_model::get();
        return response()->json($pelanggan);
      } else {
        return response()->json(['status'=>'anda bukan admin']);
      }
    }

    public function store(Request $req){
      $validator = Validator::make($req->all(),
      [
        'nama_pelanggan' => 'required',
        'alamat_pelanggan' => 'required',
        'telp' => 'required',
        'no_ktp' => 'required',
        'foto' => 'required'
      ]);
      if($validator->fails()){
        return Response()->json($validator->errors());
      }
      $simpan = pelanggan_model::create([
        'nama_pelanggan' => $req->nama_pelanggan,
        'alamat_pelanggan' => $req->alamat_pelanggan,
        'telp' => $req->telp,
        'no_ktp' => $req->no_ktp,
        'foto' => $req->foto
      ]);
      $status=1;
      $message="Yey pelanggan Berhasil ditambahkan";
      if($simpan){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }

    public function update($id, Request $req){
      $validator = Validator::make($req->all(),
      [
        'nama_pelanggan' => 'required',
        'telp' => 'required',
        'alamat_pelanggan' => 'required',
        'no_ktp' => 'required',
        'foto' => 'required',
      ]);
      if($validator->fails()){
        return Response()->json($validator->errors());
      }
      $ubah = pelanggan_model::where('id', $id)->update([
        'nama_pelanggan' => $req->nama_pelanggan,
        'alamat_pelanggan' => $req->alamat_pelanggan,
        'telp' => $req->telp,
        'no_ktp' => $req->no_ktp,
        'foto' => $req->foto
      ]);
      $status=1;
      $message="Yey Kamu Berhasil Mengubah data pelanggan yang ada";
      if($ubah){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }

    public function tampil(){
      $pelanggan=pelanggan_model::get();
      $count=$pelanggan->count();
      $arr_data=array();
      foreach ($pelanggan as $pelanggan){
        $arr_data[]=array(
          'id' => $pelanggan->id,
          'nama_pelanggan' => $pelanggan->nama_pelanggan,
          'alamat_pelanggan' => $pelanggan->alamat_pelanggan,
          'telp' => $pelanggan->telp,
          'no_ktp' => $pelanggan->no_ktp,
          'foto' => $pelanggan->foto
        );
      }
      $status=1;
      return Response()->json(compact('status','count','arr_data'));
    }

    public function destroy($id){
      $hapus = pelanggan_model::where('id', $id)->delete();
      $status=1;
      $message="Yey Kamu Berhasil Menghapus data pelangganmu";
      if($hapus){
        return Response()->json(compact('status','message'));
      } else {
        return Response()->json(['status' => 0]);
      }
    }
}
