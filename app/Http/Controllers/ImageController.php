<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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

    public function photo($image){
        $image = basename($image);
        if (!$this->checkPermission($image)) {
            abort(403, 'Unauthorized access to student photo.');
        }

        $paths = [
            storage_path('app/photo/'.$image),
            public_path('app/photo/'.$image),
            public_path('photo/'.$image)
        ];
        foreach ($paths as $path) {
            if (File::exists($path)) return response()->file($path);
        }
        abort(404);
    }
    public function ijazah($image){
        $image = basename($image);
        if (!$this->checkPermission($image)) {
            abort(403, 'Unauthorized access to student ijazah.');
        }

        $paths = [
            storage_path('app/ijazah/'.$image),
            public_path('app/ijazah/'.$image),
            public_path('ijazah/'.$image)
        ];
        foreach ($paths as $path) {
            if (File::exists($path)) return response()->file($path);
        }
        abort(404);
    }
    public function transkip($image){
        $image = basename($image);
        if (!$this->checkPermission($image)) {
            abort(403, 'Unauthorized access to student transkip.');
        }

        $paths = [
            storage_path('app/transkip/'.$image),
            public_path('app/transkip/'.$image),
            public_path('transkip/'.$image)
        ];
        foreach ($paths as $path) {
            if (File::exists($path)) return response()->file($path);
        }
        abort(404);
    }
    public function ortuTtd($image){
        $image = basename($image);
        if (!$this->checkPermission($image)) {
            abort(403, 'Unauthorized access to signature file.');
        }

        $paths = [
            storage_path('app/ortu_ttd/'.$image),
            public_path('app/ortu_ttd/'.$image),
            public_path('ortu_ttd/'.$image)
        ];
        foreach ($paths as $path) {
            if (File::exists($path)) return response()->file($path);
        }
        abort(404);
    }
    public function mabaTtd($image){
        $image = basename($image);
        if (!$this->checkPermission($image)) {
            abort(403, 'Unauthorized access to signature file.');
        }

        $paths = [
            storage_path('app/ttd/'.$image),
            public_path('app/ttd/'.$image),
            public_path('ttd/'.$image)
        ];
        foreach ($paths as $path) {
            if (File::exists($path)) return response()->file($path);
        }
        abort(404);
    }
    public function bglunas(){
        $paths = [
            storage_path('app/lunas.png'),
            public_path('images/lunas.png')
        ];
        foreach ($paths as $path) {
            if (File::exists($path)) return response()->file($path);
        }
        abort(404);
    }
    public function bgunpaid(){
        $paths = [
            storage_path('app/unpaid.png'),
            public_path('images/unpaid.png')
        ];
        foreach ($paths as $path) {
            if (File::exists($path)) return response()->file($path);
        }
        abort(404);
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
        if (!$set || !$set->logo_app) abort(404);
        
        $logo = trim($set->logo_app);
        $paths = [
            public_path('logo/'.$logo),
            storage_path('app/public/logo/'.$logo),
            storage_path('app/logo/'.$logo),
            public_path('storage/logo/'.$logo),
            public_path('app/logo/'.$logo)
        ];
        
        foreach ($paths as $path) {
            if (File::exists($path)) {
                return response()->file($path, [
                    'Content-Type' => File::mimeType($path),
                    'Cache-Control' => 'no-cache, must-revalidate'
                ]);
            }
        }
        
        abort(404);
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

    private function checkPermission($image)
    {
        if (!auth()->check()) {
            return false;
        }

        $user = auth()->user();
        if ($user->level_id == 1) { // Admin
            return true;
        }

        if ($user->pendaftaran_id) {
            $pendaftaran = DB::table('d_pendaftaran')->where('id', $user->pendaftaran_id)->first();
            // Check if the filename starts with the user's no_daftar
            if ($pendaftaran && strpos($image, $pendaftaran->no_daftar) === 0) {
                return true;
            }
        }

        return false;
    }
}
