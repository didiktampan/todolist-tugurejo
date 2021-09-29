<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_log') != TRUE) {
			redirect('signin');
		}
    }
    

    public function index()
    {
        $data['token'] = $token = AUTHORIZATION::private_token();
        $this->template->load('layouts/Layouts', 'dashboard/V_transaksi', $data);
    }

    public function availableTt(){
        $final = [];
        $result = [];
        $data = $this->tempatTidur->availableTt();
        $nomor = 0;
        foreach($data as $key => $value){
            $nomor++;
            $waktu = $value->tglswab_akhir === null ? '-':
            date_diff(date_create($value->tglswab_akhir), date_create('now'))->d.' hari lalu';
            $result[] = [
                'nomor' => $nomor,
                'kode_tt' => $value->kode_tt,
                'kode_rs' => $value->kode_rs,
                'nama_rs' => $value->nama_rs,
                'kode_bangsal' => $value->kode_bangsal,
                'nama_bangsal' => $value->nama_bangsal,
                'no_kamar' => $value->no_kamar,
                'no_tt' => $value->no_tt,
                'kode_inden' => $value->kode_inden,
                'id_pasien' => $value->idpasien,
                'no_registrasi' => $value->no_registrasi,
                'nama' => $value->nama,
                'tgllahir' => $value->tgllahir,
                'jeniskel' => $value->jeniskel,
                'alamat' => $value->alamat_ktp,
                'notelp' => $value->notelp,
                'status' => $value->status,
                'status_co' => $value->status_covid,
                'tglswab_akhir' => $waktu,
                'faskes_asal' => $value->faskes_asal,
                'action' => '
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Mutasi"
                    id="btn-mutasi"
                    data-no_registrasi="'.$value->no_registrasi.'"
                    data-jeniskel="'.$value->jeniskel.'">
                        Mutasi
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Pulang"
                    id="btn-pulang"
                    data-no_registrasi="'.$value->no_registrasi.'"
                    data-kode_tt="'.$value->kode_tt.'">
                        Pulang
                    </button>'
            ];
        }
        $final = [
            'aaData' => $result
        ];
        return APIRESPONSE::response('', $final);
    }

}

/* End of file Transaksi.php */
