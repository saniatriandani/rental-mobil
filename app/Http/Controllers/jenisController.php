<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis_model;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;


class jenisController extends Controller
{
  // public function index(){
  //   if(Auth::user()->level=="admin"){
  //     $jenis=jenis::get();
  //     return response()->json($jenis);
  //   } else {
  //     return response()->json(['status'=>'anda bukan admin']);
  //   }
  // }

  public function store(Request $req){
    if(Auth::user()->level=="admin"){
    $validator = Validator::make($req->all(),
    [
      'jenis_mobil' => 'required'
    ]);
    if($validator->fails()){
      return Response()->json($validator->errors());
    }
    $simpan = jenis_model::create([
      'jenis_mobil' => $req->jenis_mobil
    ]);
    $status=1;
    $message="Berhasil Menambah Data";
    if($simpan){
      return Response()->json(compact('status','message'));
    } else {
        return Response()->json(['status' => 0]);
    }
  } else {
      return response()->json(['status'=>'anda bukan admin']);
  }
  }

  public function update($id, Request $req){
    $validator = Validator::make($req->all(),
    [
      'jenis_mobil' => 'required'
    ]);
    if($validator->fails()){
      return Response()->json($validator->errors());
    }
    $ubah = jenis_model::where('id', $id)->update([
      'jenis_mobil' => $req->jenis_mobil
    ]);
    $status=1;
    $message="Ubah Data Berhasil";
    if($ubah){
      return Response()->json(compact('status','message'));
    } else {
      return Response()->json(['status' => 0]);
    }
  }

  public function tampil(){
    if(Auth::user()->level=="admin"){
    $jenis=jenis_model::get();
    $count=$jenis->count();
    $arr_data=array();
    foreach ($jenis as $j){
      $arr_data[]=array(
        'id' => $j->id,
        'jenis_mobil' => $j->jenis_mobil
      );
    }
    $status=1;
    return Response()->json(compact('status','count','arr_data'));
  } else {
    return Response()->json(['status' => 0]);
  }
  }

  public function destroy($id){
    $hapus = jenis_model::where('id', $id)->delete();
    $status=1;
    $message="Hapus Data berhasil";
    if($hapus){
      return Response()->json(compact('status','message'));
    } else {
      return Response()->json(['status' => 0]);
    }
  }
}
