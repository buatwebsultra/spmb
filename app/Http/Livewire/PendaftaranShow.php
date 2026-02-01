<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranShow extends Component
{
    public $idp;
    protected $queryString = ['idp'];
    public $data;
    public $akun;
    public $invoice = [];
    public $setting;

    public function render()
    {

        $setting = DB::table('d_setting')->first();
        $this->setting = collect($setting)->all();
        $data = $this->getData($this->idp);
        if($data){
            $data = collect($data)->all();
            // dd($data);
            $data['ta'] = $setting->ta_pendaftaran;
            $data['daftar_ulang_awal'] = $setting->daftar_ulang_awal;
            $data['daftar_ulang_akhir'] = $setting->daftar_ulang_akhir;
            $data['qrcode'] = url('/qr/'.$data['no_daftar']);
            $data['bgdaftar'] = $this->cekLunasDaftar($this->idp) ? url('/bglunas') : url('bgunpaid');
            $data['bgspp'] = $this->cekLunasSpp($this->idp) ? url('/bglunas') : url('bgunpaid');
    
            $akun = collect($this->getAkun($this->idp))->all();
            $this->data  = $data;
            $this->akun = $akun;
        }else{
            $this->akun = collect(
                DB::table('users as u')->where('u.id', '=', auth()->user()->id)
                ->join('m_level as l', 'l.id', '=', 'u.level_id')
                ->select('u.*', 'l.nama as level')
                ->first()
            );
        }
        

        return view('livewire.pendaftaran-show')
        ->extends('layouts.app')
        ->section('content');
    }
    private function cekLunasDaftar($id){
        $data = DB::table('d_bayar_pendaftaran')->where('pendaftaran_id', '=', $id)->first();
        return $data ? true : false;
    }
    private function cekLunasSpp($id){
        $data = DB::table('d_bayar_spp')->where('pendaftaran_id', '=', $id)->first();
        return $data ? true : false;
    }
    private function getData($idp){
        return DB::table('d_pendaftaran as i')
        ->join('users as u','u.id', '=', 'i.user_id')
        ->leftJoin('m_provinsi as mp', 'mp.id', '=', 'i.provinsi_id')
        ->leftJoin('m_kabkota as mb', 'mb.id', '=', 'i.kabkota_id')
        ->leftJoin('m_kecamatan as mc', 'mc.id', '=', 'i.kecamatan_id')
        ->leftJoin('m_kelurahan as ml', 'ml.id', '=', 'i.kelurahan_id')
        ->leftJoin('m_agama as ma', 'ma.id', '=', 'i.agama_id')
        ->leftJoin('m_jurusan as mj', 'mj.id', '=', 'i.jurusan_id')
        ->leftJoin('m_jurusan as mj2', 'mj2.id', '=', 'i.jurusan_id2')
        ->leftJoin('m_jurusan as mj3', 'mj3.id', '=', 'i.jurusan_id3')
        ->leftJoin('m_jurusan as mjl', 'mjl.id', '=', 'i.jurusan_id_lulus')

        ->leftJoin('m_agama as mao', 'mao.id', '=', 'i.ortu_agama_id')
        ->leftJoin('m_provinsi as mpo', 'mpo.id', '=', 'i.provinsi_id')
        ->leftJoin('m_kabkota as mbo', 'mbo.id', '=', 'i.kabkota_id')
        ->leftJoin('d_seleksi_jadwal as sj', 'sj.pendaftaran_id', '=', 'i.id')
        ->leftJoin('d_seleksi_hasil as sh', 'sh.pendaftaran_id', '=', 'i.id')
        ->leftJoin('m_status as ms', 'ms.id', '=', 'sh.status')
        ->leftJoin('d_bayar_pendaftaran as bp', 'bp.pendaftaran_id', '=', 'i.id')
        ->leftJoin('d_bayar_spp as bs', 'bs.pendaftaran_id', '=', 'i.id')

        ->select('i.*', 'u.name as user', 'mp.nama as provinsi', 'mb.nama as kabkota', 'ma.nama as agama',   'mc.nama as kecamatan', 'ml.nama as kelurahan',
            'mj.nama as jurusan', 'mj2.nama as jurusan2','mj3.nama as jurusan3', 'mjl.nama as jurusan_lulus',

            'mao.nama as ortu_agama', 'mpo.nama as ortu_provinsi', 'mbo.nama as ortu_kabkota', 
            'sj.tanggal as tanggal_ujian', 'sj.jam as jam_ujian', 'sj.ruangan', 'ms.nama as status_seleksi',
             'sh.tanggal_pengumuman', 'sh.status', 'sh.nilai',
             'bs.jumlah as biaya_jumlah', 'bs.spp as biaya_spp' ,'bs.pendidikan as biaya_pendidikan', 'bs.almamater as biaya_almamater', 'bs.lain as biaya_lain',
             'bs.waktu as waktu_bayar_spp', 'bp.waktu as waktu_bayar_pendaftaran'
             )
        ->where('i.id', '=', $idp)
        ->first();
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
        $jumlah = $bayar->biaya_spp + $bayar->biaya_pendidikan + $bayar->biaya_almamater + $bayar->biaya_lain;

        $invoice['biaya_jumlah'] = number_format($jumlah, 0, ',', '.');
        $invoice['biaya_spp'] = number_format($bayar->biaya_spp, 0, ',', '.');
        $invoice['biaya_pendidikan'] = number_format($bayar->biaya_pendidikan, 0, ',', '.');
        $invoice['biaya_almamater'] = number_format($bayar->biaya_almamater, 0, ',', '.');
        $invoice['biaya_lain'] = number_format($bayar->biaya_lain, 0, ',', '.');

        $invoice['terbilang'] = $this->terbilang($bayar->biaya_pendaftaran);
        $invoice['terbilang_jumlah'] = $this->terbilang($jumlah);
        $invoice['nama_bank'] = $bayar->nama_bank;
        $invoice['nama_rekening'] = $bayar->nama_rekening;
        $invoice['nomor_rekening'] = $bayar->nomor_rekening;

        $this->invoice = $invoice;

        $akun->tanggal_daftar = $daftar ? $daftar->waktu : '';
        $akun->no_daftar = $daftar ? $daftar->no_daftar : '';


        return $akun;
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
    public function cetak(){
        // $pdf = Pdf::loadView('pdf.form-pendaftaran');
        // return $pdf->download('pendaftaran.pdf');
        $data = $this->getData($this->idp);
        if($data){
            $setting = DB::table('d_setting')->first();
            $no_daftar = $data->no_daftar;
            $data = collect($data)->all();
            $data['ta'] = $setting->ta_pendaftaran;
            $data['daftar_ulang_awal'] = $setting->daftar_ulang_awal;
            $data['daftar_ulang_akhir'] = $setting->daftar_ulang_akhir;
            $data['qrcode'] = $data['no_daftar'];
            $data['bgdaftar'] = $this->cekLunasDaftar($this->idp) ? url('/bglunas') : url('bgunpaid');
            $data['bgspp'] = $this->cekLunasSpp($this->idp) ? url('/bglunas') : url('bgunpaid');
            $filename = 'FORM_PENDAFTARAN_'.$no_daftar.'.pdf';

            $pdfc = PDF::loadView('pdf.form-pendaftaran', ['data' => $data]);
            // return response()->streamDownload(
            //     fn () => print($pdfContent), 'FORM_PENDAFTARAN_'.$no_daftar.".pdf"
            // );
            // $html = view('pdf.form-pendaftaran', ['data' => $data])->render();
            // return response()->streamDownload(function () {
            //     $pdf = App::make('dompdf.wrapper');
            //     $pdf->loadHTML($html);
            //     echo $pdf->stream();
            // },  $filename);
            // $pdfc = Pdf::loadHTML($html);
               
            // return response()->streamDownload(fn () => print($pdf), $filename);
            $pdfc->save(storage_path('/app/pdf/'.$filename));
            // return $pdfc->stream();
        }
        
    }
    public function edit(){
        return redirect()->to('/pendaftaran/form?idp='.$this->idp);
    }
    public function upload(){
        return redirect()->to('/pendaftaran/upload?idp='.$this->idp);
    }
}
