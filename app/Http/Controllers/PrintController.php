<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class PrintController extends Controller
{
    //
    private $idp;
    private $data;
    private $akun;
    private $invoice;
    private function getData($idp){
        $this->idp = $idp;
        $data = DB::table('d_pendaftaran as i')
        ->join('users as u','u.id', '=', 'i.user_id')
        ->leftJoin('m_provinsi as mp', 'mp.id', '=', 'i.provinsi_id')
        ->leftJoin('m_kabkota as mb', 'mb.id', '=', 'i.kabkota_id')
        ->leftJoin('m_kecamatan as mc', 'mc.id', '=', 'i.kecamatan_id')
        ->leftJoin('m_kelurahan as ml', 'ml.id', '=', 'i.kelurahan_id')
        ->leftJoin('m_agama as ma', 'ma.id', '=', 'i.agama_id')
        ->leftJoin('m_jurusan as mj', 'mj.id', '=', 'i.jurusan_id')
        ->leftJoin('m_jurusan as mj2', 'mj2.id', '=', 'i.jurusan_id2')
        ->leftJoin('m_jurusan as mj3', 'mj3.id', '=', 'i.jurusan_id3')

        ->leftJoin('m_agama as mao', 'mao.id', '=', 'i.ortu_agama_id')
        ->leftJoin('m_provinsi as mpo', 'mpo.id', '=', 'i.provinsi_id')
        ->leftJoin('m_kabkota as mbo', 'mbo.id', '=', 'i.kabkota_id')
        ->leftJoin('d_seleksi_jadwal as sj', 'sj.pendaftaran_id', '=', 'i.id')
        ->leftJoin('d_seleksi_hasil as sh', 'sh.pendaftaran_id', '=', 'i.id')
        ->leftJoin('m_status as ms', 'ms.id', '=', 'sh.status')
        ->leftJoin('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
        ->leftJoin('d_bayar_spp as bs', 'bs.pendaftaran_id', '=', 'i.id')

        ->select('i.*', 'u.name as user', 'mp.nama as provinsi', 'mb.nama as kabkota', 'ma.nama as agama',    'mc.nama as kecamatan', 'ml.nama as kelurahan',
        'mj.nama as jurusan', 'mj2.nama as jurusan2','mj3.nama as jurusan3',
            'mao.nama as ortu_agama', 'mpo.nama as ortu_provinsi', 'mbo.nama as ortu_kabkota', 
            'sj.tanggal as tanggal_ujian', 'sj.jam as jam_ujian', 'sj.ruangan', 'ms.nama as status_seleksi',
             'sh.tanggal_pengumuman', 'sh.status', 'sh.nilai',
             'bs.waktu as waktu_bayar_spp', 'bp.waktu as waktu_bayar_pendaftaran')
        ->where('i.id', '=', $idp)
        ->first();
        $setting = DB::table('d_setting')->first();
        if($data){
            $data = collect($data)->all();
            // dd($data);
            $data['ta'] = $setting->ta_pendaftaran;
            $data['daftar_ulang_awal'] = $setting->daftar_ulang_awal;
            $data['daftar_ulang_akhir'] = $setting->daftar_ulang_akhir;
            $data['qrcode'] = $data['no_daftar'];
            $data['bgdaftar'] = $this->cekLunasDaftar($this->idp) ? url('/bglunas') : url('bgunpaid');
            $data['bgspp'] = $this->cekLunasSpp($this->idp) ? url('/bglunas') : url('bgunpaid');
    
            $akun = collect($this->getAkun($this->idp))->all();
            $this->data  = $data;
            $this->akun = $akun;
        }
        return $data;
    }
    
    private function cekLunasDaftar($id){
        $data = DB::table('d_bayar_pendaftaran')->where('pendaftaran_id', '=', $id)->first();
        return $data ? true : false;
    }
    private function cekLunasSpp($id){
        $data = DB::table('d_bayar_spp')->where('pendaftaran_id', '=', $id)->first();
        return $data ? true : false;
    }
    private function getAkun($idp){
        $data = DB::table('d_pendaftaran')->where('id', '=', $idp)->first();
        $user = auth()->user();
        $akun = DB::table('users as u')->where('u.id', '=', $data->user_id)
        ->join('m_level as l', 'l.id', '=', 'u.level_id')
        ->select('u.*', 'l.nama as level')
        ->first();
        $daftar = DB::table('d_pendaftaran')->where('id', '=', $idp)->first();
        $bayar = DB::table('d_setting')->first();
        $invoice = [];
        $invoice['biaya_pendaftaran'] = number_format($bayar->biaya_pendaftaran, 0, ',', '.');
        $invoice['biaya_spp'] = number_format($bayar->biaya_spp, 0, ',', '.');
        $invoice['terbilang'] = $this->terbilang($bayar->biaya_pendaftaran);
        $invoice['terbilang_spp'] = $this->terbilang($bayar->biaya_spp);
        $invoice['nama_bank'] = $bayar->nama_bank;
        $invoice['nama_rekening'] = $bayar->nama_rekening;
        $invoice['nomor_rekening'] = $bayar->nomor_rekening;
        $this->invoice = $invoice;

        $akun->tanggal_daftar = $daftar ? $daftar->waktu : '';
        $akun->no_daftar = $daftar ? $daftar->no_daftar : '';


        return $akun;
    }
    public function printPendaftaran($idp){
        return view('cetak', ['data'=>$this->getData($idp), 'cetak'=>1]);
    }
    public function printInvoiceDaftar($idp){

        return view('cetak', ['data'=>$this->getData($idp), 'invoice'=>$this->invoice, 'cetak'=>2]);
    }
    public function printKartuUjian($idp){
        return view('cetak', ['data'=>$this->getData($idp), 'cetak'=>3]);
    }
    public function printInvoiceSpp($idp){
        return view('cetak', ['data'=>$this->getData($idp), 'invoice'=>$this->invoice, 'cetak'=>4, 'setting'=>collect(DB::table('d_setting')->first())->all()]);
    }
    public function printJadwal(){
        $data = $this->getDataJadwal();
        return view('cetak', ['jadwal'=>$data, 'cetak'=>5, 'setting'=>DB::table('d_setting')->first()]);
    }
    public function printHasil(){
        $data = $this->getDataHasil();
        return view('cetak', ['hasil'=>$data, 'cetak'=>6, 'setting'=>DB::table('d_setting')->first()]);
    }
    public function getPdfPengumuman($id){
        $set = DB::table('d_setting')->first();
        $ta = $set->ta_pendaftaran;
        $link_syarat_daftar_ulang = $set->link_syarat_daftar_ulang;
        $instansi = $set->instansi;
        $data = $this->pdfPengumuman($id);
        $data['qrcode'] = url('/qr/'.$data['no_daftar']);
        // $view =  view('cetak', ['cetak'=> 7, 'data'=> $data, 'ta'=>$ta, 'link_syarat_daftar_ulang'=>$link_syarat_daftar_ulang, 'instansi'=>$instansi])->render();
        // $pdf = PDF::loadview($view);
        
        $pdf = PDF::loadview('cetak', ['cetak'=> 7, 'data'=> $data, 'ta'=>$ta, 'link_syarat_daftar_ulang'=>$link_syarat_daftar_ulang, 'instansi'=>$instansi]);
    	return $pdf->download('pengumuman_'.$data['no_daftar'].'.pdf');
        // return view('cetak', ['cetak'=> 7, 'data'=> $data, 'ta'=>$ta, 'link_syarat_daftar_ulang'=>$link_syarat_daftar_ulang, 'instansi'=>$instansi]);
    }
    private function pdfPengumuman($id){
        $data = DB::table('d_pendaftaran as p')
                ->join('d_seleksi_hasil as sh', 'sh.pendaftaran_id', '=', 'p.id')
                ->join('m_status as ms', 'ms.id', '=', 'sh.status')
                ->join('m_jurusan as mj', 'mj.id', '=', 'sh.jurusan_id')
                ->select('p.*', 'mj.nama as jurusan', 
                    'sh.tanggal_pengumuman', 'sh.waktu as waktu_pengumuman', 'sh.nilai', 'sh.status',
                    'ms.nama as status_keterangan')
                ->where('p.id', '=', $id)
                ->first();
        return $data ? collect($data)->all() : null;
    }
    private function getDataJadwal(){
        $data = DB::table('d_pendaftaran as i')
        ->join('m_jurusan as j', 'j.id', '=', 'i.jurusan_id')
            ->join('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
            ->leftJoin('d_seleksi_jadwal as sj','sj.pendaftaran_id','=', 'i.id')
            ->select('i.*', 'j.nama as jurusan',  'sj.tanggal', 'sj.jam', 'sj.ruangan')
            ->orderBy('sj.tanggal', 'asc')
            ->orderBy('sj.ruangan', 'asc')
            ->orderBy('i.no_daftar', 'asc')
            ->get();
        
        
        $cdata = collect($data)->groupBy('tanggal')->all();
        $data = [];
        foreach ($cdata as $key => $value) {
            $cjam = collect($value)->groupBy('jam')->all();
            foreach ($cjam as $keyj => $valuej) {
                $cruangan = collect($valuej)->groupBy('ruangan')->all();
                foreach ($cruangan as $keyr => $valuer) {
                    array_push($data, [
                        'tanggal'=> $key,
                        'jam' => $keyj,
                        'ruangan' => $keyr,
                        'data' => $valuer,
                    ]);
                }
            }
        }
        return $data;
    }
    private function getDataHasil(){
        $data = DB::table('d_pendaftaran as i')
        ->join('m_jurusan as j', 'j.id', '=', 'i.jurusan_id')
            ->join('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
            ->join('d_seleksi_jadwal as sj','sj.pendaftaran_id','=', 'i.id')
            ->leftJoin('d_seleksi_hasil as sh','sh.pendaftaran_id','=', 'i.id')
            ->leftJoin('m_status as ms', 'ms.id', '=', 'sh.status')
            ->select('i.*', 'j.nama as jurusan',  'sj.tanggal', 'sj.jam', 'sj.ruangan', 'sh.nilai', 'ms.nama as status')
            ->orderBy('sj.tanggal', 'asc')
            ->orderBy('sj.ruangan', 'asc')
            ->orderBy('i.no_daftar', 'asc')
            ->get();
        
        
        $cdata = collect($data)->groupBy('tanggal')->all();
        $data = [];
        foreach ($cdata as $key => $value) {
            $cjam = collect($value)->groupBy('jam')->all();
            foreach ($cjam as $keyj => $valuej) {
                $cruangan = collect($valuej)->groupBy('ruangan')->all();
                foreach ($cruangan as $keyr => $valuer) {
                    array_push($data, [
                        'tanggal'=> $key,
                        'jam' => $keyj,
                        'ruangan' => $keyr,
                        'data' => $valuer,
                    ]);
                }
            }
        }
        return $data;
    }
    private function penyebut($nilai){
        $nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
    }
    function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return ucwords($hasil).' Rupiah';
	}
    
}
