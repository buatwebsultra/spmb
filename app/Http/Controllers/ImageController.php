<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
class ImageController extends Controller
{
    //
    public function image($filename){
        $path = storage_path('app/images/').$filename;
        if (!file_exists($path)) $path = storage_path('app/public/images/').$filename;
        if (!file_exists($path)) $path = public_path('images/').$filename;
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('jpg');
    }

    public function photo($filename){
        $path = storage_path('app/photo/').$filename;
        if (!file_exists($path)) $path = public_path('photo/').$filename;
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('jpg');
    }
    public function ijazah($filename){
        $path = storage_path('app/ijazah/').$filename;
        if (!file_exists($path)) $path = public_path('ijazah/').$filename;
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('jpg');
    }
    public function transkip($filename){
        $path = storage_path('app/transkip/').$filename;
        if (!file_exists($path)) $path = public_path('transkip/').$filename;
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('jpg');
    }
    public function ortuTtd($filename){
        $path = storage_path('app/ortu_ttd/').$filename;
        if (!file_exists($path)) $path = public_path('ortu_ttd/').$filename;
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('png');
    }
    public function mabaTtd($filename){
        $path = storage_path('app/ttd/').$filename;
        if (!file_exists($path)) $path = public_path('ttd/').$filename;
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('png');
    }
    public function bglunas(){
        $path = storage_path('app/lunas.png');
        if (!file_exists($path)) $path = public_path('images/lunas.png');
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('png');
    }
    public function bgunpaid(){
        $path = storage_path('app/unpaid.png');
        if (!file_exists($path)) $path = public_path('images/unpaid.png');
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('png');
    }
    public function bghead(){
        $set = DB::table('d_setting')->first();
        if($set->bg_head==null) {
            $path = storage_path('app/maba.jpg');
            if (!file_exists($path)) $path = public_path('images/maba.jpg');
        } else {
            $path = storage_path('app/bghead/'.$set->bg_head);
            if (!file_exists($path)) $path = storage_path('app/public/bghead/'.$set->bg_head);
            if (!file_exists($path)) $path = public_path('bghead/'.$set->bg_head);
        }
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('jpg');
    }
    public function logo(){
        $set = DB::table('d_setting')->first();
        $path = storage_path('app/logo/'.$set->logo_app);
        if (!file_exists($path)) $path = storage_path('app/public/logo/'.$set->logo_app);
        if (!file_exists($path)) $path = public_path('logo/'.$set->logo_app);
        if (!file_exists($path)) abort(404);
        $img =  Image::make($path);
        return $img->response('png');
    }
    public function upload(Request $request){
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(storage_path('app/images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = url('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 

            // $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            // @header('Content-type: text/html; charset=utf-8'); 
            // echo $response;
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
