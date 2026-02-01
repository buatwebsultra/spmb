<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
class ImageController extends Controller
{
    //
    public function image($filename){
        $img =  Image::make(storage_path('app/images/').$filename);
        return $img->response('jpg');
    }
    public function photo($filename){
        $img =  Image::make(storage_path('app/photo/').$filename);
        return $img->response('jpg');
    }
    public function ijazah($filename){
        $img =  Image::make(storage_path('app/ijazah/').$filename);
        return $img->response('jpg');
    }
    public function transkip($filename){
        $img =  Image::make(storage_path('app/transkip/').$filename);
        return $img->response('jpg');
    }
    public function ortuTtd($filename){
        $img =  Image::make(storage_path('app/ortu_ttd/').$filename);
        return $img->response('png');
    }
    public function mabaTtd($filename){
        $img =  Image::make(storage_path('app/ttd/').$filename);
        return $img->response('png');
    }
    public function bglunas(){
        $img =  Image::make(storage_path('app/lunas.png'));
        return $img->response('png');
    }
    public function bgunpaid(){
        $img =  Image::make(storage_path('app/unpaid.png'));
        return $img->response('png');
    }
    public function bghead(){
        $set = DB::table('d_setting')->first();
        if($set->bg_head==null) $img =  Image::make(storage_path('app/maba.jpg'));
        $img =  Image::make(storage_path('app/bghead/'.$set->bg_head));
        return $img->response('jpg');
    }
    public function logo(){
        $set = DB::table('d_setting')->first();
        // if($set->bg_head==null) $img =  Image::make(storage_path('app/maba.jpg'));
        $img =  Image::make(storage_path('app/logo/'.$set->logo_app));
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
